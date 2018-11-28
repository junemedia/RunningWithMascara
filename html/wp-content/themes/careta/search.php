<?php
	get_header();
	
	if(have_posts()) :

?>

		<div id="post">
			<div class="post-list-content">
				<h1>
				<?php echo '<em>' . get_search_query() . '</em>'; ?>
				</h1>
			</div>
		</div>

<?php
	
		get_template_part('content', 'postlist');

	else :
	
		get_template_part('content', 'none');
	
	endif;
	
	get_footer();
?>
