<?php if(is_active_sidebar('sidebar-footer')) : ?>

<div id="sidebar-footer" class="clear">
	<div id="fcol1" class="col"></div>
	<div id="fcol2" class="col"></div>
	<div id="fcol3" class="col"></div>
	<div id="fcol4" class="col"></div>
	<?php dynamic_sidebar('sidebar-footer'); ?>
	<?php 
		if (get_theme_mod('careta_social_location', 'header') == 'footer') 
		{
			echo "<div style=\"clear:both;float:right;\">";
			careta_draw_social();  
			echo "</div>";
		}
	?>
</div>
	<?php 
		$themeInfo = get_theme_mod('careta_themeinfo_text', 'Theme Careta by <a href="http://mcunha98.wordpress.com">MCunha98</a>');
		if (trim($themeInfo) != '')
		{
		?>
			<div id="themeinfo">
				<?php echo $themeInfo; ?>
			</div>
		<?php
		}
	?>

<?php endif; ?>