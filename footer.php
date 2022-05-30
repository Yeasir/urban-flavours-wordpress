<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package urban_flavours
 */

?>

<!-- /.urbanflavours end  -->
</main>
<!-- /.main start  -->
<?php
//$rss_feeds_urls = get_field('rss_feeds_urls', 'option');
//$rss_feeds_url_array = explode(',',$rss_feeds_urls);
$default_featured_images = get_field('default_featured_images', 'option');

//$random_url = $rss_feeds_url_array[array_rand($rss_feeds_url_array)];
//$random_url = trim($random_url);
$random_url = 'http://leafly.com/feed';

?>
<!-- /.footer start  -->
<footer class="footer">
    <div class="footer-up">
        <?php if(is_home() || is_front_page()):?>
        <!-- /.latest-news start  -->
        <div class="latest-news">
            <div class="container pb-90">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                        <div class="top-title">
                            <h2 class="white-text">latest News</h2>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row align-items-center">
                    <?php
                    $feeds = @simplexml_load_file($random_url);
                    if($feeds){
                        $counter = 1;
                        foreach($feeds->channel->item as $item) {
                            if($counter > 3)
                                continue;
                            $random_item = $default_featured_images[array_rand($default_featured_images)];
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-6 ">
                                <a href="<?php echo $item->link;?>" target="_blank">
                                    <div class="blog ">
                                        <?php
                                        if(!isset($item->image)){
                                            ?>
                                            <img class="img-fluid d-block" src="<?php echo $random_item['url'];?>" alt="">
                                            <?php
                                        }else{
                                        ?>
                                        <img class="img-fluid d-block" src="<?php bloginfo('template_url');?>/images/news1.png" alt="">
                                        <?php };?>
                                        <div class="content-box align-items-center h-100 d-block">
                                            <a href="<?php echo $item->link;?>" class="text-uppercase title" target="_blank"><?php echo $item->title;?></a>

                                            <div class="clearfix"></div>
                                            <div class="float-left">
                                                <?php date('F d, Y', strtotime($item->pubDate));?>
                                            </div>
                                            <div class="float-right">
                                                <a href="<?php echo $item->link;?>" class="btn custom-btn text-uppercase" target="_blank">Read more</a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <?php
                            $counter++;
                        }
                    }else{
                        ?>
                        <div class="col-lg-12"><h2 style="color: #ffffff">Invalid RSS feed URL.</h2></div>
                        <?php
                    }
                    ?>
                </div>
            </div>

        </div>
        <!-- /.latest-news end  -->
        <?php endif;?>
        <!-- /.footer-top start  -->
        <div class="footer-top">
            <div class=" text-center">
                <h3 class="white-text text-uppercase title"> <?php echo get_field('site_name', 'option');?></h3>
            </div>
            <div class="container">
                <div class="row ">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <?php echo get_field('contact_information', 'option');?>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <h5 class="text-uppercase white-text">Hours</h5>
                        <p class="white-text"><?php echo get_field('open_hours', 'option');?></p>
                        <ul class="list-unstyled footer-menu">
                            <li><a href="<?php bloginfo('url');?>/how-to-order/" aria-current="page">How to Order</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <h5 class="text-uppercase white-text">Information</h5>
                        <?php
                        wp_nav_menu( array(
                            'menu_class'        => "list-unstyled footer-menu",
                            'container'         => "",
                            'theme_location'    => 'menu-footer',
                        ) );
                        ?>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <h5 class="text-uppercase white-text">Newsletter</h5>
                        <form action="" class="form-inline" method="post">
                            <div class="form-group  align-items-center d-block h-100">
                                <input type="email" name="mailchimp_email" class="form-control" placeholder="Enter your email...">
                                <button type="submit" class="btn custom-btn mb-2">Subscribe</button>
                            </div>
                        </form>
                        <ul class="list-inline social">
                            <li class="list-inline-item"><a href="<?php echo get_field('facebook_url', 'option');?>"><i class="pe-so-facebook pe-lg pe-va"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="<?php echo get_field('twitter_url', 'option');?>"><i class="pe-so-twitter pe-lg pe-va"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="<?php echo get_field('instagram_url', 'option');?>"><i class="pe-so-instagram pe-lg pe-va"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.footer-top start  -->
    </div>
    <!-- /.footer-bottom start  -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-7 col-sm-12 text-lg-left text-md-left text-sm-center">
                    <p><?php echo get_field('copyright_text', 'option');?></p>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 text-lg-right text-md-right text-sm-center">
                    <p><?php echo get_field('license_number', 'option');?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.footer-bottom start  -->

    <!-- /.age-verify start  -->
    <section class="age-verify">
        <div class="container">  <!-- /.container start  -->
            <!-- The Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">

                        <!-- Modal body -->
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>


                            <div class="row text-center age-verify-body">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h4><?php echo get_field('age_verification_heading', 'option');?></h4>
                                    <p><?php echo get_field('age_verification_content', 'option');?></p>
                                    <a href="javascript:void(0);" class="btn  text-uppercase enter-btn"><?php echo get_field('agree_button_text', 'option');?></a>
                                    <b class="text-center-or pl-3 pr-3">OR</b>
                                    <a href="javascript:void(0);" class="btn  text-uppercase exit-btn "><?php echo get_field('disagree_button_text', 'option');?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</footer>
<!-- /.footer end  -->
</div><!-- /.wrapper -->

<!-- /.advanced-search-model start -->
<div class="modal advanced-search-model" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <form action="<?php bloginfo('url');?>" class="col-12">
                            <!-- /.search-target start -->
                            <div class="position-relative search-target">
                                <button type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                                <input type="text" class="form-control" value="" name="s" />
                                <span class="wait" id="wait2"></span>
                            </div>
                            <!-- /.search-target end -->
                            <!-- /.advanced-search-wrapper start -->
                            <div class="advanced-search-wrapper"></div>
                            <!-- /.advanced-search-wrapper end -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.advanced-search-model end -->

<!-- /.single-product start -->
<div class="modal avatar-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body ">
                <div class="container-fluid">
                    <!-- /.upload-photo start -->
                    <h3 class="">Profile Image</h3>
                    <form action="" class="row " name="avatarImage" method="post">
                        <div class="col-lg-8 col-md-8 col-sm-12 text-center back-side-id">
                            <div id="dz_upload5" class="dz-message needsclick id-upload-fix">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/urban-upload.png" class="img-fluid" >
                                <h5>Profile Photo</h5>
                                <p>Drag and drop photo here or just click to <span class="dz-message needsclick dz-clickable">browse</span> files</p>
                            </div>
                        </div>
                        <div  class="col-lg-4 col-md-4 col-sm-12 font-side-fix text-left" id="dz_preview_wrap2">
                            <div class="preview_container_front2 dropzone-previews" id="preview_container_front"></div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-lg-6 col-md-6 col-sm-12 text-lg-right text-md-right text-sm-center  mt-3">
                            <div class="ml-lg-auto ml-auto text-uppercase">
                                <input type="hidden" name="avatar_photo_id" id="avatar_photo_id" value="">
                                <button type="submit" class="btn orange" id="id_image_upload2">upload photo</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.upload-photo end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.single-product end -->

<?php wp_footer(); ?>
<script>
    // This sample uses the Autocomplete widget to help the user select a
    // place, then it retrieves the address components associated with that
    // place, and then it populates the form fields with those details.
    // This sample requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script
    // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete, autocomplete2;

    var componentForm = {
        postal_code: 'short_name',
        locality: 'short_name'
    };

    var componentForm2 = {
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('billing_address_1'), {types: ['geocode']});

        autocomplete2 = new google.maps.places.Autocomplete(
            document.getElementById('address'), {types: ['geocode']});
        //newly added
        autocomplete.setComponentRestrictions(
            {'country': ['us']});

        autocomplete2.setComponentRestrictions(
            {'country': ['us']});
        //end

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(['address_component']);
        autocomplete2.setFields(['address_component']);

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
        autocomplete2.addListener('place_changed', fillInAddress2);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            if(component == 'postal_code'){
                component = 'billing_postcode';
            } else if (component == 'locality') {
                component = 'billing_city';
            }
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
            jQuery('.delivery-address .woocommerce-checkout input[name="billing_postcode"]').trigger("change");
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                if(addressType == 'postal_code'){
                    addressType = 'billing_postcode';
                } else if (addressType == 'locality') {
                    addressType = 'billing_city';
                }
                document.getElementById(addressType).value = val;
                jQuery('.delivery-address .woocommerce-checkout input[name="billing_postcode"]').trigger("change");
            }
        }
    }

    function fillInAddress2() {
        // Get the place details from the autocomplete object.
        var place = autocomplete2.getPlace();

        console.log(place);

        for (var component in componentForm2) {
            if(component == 'postal_code'){
                //component = 'zip_code';
                component = 'zipcode';
            }
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
            jQuery('#registration input[name="zip-code"]').trigger("blur");
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm2[addressType]) {
                var val = place.address_components[i][componentForm2[addressType]];
                if(addressType == 'postal_code'){
                    //addressType = 'zip_code';
                    addressType = 'zipcode';
                }
                document.getElementById(addressType).value = val;
                jQuery('#registration input[name="zip-code"]').trigger("blur");
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle(
                    {center: geolocation, radius: position.coords.accuracy});
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
    function geolocate2() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle(
                    {center: geolocation, radius: position.coords.accuracy});
                autocomplete2.setBounds(circle.getBounds());
            });
        }
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4S0UGHELNCLiC9b2QkPlzSAuZ0at0alk&libraries=places&callback=initAutocomplete"
></script>
<!-- Start of LiveChat (www.livechatinc.com) code -->
<script type="text/javascript">
    window.__lc = window.__lc || {};
    window.__lc.license = 11579983;
    (function() {
        var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
        lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
    })();
</script>
<noscript>
    <a href="https://www.livechatinc.com/chat-with/11579983/" rel="nofollow">Chat with us</a>,
    powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a>
</noscript>
<!-- End of LiveChat code -->
</body>
</html>
