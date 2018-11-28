<?php 
  function clm_get_option($Aoption_name, $default = null)
  {
    return stripslashes(get_option($Aoption_name, $default));
  };

	$themename = "columnist";
	$defaults = array(
	'default-color'          => '#dcdcdc',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );


function clm_filter_wp_title( $title ) {
	global $page, $paged;
    $site_name = get_bloginfo( 'name' );
    $filtered_title = $site_name . $title;
      return $filtered_title;
	  $site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'columnist' ), max( $paged, $page ) ); 
}

add_filter( 'wp_title', 'clm_filter_wp_title' );

function clm_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'clm_add_editor_styles' );	


function clm_theme_styles()  
{ 
  wp_register_style( 'custom-style', 
    get_template_directory_uri() . '/css/comments.css'
);
  wp_enqueue_style( 'custom-style' );
}
add_action('wp_enqueue_scripts', 'clm_theme_styles');



	
function clm_register_my_menus()
{
register_nav_menus
(
array( 
	'primary' => __( 'Primary Menu', 'columnist'),
	'header-cats' => __( 'Header Categories', 'columnist' ),
));
}
	add_action( 'after_setup_theme', 'clm_register_my_menus' );	

  function clm_template_setup() 
  {	
 	 if ( ! isset( $content_width ) ) 
        $content_width = 630;
	add_theme_support( 'automatic-feed-links' );	
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'gallery' ) );
	set_post_thumbnail_size( 280, 150, true ); 
	load_theme_textdomain('columnist', get_template_directory() . '/languages');
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if (is_readable($locale_file ))
	  require_once($locale_file);	    
  };
  add_action('after_setup_theme', 'clm_template_setup');
  

 function clm_enqueue_comment_reply() {	

	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );	
	
    }

// Short Featured Title

function clm_short_feat_title() {
 $title = get_the_title();
 $count = strlen($title);
 if ($count >= 30) {
 $title = substr($title, 0, 30);
 $title .= '...';
 }
 echo $title;
}


 if ( ! function_exists( 'clm_comment' ) ) :	
  function clm_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>			
			<?php printf( __( '%s', 'columnist' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'columnist' ); ?></em>
			<br />
		<?php endif; ?>

<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'columnist'), get_comment_date('n-j-Y'), get_comment_time('H:i:s')) ?></a><?php edit_comment_link(__('(Edit)', 'columnist'),'  ','') ?>

</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php sanitize_text_field(comment_text()); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'columnist' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'columnist' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
  };
  endif; 


//  Standard Post Image

function clm_get_post_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $matches[1][0] = '';
  $first_img = $matches [1] [0];


  if(empty($first_img)){ 
  	$img_dir = get_template_directory_uri();
    $first_img = $img_dir . '/images/post-default.jpg';
  }
  return $first_img;
}



// Standard Post Excerpt


function clm_the_post_excerpt($excerpt_length='', $allowedtags='', $filter_type='none', $use_more_link=false, $more_link_text="Read More", $force_more_link=false, $fakeit=1, $fix_tags=true) {

	if (preg_match('%^content($|_rss)|^excerpt($|_rss)%', $filter_type)) {

		$filter_type = 'the_' . $filter_type;

	}

	$text = apply_filters($filter_type, clm_get_the_post_excerpt($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit));

	$text = ($fix_tags) ? balanceTags($text) : $text;

	echo $text;

}

function clm_get_the_post_excerpt($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit) {

	global $id, $post;

	$output = '';

	$output = $post->post_excerpt;

	if (!empty($post->post_password)) { 

		if ( post_password_required() ) {  
			$output = __('There is no excerpt because this is a protected post.', 'columnist');

			return $output;

		}

	}



	if ((($output == '') && ($fakeit == 1)) || ($fakeit == 2)) {

		$output = $post->post_content;

		$output = strip_tags($output, $allowedtags);

        $output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );

		$blah = explode(' ', $output);

		if (count($blah) > $excerpt_length) {

			$k = $excerpt_length;

			$use_dotdotdot = 1;

		} else {

			$k = count($blah);

			$use_dotdotdot = 0;

		}

		$excerpt = '';

		for ($i=0; $i<$k; $i++) {

			$excerpt .= $blah[$i] . ' ';

		}


		if (($use_more_link && $use_dotdotdot) || $force_more_link) {

			$excerpt .= "...&nbsp;<a href=\"". get_permalink() . "#more-$id\" class=\"more-link\">$more_link_text</a>";

		} else {

			$excerpt .= ($use_dotdotdot) ? '...' : '';

		}

		 $output = $excerpt;

	} 

	return $output;

}


// Excerpt Feature Category

function clm_the_excerpt_feat_cat($excerpt_length='', $allowedtags='', $filter_type='none', $use_more_link=false, $more_link_text="Read More", $force_more_link=false, $fakeit=1, $fix_tags=true) {

	if (preg_match('%^content($|_rss)|^excerpt($|_rss)%', $filter_type)) {

		$filter_type = 'the_' . $filter_type;

	}

	$text = apply_filters($filter_type, clm_get_the_excerpt_feat_cat($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit));

	$text = ($fix_tags) ? balanceTags($text) : $text;

	echo $text;

}

function clm_get_the_excerpt_feat_cat($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit) {

	global $id, $post;

	$output = '';

	$output = $post->post_excerpt;

	if (!empty($post->post_password)) { 

		if ($_COOKIE['wp-postpass_'.COOKIEHASH] != $post->post_password) {  
			$output = __('There is no excerpt because this is a protected post.', 'columnist');

			return $output;

		}

	}



	if ((($output == '') && ($fakeit == 1)) || ($fakeit == 2)) {

		$output = $post->post_content;

		$output = strip_tags($output, $allowedtags);

        $output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );

		$blah = explode(' ', $output);

		if (count($blah) > $excerpt_length) {

			$k = $excerpt_length;

			$use_dotdotdot = 1;

		} else {

			$k = count($blah);

			$use_dotdotdot = 0;

		}

		$excerpt = '';

		for ($i=0; $i<$k; $i++) {

			$excerpt .= $blah[$i] . ' ';

		}


		if (($use_more_link && $use_dotdotdot) || $force_more_link) {

			$excerpt .= "...&nbsp;<a href=\"". get_permalink() . "#more-$id\">$more_link_text</a>";

		} else {

			$excerpt .= ($use_dotdotdot) ? '...' : '';

		}

		 $output = $excerpt;

	} 

	return $output;

}



// Sidebar Widget
function clm_widget_init() {	
	register_sidebar(array('name'=>'Sidebar',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h6>',
	'after_title' => '</h6>',
	));
  } 	
add_action( 'widgets_init', 'clm_widget_init' );

function clm_wp_corenavi() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 1; 
  $a['mid_size'] = 3; 
  $a['end_size'] = 1; 
  $a['prev_text'] = '&laquo;'; 
  $a['next_text'] = '&raquo;'; 

  if ($max > 1) echo '<div class="navigation">';

  echo $pages . paginate_links($a);
  if ($max > 1) echo '</div>';
}

add_action('wp_head', 'clm_head');

  function clm_head()
  {  
    if (!is_admin())
	{
	  global $clm_favicon_url;
?>	
<link rel="shortcut icon" href="<?php echo sanitize_text_field(clm_get_option('clm_favicon_url', $clm_favicon_url)); ?>" type="image/x-icon" />


<?php	  
	};
  };   


function clm_general_options_input() {  
register_setting('clm_general_options_page','clm_general_options_page','clm_options_validate'); 
register_setting( 'clm_general_options_page', 'ads_120_600_post' ); 
register_setting( 'clm_general_options_page', 'clm_favicon_url' ); 
register_setting( 'clm_general_options_page', 'clm_show_bottom' ); 
}

add_action( 'admin_init', 'clm_general_options_input' );  		

 if ( ! function_exists( 'clm_options_admin_menu' ) ) :
  function clm_options_admin_menu() 
  {	    
	$clm_theme_page = add_theme_page(__("Columnist Options", 'columnist'), __("Columnist Options", 'columnist'), 
	  'edit_theme_options', 'clm_general_options_page', 'clm_general_options_page');	
  };
  endif; 
  
  add_action('admin_menu', 'clm_options_admin_menu');
  
	$clm_options = get_option( 'clm_options' );	
	$ads_120_600_post = esc_textarea($clm_options[trim('ads_120_600_post')]);
	
	     
 
   function clm_options_update() 
   {
     global $_POST, $clm_favicon_url;
		
	 if ($_POST['clm_favicon_url'] != '')
	 {
	   update_option('clm_favicon_url', $_POST['clm_favicon_url']);
	 } else 
	 {
	   update_option('clm_favicon_url', $clm_favicon_url);	  
	 };
	 
	 	if ($_POST['clm_show_bottom'] != '')
	{
	  update_option('clm_show_bottom', $_POST['clm_show_bottom']);
	} else 
	{
	  update_option('clm_show_bottom', '0');	  
	};
		
		  };
  function clm_options_validate ( $clm_options) {  
    $output = array();  
    if(isset($clm_options) && is_array($clm_options)) foreach( $clm_options as $key => $value ) {  
        if( isset( $clm_options[$key] ) ) {  
            $output[$key] = strip_tags( stripslashes( $clm_options[ $key ] ) );        
        }          
    }  
    return apply_filters( 'clm_options_validate', $output, $clm_options );    
} 
 
  function clm_general_options_page()
  {
    global  $_POST, $clm_favicon_url; 
	
 if ( isset($_POST['update_options']) && $_POST['update_options'] == 'true' )
?>	
	    <div class="wrap">
		<div id="icon-options-general" class="icon32"><br /></div>
      		<h2><?php _e('Columnist General Options', 'columnist'); ?></h2>

        <form method="post" action="options.php">
		<?php 
 wp_nonce_field('update-options'); 
settings_fields( 'clm_general_options_page' );?>
			
            <table class="form-table">

 <tr valign="top">
                    <th scope="row"><label for="clm_favicon_url"><?php _e('Favicon:', 'columnist'); ?></label></th>
                    <td><input type="text" name="clm_favicon_url" size="95" 
					  value="<?php echo sanitize_text_field(clm_get_option('clm_favicon_url')); ?>"/>
					<br/>
					<span class="description"> 
					<?php printf(__('<a href="%s" target="_blank">Upload your favicon</a> using WordPress Media Library and insert its URL here', 
					  'columnist'), home_url().'/wp-admin/media-new.php'); ?>
					</span><br/><br/>
					<img src="<?php echo sanitize_text_field(clm_get_option('clm_favicon_url')); ?>" alt=""/>
					</td>
                </tr>	  		
			    										
				<tr valign="top">
                    <th scope="row"><label for="ads_120_600_post"><?php _e('120x600 adsense code for sticky post:', 'columnist'); ?></label></th>
                    <td><textarea style="width:100%" name="ads_120_600_post"><?php echo esc_textarea(clm_get_option('ads_120_600_post')); ?></textarea></td>
                </tr>

<tr valign="top">
					<th scope="row"><label for="clm_show_bottom"><?php _e('Show bottom entries', 'columnist'); ?></label></th>
				    <td><input name="clm_show_bottom" type="checkbox" id="clm_show_bottom" value="1" <?php checked('1', get_option('clm_show_bottom')); ?> />
					<?php _e('Show', 'columnist'); ?>
					</td>
                </tr> 					
	
            </table>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="clm_favicon_url, ads_120_600_post, clm_show_bottom" />
	<p><a href="https://twitter.com/wpmole" class="twitter-follow-button" data-show-count="false">Follow @wpmole</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> <a href="http://www.facebook.com/pages/WPMole/142454599181539" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" /></a>  <a href="http://wpmole.com" target="_blank">WPMole</a></p>	
     			<p><?php submit_button(); ?></p>
        </form>
		
    </div>
	<?php

if ( !empty($_POST) && check_admin_referer( 'update-options') ) {
}

  };
?>