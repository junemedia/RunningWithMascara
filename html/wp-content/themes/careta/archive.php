<?php
	get_header();
	
	if(have_posts()) :
?>
		<div id="post">
			<div class="post-list-content">
				<h1><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'careta' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						echo __('Select Month') . ':';
						echo get_the_date( _x( 'F Y', 'monthly archives date format', 'careta' )   );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'careta' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'careta' ) ) . '</span>' );
					else :
						_e( 'Archives', 'careta' );
					endif;
				?></h1>
			</div>
		</div>
		
<?php
		get_template_part('content', 'postlist');

	else :
	
		get_template_part('content', 'none');
	
	endif;
	
	get_footer();
?>
