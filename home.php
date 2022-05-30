<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package urban_flavours
 */

get_header();
?>
    <?php
        $slider_settings = get_field('slider_settings', 'option');
        if(!empty($slider_settings)):
    ?>
        <!-- /.slider-area start  -->
        <section class="slider-area slider">
            <?php foreach ($slider_settings as $slider_setting):?>
            <div>
                <div style="background-image: url('<?php echo $slider_setting['slider_image'];?>');" class="slide">
                    <div class="caption d-flex h-100 align-items-center justify-content-center">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-12 text-center ">
                                    <h1 class="white-text"><?php echo $slider_setting['slider_heading'];?></h1>
                                    <h4 class="white-text mb-60">
                                        <?php echo $slider_setting['slider_sub_heading'];?>
                                    </h4>
                                    <a href="<?php echo get_bloginfo('url');?>/meadow/?" class="btn custom-btn text-uppercase">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </section>
        <!-- /.slider-area end  -->
    <?php endif;?>
    <?php
    $deal_of_the_day_title = get_field('deal_of_the_day_title', 'option');
    $deal_of_the_day_category_name = get_field('deal_of_the_day_category_name', 'option');
    $deal_of_the_day_product_name = get_field('deal_of_the_day_product_name', 'option');
    $deal_of_the_day_product_image = get_field('deal_of_the_day_product_image', 'option');
    $deal_of_the_day_content = get_field('deal_of_the_day_content', 'option');
    $deal_of_the_day_button_text = get_field('deal_of_the_day_button_text', 'option');
    $deal_of_the_day_button_url = get_field('deal_of_the_day_button_url', 'option');
    $button_text = get_field('button_text', 'option');

    if(!empty($deal_of_the_day_title)):
    ?>
    <!-- /.deal-area start  -->
    <section class="deal-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <div class="deal-box">
                        <h2 class="text-uppercase green-text"><?php echo $deal_of_the_day_title;?></h2>
                        <?php if( !empty( $deal_of_the_day_product_image ) ):?>
                        <img src="<?php  echo $deal_of_the_day_product_image; ?>" alt="<?php echo $deal_of_the_day_product_name;?>">
                        <?php endif;?>
                    </div>
                    <div class="deal-info-box text-center">
                        <div class="cat">
                            <h6 class="text-uppercase text-center black-text"><?php echo $deal_of_the_day_category_name;?></h6>
                        </div>
                        <div class="top-title ">
                            <h3 class="text-uppercase black-text "><a href="<?php echo $deal_of_the_day_button_url;?>"><?php echo $deal_of_the_day_product_name;?></a></h3>
                        </div>
                        <p class="black-text"><?php echo $deal_of_the_day_content;?></p>

                        <a href="<?php echo $deal_of_the_day_button_url;?>" class="btn add-to-cart text-uppercase"><?php echo $deal_of_the_day_button_text;?></a>
                    </div>
                    <div class="more-btn text-center">
                        <a href="<?php echo get_bloginfo('url');?>/meadow/?" class="btn custom-btn text-uppercase"><?php echo $button_text;?></a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.deal-area end  -->
    <?php endif;?>

    <!-- /.urbanflavours start  -->
    <section class="urbanflavours">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-9 col-sm-12 ml-auto">
                    <h2 class="green-text text-uppercase title">#urbanflavours</h2>
                </div>
            </div>
        </div>
        <?php
        $instagram_access_token = trim(get_field('instagram_access_token', 'option'));
        $result = fetchData("https://api.instagram.com/v1/users/self/media/recent/?access_token=".$instagram_access_token."&count=20");
        $instagram_result = json_decode($result);
        if(!empty($instagram_result->data)):
        ?>
        <!-- /.urban-slider start  -->
        <div class="urban-slider">
            <div class="container-fluid no-gutters">
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="centrer-slider">
                            <?php foreach ($instagram_result->data as $im):
                                ?>
                            <div>
                                <img src="<?php echo $im->images->standard_resolution->url;?>">
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.urban-slider end  -->
        <?php endif;?>
    </section>
<?php
get_footer();
