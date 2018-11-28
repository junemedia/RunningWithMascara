<?php get_header(); ?>

<div id="content">
<div id="contentinner">
<div class="sticky">
<?php 
$args = array(  
    'posts_per_page' => 1,  
    'post__in'  => get_option('sticky_posts'),  
    'ignore_sticky_posts' => 1,

);  
$query1 = new WP_Query($args); 
while($query1->have_posts()){ $query1->the_post();  ?>
<div <?php post_class(); ?>>
<?php if ( has_post_thumbnail() ) { ?>
<div class="thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(array(220,9999), array('class' => 'aligncenter')); ?></div></a>
<?php } else { ?>
<div class="thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/post-default.jpg" alt="<?php the_title(); ?>" class="aligncenter" /></a></div>
<?php } ?>
<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></h2>
<div class="post-content"><?php clm_the_post_excerpt($excerpt_length=15); ?></div></a>

<div class="post-date"><?php the_time('j F G:i') ?></div>
</div>
<?php if (clm_get_option('ads_120_600_post', '') != '' ): ?>
<div style="float:left; margin-top:10px;">
<?php echo clm_get_option('ads_120_600_post'); ?>
</div>
<?php 
      endif;?>
<?php }  

wp_reset_postdata();  ?>
</div>
<div id="post-entry">
<?php  if (is_tag())
  {
    echo '<h1 style="font-style:oblique">';
    printf( __( 'Tag Archives: %s', 'columnist' ), '<span>' . single_tag_title( '', false ) . '</span>' );
	echo '</h1>';
  };  
 $postcounter = 0; if (have_posts()) : ?>

<?php while (have_posts()) : $postcounter = $postcounter + 1; the_post(); ?>

<div class="post-meta" id="post-<?php the_ID(); ?>">
<?php if ( has_post_thumbnail() ) { ?>
<div class="thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(array(220,9999), array('class' => 'aligncenter')); ?></a></div>
<?php } else { ?>
<div class="thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/post-default.jpg" alt="<?php the_title(); ?>" class="aligncenter" /></a></div>
<?php } ?>
<div class="post-content"><a href="<?php the_permalink(); ?>"><?php clm_the_post_excerpt($excerpt_length=15); ?></a></div>
<div class="post-date"><?php the_time('j F G:i') ?></div>

</div><!-- POST META <?php the_ID(); ?> END -->

<?php endwhile; ?>

<?php else : ?>

<p class="center"><?php _e( 'Sorry but nothing matched your search criteria. Please try again with some different keywords.', 'columnist' ); ?></p>

<?php endif; 
wp_reset_postdata();  ?>
<div id="nav"><?php if (function_exists('clm_wp_corenavi')) clm_wp_corenavi(); ?></div>
</div><!-- POST ENTRY END -->

</div><!-- CONTENTINNER END -->
</div><!-- CONTENT END -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>