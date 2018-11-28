<?php get_header(); ?>

<div id="content">
<div id="contentinner">

<div id="post-entry-single">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<div class="post-meta-page" id="post-<?php the_ID(); ?>">
<div class="post-info">
<h1><?php the_title(); ?></h1>
</div><!-- POST INFO END -->
<div class="post-content">
<?php the_content(); ?>
	<div class="clear"></div>
<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
<?php comments_template( '', true ); ?>
</div><!-- POST CONTENT END -->
</div><!-- POST META <?php the_ID(); ?> END -->

<?php endwhile; ?>

<?php else : ?>

<p class="center"><?php _e( 'Sorry but nothing matched your search criteria. Please try again with some different keywords.', 'columnist' ); ?></p>

<?php endif; ?>

</div><!-- POST ENTRY END -->



</div><!-- CONTENTINNER END -->
</div><!-- CONTENT END -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>