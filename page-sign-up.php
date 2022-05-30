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

    <div class="registration-wrapper">
        <!-- sing up top section -->
        <div class="sing-up-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <nav class="sing-up-nvigation">

                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">


                                    <a class=" nav-link active" title="Registration" href="#registration" role="tab" data-toggle="tab" disabled="disabled">REGISTRATION</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#upload_id" role="tab" data-toggle="tab" disabled="disabled">UPLOAD ID</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#upload_photo" role="tab" data-toggle="tab" disabled="disabled">UPLOAD SELFIE</a>
                                </li>
                            </ul>
                        </nav>
                        <!-- Tab panes -->
                    </div>
                </div>
            </div>
        </div>
        <!-- sing up top section -->

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade show active" id="registration">
                <?php
                if(isset($_GET['autosave'])) {
                    global $wpdb;
                    $id = $_GET['autosave'];
                    $table_registration = $wpdb->prefix . 'registration_step_data';
                    $sql = "SELECT * FROM $table_registration WHERE id = $id";
                    $res = $wpdb->get_row( $sql );
                    $id = $res->id;
                    $user_email = $res->user_email;
                    $form_data = unserialize($res->form_data);
                    $status = $res->status;
                }
                ?>
                <!-- sing up section start here -->
                <form class="sing-up-section">
                    <div class="container">
                        <div class="row pb-2">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="sing-in-left">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group validation_required <?php if(!empty($form_data['first-name'])){ echo 'validation-success';}?>">
                                                    <label for="text">First Name*</label>
                                                    <input type="text" class="form-control sing-up" id="text" aria-describedby="textHelp" name="first-name" value="<?php if(!empty($form_data['first-name'])){ echo $form_data['first-name'];}?>">
                                                    <span class="error-span">Please provide your first name!</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group validation_required <?php if(!empty($form_data['last-name'])){ echo 'validation-success';}?>">
                                                    <label for="text1">Last Name*</label>
                                                    <input type="text" class="form-control sing-up" id="text1" aria-describedby="text1Help" name="last-name" value="<?php if(!empty($form_data['last-name'])){ echo $form_data['last-name'];}?>">
                                                    <span class="error-span">Please provide your last name!</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group validation_required <?php if(!empty($form_data['email'])){ echo 'validation-success';}?>">
                                                    <label for="email">Email*</label>
                                                    <input type="email" class="form-control sing-up" id="email" aria-describedby="emailHelp" name="email" value="<?php if(!empty($form_data['email'])){ echo $form_data['email'];}?>">
                                                    <span class="error-span" data-invalid="Invalid Email!" data-ajax="Your email is not available">Invalid Email</span>
                                                    <div class="yloader"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group validation_required <?php if(!empty($form_data['user-password'])){ echo 'validation-success';}?>">
                                                    <label for="password">Password*</label>
                                                    <input type="password" class="form-control sing-up" id="password" aria-describedby="emailHelp" name="user-password" value="<?php if(!empty($form_data['user-password'])){ echo $form_data['user-password'];}?>">
                                                    <span class="error-span">Please provide your Password!</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group validation_required <?php if(!empty($form_data['confirm-pass'])){ echo 'validation-success';}?>">
                                                    <label for="confrim-pass">Confirm Password*</label>
                                                    <input type="password" class="form-control sing-up" id="confrim-pass" aria-describedby="emailHelp" name="confirm-pass" value="<?php if(!empty($form_data['confirm-pass'])){ echo $form_data['confirm-pass'];}?>">
                                                    <span class="error-span">Password Does not match..!</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <div class="form-check validation_required <?php if(!empty($form_data['email'])){ echo 'validation-success';}?>">
                                                        <input class="form-check-input" type="checkbox" id="terms" <?php if(!empty($form_data['email'])){ echo 'checked';}?>>
                                                        <label class="form-check-label sing-up-check" for="terms">
                                                            I agree the <a href="#">terms and conditions</a>
                                                            <span class="error-span">You must agree to our Terms and Conditions to Continue.</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="sing-in-right">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group validation_required <?php if(!empty($form_data['birth-date'])){ echo 'validation-success';}?>">
                                                <label for="datepicker">Date of Birth*</label>
                                                <input type="text" class="form-control sing-up" id="datepicker" aria-describedby="emailHelp" placeholder="MM / DD / YYYY" name="birth-date" value="<?php if(!empty($form_data['birth-date'])){ echo $form_data['birth-date'];}?>">
                                                <span class="error-span">You must be 18+</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group validation_required <?php if(!empty($form_data['phone'])){ echo 'validation-success';}?>">
                                                <label for="number">Phone Number*</label><div class="float-right"><input class="form-check-input" type="checkbox" id="gridCheck" name="allow_text_message" <?php if(isset($form_data['allow_text_message']) && ($form_data['allow_text_message'] == 1 || $form_data['allow_text_message'] == 'on')){ echo 'checked';}?>>
                                                    <label class="form-check-label sing-up-check" for="gridCheck">Allow TEXT?
                                                    </label></div>
                                                <input type="text" class="form-control sing-up" id="number" aria-describedby="emailHelp" name="phone" value="<?php if(!empty($form_data['phone'])){ echo $form_data['phone'];}?>">
                                                <span class="error-span">Please provide a valid phone number!</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group validation_required <?php if(!empty($form_data['zip-code'])){ echo 'validation-success';}?>">
                                                <label for="zipcode">ZIP Code*</label>
                                                <input type="text" class="form-control sing-up" id="zipcode" aria-describedby="emailHelp" name="zip-code" value="<?php if(!empty($form_data['zip-code'])){ echo $form_data['zip-code'];}?>">
                                                <span class="error-span" data-invalid="Please provide a zip in the format #####">Please provide a zip in the format #####</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group validation_required <?php if(!empty($form_data['address'])){ echo 'validation-success';}?>">
                                                <label for="address">Address*</label>
                                                <input type="text" class="form-control sing-up" id="address" aria-describedby="emailHelp" name="address" value="<?php if(!empty($form_data['address'])){ echo $form_data['address'];}?>">

                                                <span class="error-span">Address field is too short!</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group text-center mt-4">
                                                <button type="submit" id="singBtn" class="btn sing-up-btn su-btn-next text-uppercase" data-id="upload_id">NEXT</button>
                                                <a href="<?php bloginfo('url');?>/login" class="btn  text-center or-login-btn text-uppercase" >OR LOGIN</a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>


            </div>
            <div role="tabpanel" class="tab-pane fade" id="upload_id">

                <!-- sing up upload-id section -->
                <div class="upload-section pb-5">
                    <div class="container">
                        <div class="row text-center align-items-center">
                            <div class="col-lg-6 col-md-8 col-sm-7  ml-auto">
                                <div class="upload-left-side py-5 px-5 font-side-upload" id="dz_upload1">
                                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/urban-upload.png" class="pt-3" alt="urban-upload-img">
                                    <h5 class="text-uppercase">UPLOAD Font Side</h5>
                                    <p class="pt-2">Drag and drop photo here or just click to <span class="font-side-btn green-text font-weight-bold">browse</span> files  </p>
                                </div>

                                <div class="upload-left-side py-5 px-5 back-side-upload" id="dz_upload2" style="display: none;">
                                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/urban-upload.png" class="pt-3" alt="urban-upload-img">
                                    <h5 class="text-uppercase">UPLOAD Back Side</h5>
                                    <p class="pt-2">Drag and drop photo here or just click to <span class="back-side-btn green-text font-weight-bold">browse</span> files  </p>
                                </div>

                                <p id="dz_upload1_err" class="validation_required"><span class="error-span">Please Upload both Front &amp; Back Side of your ID</span></p>
                                <p id="dz_upload1_err1" class="validation_required"><span class="error-span">Please Upload Only Images File for both Front &amp; Back Side of your ID</span></p>

                                <div class="upload-left-side py-5 px-5 back-side-upload" id="dz_upload3" style="display: none;">
                                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/urban-upload.png" class="pt-3" alt="urban-upload-img">
                                    <h5 class="text-uppercase">UPLOAD Medical ID</h5>
                                    <p class="pt-2">Drag and drop photo here or just click to <span class="back-side-btn green-text font-weight-bold">browse</span> files  </p>
                                </div>

                                <p id="dz_upload3_err" class=""><span class="error-span">Please Upload your Medical ID</span></p>
                                <p id="dz_upload3_err1" class=""><span class="error-span">Please Upload Only Images File your Medical ID</span></p>

                                <!--<div id="expired-date" class="input-group-items expired-date" style="display: none;">
                                    <i class="fa fa-calendar"></i>
                                    <input type="text" class="form-control" id="expired_date" name="expired_date"
                                           placeholder="Expired Date">
                                    <span class="error-span">Please select a valid expire date.</span>
                                </div>-->

                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-5" id="dz_preview_wrap">

                                <div class="preview_container_front dropzone-previews" id="preview_container_front">
                                    <div class="upload-right-side dash-border align-items-center" >
                                        <div class="box">
                                            <h5>Front SIDE</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview_container_back dropzone-previews" id="preview_container_back">
                                    <div class="upload-right-side dash-border align-items-center  mt-2" >
                                        <div class="box">
                                            <h5>BACK SIDE</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview_container_mid dropzone-previews" id="preview_container_mid">
                                    <div class="upload-right-side dash-border align-items-center  mt-2" >
                                        <div class="box">
                                            <h5>MEDICAL ID</h5><p>+if needed</p>
                                        </div>
                                    </div>
                                </div>

                                <!--
                                <div class="bg-gray border-3  align-items-center upload-right-side" id="font-side-uploaded">
                                    <a href="" class="close" data-dismiss="modal" aria-label="Close">X</a>
                                </div>

                                <div class="upload-right-side dash-border align-items-center  mt-2" >
                                    <div class="box">
                                        <h5>BACK SIDE</h5>
                                    </div>
                                </div>

                                <div class="upload-right-side dash-border mt-2">
                                    <div class="box">
                                        <h5>MEDICAL ID</h5><p>+if needed</p>
                                    </div>

                                </div>-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                                <div class="upload-button">
                                    <button type="submit" class="btn upload-back-btn pull-left su-btn" data-id="registration"><i aria-hidden="true" class="arrow_carrot-left"></i>BACK</button>
                                    <button type="submit" class="btn upload-next-btn su-btn-next float-right" data-id="upload_photo">NEXT</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sing up upload-id section -->
            </div>
            <div role="tabpanel" class="tab-pane fade" id="upload_photo">
                <!-- sing up upload-id section -->
                <div class="upload-section pb-5">
                    <div class="container">
                        <form action=" "  >
                            <div class="row text-center">
                                <div class="col-lg-6 col-md-8 col-sm-7  ml-auto">
                                    <h4 class="success_msg" style="display: none;"></h4>
                                    <div class="upload-left-side  upload-photo  py-5 px-5" id="dz_upload4">
                                        <input type="file" name="file" multiple class="d-none">
                                        <img src="<?php echo get_stylesheet_directory_uri();?>/images/urban-upload.png" class="pt-3" alt="urban-upload-img">
                                        <h5 class="text-uppercase">UPLOAD SELFIE</h5>
                                        <p class="pt-2">Drag and drop photo here or just click to <span class="upload-photo-btn green-text font-weight-bold">browse</span> files  </p>
                                    </div>
                                    <p id="dz_upload4_err" class="validation_required"><span class="error-span">Please Upload Your Photo</span></p>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-5">
                                    <div class="preview_container_pto dropzone-previews" id="preview_container_pto">
                                        <div class="upload-right-side dash-border align-items-center  mt-2" >
                                            <div class="box">
                                                <h5>Your Photo</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                                    <div class="upload-button">
                                        <input type="hidden" name="front_side" id="front_side" value="">
                                        <input type="hidden" name="back_side" id="back_side" value="">
                                        <input type="hidden" name="medical_id" id="medical_id" value="">
                                        <input type="hidden" name="photo_id" id="photo_id" value="">
                                        <input type="hidden" name="create_user" value="1">

                                        <button type="submit" class="btn su-btn upload-back-btn" data-id="upload_id"><i aria-hidden="true" class="arrow_carrot-left"></i>BACK</button>
                                        <button type="submit" class="btn upload-next-btn float-right" id="create_account">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- sing up upload-id section -->
            </div>
        </div>
    </div>

    <div class="wait wait-reg"></div>

<?php
get_footer();
