<?php include 'email-header.php';?>

<!-- START CENTERED WHITE CONTAINER -->
<table role="presentation" class="main">

    <!-- START MAIN CONTENT AREA -->
    <tr>
        <td class="wrapper">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center">
                            <?php
                            $header_menu_logo = get_field('main_logo', 'option');

                            if( !empty($header_menu_logo) ): ?>

                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img src="<?php echo $header_menu_logo; ?>" class="img-fluid" alt="" />
                                </a>
                            <?php endif; ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php
                            $registration_email_text_to_user = get_field('registration_email_text_to_user','option');
                            if(!empty($registration_email_text_to_user)){
                                echo $registration_email_text_to_user;
                            }else{
                                ?>
                                <p>Hi {FULL_NAME},</p>
                                <p>We received your registration request. Your account is under review!</p>
                                <p>You will be get confirmation email after approved!</p>
                                <p>Thank you!</p>
                            <?php };?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <!-- END MAIN CONTENT AREA -->
</table>

<?php include 'email-footer.php';?>