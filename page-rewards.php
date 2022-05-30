<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package urban_flavours
 */

get_header();
?>
    <!-- /.gift bag left section start  --->
    <section class="gift-bag-area">
        <div class="container-fluid no-gutters"> <!-- /.container start  -->
            <!-- /.row start  --->
            <div class="row align-items-center">
                <?php
                while ( have_posts() ) :the_post();?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="gift-bag">
                        <h5 class=""><?php echo get_field('reward_before_heading_text', 'option');?></h5>
                        <div class="top-title"><h3><?php echo get_field('reward_page_heading', 'option');?></h3></div>
                        <?php echo get_field('reward_page_content', 'option');?><br>
                        <a href="#" class="btn custom-btn text-uppercase line-btn"><?php echo get_field('reward_button_text', 'option');?></a>
                        <br>
                    </div>
                </div>
                <!-- /.thanks right section start  -->
                <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                    <div class="section-right-image">
                        <img src="<?php echo get_field('reward_page_image', 'option');?>" class="img-fluid" alt="<?php the_title();?>">
                    </div>    <!-- /.thanks right section end  -->
                </div>
                <?php endwhile; // End of the loop.?>
            </div>    <!-- /.row end  -->
        </div>         <!-- /.container end  -->
    </section><!-- /.gift bag left section end  -->
<?php
get_footer();
