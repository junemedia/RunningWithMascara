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
				<?php echo "<img src='$folder/post-date.png'  width='16px' height='16px'>"; ?>
				<?php the_date(); ?>
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
				'before'           => '<div id="post-navi">' . __('Pages:'),
				'after'            => '</div>',
				'link_before'      => '<span class="page-numbers">',
				'link_after'       => '</span>'							
			));
		?>
		
		<?php if($displayAuthor) : ?>
			<div class="author-box">
			   <div class="author-pic"><?php echo get_avatar( get_the_author_meta('email') , '80' ); ?></div>
			   <div class="author-name"><strong><?php the_author_meta( "display_name" ); ?></strong></div>
			   <div class="author-bio"><?php the_author_meta( "user_description" ); ?></div>
			</div>
		<?php endif; ?>
	
		<?php comments_template(); ?>			
		</div>
	<?php endwhile; ?>
	
	</div>
	
	

<?php get_footer(); ?>