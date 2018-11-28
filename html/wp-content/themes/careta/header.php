<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style.css" />

<?php $blogTitle = get_bloginfo('name'); ?>
<title><?php wp_title('&middot;', true, 'right'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class('lt-480'); ?>>
<div id="page-wrap">
<div id="page">

	<a id="mobile-menu" href="#menu"></a>
	
	<div id="header">
		<div class="wrap">
			<div class="inner">
				<?php
					$headerImage = get_theme_mod('careta_header_image', '');
					$headerShowName = (bool)get_theme_mod('careta_header_showname', true); 
					$headerShowMenu = (bool)get_theme_mod('careta_header_showmenu', true);
					
				?>
				
				<a href="<?php echo home_url(); ?>" title="<?php echo str_replace('"', '\'', $blogTitle); ?>">
				<div id="blog-title"> 
					<?php 
						if ($headerShowName)
						{
							echo $blogTitle;
						}
						else
						{
							echo "&nbsp;";
						}
					?>
				&nbsp;
				</div>
				</a>
				
				<?php if ($headerShowMenu) { ?>
					<div id="menu">
					<?php
						wp_nav_menu(array(
							'theme_location' => 'primary',
							'container' => false
						));
					?>
					</div>
				<?php } ?>
			</div>
			
			<?php if (get_theme_mod('careta_social_location', 'header') == 'header') careta_draw_social();  ?>
		</div>
	</div>

	<div id="main" class="wrap clear">