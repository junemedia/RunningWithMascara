		<div id="post-list">
			<div id="col1" class="col"></div>
			<div id="col2" class="col"></div>
			<div id="col3" class="col"></div>
			<div id="col4" class="col"></div>
		<?php
		$i = 0;
		$c = 0;
		$style = get_theme_mod('careta_category_style','variable');		

		while(have_posts()) :
			$i++;
			$c++;
			if ($c > 4) $c = 1;
			
			
			the_post();
			$classes = array();
			$displayColor = "";
			$displayExcerpt = (bool) get_theme_mod('careta_display_excerpts', true);
			$displayMoreLink = (bool) get_theme_mod('careta_display_more', true);
			$highlightColor = get_theme_mod('careta_highlight_color', '#10234F');
			$textHoverColor = get_theme_mod('careta_text_hover_color', '#ffffff');
			$custom = get_post_custom();
			if(!$displayExcerpt) $classes[] = 'no-excerpt';
			if(!$displayMoreLink) $classes[] = 'no-more';
			
			$custombackground = null;
			$customtext = null;
			if (isset($custom) && careta_index_exists($custom,'careta-box-color'))
			{
				$array = $custom['careta-box-color'];
				$custombackground = $array[0];
			}
			
			if (isset($custom) && careta_index_exists($custom,'careta-box-text-color'))
			{
				$array = $custom['careta-box-text-color'];
				$customtext = $array[0];
			}
			
			if ($customtext != null || $custombackground != null)
			{
				echo "<style>";
					if ($custombackground != null)
					{
						echo "#post-" . $i;
						echo "{";
						echo "background: " . $custombackground . ";";
						echo "}";
					}
					
					if ($customtext != null) 
					{
						echo "#post-" . $i . " h2";
						echo "{";
						echo "color: " . $customtext . " !important;";
						echo "}";
					}
				echo "</style>\n";
			}
			$classes[] = "col" . $c;
?>
			<div id="post-<?php echo $i; ?>" <?php post_class(implode(' ', $classes)); ?> title="<?php echo htmlspecialchars(strip_tags(get_the_title())); ?>">
				<?php if(is_sticky()) : ?><span class="sticky-icon"></span><?php endif; ?>
				<?php if(!$displayMoreLink) : ?><a href="<?php the_permalink(); ?>" title="<?php echo htmlspecialchars(strip_tags(get_the_title())); ?>" class="no-more"><?php endif; ?>
				<?php 
					if (has_post_thumbnail())
					{
						the_post_thumbnail('medium', array('class' => 'post-thumb', 'title' => htmlspecialchars(strip_tags(get_the_title())))); 
					}
					else
					{
						careta_draw_transparent();
					}
				?>
				<h2><?php careta_cut_text(get_the_title(),150); ?></h2>
				<?php if($displayExcerpt) : ?><span><?php echo strip_tags(get_the_excerpt()); ?></span><?php endif; ?>
				<?php if($displayMoreLink) : ?><span class="tr"><a href="<?php the_permalink(); ?>" title="<?php echo htmlspecialchars(strip_tags(get_the_title())); ?>"><?php _e('More...'); ?></a></span><?php endif; ?>
				<?php if(!$displayMoreLink) : ?></a><?php endif; ?>
			</div>
		<?php
		//echo "\n";
		endwhile;
		?>
		</div>
		
		<div id="post-navi">
			<?php 
				$big = 999999999; 
				if ($wp_query->max_num_pages > 1) echo __('Pages') . ' : ' ;
				echo paginate_links(array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ), 
						'format' => '?paged=%#%', 'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages,
						'prev_next' => False
				));
			?>
		</div>
