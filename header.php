<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package urban_flavours
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body <?php body_class(); ?>>
    <div class="wrapper">
        <!-- /.header start  -->
        <header class="header <?php if(is_home()){?>position-absolute<?php };?> <?php if(!is_home()){?> inner-header<?php };?>">

            <nav class="navbar  navbar-expand-md custom-nav ">
                <a href="<?php bloginfo('url');?>" class="navbar-brand mr-0"><?php echo get_field('site_name', 'option');?></a>
                <button class="navbar-toggler ml-1" type="button" data-toggle="collapse" data-target="#collapsingNavbar2">
                    <span class="pe-7s-menu  pe-2x pe-va white-text"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-between align-items-center w-100" id="collapsingNavbar2">
                    <?php
                    wp_nav_menu( array(
                        'menu_class'        => "navbar-nav mx-auto menu",
                        'container'         => "",
                        'theme_location'    => 'menu-header',
                        'walker'            => new WP_Bootstrap_Navwalker()
                    ) );
                    ?>
                    <ul class="nav navbar-nav flex-row  flex-nowrap user-menu">
                        <li class="nav-item"><a id="advance_search_btn" class="nav-link" href="javascript:void(0);"><i class="pe-7s-search  pe-2x pe-va mr-1"></i></a></li>
                    </ul>
                </div>
            </nav>

        </header>
        <!-- /.header -->
        <!-- /.main start  -->
        <main class="main">
            <?php //global $template;echo $template;?>
