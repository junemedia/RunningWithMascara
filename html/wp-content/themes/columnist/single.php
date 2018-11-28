<?php get_header(); ?>

<div id="content">
<div id="contentinner">

<div id="post-entry-single">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<div class="post-meta-single" id="post-<?php the_ID(); ?>">
<div class="post-info">
<h1><?php the_title(); ?></h1>
<div class="post-date"><?php the_author_posts_link(); ?> <?php the_time('j F G:i') ?></div><!-- POST DATE END -->
<?php if ( has_post_thumbnail() ) { ?>
<div class="thumb"><?php the_post_thumbnail(array(400,9999), array('class' => 'aligncenter')); ?></div>  <?php if (get_the_tag_list()) : ?>  
  <div class="taggs">  
<?php echo get_the_tag_list('',', ',''); ?>
  </div>  
  <?php endif; ?>
<?php } else { ?>

	 <?php if (get_the_tag_list()) : ?>  
  <div class="taggs1">  
<?php echo get_the_tag_list('',', ',''); ?>
  </div>  
  <?php endif; ?>
<?php } ?>

</div><!-- POST INFO END -->
<div class="post-content">
<?php the_content(); ?>
	<div class="clear"></div>
<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
<div class="post-nav">
			<div class="post-nav-l"><?php previous_post_link(__('&larr; %link', '<span class="meta-nav">' . '</span> %title', 'exility')); ?></div>
			<div class="post-nav-r"><?php next_post_link( __('%link &rarr;', '%title <span class="meta-nav">' . '</span>' , 'exility')); ?></div>
				</div>
				<div class="clear"></div>
<div class="single-com"><?php comments_template( '', true ); ?></div>
</div><!-- POST CONTENT END -->
</div><!-- POST META <?php the_ID(); ?> END -->

<?php endwhile; 
wp_reset_postdata();  ?>

<div id="single-entry">
<?php $temp = $wp_query; $wp_query= null; $wp_query = new WP_Query('showposts=&cat=&paged=' . $paged);?>
<?php query_posts(array("post__not_in" =>get_option("sticky_posts")));  ?>
<?php $postcounter = 0; if ($wp_query->have_posts()) : ?>

<?php while ($wp_query->have_posts()) : $postcounter = $postcounter + 1; $wp_query->the_post();?>


<div class="post-meta" id="post-<?php the_ID(); ?>">
<div <?php post_class(); ?>>
<?php if (!is_sticky()) { ?>


<!-- <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>-->

<div class="post-content"><a href="<?php the_permalink(); ?>"><?php clm_the_post_excerpt($excerpt_length=15); ?></a></div>

<div class="single-date"><?php the_time('j F G:i') ?></div>

<?php }?>
</div><!-- POST META <?php the_ID(); ?> END -->
</div>
<?php endwhile; 
wp_reset_postdata();  ?>
<?php else : ?>

<p class="center"> <?php _e( 'Sorry but nothing matched your search criteria. Please try again with some different keywords.', 'columnist' ); ?></p>

<?php endif; ?>
</div>


<?php else : ?>



<p class="center"> <?php _e( 'Sorry but nothing matched your search criteria. Please try again with some different keywords.', 'columnist' ); ?></p>

<?php endif; ?>

</div><!-- POST ENTRY END -->



</div><!-- CONTENTINNER END -->
</div><!-- CONTENT END -->

<?php get_sidebar(); ?>


<?php get_footer(); ?>