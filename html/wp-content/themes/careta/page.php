
<?php get_header(); ?>
	<div id="post">
		<div class="post-content">
		<?php while(have_posts()) : the_post(); ?>

		<?php
				$displayTags = (bool) get_theme_mod('careta_display_tags', true);
				$displayAuthor = (bool) get_theme_mod('careta_display_author', true);
				$displayCategory = (bool) get_theme_mod('careta_display_category', true);
				$displayDate = (bool) get_theme_mod('careta_display_date', true);
				$folder = get_template_directory_uri()  . "/images/";
		?>
					<div id="post-details">
						<?php if($displayDate) : ?>
							<?php echo "<img src='$folder/post-date.png' width='16px' height='16px'>"; ?>
							<?php the_date(); ?>
							<?php echo "&nbsp;&nbsp;" ?>
						<?php endif; ?>

						<?php if($displayAuthor) : ?>
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 16 ); ?>
							<?php the_author(); ?> 
							<?php echo "&nbsp;&nbsp;" ?>
						<?php endif; ?>

						<?php if($displayTags && get_the_tags()) : ?>
							<?php echo "<img src='$folder/post-tags.png' width='16px' height='16px'>"; ?>
							<?php echo the_tags(); ?>
						<?php endif; ?>
						
						<?php if($displayCategory && get_the_category()) : ?>
							<?php echo "<img src='$folder/post-category.png' width='16px' height='16px'>"; ?>
							<?php the_category(' '); ?>
							<?php echo "&nbsp;&nbsp;" ?>
						<?php endif; ?>
					</div>
					
					<h3><?php the_title(); ?></h3>
					<?php  the_content(); ?>
					
					
					<?php
						wp_link_pages(array
						(
							'before'           => '<p class="tr post-pages">' . __('Pages:', 'fluxibox'),
							'after'            => '</p>',
							'nextpagelink'     => __('Next page', 'careta'),
							'previouspagelink' => __('Previous page', 'careta'),
						));
					?>
				<?php comments_template(); ?>			
				</div>
	<?php endwhile; ?>
	</div>
	
	

<?php get_footer(); ?>

<!--
<?php get_header(); ?>
	<div id="post">
		<div class="post-content">
		<?php while(have_posts()) : the_post(); ?>
				<h3><?php the_title(); ?></h3>
				<?php the_content(); ?>
		<?php endwhile; ?>
		</div>
		<?php comments_template(); ?>
	</div>
	
<?php get_footer(); ?>

-->
