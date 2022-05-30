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
    <!-- /. contactus-section start here -->
    <div class="contactus-section">
        <div class="container-fluid no-gutters">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12  ml-auto mt-5">
                    <div class="contactus-text pt-5 pb-5">
                        <h3 class="text-uppercase green-text pb-5 font-weight-bold">Contact Us</h3>
                        <p><i aria-hidden="true" class="icon_pin"></i><?php echo get_field('contact_page_address', 'option');?></p>
                        <p><a href="mailto:<?php echo get_field('contact_page_email', 'option');?>"><i aria-hidden="true" class="icon_mail"></i><?php echo get_field('contact_page_email', 'option');?> </a></p>
                        <p><a href="tel:<?php echo get_field('contact_page_phone_number', 'option');?>"><i aria-hidden="true" class="icon_phone"></i><?php echo get_field('contact_page_phone_number', 'option');?></a></p>
                    </div>
                    <div class="social-title">
                        <h6 class="green-text font-weight-bold">Connect to</h6>
                    </div>
                    <ul class="list-inline social-section pt-3 pb-4">
                        <li class="list-inline-item"><a href="<?php echo get_field('connect_to_facebook', 'option');?>"><i class="social_facebook"></i></a></li>
                        <li class="list-inline-item"><a href="<?php echo get_field('connect_to_twitter', 'option');?>"><i class="social_twitter"></i></a></li>
                        <li class="list-inline-item"><a href="<?php echo get_field('connect_to_instagram', 'option');?>"><i class="social_instagram"></i></a></li>
                        <li class="list-inline-item"><a href="<?php echo get_field('connect_to_pinterest', 'option');?>"><i class="social_pinterest"></i></a></li>
                        <li class="list-inline-item"><a href="<?php echo get_field('connect_to_skype', 'option');?>"><i class="social_skype"></i></a></li>
                    </ul>
                    <div class="hours-text pt-5">
                        <h6 class="green-text font-weight-bold">Hours</h6>
                        <p><?php echo get_field('contact_page_opening_hour_text', 'option');?></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 com-sm-6 p-0 ">
                    <div class="map-area">
                        <div class="map-section" id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /. contactus-section end here -->

    <!-- /. contact-write-section start here -->
    <div class="contact-write-section">
        <div class="container">
            <div class="row ">
                <div class="col-lg-8 col-md-10 col-sm-12 m-auto">
                    <div class="contact-write-title">
                        <h3 class="text-center green-text pt-1 pb-3 font-weight-bold"><?php echo get_field('contact_form_heading', 'option');?></h3>
                    </div>
                    <form method="post" action="">
                        <div class="row pt-2 pb-4 ">
                            <div class="col-lg-4 col-md-4 col-sm-4 radio">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" checked="checked" name="form_type" id="general" value="general-inquiry">
                                    <label class="form-check-label" for="general">GENERAL INQUIRY</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 radio">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="form_type" id="support" value="order-support">
                                    <label class="form-check-label" for="support">ORDER SUPPORT</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 radio">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input"  name="form_type" id="error" value="website-error">
                                    <label class="form-check-label" for="error">WEBSITE ERROR</label>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-2 pb-1">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control contact-form" name="contact-name" placeholder="Your Name" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="email" class="form-control contact-form" name="contact-email" placeholder="Your Email" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <textarea class="form-control contact-form" name="contact-message" rows="6" placeholder="Your Message"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-2 pb-1 mb-3 order-field">
                            <div class="col-md-12 col-12 ">
                                <input type="text" class="form-control contact-form" placeholder="Order Number" name="contact-order-number" value="" required>
                            </div>
                        </div>

                        <div class="row pt-1 pb-2">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <div>
                                    <button type="submit" class="btn custom-btn text-uppercase send-message-btn"><?php echo get_field('contact_form_button_text', 'option');?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /. contact-write-section end here -->
<?php
get_footer();
