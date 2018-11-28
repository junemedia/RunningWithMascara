<?php get_header(); ?>

<div class="content">
<img src="<?php bloginfo('template_url'); ?>/images/img_08.jpg" alt="" />
	<div class="contenttext">

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="postheader">
				<div class="postdate">
					<div class="postday"><?php the_time('j') ?></div> <!-- POST DAY -->
					<div class="postmonth"><?php the_time('M') ?></div> <!-- POST MONTH -->
				</div> <!-- POST DATE -->
				
				<div class="posttitle">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				</div> <!-- POST TITLE -->

				<div class="postmeta">
					<div class="postauthor">by <?php the_author() ?></div> <!-- POST AUTHOR -->
					<div class="postcategory"><?php the_category(', ') ?></div> <!-- POST CATEGORY -->
				</div> <!-- POST META -->
			</div> <!-- POST HEADER -->
			<div style=" clear:both;"></div>
			<div class="posttext">
				<?php the_content('Read the rest of this entry &raquo;'); ?>
			</div> <!-- POST TEXT -->
			<div style="clear:both;"></div>
		</div> <!-- POST -->
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div> <!-- CONTENT TEXT -->
<img src="<?php bloginfo('template_url'); ?>/images/img_09.jpg" style="vertical-align: bottom;" alt="" />
</div> <!-- CONTENT -->


<?php get_sidebar(); ?>

<?php get_footer(); ?>