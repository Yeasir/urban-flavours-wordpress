<?php include 'email-header.php';?>

<!-- START CENTERED WHITE CONTAINER -->
<table role="presentation" class="main">
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
    <!-- START MAIN CONTENT AREA -->
    <tr>
        <td class="wrapper">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <?php
                        $approve_notification_email_text = get_field('approve_notification_email_text','option');
                        if(!empty($approve_notification_email_text)){
                            echo $approve_notification_email_text;
                        }else{
                            ?>
                            <p>Hi {FULL_NAME},</p>
                            <p>Your account has been activated!</p>
                            <p>Please try to loggedIn!</p>
                            <p>Thank you!</p>
                        <?php };?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- END MAIN CONTENT AREA -->
    </tbody>

</table>

<?php include 'email-footer.php';?>