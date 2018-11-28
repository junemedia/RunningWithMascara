<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--[if IE 7]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie7.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 6]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie6.css" type="text/css" media="screen" />
<![endif]-->

<?php wp_head(); ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-10900002-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<meta name="google-site-verification" content="d7U_D-ar0XhcLpSVU-spuwWdJ11prkinnEsaucNrKJM" />
<link href="<?php bloginfo('template_url'); ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
<div class="all">
	<div class="header">
		<p><img src="http://pics.fitandfabliving.com/RWM-header.jpg" width="750" height="200" border="0" usemap="#ImageMap1">&nbsp;</p>
<map name="ImageMap1">
<area shape="rect" coords="322, 153, 726, 194" href="http://www.fitandfabliving.com">
<area shape="rect" coords="2, 3, 747, 198" href="http://www.runningwithmascara.com">

</map>
</p>
	</div> <!-- HEADER -->

<div class="menu1">
<div class="menu2">
	<ul>
		<li<?php if (is_home()) { echo ' class="current_page_item"'; } ?>><a href="<?php echo get_option('home'); ?>/">home</a></li>
		<?php wp_list_pages('title_li=' ); ?>
	</ul>
</div> <!-- MENU 2 -->
</div> <!-- MENU 1 -->