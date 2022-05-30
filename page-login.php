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
if(is_user_logged_in()){
    $url = get_bloginfo('url').'/my-account';
    wp_redirect( $url );
    exit;
}
get_header();
?>
    <!-- /.about-section start  --->
    <section class="about-section">
        <div class="container-fluid no-gutters"> <!-- /.container start  -->
            <!-- /.row start  -->
            <?php while ( have_posts() ) :the_post();?>
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="about-content login-box">
                        <h3 class="text-uppercase green-text">Login</h3>
                        <div class="alert alert-danger d-none" role="alert"></div>
                        <div class="alert alert-success d-none" role="alert"></div>
                        <div class="alert alert-warning d-none" role="alert"></div>
                        <form name="loginform" id="loginFrm" action="<?php echo site_url('/wp-login.php'); ?>" method="post">
                            <div class="form-group">
                                <label for="text">Username or email address *</label>
                                <input type="text" class="form-control" name="log" id="user_login" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                                <label for="pass">Password *</label>
                                <input type="password" class="form-control" name="pwd" id="user_pass" required>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-check float-left">
                                <input name="rememberme" type="checkbox" class="form-check-input" id="rememberme" value="forever">
                                <label class="form-check-label" for="savepass">Save Password</label>
                            </div>

                            <div class="form-check float-right">
                                <a href="<?php echo wp_lostpassword_url(); ?>">Foget your Password</a>
                            </div>
                            <div class="clearfix"></div>

                            <div class="text-center ">
                                <button type="submit" class="btn custom-btn log-cus-btn">Sign In</button>
                                <a href="<?php bloginfo('url');?>/sign-up" class="btn  text-center create-btn" >OR Create an account</a>
                            </div>
                        </form>
                        <?php //echo wp_login_form();?>
                    </div>
                </div>
                <!-- /.about right section start  -->
                <div class="col-lg-6 col-md-6 col-sm-12 p-0 ">
                    <div class="section-right-image">
                        <?php $login_image_url = get_the_post_thumbnail_url( $post, 'full' );?>
                        <?php if(!empty($login_image_url)):?>
                            <img src="<?php echo $login_image_url;?>" class="img-fluid" alt="login-image">
                        <?php else:?>
                            <img src="<?php bloginfo('template_url');?>/images/login.png" class="img-fluid" alt="login-image">
                        <?php endif;?>
                        <p class="img-centered-text"><?php echo get_field('site_name', 'option');?></p>
                    </div>    <!-- /.about right section end  -->
                </div>
            </div>    <!-- /.row end  -->
            <?php endwhile; // End of the loop.?>
        </div>         <!-- /.container end  -->
    </section><!-- /.about-section end  -->

<?php
get_footer();
