;(function ($, window, document, undefined) {
    var $win = $(window);
    var $doc = $(document);
    var $body = $('body');


    var $datePicker = $body.find( "#datepicker" ),
        $register_form = $body.find('.registration-wrapper'),
        dz_upload1, dz_upload2, dz_upload3,dz_upload4,
        $dz_upload1 = $body.find('#dz_upload1'),
        $dz_upload2 = $body.find("#dz_upload2"),
        $dz_upload3 = $body.find("#dz_upload3"),
        $dz_upload4 = $body.find("#dz_upload4"),
        $md_expire_date = $body.find('#expired-date'),
        $datepickerDMY = $body.find( "#datepicker-dmy" ),
        $datepicker = $body.find( "#datepicker" ),
        $datepickerReg = $body.find( "#datepicke-reg" ),
        $expired_date = $body.find( "#expired_date" ),
        today = new Date();


    function setClassOnCondition($elem, condition) {
        //alert(condition);
        if (condition) {
            $elem.addClass('validation-success').removeClass('validation-error');
        } else {
            $elem.addClass('validation-error').removeClass('validation-success');
        }
    }

    $doc.ready(function () {


        $('body').bind('click', function(e) {
            if($(e.target).closest('.navbar-toggler').length == 0) {
                var opened = $('.navbar-collapse').hasClass('collapse');
                if ( opened === true ) {
                    $('.navbar-collapse').collapse('hide');
                }
            }
        });

        var slider = $(".slider-area");

        slider.slick({
            dots: true,
            arrows: false,
            infinite: true,
            speed: 500,
            autoplay: false,
            autoplaySpeed: 2000,
            pauseOnHover: false
        });
        slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            $(slick.$slides).removeClass('is-animating');
        });

        slider.on('afterChange', function(event, slick, currentSlide, nextSlide) {
            $(slick.$slides.get(currentSlide)).addClass('is-animating');
        });

        $(".centrer-slider").slick({
            dots: false,
            infinite: true,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow:"<button type='button' class='slick-prev pull-left'><i class='pe-7s-angle-left  pe-2x pe-va' aria-hidden='true'></i></button>",
            nextArrow:"<button type='button' class='slick-next pull-right'><i class='pe-7s-angle-right  pe-2x pe-va' aria-hidden='true'></i></button>",
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {


                        slidesToShow: 1
                    }
                }
            ]

        });

        $('.acc_container').hide();

        $('.strength_selection .acc_trigger').click(function(){
            $('.full-wait').show();
            var price_range_array = [];
            var $this = $(this), thisActive = $this.hasClass('active'), active, strength;
            if (thisActive) {
                $this.removeClass('active');
                strength = '';
            }
            else {
                active = $('.acc_trigger.active');
                if (active.length === 1) {
                    active.removeClass('active');
                }
                $this.addClass('active');
                strength = $this.text();
            }
            price_range_array.push(parseInt($('.price-filter p .min-value').text()));
            price_range_array.push(parseInt($('.price-filter p .max-value').text()));
            var order_by = $('.sort-by #order_by option:selected').val();
            $.ajax({
                method: 'POST',
                url: js_var.ajax_url,
                data: { action: "filter_category_listing_product", price_range: JSON.stringify(price_range_array), strength: strength, order_by: order_by},
                dataType: "json",
                async:false,
                success: function (msg) {
                    $('.full-wait').hide();
                    if(msg.output){
                        $('.cat_list_container').html(msg.output);
                    }else{
                        $('.cat_list_container').html('<h2 class="mt-4">Nothings found!</h2>');
                    }
                }
            });

        });

        $('.strength_selection_cat .acc_trigger').click(function(){
            $('.full-wait').show();
            var price_range_array = [];
            var $this = $(this), thisActive = $this.hasClass('active'), active, strength;
            if (thisActive) {
                $this.removeClass('active');
                strength = '';
            }
            else {
                active = $('.acc_trigger.active');
                if (active.length === 1) {
                    active.removeClass('active');
                }
                $this.addClass('active');
                strength = $this.text();
            }
            price_range_array.push(parseInt($('.price-filter p .min-value').text()));
            price_range_array.push(parseInt($('.price-filter p .max-value').text()));
            var order_by = $('.sort-by #order_by option:selected').val();
            var taxonomy = $this.attr('data-taxonomy');
            var trmid = $this.attr('data-trmid');
            $.ajax({
                method: 'POST',
                url: js_var.ajax_url,
                data: { action: "filter_single_category_product", price_range: JSON.stringify(price_range_array), strength: strength, order_by: order_by, taxonomy: taxonomy, trmid: trmid},
                dataType: "json",
                async:false,
                success: function (msg) {
                    $('.full-wait').hide();
                    if(msg.output){
                        $('.cat-items').html(msg.output);
                    }else{
                        $('.cat-items').html('<h2 class="mt-4">Nothings found!</h2>');
                    }
                }
            });

        });

        $('.sub_cat').click(function(){
            var $this = $(this),
                thisActive = $this.hasClass('active'),
                active;
            if (thisActive) {
                $this.removeClass('active');
            }
            else {
                active = $('.sub_cat.active');
                if (active.length === 1) {
                    active.removeClass('active');
                }
                $this.addClass('active');
            }
        });

        $('.pe-lg').click(function(){
            var $this = $(this),
                thisActive = $this.hasClass('active'),
                active;
            $this.addClass('pe-7s-angle-down');
            $this.removeClass('pe-7s-angle-up');
            // If this one is active, we always just close it.

            if (thisActive) {
                $this.removeClass('active').parents('li').find('.acc_container').slideUp();
                $this.parents('li').removeClass('active');
            }
            else {
                // Is there just one active?
                active = $('.pe-lg.active');
                if (active.length === 1) {
                    // Yes, close it
                    active.removeClass('active').parents('li').find('.acc_container').slideUp();
                    $this.parents('li').removeClass('active');
                    active.addClass('pe-7s-angle-down');
                    active.removeClass('pe-7s-angle-up');
                }

                // Open this one

                $this.addClass('active').parents('li').find('.acc_container').slideDown();
                $this.parents('li').addClass('active');
                $this.removeClass('pe-7s-angle-down');
                $this.addClass('pe-7s-angle-up');
            }
        });

        $('.category_selection li.active').find('.acc_container').slideDown();

        if($('.input-range').length > 0) {
            $this = $( '.input-range');
            var value = $this.attr('data-slider-value');
            var separator = value.indexOf(',');
            if (separator !== -1) {
                value = value.split(',');
                value.forEach(function (item, i, arr) {
                    arr[i] = parseFloat(item);
                });
            } else {
                value = parseFloat(value);
            }
            $this.slider({
                formatter: function (value) {
                    //alert(value);
                    return value;
                },
                min: parseFloat($this.attr('data-slider-min')),
                max: parseFloat($this.attr('data-slider-max')),
                range: $this.attr('data-slider-range'),
                value: value,
                tooltip_split: $this.attr('data-slider-tooltip_split'),
                tooltip: $this.attr('data-slider-tooltip')
            }).on('change', change);


            var originalVal;
            var strength;

            $this.slider().on('slideStart', function(ev){
                originalVal = $this.data('slider').getValue();
            });
            $this.slider().on('slideStop', function(ev){
                $('.full-wait').show();
                var newVal = $this.data('slider').getValue();
                if(originalVal != newVal) {

                    var order_by = $('.sort-by #order_by option:selected').val();

                    var taxonomy = $('.sort-by #order_by').attr('data-taxonomy');
                    var trmid = $('.sort-by #order_by').attr('data-trmid');

                    if(trmid === undefined || trmid === null){
                        if ($('.strength_selection li').find('a').hasClass('active')) {
                            strength = $('.strength_selection li a.active').text();
                        }
                        if (strength === undefined || strength === null) {
                            $.ajax({
                                method: 'POST',
                                url: js_var.ajax_url,
                                data: {
                                    action: "filter_category_listing_product",
                                    price_range: JSON.stringify(newVal),
                                    strength: '',
                                    order_by: order_by
                                },
                                dataType: "json",
                                async: false,
                                success: function (msg) {
                                    $('.full-wait').hide();
                                    if (msg.output) {
                                        $('.cat_list_container').html(msg.output);
                                    }
                                }
                            });
                        } else {
                            $.ajax({
                                method: 'POST',
                                url: js_var.ajax_url,
                                data: {
                                    action: "filter_category_listing_product",
                                    price_range: JSON.stringify(newVal),
                                    strength: strength,
                                    order_by: order_by
                                },
                                dataType: "json",
                                async: false,
                                success: function (msg) {
                                    $('.full-wait').hide();
                                    if (msg.output) {
                                        $('.cat_list_container').html(msg.output);
                                    }
                                }
                            });
                        }
                    }else{
                        if ($('.strength_selection li').find('a').hasClass('active')) {
                            strength = $('.strength_selection li a.active').text();
                        }
                        if (strength === undefined || strength === null) {
                            $.ajax({
                                method: 'POST',
                                url: js_var.ajax_url,
                                data: {
                                    action: "filter_single_category_product",
                                    price_range: JSON.stringify(newVal),
                                    strength: '',
                                    order_by: order_by,
                                    taxonomy: taxonomy,
                                    trmid: trmid
                                },
                                dataType: "json",
                                async: false,
                                success: function (msg) {
                                    $('.full-wait').hide();
                                    if (msg.output) {
                                        $('.cat-items').html(msg.output);
                                    }
                                }
                            });
                        } else {
                            $.ajax({
                                method: 'POST',
                                url: js_var.ajax_url,
                                data: {
                                    action: "filter_single_category_product",
                                    price_range: JSON.stringify(newVal),
                                    strength: strength,
                                    order_by: order_by,
                                    taxonomy: taxonomy,
                                    trmid: trmid
                                },
                                dataType: "json",
                                async: false,
                                success: function (msg) {
                                    $('.full-wait').hide();
                                    if (msg.output) {
                                        $('.cat-items').html(msg.output);
                                    }
                                }
                            });
                        }
                    }
                }
            });

        }

        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            fade: true,
            asNavFor: '.flex-control-nav',
            accesibility: false,
            draggable: false,
            swipe: false,
            touchMove: false
        });
        $('.flex-control-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            arrows: false,
            focusOnSelect: true
        });

        var  triger = $('.review-box').find('ul>li.active i');

        if (triger.length > 0) {
            triger.removeClass('fa-star-o');
            triger.addClass('fa-star');
        }

        function increaseValue() {
            var value = parseInt(document.getElementById('quantity').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
             document.getElementById('quantity').value = value;
        }

        function decreaseValue() {
            var value = parseInt(document.getElementById('quantity').value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            document.getElementById('quantity').value = value;
        }

        $('.increase').click(function(){
            increaseValue();
        });
        $('.decrease').click(function(){
            decreaseValue();
        });

        var current_i = 1;
        $(".review-block .media:lt(4)").addClass('d-flex');
        var total_items = $(".review-block .media").length;
        if(total_items <= 4){
            $('.review-block .text-center').addClass('d-none');
        }
        $('.load-more').click(function(){
            current_i++;
            var cnoi = 4 * current_i;
            $(".review-block .media:lt(" + cnoi + ")").addClass('d-flex');
            if(cnoi >= total_items){
                $('.review-block .text-center a').removeClass('load-more').addClass('no-more');
                $('.review-block .text-center a').text('No More to Load');
            }
        });

        $datePicker.datepicker({
            changeMonth: true,
            yearRange: "1960:2050",
            changeYear: true,
            directionReverse: false,
            onClose:function(){
                $(this).trigger('blur');
            },
        });

        var addreviewbtn= $('.addReview').find('.addreviewbtn');
        //var addreviewForm = $('.add-review-form');
        //addreviewForm.hide();
        addreviewbtn.on( 'click', function () {
            //addreviewForm.show();
            //addreviewbtn.hide();

        });

        var  variation = $('.variation').find('p');
        var  variation_add_to_cart = $('.deal-info-box').find('.add-to-cart');

        variation.on( 'click', function () {
            $('.viw-crd').remove();
            variation.parent('li.active').removeClass('active');
            $(this).parent('li').addClass('active');
            variation_add_to_cart.removeAttr('disabled');
            $('.cus_ajax_add_to_cart').attr('data-vid',$(this).attr('data-variation_id'));
            $('.cus_ajax_add_to_cart').attr('data-attribute',$(this).attr('data-attribute'));

            if($('.summary.entry-summary .price').length > 0){
                $('.summary.entry-summary .price .woocommerce-Price-amount.amount').text($(this).parent('li').find('.price-container').text());
            }

        });



        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        };
        var atci = getUrlParameter('add-to-cart');
        if(atci){
            $('#vid-'+atci+' p').trigger('click');
        }
        //deleteCookie('Age_Verified');
        if (getCookie("Age_Verified") != "true") {
            $("#myModal").modal({backdrop: 'static', keyboard: false, show: true})
        }
        // Age Enter
        $body.on("click", '.enter-btn', function (e) {
            e.preventDefault();
            SetCookieForAge();
            $("#myModal").modal("hide");
        });

        // Age Exit
        $body.on("click", '.exit-btn', function (e) {
            e.preventDefault();
            window.location.replace("https://www.google.com/");
        });

        $( ".sort-by #order_by" ).change(function(e) {
            e.preventDefault();
            var price_range_array = [];
            var order_by = $('.sort-by #order_by option:selected').val();
            var taxonomy = $('.sort-by #order_by').attr('data-taxonomy');
            var trmid = $('.sort-by #order_by').attr('data-trmid');
            price_range_array.push(parseInt($('.price-filter p .min-value').text()));
            price_range_array.push(parseInt($('.price-filter p .max-value').text()));
            if($('.strength_selection li').find('a').hasClass('active')){
                strength = $('.strength_selection li a.active').text();
            }
            if (strength === undefined || strength === null) {
                strength = '';
            }
            //added for prevent strength sorting
            strength = '';
            //end
            if(trmid === undefined || trmid === null){
                $.ajax({
                    method: 'POST',
                    url: js_var.ajax_url,
                    data: { action: "filter_category_listing_product", price_range: JSON.stringify(price_range_array), strength: strength, order_by: order_by},
                    dataType: "json",
                    async:false,
                    success: function (msg) {
                        $('.full-wait').hide();
                        if(msg.output){
                            $('.cat_list_container').html(msg.output);
                        }else{
                            $('.cat_list_container').html('<h2 class="mt-4">Nothings found!</h2>');
                        }
                    }
                });
            }else {
                $.ajax({
                    method: 'POST',
                    url: js_var.ajax_url,
                    data: {
                        action: "filter_single_category_product",
                        price_range: JSON.stringify(price_range_array),
                        strength: strength,
                        order_by: order_by,
                        taxonomy: taxonomy,
                        trmid: trmid
                    },
                    dataType: "json",
                    async: false,
                    success: function (msg) {
                        $('.full-wait').hide();
                        if (msg.output) {
                            $('.cat-items').html(msg.output);
                        } else {
                            $('.cat-items').html('<h2 class="mt-4">Nothings found!</h2>');
                        }
                    }
                });
            }
        });

        var orderField = $(".order-field");
        orderField.hide();
        $(".radio input[type='radio']").click(function(){
            var that = $(this).val();
            orderField.hide();
            if( that == 'order-support' ){
                orderField.show();
            }
        });
        $body.on("click", '.cus_ajax_add_to_cart', function (e) {
            e.preventDefault();
            $('.viw-crd').remove();
            var pid = $(this).attr('data-pid');
            var vid = $(this).attr('data-vid');
            var attributes = $(this).attr('data-attribute');
            var quantity = $(this).parent().find('.quantity input').val();
            if(quantity === undefined || quantity === null) {
                if (pid) {
                    $.ajax({
                        method: 'POST',
                        url: js_var.ajax_url,
                        data: {action: "variable_product_ajax_add_to_cart", pid: pid, vid: vid, attribute: attributes, quantity: 1},
                        dataType: "json",
                        async: false,
                        success: function (response) {
                            $('.deal-info-box').append(response.view_cart);
                        }
                    });
                }
            }else{
                if (pid) {
                    $.ajax({
                        method: 'POST',
                        url: js_var.ajax_url,
                        data: {action: "variable_product_ajax_add_to_cart", pid: pid, vid: vid, attribute: attributes, quantity: quantity},
                        dataType: "json",
                        async: false,
                        success: function (response) {
                            $('.single_add_tc').append(response.view_cart);
                        }
                    });
                }
            }
        });

        if($('.load-more2').length > 0){
        }else{
            $('.hide-con').removeClass('d-none');
        }

        $body.on("click", '.load-more2', function (e) {
            e.preventDefault();
            $('.full-wait').show();
            $obj = $(this);
            var trmid = $obj.attr('data-trmid');
            var taxonomy = $obj.attr('data-taxonomy');
            var show_num_of_itm_def = $obj.attr('data-dnoi');
            var curpageid = $obj.attr('data-curpageid');
            if(trmid){
                $.ajax({
                    method: 'POST',
                    url: js_var.ajax_url,
                    data: { action: "load_all_products_by_category", trmid: trmid, taxonomy: taxonomy, show_num_of_itm_def:  show_num_of_itm_def, curpageid:  curpageid},
                    dataType: "json",
                    async:false,
                    success: function (msg) {
                        $('.full-wait').hide();
                        var out = msg.output;

                        if (!out.trim()) {
                            $obj.hide('slow');
                            $('.hide-con').removeClass('d-none');
                        }else{
                            $obj.attr('data-curpageid', msg.curpageid);
                            $obj.parent().find(".cat-items").append(out);
                            if(msg.nomoretoload){
                                $('.hide-con').removeClass('d-none');
                                $obj.hide('slow');
                            }
                        }
                    }
                });
            }
        });

        $body.on("mouseover", '.sub-review ul li', function (e) {
            $('.sub-review ul li a i').removeClass('fa-star').addClass('fa-star-o');
            for (var i = 0; i <= $(this).index(); i++) {
                $('.sub-review ul li').eq(i).find('a i').removeClass('fa-star-o').addClass('fa-star');
            }
        });
        $body.on("mouseleave", '.sub-review ul li', function (e) {
            $('.sub-review ul li a i').removeClass('fa-star').addClass('fa-star-o');
        });

        $body.on("click", '.sub-review ul li', function (e) {
            e.preventDefault();
            $('.sub-review ul li').removeClass('active');
            for (var i = 0; i <= $(this).index(); i++) {
                $('.sub-review ul li').eq(i).addClass('active');
            }
            $('#rate_value').val($(this).index() + 1);
        });

        $body.on("click", '#comment_sub', function (e) {
            e.preventDefault();
            $frm = $('#review_frm');
            var comment_post_ID = $('#comment_post_ID').val();
            var rate_value = $('#rate_value').val();
            var reviewer_name = $('#reviewer_name').val();
            var reviewer_email = $('#reviewer_email').val();
            var comment = $('#comment').val();

            $.ajax({
                method: 'POST',
                url: js_var.ajax_url,
                data: { action: "save_review", pid: comment_post_ID, rate_value: rate_value, reviewer_name: reviewer_name, reviewer_email: reviewer_email, comment: comment},
                dataType: "json",
                async:false,
                success: function (response) {
                    if(response.status == 1) {
                        $('.add-review-form .alert-success').html('<strong>Success!</strong> Comment added successfully.');
                        $('.add-review-form .alert-success').removeClass('d-none');
                        $('#rate_value').val('');
                        $('#reviewer_name').val('');
                        $('#reviewer_email').val('');
                        $('#comment').val('');
                        $('.sub-review ul li').removeClass('active');
                    }else{
                        $('.add-review-form .alert-danger').html('<strong>Error!</strong> Failed to save comments.');
                        $('.add-review-form .alert-danger').removeClass('d-none');
                    }
                }
            });
        });
        $body.on( 'click', '.increase2', function (e) {
            var value = parseInt($(this).prev('input').val(), 10);
            value = isNaN(value) ? 0 : value;
            value++;
            $(this).prev('input').val(value);
            $(this).prev('input.qty').change();
            setTimeout(function(){ $("[name='update_cart']").trigger('click'); }, 1000);
        });
        $body.on( 'click', '.decrease2', function (e) {
            var value = parseInt($(this).next('input').val(), 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            $(this).next('input').val(value);
            $(this).next('input.qty').change();
            setTimeout(function(){ $("[name='update_cart']").trigger('click'); }, 1000);
        });
        $body.on( 'click', '.log-cus-btn', function (e) {
            e.preventDefault();
            var log = $("input[name=log]").val();
            var pwd = $("input[name=pwd]").val();
            if(log){
                $.ajax({
                    method: 'POST',
                    url: js_var.ajax_url,
                    data: { action: "check_authentication", logname: log, pwd: pwd},
                    dataType: "json",
                    async:false,
                    success: function (msg) {
                        if(msg.status == 2){
                            $('.login-box .alert-danger').text('Username or password not match!');
                            $('.login-box .alert-danger').removeClass('d-none');
                        }else if(msg.status == 1){
                            $('#loginFrm').submit();
                        }else if(msg.status == 3){
                            $('.login-box .alert-danger').text('Your account not approved yet!');
                            $('.login-box .alert-danger').removeClass('d-none');
                        }else if(msg.status == 4){
                            $('.login-box .alert-danger').text('Your account is inactive!');
                            $('.login-box .alert-danger').removeClass('d-none');
                        }
                    }
                });
            }else{
                $('.login-box .alert-warning').text('Please enter username and password!');
                $('.login-box .alert-warning').removeClass('d-none');
            }
        });

        $('body').on('focus', '.delivery-address .woocommerce-checkout #billing_address_1', function () {
            geolocate();
        });

        $('body').on('focus', "#registration #address", function () {
            geolocate2();
        });

        var advance_search_btn = $('#advance_search_btn');
        advance_search_btn.on("click", function() {
            if ($('.advanced-search-model').length > 0) {
                $('.advanced-search-model').modal('show');
            }
        });

        $body.on( 'click', '.edit-profile-picture', function (e) {
            if($body.hasClass('woocommerce-account')){
                e.preventDefault();
                e.stopImmediatePropagation();
                e.stopPropagation();
                $('.avatar-modal').modal('show');
                $('.dropdown-menu.dropdown-menu-right').removeClass('show');
            }
        });

        // Advance search ajax
        $(".search-target .form-control").keyup( function () {
            $(".search-target").addClass('active');
            //console.log($(".search-target .form-control").val());
            var stem = $(".search-target .form-control").val();
            $.ajax({
                method: 'POST',
                url: js_var.ajaxurl,
                data: {
                    action: "advance_search",
                    keyword: $(".search-target .form-control").val()
                },
                dataType: "json",
                async:true,
                success: function (response) {
                    $('.advanced-search-wrapper').html(response.output);
                    $('.mb-0.highlight span').text(stem);
                    $(".search-target").removeClass('active');
                }
            });

        });

        $('.news-area .content-box a').attr('target', '_blank');

        if(js_var.hasOwnProperty('strength')){
            $('.strength_selection_cat li').each(function(i,v){
                if($(this).find('a').text() == js_var.strength){
                    $(this).find('a').trigger( "click" );
                }
            });
        }

    });
    $win.load(function () {
        var  variation = $('.variation');
        var  variation_add_to_cart = $('.deal-info-box').find('.add-to-cart');
        if(variation.find('li').hasClass('active')){
            variation_add_to_cart.removeAttr('disabled');
        }

        if($('#billing_postcode_field').length > 0){
            $('#billing_postcode_field').addClass('validate-required');
        }
    });

    if ($('.avatar-modal').length) {

        function hide_show_dropzone2($elem, $hide_elem) {
            $elem.show();
            $hide_elem.hide();
            var img = $("#dz_preview_wrap2 img[data-dz-thumbnail]");
            if (!img.length) {
                dz_upload5.show();
            }
        }

        function remove_old_file2($this) {
            if ($this.files[1] != null) {
                $this.removeFile($this.files[0]);
            }
        }

        function dropzone_id_init2(id) {
            var msg, preview;
            msg = '';
            preview = '.preview_container_front2';

            return new Dropzone("#" + id, {
                url: js_var.homeurl + '?file_upload=1',
                previewsContainer: preview,
                autoProcessQueue: false,
                addRemoveLinks: true,
                maxFiles: 1,
                previewTemplate: '<div class="dz-preview dz-file-preview">\n' +
                    '  <div class="dz-details">\n' +
                    '  <img data-dz-thumbnail />\n' +
                    msg +
                    '  </div>\n' +
                    '</div>'

            });
        }

        dz_upload5 = dropzone_id_init2('dz_upload5');

        dz_upload5.on("addedfile", function (file) {

            removing_on_error = false;
            if(! validate_file_type_when_added(file.type)){
                removing_on_error = true;
                this.removeFile(this.files[(this.files.length - 1)]);
                return false;
            }

            remove_old_file2(this);
            if (this.files[1] != null) {
                this.removeFile(this.files[0]);
            }
        }).on("removedfile", function (file) {
            if(removing_on_error){
                removing_on_error = false;
                return true;
            }
            hide_show_dropzone2($dz_upload5);
        });

        function process_dropzone_upload2(id) {
            //alert(id);
            $.ajax({
                method: 'POST',
                url: js_var.ajaxurl,
                data: getImage2(id),
                processData: false, // required for FormData with jQuery
                contentType: false, // required for FormData with jQuery
                success: function (response) {
                    if(response.type == 'success' && id == 'dz_upload5'){
                        $('#avatar_photo_id').val(response.data.url);
                        window.location.href = js_var.homeurl;
                    }

                }
            });
        }

        function getImage2(id) {
            var formData = new FormData();
            formData.append('image', dz_upload5.getAcceptedFiles()[0]);
            formData.append("action", 'id_image_upload');
            formData.append("id", id);
            // formData.append("_method", 'PUT');
            return formData;
        }

        $("#id_image_upload2").on('click', function (e) {
            e.preventDefault();
            process_dropzone_upload2('dz_upload5');
        });

    }

    function SetCookieForAge(){
        setCookie('Age_Verified','true',30);
    }

    function getCookie(name) {
        var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
        return v ? v[2] : null;
    }

    function setCookie(name, value, days) {
        var d = new Date;
        d.setTime(d.getTime() + 24*60*60*1000*days);
        document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
    }

    function deleteCookie(name) { setCookie(name, '', -1); }

    function change(e){
        var val = $(this).val();
        var separator1 = val.indexOf(',');
        if (separator1 !== -1) {
            val_a = val.split(',');
            $('.price-filter').find('.min-value').text(val_a[0]);
            $('.price-filter').find('.max-value').text(val_a[1]);
        }
    }
    $body.on('click', '.su-btn', function (e) {
        e.preventDefault();
        var $this = $(this),
            id = $this.attr('data-id');
        $body.find('[href="#' + id +'"]').tab('show');

        if(id == 'upload_id'){
            $('#upload_id #dz_upload3').css('display','block');
        }

        if(id == 'edit_upload_id'){
            $('#edit_upload_id #dz_upload3').css('display','block');
            $('#edit_upload_id #dz_upload1_err').removeClass('validation-error');
        }
    }).on('click', '.su-btn-next', function (e) {
        e.preventDefault();
        var $this = $(this),
            id = $this.attr('data-id'),
            is_valid = check_validation_form($this.closest('.tab-pane'));

        if($this.closest('#registration').length){
            var $form = $body.find('#registration form'),
                email = $form.find("input[name=email]").val();
            var formData = $form.serialize();
            $.ajax({
                method: 'POST',
                url: js_var.ajaxurl,
                data: { action: "save_registration_first_step_data", email: email, formdata: formData},
                dataType: "json",
                success: function (msg) {

                }
            });
            if(is_valid){
                $body.find('[href="#' + id +'"]').tab('show');
            }
        }
        if($this.closest('#edit-registration').length){
            var $form = $body.find('#edit-registration form'),
                email = $form.find("input[name=email]").val();
            var formData = $form.serialize();

            if(is_valid){
                $('#edit_upload_id #dz_upload1').css('display','block');
                $('#edit_upload_id #dz_upload2').css('display','block');
                $('#edit_upload_id #dz_upload3').css('display','block');
                $body.find('[href="#' + id +'"]').tab('show');
            }
        }
        if($this.closest('#upload_id').length){
            var $elem = $this.closest('#upload_id'),
                fb_validation = $('#preview_container_front').find('img[data-dz-thumbnail]').length
                    && $('#preview_container_back').find('img[data-dz-thumbnail]').length,
                fb_validation_src = $('#preview_container_front').find('img[src]').length
                    && $('#preview_container_back').find('img[src]').length,
                mid_validation = $('#preview_container_mid').find('img[data-dz-thumbnail]').length,
                mid_validation_src = $('#preview_container_mid').find('img[src]').length,
                mid_lenght = $register_form.find('#dz_upload3_err').hasClass('validation_required');

            setClassOnCondition($('#dz_upload1_err'),
                fb_validation
            );

            setClassOnCondition($('#dz_upload1_err1'),
                fb_validation_src
            );

            //console.log(mid_validation);
            //console.log(mid_lenght);

            if(mid_lenght){
                setClassOnCondition($('#dz_upload3_err'),
                    mid_validation
                );
                setClassOnCondition($('#dz_upload3_err1'),
                    mid_validation_src
                );
            } else {
                mid_validation = true;
            }

            is_valid = check_validation_form($elem);
            if(is_valid){
                if(fb_validation && mid_validation) {
                    process_dropzone_upload('dz_upload1');
                    process_dropzone_upload('dz_upload2');
                }
                //if(mid_validation && mid_lenght) {
                if(mid_validation) {
                    process_dropzone_upload('dz_upload3');
                }
                hide_show_dropzone($dz_upload4);
                $body.find('[href="#' + id +'"]').tab('show');;
            }
        }

        if($this.closest('#edit_upload_id').length){
            var $elem = $this.closest('#edit_upload_id'),
                f_validation = $('#preview_container_front').find('img[data-dz-thumbnail]').length,
                b_validation = $('#preview_container_back').find('img[data-dz-thumbnail]').length,
                mid_validation = $('#preview_container_mid').find('img[data-dz-thumbnail]').length,
                mid_lenght = $register_form.find('#dz_upload3_err').hasClass('validation_required');

            setClassOnCondition($('#dz_upload1_err'),
                f_validation
            );

            setClassOnCondition($('#dz_upload1_err'),
                b_validation
            );

            //console.log(mid_validation);
            //console.log(mid_lenght);

            if(mid_lenght){
                setClassOnCondition($('#dz_upload3_err'),
                    mid_validation
                );
            } else {
                mid_validation = true;
            }

            is_valid = check_validation_form($elem);
            if(is_valid){
                if(f_validation) {
                    process_dropzone_upload('dz_upload1');
                }
                if(b_validation) {
                    process_dropzone_upload('dz_upload2');
                }

                //if(mid_validation && mid_lenght) {
                if(mid_validation) {
                    process_dropzone_upload('dz_upload3');
                }
                hide_show_dropzone($dz_upload4);
                $body.find('[href="#' + id +'"]').tab('show');;
            }
        }
    });
    $register_form.find('.sing-up-section input').on('focus', function () {
        $(this).closest('.input-group-items').addClass('focused');
    }).on('blur', function () {
        $(this).closest('.input-group-items').removeClass('focused');
    });


    /**
     * Register Validation
     */

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function getAge(birthDateString) {
        var birthDate = new Date(birthDateString),
            age = today.getFullYear() - birthDate.getFullYear(),
            m = today.getMonth() - birthDate.getMonth(),
            n = today.getDay() - birthDate.getDay();
        console.log(age,m, n);
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        if(age == 20 && n > 0){
            age++;
        }

        return age;
    }

    function modify_error_txt($elem, $is_ajax){
        $elem.text($elem.attr('data-invalid'));
        if($is_ajax){
            $elem.text($elem.attr('data-ajax'));
        }
    }

    function check_validation_form($elem){
        var validation = true;

        $elem.find('.validation_required').each(function () {
            var $this = $(this),
                elem_val = true;
            if($this.hasClass('validation-error') || !$this.hasClass('validation-success')){
                elem_val = false;
                setClassOnCondition($this, false);
            }
            if(validation){
                validation = elem_val;
            }
        });

        return validation;
    }



    $body.on('blur', 'input[name="first-name"]', function (e) {
        var $this = $(this);
        setClassOnCondition(
            $this.closest('.validation_required'),
            ($this.val().length > 2)
        );
    }).on('blur', 'input[name="last-name"]', function (e) {
        var $this = $(this);
        setClassOnCondition(
            $this.closest('.validation_required'),
            ($this.val().length > 2)
        );
    }).on('change', 'select[name="date_[month]"], select[name="date_[day]"], select[name="date_[year]"]', function (e) {
        //$datepicker.trigger('blur');
        $("#datepicker-reg").trigger('blur');
    }).on('blur', 'input[name="birth-date"]', function (e) {
        var $this = $(this),
            elem = $this.closest('.validation_required'),
            val = $this.val(),
            condition = val.length;
        if (condition) {
            var age = getAge(val);
            if (age >= 18) {

                if (age >= 18 && age <= 20) {
                    $dz_upload3.addClass("dz-upload3-photo");
                    $register_form.find('#dz_upload3_err').addClass('validation_required');
                    $md_expire_date.addClass('validation_required');
                } else {
                    $dz_upload3.hide();
                    $md_expire_date.hide();
                    $register_form.find('#dz_upload3_err').removeClass('validation_required');
                    $md_expire_date.removeClass('validation_required');
                }

            } else {
                condition = false;
                $dz_upload3.hide();
            }
        }
        setClassOnCondition(elem, condition);
    }).on('blur', 'input[name="email"]', function (e) {
        var $this = $(this),
            val = $this.val(),
            condition = validateEmail(val),
            $elem =  $this.closest('.validation_required');
        modify_error_txt($elem.next('.error-span'), false);
        if(condition){
            $elem.addClass('yloader-open');
            $.ajax({
                method: 'POST',
                url: js_var.ajaxurl,
                data: { action: "urban_validate_email", email: val},
                dataType: "json",
                async:true,
                success: function (response) {
                    if(response.status == 'error'){
                        condition = false;
                        modify_error_txt($elem.next('.error-span'), true);
                    }
                    setClassOnCondition(
                        $elem,
                        condition
                    );
                    setTimeout(function () {
                        $elem.removeClass('yloader-open');
                    }, 500);
                }
            });
        } else {
            setClassOnCondition(
                $elem,
                condition
            )
        }
    }).on('blur', 'input[name="user-password"]', function (e) {
        var $this = $(this);
        setClassOnCondition(
            $this.closest('.validation_required'),
            ($this.val().length > 2)
        )
    }).on('blur', 'input[name="confirm-pass"]', function (e) {
        var $this = $(this);
        setClassOnCondition(
            $this.closest('.validation_required'),
            ($this.val().length > 2 && $register_form.find('input[name="user-password"]').val() == $this.val())
        )
    }).on('blur', 'input[name="zip-code"]', function (e) {
        var $this = $(this),
            val = $.trim($this.val()),
            condition = (val.length == 5 && jQuery.isNumeric( val )),
            $elem =  $this.closest('.validation_required');
        modify_error_txt($elem.find('.error-span'), false);
        setClassOnCondition(
            $this.closest('.validation_required'),
            condition
        );
    }).on('blur', 'input[name="phone"]', function (e) {
        var $this = $(this),
            val = $.trim($this.val());
            //val = $.trim($this.val()),
            //condition = (val.length > 5 && jQuery.isNumeric( val ));
            //condition = (val.length > 5 &&  val.match([0-9\-\(\)\s]+);
            if(val.length > 5 &&  val.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/)){
                condition = true;
            }else{
                condition = false;
            }
        setClassOnCondition(
            $this.closest('.validation_required'),
            condition
        )
    }).on('blur', 'input[name="address"]', function (e) {
        var $this = $(this),
            val = $.trim($this.val());
        setClassOnCondition(
            $this.closest('.validation_required'),
            val.length > 3
        )
    }).on("change", '#terms', function (e) {
        var $this = $(this);
        setClassOnCondition($this.closest('.validation_required'), $this.is(':checked'));
    }).on("blur", '#expired_date', function (e) {
        var $this = $(this),
            val = $this.val();
        setClassOnCondition($this.closest('.validation_required'), (val.length && today <= new Date(val)));
    });


    if ($('.registration-wrapper').length) {

        function hide_show_dropzone($elem, $hide_elem) {
            $dz_upload1.hide();
            $dz_upload2.hide();
            $dz_upload3.hide();
            $dz_upload4.hide();
            $elem.show();
        }

        function remove_old_file($this) {
            if ($this.files[1] != null) {
                $this.removeFile($this.files[0]);
            }
        }

        function show_hide_preview($elem) {
            $elem.find(".upload-right-side").fadeToggle(10);
            $body.find("#dz_upload1_err, #dz_upload3_err").removeClass('validation-error');
        }

        function dropzone_id_init(id) {
            var msg, preview;
            if (id === 'dz_upload1') {
                msg = '<p>Front Side</p>';
                preview = '.preview_container_front';
            } else if (id === 'dz_upload2') {
                msg = '<p>Back Side</p>';
                preview = '.preview_container_back';
            } else if (id === 'dz_upload3') {
                msg = '<p>Medical ID</p>';
                preview = '.preview_container_mid';
            }
            else if (id === 'dz_upload4') {
                msg = '';
                preview = '.preview_container_pto';
            }

            return new Dropzone("#" + id, {
                url: js_var.homeurl + '?file_upload=1',
                previewsContainer: preview,
                autoProcessQueue: false,
                addRemoveLinks: true,
                acceptedFiles: "image/*,application/pdf",
                maxFiles: 1,
                previewTemplate: '<div class="dz-preview dz-file-preview">\n' +
                    '  <div class="dz-details">\n' +
                    '  <img data-dz-thumbnail />\n' +
                    msg +
                    '  </div>\n' +
                    '</div>'

            });
        }

        dz_upload1 = dropzone_id_init('dz_upload1');
        dz_upload2 = dropzone_id_init('dz_upload2');
        dz_upload3 = dropzone_id_init('dz_upload3');
        dz_upload4 = dropzone_id_init('dz_upload4');


        function validate_file_type_when_added($type){
            return ($type.search('pdf') !== -1) || ($type.search('image') !== -1);
        }

        var removing_on_error = false;

        dz_upload1.on("addedfile", function (file) {

            removing_on_error = false;
            if(! validate_file_type_when_added(file.type)){
                removing_on_error = true;
                this.removeFile(this.files[(this.files.length - 1)]);
                return false;
            }
            hide_show_dropzone($dz_upload2, $dz_upload1);
            remove_old_file(this);
            if (this.files[1] != null) {
                this.removeFile(this.files[0]);
            }
            show_hide_preview($("#preview_container_front"));
        }).on("removedfile", function (file) {
            if(removing_on_error){
                removing_on_error = false;
                return true;
            }
            hide_show_dropzone($dz_upload1, $dz_upload2);
            show_hide_preview($("#preview_container_front"));
        });

        dz_upload2.on("addedfile", function (file) {
            removing_on_error = false;
            if(! validate_file_type_when_added(file.type)){
                removing_on_error = true;
                this.removeFile(this.files[(this.files.length - 1)]);
                return false;
            }
            hide_show_dropzone($dz_upload3, $dz_upload2);
            remove_old_file(this);
            show_hide_preview($("#preview_container_back"));
        }).on("removedfile", function (file) {
            if(removing_on_error){
                removing_on_error = false;
                return true;
            }
            hide_show_dropzone($dz_upload2, $dz_upload1);
            show_hide_preview($("#preview_container_back"));
        });

        dz_upload3.on("addedfile", function (file) {
            removing_on_error = false;
            if(! validate_file_type_when_added(file.type)){
                removing_on_error = true;
                this.removeFile(this.files[(this.files.length - 1)]);
                return false;
            }
            remove_old_file(this);
            show_hide_preview($("#preview_container_mid"));
        }).on("removedfile", function (file) {
            if(removing_on_error){
                removing_on_error = false;
                return true;
            }
            show_hide_preview($("#preview_container_mid"));
        });

        dz_upload4.on("addedfile", function (file) {
            removing_on_error = false;
            if(! validate_file_type_when_added(file.type)){
                removing_on_error = true;
                this.removeFile(this.files[(this.files.length - 1)]);
                return false;
            }
            remove_old_file(this);
            setClassOnCondition($register_form.find('#dz_upload4_err'), true);
            show_hide_preview($("#preview_container_pto"));
        }).on("removedfile", function (file) {
            if(removing_on_error){
                removing_on_error = false;
                return true;
            }
            setClassOnCondition($register_form.find('#dz_upload4_err'), false);
            show_hide_preview($("#preview_container_pto"));
        });

        function process_dropzone_upload(id) {
            //alert(id);
            $.ajax({
                method: 'POST',
                url: js_var.ajaxurl,
                data: getImage(id),
                processData: false, // required for FormData with jQuery
                contentType: false, // required for FormData with jQuery
                success: function (response) {
                    if(response.type == 'success' && id == 'dz_upload1'){
                        $('#front_side').val(response.data.url);
                    }
                    if(response.type == 'success' && id == 'dz_upload2'){
                        $('#back_side').val(response.data.url);
                    }
                    if(response.type == 'success' && id == 'dz_upload3'){
                        $('#medical_id').val(response.data.url);
                    }
                    if(response.type == 'success' && id == 'dz_upload4'){
                        $('#photo_id').val(response.data.url);
                        //$('.register-modal').modal({backdrop:'static', keyboard:false});
                        setTimeout(function(){
                            //$("#regForm").submit();
                            //var fname = $("input[name=full-name]").val();
                            var fname = $("input[name=first-name]").val()+' '+$("input[name=last-name]").val();
                            var birthdate = $("input[name=birth-date]").val();
                            var email = $("input[name=email]").val();
                            var phone = $("input[name=phone]").val();
                            if($("input[name=allow_text_message]").is(':checked'))
                                var allow_text_message = 1;
                            else
                                var allow_text_message = 0;

                            var userpassword = $("input[name=user-password]").val();
                            var zipcode = $("input[name=zip-code]").val();
                            var address = $("input[name=address]").val();
                            //var expired_date = $("input[name=expired_date]").val();
                            var front_side = $("input[name=front_side]").val();
                            var back_side = $("input[name=back_side]").val();
                            var medical_id = $("input[name=medical_id]").val();
                            var photo_id = $("input[name=photo_id]").val();

                            $.ajax({
                                method: 'POST',
                                url: js_var.ajaxurl,
                                //data: { action: "save_registration_data", fname: fname, birthdate: birthdate, email: email, phone: phone, allow_text_message: allow_text_message, userpassword: userpassword, zipcode: zipcode, address: address, expired_date: expired_date, front_side: front_side, back_side: back_side, medical_id: medical_id, photo_id: photo_id},
                                data: { action: "save_registration_data", fname: fname, birthdate: birthdate, email: email, phone: phone, allow_text_message: allow_text_message, userpassword: userpassword, zipcode: zipcode, address: address, front_side: front_side, back_side: back_side, medical_id: medical_id, photo_id: photo_id},
                                dataType: "json",
                                async:false,
                                success: function (msg) {
                                    var $succ = $register_form.find('.success_msg').show().removeClass('err');
                                    $register_form.find('.wait-reg').hide();
                                    if(msg.status == 1){
                                        $succ.text('You have successfully completed registration! You are now being redirected to the NEXT STEPS page');
                                        setTimeout(function(){
                                            //location.reload(true);
                                            window.location.href = js_var.homeurl+"next-steps";
                                        },3000);
                                    }else if(msg.status == 2){
                                        $succ.addClass('err');
                                        $succ.text('Registration failed.Please try again.');
                                    }else if(msg.status == 3){
                                        $succ.addClass('err');
                                        $succ.text('User already exist with this name or email. Please try with different name and email.');
                                    }
                                }
                            });

                        }, 2000);
                    }
                }
            });
        }

        function process_dropzone_upload3(id) {
            $.ajax({
                method: 'POST',
                url: js_var.ajaxurl,
                data: getImage(id),
                processData: false, // required for FormData with jQuery
                contentType: false, // required for FormData with jQuery
                success: function (response) {

                    if(response.type == 'success' && id == 'dz_upload4'){
                        $('#photo_id').val(response.data.url);
                        setTimeout(function(){
                            var fname = $("input[name=first-name]").val()+' '+$("input[name=last-name]").val();
                            var birthdate = $("input[name=birth-date]").val();
                            var email = $("input[name=email]").val();
                            var phone = $("input[name=phone]").val();
                            if($("input[name=allow_text_message]").is(':checked'))
                                var allow_text_message = 1;
                            else
                                var allow_text_message = 0;

                            var userpassword = $("input[name=user-password]").val();
                            var zipcode = $("input[name=zip-code]").val();
                            var address = $("input[name=address]").val();
                            var edit_user_id = $("input[name=edit_user_id]").val();
                            var front_side = $("input[name=front_side]").val();
                            var back_side = $("input[name=back_side]").val();
                            var medical_id = $("input[name=medical_id]").val();
                            var photo_id = $("input[name=photo_id]").val();

                            $.ajax({
                                method: 'POST',
                                url: js_var.ajaxurl,
                                data: { action: "edit_registration_data", fname: fname, birthdate: birthdate, email: email, phone: phone, allow_text_message: allow_text_message, userpassword: userpassword, zipcode: zipcode, address: address, front_side: front_side, back_side: back_side, medical_id: medical_id, photo_id: photo_id, edit_user_id: edit_user_id},
                                dataType: "json",
                                async:false,
                                success: function (msg) {
                                    var $succ = $register_form.find('.success_msg').show().removeClass('err');
                                    $register_form.find('.wait-reg').hide();
                                    if(msg.status == 1){
                                        $succ.text('Successfully updated user information!');
                                        setTimeout(function(){
                                            location.reload(true);
                                            //window.location.href = js_var.homeurl+"next-steps";
                                        },3000);
                                    }
                                }
                            });

                        }, 2000);
                    }
                }
            });
        }

        function getImage(id) {

            var formData = new FormData();
            if (id === 'dz_upload1') {
                formData.append('image', dz_upload1.getAcceptedFiles()[0]);
            } else if (id === 'dz_upload2') {
                formData.append('image', dz_upload2.getAcceptedFiles()[0]);
            } else {

            }
            if (id === 'dz_upload3') {
                formData.append('image', dz_upload3.getAcceptedFiles()[0]);
            } else {

            }
            if (id === 'dz_upload4') {
                formData.append('image', dz_upload4.getAcceptedFiles()[0]);
            } else {

            }
            formData.append("action", 'id_image_upload');
            formData.append("id", id);
            // formData.append("_method", 'PUT');
            return formData;
        }



        $("#create_account").on('click', function (e) {
            e.preventDefault();
            var $this = $(this),
                $elem = $this.closest('.tab-pane'),
                is_valid = check_validation_form($elem);


            if(is_valid){
                $register_form.find('.success_msg').hide();
                $body.find('.wait-reg').show();
                process_dropzone_upload('dz_upload4');
            }
        });

        $("#edit_account").on('click', function (e) {
            e.preventDefault();
            var $this = $(this),
                $elem = $this.closest('.tab-pane'),
                is_valid = check_validation_form($elem);


            if(is_valid){
                $register_form.find('.success_msg').hide();
                $body.find('.wait-reg').show();
                if($('.photo-edit-wrap .dz-image-preview').length > 0){
                    process_dropzone_upload3('dz_upload4');
                }else{
                    var fname = $("input[name=first-name]").val()+' '+$("input[name=last-name]").val();
                    var birthdate = $("input[name=birth-date]").val();
                    var email = $("input[name=email]").val();
                    var phone = $("input[name=phone]").val();
                    if($("input[name=allow_text_message]").is(':checked'))
                        var allow_text_message = 1;
                    else
                        var allow_text_message = 0;

                    var userpassword = $("input[name=user-password]").val();
                    var zipcode = $("input[name=zip-code]").val();
                    var address = $("input[name=address]").val();
                    var edit_user_id = $("input[name=edit_user_id]").val();
                    var front_side = $("input[name=front_side]").val();
                    var back_side = $("input[name=back_side]").val();
                    var medical_id = $("input[name=medical_id]").val();
                    var photo_id = $("input[name=photo_id]").val();

                    $.ajax({
                        method: 'POST',
                        url: js_var.ajaxurl,
                        data: { action: "edit_registration_data", fname: fname, birthdate: birthdate, email: email, phone: phone, allow_text_message: allow_text_message, userpassword: userpassword, zipcode: zipcode, address: address, front_side: front_side, back_side: back_side, medical_id: medical_id, photo_id: photo_id, edit_user_id: edit_user_id},
                        dataType: "json",
                        async:false,
                        success: function (msg) {
                            var $succ = $register_form.find('.success_msg').show().removeClass('err');
                            $register_form.find('.wait-reg').hide();
                            if(msg.status == 1){
                                $succ.text('Successfully updated user information!');
                                setTimeout(function(){
                                    location.reload(true);
                                },3000);
                            }else if(msg.status == 2){
                                $succ.text('Successfully updated user information!');
                                setTimeout(function(){
                                    window.location.href = js_var.logout_url;
                                },3000);
                            }
                        }
                    });
                }
            }
        });

    }

})(jQuery, window, document);





