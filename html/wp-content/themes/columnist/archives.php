<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="content">
<div id="contentinner">

<ul id="archives">
<li>

<ul><?php wp_get_archives('type=monthly'); ?></ul>

<ul><?php wp_list_categories(); ?></ul>	

<ul><?php query_posts('showposts=50'); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'adsticle' ), 
    the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></li>
<?php endwhile; else: endif; ?>
</ul>				
</li>
</ul><!-- ARCHIVES END -->

</div><!-- CONTENTINNER END -->
</div><!-- CONTENT END -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>