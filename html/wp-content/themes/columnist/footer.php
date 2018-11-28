<div class="clearfix"></div>
</div><!-- INNERWRAP END -->
</div><!-- MAIN END -->

<div id="footer">

<!-- BOTTOM -->
<?php if (get_option('clm_show_bottom', '0') == '1') : ?>
<div id="content-bottom">
<div id="contentinner-bottom">
<div id="post-entry-bottom-y">
<h2><?php _e( 'Yesterday', 'columnist' ) ?></h2><hr>
<?php 
global $query_string;  
$today = getdate();
$query3 = new WP_Query($query_string .'year=' .$today["year"] .'&monthnum=' .$today["mon"] .'&day=' .($today["mday"]-1) .'&posts_per_page=8');  ?>
<?php while($query3->have_posts()){ $query3->the_post(); ?>
<div class="post-meta" id="post-<?php the_ID(); ?>">

<div class="post-content"><a href="<?php the_permalink(); ?>"><?php clm_the_post_excerpt($excerpt_length=15); ?></a></div>

<div class="post-date"><?php the_time('j F') ?></div>

</div><!-- POST META END -->

<?php }  

wp_reset_postdata();  ?>
</div>

<div id="post-entry-bottom-w">
<h2><?php _e( 'Week', 'columnist' ) ?></h2><hr>
<?php 
function filter_where($where = '') {
 $where .= " AND post_date > '" . date('Y-m-d', strtotime('-7 days')) . "'";
 return $where;
}
add_filter('posts_where', 'filter_where');
$query4 = new WP_Query('post_type=post&posts_per_page=4&orderby=comment_count&order=DESC&ignore_sticky_posts=1'); 
 ?>


<?php while($query4->have_posts()){ $query4->the_post(); ?>
<div class="post-meta" id="post-<?php the_ID(); ?>">

<div class="post-content"><a href="<?php the_permalink(); ?>"><?php clm_the_post_excerpt($excerpt_length=15); ?></a></div>

<div class="post-date"><?php the_time('j F') ?></div>

</div><!-- POST META END -->

<?php }  
remove_filter( 'posts_where', 'filter_where' );
wp_reset_postdata();
 ?>
</div>

<div id="post-entry-bottom-m">
<h2><?php _e( 'Month', 'columnist' ) ?></h2><hr>
<?php 
global $query_string;  
$today = getdate();
$query5 = new WP_Query($query_string .'year=' .$today["year"] .'&monthnum=' .$today["mon"] .'&posts_per_page=4' .'&orderby=comment_count' .'&order=ASC'); 
 ?>
<?php while($query5->have_posts()){ $query5->the_post(); ?>
<div class="post-meta" id="post-<?php the_ID(); ?>">

<div class="post-content"><a href="<?php the_permalink(); ?>"><?php clm_the_post_excerpt($excerpt_length=15); ?></a></div>

<div class="post-date"><?php the_time('j F ') ?></div>

</div><!-- POST META END -->

<?php }  

wp_reset_postdata();  ?>
</div>

<div id="post-entry-bottom-f">
<h2><?php _e( 'Photo', 'columnist' ) ?></h2><hr>
<?php $format = get_post_format();  
get_template_part( 'format', $format );  

$query6 = new WP_Query( array(
'posts_per_page' => 1,
	'tax_query' => array(
		array(
		'taxonomy' => 'post_format',
		'field'    => 'slug',
		'terms'    => array( 'post-format-gallery' )
		)
	 )
));
?>

<?php while($query6->have_posts()){ $query6->the_post(); ?>
<div class="post-meta" id="post-<?php the_ID(); ?>">
<?php if ( has_post_thumbnail() ) { ?>
<div class="thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(array(290,9999), array('class' => 'aligncenter')); ?></div></a>
<?php } else { ?>
<div class="thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/post-default.jpg" alt="<?php the_title(); ?>" class="aligncenter" /></a></div>
<?php } ?>




</div><!-- POST META END -->

<?php }  

wp_reset_postdata();  ?>
</div>

</div>
<?php endif; ?>
<!-- BOTTOM END -->

<div id="footer-left">
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'columnist' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'columnist' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'columnist' ), 'Columnist', '<a href="http://wpmole.com" rel="designer">WPMole</a>' ); ?>
</div><!-- FOOTER LEFT END -->

<div class="clearfix"></div>

</div><!-- FOOTER END -->

</div><!-- CONTAINER END -->
</div><!-- WRAPPER END -->
<?php wp_footer(); ?>
</body>
</html>