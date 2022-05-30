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
    <!-- /.about-section start  --->
    <section class="about-section">
        <div class="container-fluid no-gutters"> <!-- /.container start  -->
            <!-- /.row start  -->
            <div class="row align-items-center">
                <?php
                while ( have_posts() ) :the_post();?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="about-content">
                        <h3><?php the_title();?></h3>
                        <?php echo get_the_content();?>
                    </div>

                </div>

                <!-- /.about right section start  -->
                <div class="col-lg-6 col-md-6 col-sm-12 p-0 ">
                    <div class="section-right-image">
                        <?php
                        if ( has_post_thumbnail() ) {
                            $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
                            echo '<img src="'.$featured_img_url.'" class="img-fluid" alt="'.get_the_title().'">';
                        }
                        ?>
                        <p class="img-centered-text"><?php echo get_field('site_name', 'option');?></p>
                    </div>    <!-- /.about right section end  -->
                </div>
                <?php endwhile; // End of the loop.?>
            </div>    <!-- /.row end  -->
        </div>         <!-- /.container end  -->
    </section><!-- /.about-section end  -->
<?php
get_footer();
