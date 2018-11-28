<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php 
 wp_title('|',true,'left'); ?>

</title>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
<!--[if IE]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" /><![endif]-->
<link href="<?php echo get_template_directory_uri(); ?>/css/comments.css" rel="stylesheet" type="text/css" /> 
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
<?php flush(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">
<div id="container">


<div id="header">
<div id="top">
<div class="siteinfo">
<h1><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a></h1></div>
<div class="site-description"><?php bloginfo( 'description' ); ?></div>
</div>
		<div class="topnav">	
		<?php 
			   wp_nav_menu( array( 'container_class' => 'header-menu', 'theme_location' => 'primary'  ) ); 
		?>
		
		
    	</div> 
<!-- SITEINFO END -->
<!-- TOPBANNER END -->


<div id="main">
<div class="innerwrap">
