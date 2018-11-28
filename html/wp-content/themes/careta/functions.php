<?php


/**
* Registers the sidebar(s).
*/

register_sidebar(
	array(
		'name'			=>	'Footer',
		'id'			=>	'sidebar-footer',
		'before_widget'	=>	'<div class="widget">',
		'after_widget'	=>	'</div>'
	)
);


/**
* Registers the primary menu.
*/

register_nav_menu('primary', 'Primary Menu');

function careta_nav_menu_args($args = '')
{
	$args['container'] = false;
	return $args;
}
add_filter('wp_nav_menu_args', 'careta_nav_menu_args');


/**
* Configure general theme settings and register styles & scripts.
*/
if(!isset($content_width)) $content_width = 1140;
add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');
add_action( 'wp_enqueue_scripts', 'careta_enqueue_scripts' );


function careta_enqueue_scripts()
{
	if(is_singular()) wp_enqueue_script('comment-reply', false, array(), false, true);
}


function careta_add_stylesheets()
{
	wp_register_style(
		'magnific-popup-css',
		get_template_directory_uri() . '/css/magnific-popup.css'
	);
	wp_enqueue_style('magnific-popup-css');
	
	wp_register_style(
		'custom-css-fonts',
		'http' . ($_SERVER['SERVER_PORT'] == 443 ? 's' : '') . '://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,700,300'
	);
	wp_enqueue_style('custom-css-fonts');
}
add_action('wp_enqueue_scripts', 'careta_add_stylesheets');


function careta_warnings($text)
{
    $replace = array('[alert]' => '<div class="alert">', '[/alert]' => '</div>', '[error]' => '<div class="error">', '[/error]' => '</div>', '[info]' => '<div class="info">', '[/info]' => '</div>');
    $text = str_replace(array_keys($replace), $replace, $text);
    return $text;
}
add_filter('the_content', 'careta_warnings');

function careta_index_exists($var,$index)
{
  return(isset($var[$index])?$var[$index]:null);
}

function careta_add_scripts()
{
	wp_deregister_script('jquery');
	wp_register_script(
		'jquery',
		'http' . ($_SERVER['SERVER_PORT'] == 443 ? 's' : '') . '://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
		array(),
		false,
		true
	);
	wp_enqueue_script('jquery');
	
	wp_register_script(
		'fluxpiress-js-magnific',
		get_template_directory_uri() . '/js/jquery.magnific-popup.min.js',
		array(),
		false,
		true
	);
	wp_enqueue_script('fluxpiress-js-magnific');
	
	wp_register_script(
		'fluxpiress-js-init',
		get_template_directory_uri() . '/js/init.js',
		array(),
		false,
		true
	);
	wp_enqueue_script('fluxpiress-js-init');
}
if(!is_admin()) add_action('wp_enqueue_scripts', 'careta_add_scripts', 11);


/**
* Filter meta title.
* 
* @param mixed $title
* @param mixed $sep
*/

function careta_wp_title($title, $sep)
{
	return $title . get_bloginfo('name');
}
add_filter('wp_title', 'careta_wp_title', 10, 2);


/**
* Setup theme customization.
* 
* @param mixed $wp_customize
*/

function careta_customize_register( $wp_customize )
{
	$wp_customize->remove_control('blogdescription');


	//********************************************************************************************************************
	//********************************************************************************************************************
	// header options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_header_options',
		array(
			'title'		=> __('Header Options', 'careta'),
			'priority'	=> 30,
		)
	);
	

	// header display text
	$wp_customize->add_setting(
		'careta_header_showname',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
		)
	);
	 
	$wp_customize->add_control(
		'careta_header_showname',
		array(
			'label' => __('Display Blog Name', 'careta'),
			'section' => 'careta_header_options',
			'settings' => 'careta_header_showname',
			'type' => 'checkbox',
		)
	);
	
	// header display text
	$wp_customize->add_setting(
		'careta_header_showmenu',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
		)
	);
	 
	$wp_customize->add_control(
		'careta_header_showmenu',
		array(
			'label' => __('Display Menu', 'careta'),
			'section' => 'careta_header_options',
			'settings' => 'careta_header_showmenu',
			'type' => 'checkbox',
		)
	);
	
	
	// header image align
	$wp_customize->add_setting(
		'careta_headeralign_text',
		array(
			'default'	=> 'left',
			'transport'	=> 'refresh',
		)
	);

	// select control
	$wp_customize->add_control('careta_headeralign_text', array(
		'label' => 'Blog Name Alignment:',
		'section' => 'careta_header_options',
		'type' => 'select',
		'choices' => array(
			'left' => 'Left',
			'right' => 'Right',
			'center' => 'Center',
		),
	) );	
	

	// header background color
	$wp_customize->add_setting(
		'careta_headerbg_color',
		array(
			'default'	=> '#262626',
			'transport'	=> 'refresh',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_headerbg_color',
			array(
				'label'		=> __('Background Color', 'careta'),
				'section'	=> 'careta_header_options',
				'settings'	=> 'careta_headerbg_color',
			)
		)
	);

	// header text color
	$wp_customize->add_setting(
		'careta_header_color',
		array(
			'default'	=> '#ffffff',
			'transport'	=> 'refresh',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_header_color',
			array(
				'label'		=> __('Text and Link Color', 'careta'),
				'section'	=> 'careta_header_options',
				'settings'	=> 'careta_header_color',
			)
		)
	);
	
	// header hover text color
	$wp_customize->add_setting(
		'careta_headerhover_color',
		array(
			'default'	=> '#00FF00',
			'transport'	=> 'refresh',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_headerhover_color',
			array(
				'label'		=> __('Link Color (Hover)', 'careta'),
				'section'	=> 'careta_header_options',
				'settings'	=> 'careta_headerhover_color',
			)
		)
	);

	// header image text
	$wp_customize->add_setting(
		'careta_header_image',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);
	 
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'careta_header_image', array(
		'label' => __( 'Image', 'careta' ),
		'section' => 'careta_header_options',
		'settings' => 'careta_header_image',
	) ) );
	

 	
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// footer options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_footer_options',
		array(
			'title'		=> __('Footer Options', 'careta'),
			'priority'	=> 31,
		)
	);
	
	// footer bg color
	$wp_customize->add_setting(
		'careta_footerbg_color',
		array(
			'default'	=> '#262626',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_footerbg_color',
			array(
				'label'		=> __('Background Color Start', 'careta'),
				'section'	=> 'careta_footer_options',
				'settings'	=> 'careta_footerbg_color',
			)
		)
	);

	// footer bg color end
	$wp_customize->add_setting(
		'careta_footerbg_color_end',
		array(
			'default'	=> '#5b5b5b',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_footerbg_color_end',
			array(
				'label'		=> __('Background Color End', 'careta'),
				'section'	=> 'careta_footer_options',
				'settings'	=> 'careta_footerbg_color_end',
			)
		)
	);
	
	
	// footer text color
	$wp_customize->add_setting(
		'careta_footer_color',
		array(
			'default'	=> '#CCCCCC',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_footer_color',
			array(
				'label'		=> __('Text Color', 'careta'),
				'section'	=> 'careta_footer_options',
				'settings'	=> 'careta_footer_color',
			)
		)
	);
	
	// footer link color
	$wp_customize->add_setting(
		'careta_footerlink_color',
		array(
			'default'	=> '#ffffff',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_footerlink_color',
			array(
				'label'		=> __('Link Color', 'careta'),
				'section'	=> 'careta_footer_options',
				'settings'	=> 'careta_footerlink_color',
			)
		)
	);
	
	// footer link hover color
	$wp_customize->add_setting(
		'careta_footerlinkhover_color',
		array(
			'default'	=> '#FF0000',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_footerlinkhover_color',
			array(
				'label'		=> __('Link Color (Hover)', 'careta'),
				'section'	=> 'careta_footer_options',
				'settings'	=> 'careta_footerlinkhover_color',
			)
		)
	);
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// theme info section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_themeinfo_options',
		array(
			'title'		=> __('Theme Info Section', 'careta'),
			'priority'	=> 32,
		)
	);
	
	// theme info background color
	$wp_customize->add_setting(
		'careta_themeinfobg_color',
		array(
			'default'	=> '#000000',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_themeinfobg_color',
			array(
				'label'		=> __('Background Color', 'careta'),
				'section'	=> 'careta_themeinfo_options',
				'settings'	=> 'careta_themeinfobg_color',
			)
		)
	);	

		// theme info text color
	$wp_customize->add_setting(
		'careta_themeinfo_color',
		array(
			'default'	=> 'gray',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_themeinfo_color',
			array(
				'label'		=> __('Text Color', 'careta'),
				'section'	=> 'careta_themeinfo_options',
				'settings'	=> 'careta_themeinfo_color',
			)
		)
	);

	// theme info link color
	$wp_customize->add_setting(
		'careta_themeinfolink_color',
		array(
			'default'	=> '#ffffff',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_themeinfolink_color',
			array(
				'label'		=> __('Link Color', 'careta'),
				'section'	=> 'careta_themeinfo_options',
				'settings'	=> 'careta_themeinfolink_color',
			)
		)
	);

	// theme info left text
	$wp_customize->add_setting(
		'careta_themeinfo_text',
		array(
			'default'	=> 'Theme Careta by <a href="http://mcunha98.wordpress.com">MCunha98</a>',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_themeinfo_text',
		array(
			'label' => __('Text', 'careta'),
			'section' => 'careta_themeinfo_options',
			'settings' => 'careta_themeinfo_text',
			'type' => 'text',
		)
	);
	
	// header image align
	$wp_customize->add_setting(
		'careta_themeinfoalign_text',
		array(
			'default'	=> 'left',
			'transport'	=> 'refresh',
		)
	);

	// select control
	$wp_customize->add_control('careta_themeinfoalign_text', array(
		'label' => 'Alignment:',
		'section' => 'careta_themeinfo_options',
		'type' => 'select',
		'choices' => array(
			'left' => 'Left',
			'right' => 'Right',
			'center' => 'Center',
		),
	) );	
	
	

	//********************************************************************************************************************
	//********************************************************************************************************************
	// color options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_page_options',
		array(
			'title'		=> __('Page Options', 'careta'),
			'priority'	=> 40,
		)
	);
	
	// background color
	$wp_customize->add_setting(
		'careta_background_color',
		array(
			'default'	=> '#f0f0f0',
			'transport'	=> 'refresh',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_background_color',
			array(
				'label'		=> __('Page Background Color', 'careta'),
				'section'	=> 'careta_page_options',
				'settings'	=> 'careta_background_color',
			)
		)
	);

	// wrap color
	$wp_customize->add_setting(
		'careta_wrap_color',
		array(
			'default'	=> '#D9D9D9',
			'transport'	=> 'refresh',
		)
	);

	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_wrap_color',
			array(
				'label'		=> __('Page Wrap Background Color', 'careta'),
				'section'	=> 'careta_page_options',
				'settings'	=> 'careta_wrap_color',
			)
		)
	);
	

	// background image
	$wp_customize->add_setting(
		'careta_background_image',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);
	 
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'careta_background_image', array(
		'label' => __( 'Background Image', 'careta' ),
		'section' => 'careta_page_options',
		'settings' => 'careta_background_image',
	) ) );
	
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// category options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_category_options',
		array(
			'title'		=> __('Category Options', 'careta'),
			'priority'	=> 41,
		)
	);

	
	// display excerpts
	$wp_customize->add_setting(
		'careta_display_excerpts',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
		)
	);
	 
	$wp_customize->add_control(
		'careta_display_excerpts',
		array(
			'label' => __('Display Excerpts', 'careta'),
			'section' => 'careta_category_options',
			'settings' => 'careta_display_excerpts',
			'type' => 'checkbox',
		)
	);
	
	
	// display more link
	$wp_customize->add_setting(
		'careta_display_more',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
		)
	);
	 
	$wp_customize->add_control(
		'careta_display_more',
		array(
			'label' => __('Display More Link', 'careta'),
			'section' => 'careta_category_options',
			'settings' => 'careta_display_more',
			'type' => 'checkbox',
		)
	);
	
	
	// post box color
	$wp_customize->add_setting(
		'careta_postbox_color',
		array(
			'default'	=> '#ffffff',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_postbox_color',
			array(
				'label'		=> __('Post Box Color', 'careta'),
				'section'	=> 'careta_category_options',
				'settings'	=> 'careta_postbox_color',
			)
		)
	);
	
	
	
	// text color
	$wp_customize->add_setting(
		'careta_text_color',
		array(
			'default'	=> '#333333',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_text_color',
			array(
				'label'		=> __('Text Color', 'careta'),
				'section'	=> 'careta_category_options',
				'settings'	=> 'careta_text_color',
			)
		)
	);
	
	// text hover color
	$wp_customize->add_setting(
		'careta_text_hover_color',
		array(
			'default'	=> '#ffffff',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_text_hover_color',
			array(
				'label'		=> __('Text Color (Hover)', 'careta'),
				'section'	=> 'careta_category_options',
				'settings'	=> 'careta_text_hover_color',
			)
		)
	);
	
	// highlight color
	$wp_customize->add_setting(
		'careta_highlight_color',
		array(
			'default'	=> '#10234F',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_highlight_color',
			array(
				'label'		=> __('Background Color (Hover)', 'careta'),
				'section'	=> 'careta_category_options',
				'settings'	=> 'careta_highlight_color',
			)
		)
	);
	

	// category styles
	$wp_customize->add_setting(
		'careta_category_style',
		array(
			'default'	=> 'variable',
			'transport'	=> 'refresh',
		)
	);

	// select control
	$wp_customize->add_control('careta_category_style', array(
		'label' => 'Box Style:',
		'section' => 'careta_category_options',
		'type' => 'select',
		'choices' => array(
			'variable' => 'Variable Size',
			'fixed' => 'Fixed Size'
		),
	) );	

	
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// post options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_post_options',
		array(
			'title'		=> __('Post Options', 'careta'),
			'priority'	=> 42,
		)
	);
	
	// display tags
	$wp_customize->add_setting(
		'careta_display_tags',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_display_tags',
		array(
			'label' => __('Display Tags', 'careta'),
			'section' => 'careta_post_options',
			'settings' => 'careta_display_tags',
			'type' => 'checkbox',
		)
	);
	
	// display author
	$wp_customize->add_setting(
		'careta_display_author',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_display_author',
		array(
			'label' => __('Display Author', 'careta'),
			'section' => 'careta_post_options',
			'settings' => 'careta_display_author',
			'type' => 'checkbox',
		)
	);
	
	// display category
	$wp_customize->add_setting(
		'careta_display_category',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_display_category',
		array(
			'label' => __('Display Category', 'careta'),
			'section' => 'careta_post_options',
			'settings' => 'careta_display_category',
			'type' => 'checkbox',
		)
	);
	
	// display date
	$wp_customize->add_setting(
		'careta_display_date',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_display_date',
		array(
			'label' => __('Display Date', 'careta'),
			'section' => 'careta_post_options',
			'settings' => 'careta_display_date',
			'type' => 'checkbox',
		)
	);
	
	
	// theme info link color
	$wp_customize->add_setting(
		'careta_postlink_color',
		array(
			'default'	=> 'blue',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_postlink_color',
			array(
				'label'		=> __('Post Link Color', 'careta'),
				'section'	=> 'careta_post_options',
				'settings'	=> 'careta_postlink_color',
			)
		)
	);

	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// pagination options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_pagination_options',
		array(
			'title'		=> __('Pagination Options', 'careta'),
			'priority'	=> 44,
		)
	);
	
	// text  color
	$wp_customize->add_setting(
		'careta_pagination_color',
		array(
			'default'	=> 'lightgrey',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_pagination_color',
			array(
				'label'		=> __('Text Color', 'careta'),
				'section'	=> 'careta_pagination_options',
				'settings'	=> 'careta_pagination_color',
			)
		)
	);
	
	// text background color
	$wp_customize->add_setting(
		'careta_paginationbg_color',
		array(
			'default'	=> '#4F4F4F',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_paginationbg_color',
			array(
				'label'		=> __('Background Color', 'careta'),
				'section'	=> 'careta_pagination_options',
				'settings'	=> 'careta_paginationbg_color',
			)
		)
	);

	// text background color
	$wp_customize->add_setting(
		'careta_paginationhover_color',
		array(
			'default'	=> 'white',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_paginationhover_color',
			array(
				'label'		=> __('Text Color (Hover)', 'careta'),
				'section'	=> 'careta_pagination_options',
				'settings'	=> 'careta_paginationhover_color',
			)
		)
	);
	

	// text background color
	$wp_customize->add_setting(
		'careta_paginationbghover_color',
		array(
			'default'	=> 'black',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_paginationbghover_color',
			array(
				'label'		=> __('Background Color (Hover)', 'careta'),
				'section'	=> 'careta_pagination_options',
				'settings'	=> 'careta_paginationbghover_color',
			)
		)
	);
	
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// forms section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_form_options',
		array(
			'title'		=> __('Form Options', 'careta'),
			'priority'	=> 45,
		)
	);
	
	// text  color
	$wp_customize->add_setting(
		'careta_input_color',
		array(
			'default'	=> 'black',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_input_color',
			array(
				'label'		=> __('Text Color', 'careta'),
				'section'	=> 'careta_form_options',
				'settings'	=> 'careta_input_color',
			)
		)
	);
	// background color
	$wp_customize->add_setting(
		'careta_inputbg_color',
		array(
			'default'	=> 'lightgrey',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_inputbg_color',
			array(
				'label'		=> __('Background Color', 'careta'),
				'section'	=> 'careta_form_options',
				'settings'	=> 'careta_inputbg_color',
			)
		)
	);

	// border color
	$wp_customize->add_setting(
		'careta_inputborder_color',
		array(
			'default'	=> 'darkgrey',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_inputborder_color',
			array(
				'label'		=> __('Border Color', 'careta'),
				'section'	=> 'careta_form_options',
				'settings'	=> 'careta_inputborder_color',
			)
		)
	);

	// text background color
	$wp_customize->add_setting(
		'careta_inputfocus_color',
		array(
			'default'	=> 'white',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_inputfocus_color',
			array(
				'label'		=> __('Text Color (Focus/Hover)', 'careta'),
				'section'	=> 'careta_form_options',
				'settings'	=> 'careta_inputfocus_color',
			)
		)
	);
	

	// text background color
	$wp_customize->add_setting(
		'careta_inputfocusbg_color',
		array(
			'default'	=> '#9E9E9E',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_inputfocusbg_color',
			array(
				'label'		=> __('Background Color (Hover/Focus)', 'careta'),
				'section'	=> 'careta_form_options',
				'settings'	=> 'careta_inputfocusbg_color',
			)
		)
	);
	
	// border color
	$wp_customize->add_setting(
		'careta_inputfocusborder_color',
		array(
			'default'	=> '#4A4A4A',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_inputfocusborder_color',
			array(
				'label'		=> __('Border Color (Hover/Focus)', 'careta'),
				'section'	=> 'careta_form_options',
				'settings'	=> 'careta_inputfocusborder_color',
			)
		)
	);
	
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// social options section
	//********************************************************************************************************************
	//********************************************************************************************************************


	$wp_customize->add_section(
		'careta_social_options',
		array(
			'title'		=> __('Social Options', 'careta'),
			'priority'	=> 51,
		)
	);


	// DeviantArt
	$wp_customize->add_setting(
		'careta_social_deviantart',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_social_deviantart',
		array(
			'label' => __('DeviantArt Account', 'careta'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_deviantart',
			'type' => 'text',
		)
	);

	// Email
	$wp_customize->add_setting(
		'careta_social_email',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_social_email',
		array(
			'label' => __('Email Address', 'careta'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_email',
			'type' => 'text',
		)
	);

	// facebook
	$wp_customize->add_setting(
		'careta_social_facebook',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_social_facebook',
		array(
			'label' => __('Facebook Account', 'careta'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_facebook',
			'type' => 'text',
		)
	);


	// flickr
	$wp_customize->add_setting(
		'careta_social_flickr',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_social_flickr',
		array(
			'label' => __('Flicker Account', 'careta'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_flickr',
			'type' => 'text',
		)
	);

	// GooglePlus
	$wp_customize->add_setting(
		'careta_social_googleplus',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_social_flickr',
		array(
			'label' => __('Google Plus Account', 'careta'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_googleplus',
			'type' => 'text',
		)
	);
	
	// Linkedin
	$wp_customize->add_setting(
		'careta_social_linkedin',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_social_flickr',
		array(
			'label' => __('Linkedin Account', 'careta'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_linkedin',
			'type' => 'text',
		)
	);
	
	// Pintrest
	$wp_customize->add_setting(
		'careta_social_pintrest',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_social_pintrest',
		array(
			'label' => __('Pintrest Account', 'careta'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_pintrest',
			'type' => 'text',
		)
	);
	
	// Skype
	$wp_customize->add_setting(
		'careta_social_skype',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_social_skype',
		array(
			'label' => __('Skype Account', 'careta'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_skype',
			'type' => 'text',
		)
	);
	
	
	// twitter
	$wp_customize->add_setting(
		'careta_social_twitter',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_social_twitter',
		array(
			'label' => __('Twitther Account', 'careta'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_twitter',
			'type' => 'text',
		)
	);
	
	// vimeo
	$wp_customize->add_setting(
		'careta_social_vimeo',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_social_vimeo',
		array(
			'label' => __('Vimeo Account', 'careta'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_vimeo',
			'type' => 'text',
		)
	);
	
	// youtube
	$wp_customize->add_setting(
		'careta_social_youtube',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'careta_social_youtube',
		array(
			'label' => __('YouTube Account', 'careta'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_youtube',
			'type' => 'text',
		)
	);
	
	
	// social bar location
	$wp_customize->add_setting(
		'careta_social_location',
		array(
			'default'	=> 'header',
			'transport'	=> 'refresh',
		)
	);

	// select control
	$wp_customize->add_control('careta_social_location', array(
		'label' => 'Location:',
		'section' => 'careta_social_options',
		'type' => 'select',
		'choices' => array(
			'header' => 'Header',
			'footer' => 'Footer'
		),
	) );	
	
	
	
}
add_action('customize_register', 'careta_customize_register');


/**
* Parse custom css code.
*/

function careta_customize_css()
{
	$wrapColor = get_theme_mod('careta_wrap_color', '#D9D9D9');
	$bgColor = get_theme_mod('careta_background_color', '#f0f0f0');
	$bgImage = get_theme_mod('careta_background_image', '');
	
	$textColor = get_theme_mod('careta_text_color', '#333333');
	$textHoverColor = get_theme_mod('careta_text_hover_color', '#ffffff');
	$postBgColor = get_theme_mod('careta_postbox_color', '#ffffff');
	$highlightColor = get_theme_mod('careta_highlight_color', '#10234F');
	$thumbnailWidth = (int) get_option('thumbnail_size_w');
	$thumbnailHeight = (int) get_option('thumbnail_size_h');
	$postLinkColor = get_theme_mod('careta_postlink_color','blue');
	$style = get_theme_mod('careta_category_style','variable');
	
	
	$footerColor = get_theme_mod('careta_footer_color', '#CCCCCC');
	$footerBgColor = get_theme_mod('careta_footerbg_color', '#262626');
	$footerBgColorEnd = get_theme_mod('careta_footerbg_color_end', '#4c4c4c');
	$footerLinkColor = get_theme_mod('careta_footerlink_color', '#ffffff');
	$footerLinkHoverColor = get_theme_mod('careta_footerlinkhover_color', '#FF0000');
	
	
	$themeinfoColor = get_theme_mod('careta_themeinfo_color', 'gray');
	$themeinfoBgColor = get_theme_mod('careta_themeinfobg_color', '#000000');
	$themeinfoLinkColor = get_theme_mod('careta_themeinfolink_color', '#ffffff');
	$themeinfoAlign = get_theme_mod('careta_themeinfoalign_text', 'left');
	
	$headerColor = get_theme_mod('careta_header_color', '#ffffff');
	$headerColorHover = get_theme_mod('careta_headerhover_color', '#00FF00');
	$headerBgColor = get_theme_mod('careta_headerbg_color', '#262626');
	$headerTextAlign = get_theme_mod('careta_headeralign_text', 'left');
	$headerImage = get_theme_mod('careta_header_image', '');
	
	$paginationColor = get_theme_mod('careta_pagination_color', 'lightgrey');
	$paginationBgColor = get_theme_mod('careta_paginationbg_color', '#4F4F4F');
	$paginationHoverColor = get_theme_mod('careta_paginationhover_color', 'yellow');
	$paginationBgHoverColor = get_theme_mod('careta_paginationbghover_color', 'black');
	
	
	$inputColor = get_theme_mod('careta_input_color', 'black');
	$inputBgColor = get_theme_mod('careta_inputbg_color', 'lightgrey');
	$inputBorderColor = get_theme_mod('careta_inputborder_color','darkgrey');
	
	$inputFocusColor = get_theme_mod('careta_inputfocus_color', 'white');
	$inputFocusBgColor = get_theme_mod('careta_inputfocusbg_color', '#9E9E9E');
	$inputFocusBorderColor = get_theme_mod('careta_inputfocusborder_color', '#4A4A4A');
	
	
	$hex = $textColor;
	if($hex{0} === '#') $hex = substr($hex, 1);
	
	if(strlen($hex) == 6)
	{
		list($r, $g, $b) = array($hex{0} . $hex{1}, $hex{2} . $hex{3}, $hex{4} . $hex{5});
	}
	elseif(strlen($hex) == 3)
	{
		list($r, $g, $b) = array($hex{0} . $hex{0}, $hex{1} . $hex{1}, $hex{2} . $hex{2});
	}
	else
	{
		return array();
	}
	
	$r = hexdec($r);
	$g = hexdec($g);
	$b = hexdec($b);
	$textColorRGB = array('r' => $r, 'g' => $g, 'b' => $b);
?>
	<style type="text/css">
		body, .mfp-bg 
		{ 
			background: <?php echo $bgColor; ?>; 
			<?php if ($bgImage != '') { ?>
			background-image: url(<?php echo $bgImage; ?>);
			<?php } ?>
		}
		body, #blog-title a, #post-list .post .no-more, .comment-author, .comment-meta, .ti, .ta, .form .hint, .mfp-title, .mfp-counter, .mfp-close-btn-in .mfp-close, #page.open #menu .menu .current_page_ancestor > a 
		{
			color: <?php echo $textColor; ?>;
		}
		#menu .menu a
		{
			color: <?php echo $headerColor; ?>;
		}
		#post a, #post blockquote:before, #post blockquote:after, .comment-author a, .comment-meta a 
		{
			color: <?php echo $postLinkColor; ?>;
		}
		#post blockquote,.comment p
		{
			border-left:4pt solid <?php echo $postLinkColor; ?>;
			background:<?php echo $postBgColor; ?>;
			color:<?php echo $textColor; ?>;
		}
		.wrap
		{
			background-color: <?php echo $wrapColor; ?>;
		}
		#header .inner , #menu .menu > ul > li > .children, #menu .menu > li > .sub-menu 
		{
			color: <?php echo $headerColor; ?>;
			background-color: <?php echo $headerBgColor; ?>;
		}
		<?php if ($headerImage != ''){ ?>
		#header .inner 
		{ 
			background-image:url(<?php echo $headerImage; ?>);
			background-repeat:no-repeat;
			background-size: 100%;
		}
		<?php } ?>
		#header a, #header .inner a
		{
			color: <?php echo $headerColor; ?>;
		}
		#header a:hover, #header .inner a:hover
		{
			color: <?php echo $headerColorHover; ?>;
		}
		#header 
		{ 
			text-align: <?php echo $headerTextAlign; ?>; 
		}
		#themeinfo
		{
		
			color: <?php echo $themeinfoColor; ?>;
			background-color: <?php echo $themeinfoBgColor; ?>;
			text-align: <?php echo $themeinfoAlign; ?> !important; 
			font-size: .8rem;
			height: 100%;
			vertical-alignment: bottom;
			padding: 0.4rem;
		}
		#themeinfo a
		{
			color: <?php echo $themeinfoLinkColor; ?>;
		}
		a, #blog-title a:hover, #menu .menu a:hover, #menu .menu .current-menu-item > a, #menu .menu .current_page_item > a, #menu .menu .current_page_ancestor > a, .bypostauthor .comment-author a, .bypostauthor .comment-author cite, #post-navi div, .form .req label span 
		{
			color: <?php echo $headerColorHover; ?>;
		}
		#menu .menu > ul > li > .children, #menu .menu > li > .sub-menu 
		{ 
			border-top: 1px solid <?php echo $highlightColor; ?>; 
		}
		#post-navi 
		{ 
			text-align: left;
		}
		.mfp-title, .mfp-counter 
		{ 
			text-shadow: 1px 1px 0 <?php echo $bgColor; ?>; 
		}
		.mfp-arrow-left:after, .mfp-arrow-left .mfp-a 
		{ 
			border-right-color: <?php echo $bgColor; ?>; 
		}
		.mfp-arrow-left:before, .mfp-arrow-left .mfp-b 
		{ 
			border-right-color: <?php echo $textColor; ?>; 
		}
		.mfp-arrow-right:after, .mfp-arrow-right .mfp-a 
		{ 
			border-left-color: <?php echo $bgColor; ?>; 
		}
		.mfp-arrow-right:before, .mfp-arrow-right .mfp-b 
		{ 
			border-left-color: <?php echo $textColor; ?>; 
		}
		.page-numbers, .page-numbers a 
		{
			color: <?php echo $paginationColor; ?>;
			background-color: <?php echo $paginationBgColor; ?>;
		}
		.page-numbers a:hover, .current
		{
			color: <?php echo $paginationHoverColor; ?>;
			background-color: <?php echo $paginationBgHoverColor; ?>;
		}
		.post 
		{ 
			background: <?php echo $postBgColor; ?>; 
			<?php if ($style == 'fixed') { ?>
				min-height: 25rem;
			<?php } ?>
		}
		.post-content 
		{ 
			background: <?php echo $wrapColor; ?>; 
		}
		#post-list .post:hover 
		{ 
			background: <?php echo $highlightColor; ?>; 
		}
		#post-list .sticky-icon 
		{ 
			border-color: transparent <?php echo $highlightColor; ?> transparent transparent; 
		}
		#post-list .post:hover, #post-list .post:hover a 
		{ 
			color: <?php echo $textHoverColor; ?>; 
		}
		#post .gallery .gallery-item 
		{
			width: <?php echo $thumbnailWidth . 'px'; ?>;
			height: <?php echo $thumbnailHeight . 'px'; ?>;
		}
		#footer .widget 
		{ 
			border-bottom: 1px solid rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .3); 
		}
		#page.open 
		{ 
			box-shadow: 10px 0 20px 0 rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .3); 
		}
		input[type="text"], textarea , select, input[type="submit"], input[type="button"], .searchform input[type="text"], .searchform input[type="button"], .searchform input[type="submit"]
		{
			color: <?php echo $inputColor; ?>;
			background-color: <?php echo $inputBgColor; ?>;
			border:1px solid <?php echo $inputBorderColor; ?>;
		}

		input[type="text"]:focus, textarea:focus , select:focus, input[type="submit"]:focus, input[type="submit"]:hover, input[type="button"]
		{
			color: <?php echo $inputFocusColor; ?>;
			background-color: <?php echo $inputFocusBgColor; ?>;
			border:1px solid <?php echo $inputFocusBorderColor; ?>;
		}
		
		
		
		@media only screen and (max-width: 800px) 
		{
			#menu 
			{ 
				background: rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .2); 
			}
		}
		#mobile-menu 
		{ 
			background: rgba
			(
				<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .1); 
			}
		}
		#mobile-menu:before 
		{ 
			border-color: rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .7); 
		}
		#mobile-menu:hover 
		{ 
			background: <?php echo $highlightColor; ?>; 
		}
		#mobile-menu:hover:before 
		{ 
			border-color: <?php echo $textHoverColor; ?>; 
		}
		
		#sidebar-footer a
		{ 
			color: <?php echo $footerLinkColor; ?>;
		}
		#sidebar-footer a:hover 
		{ 
			color: <?php echo $footerLinkHoverColor; ?>;
		}
		#sidebar-footer 
		{ 
			color: <?php echo $footerColor; ?>; 
			background-color: <?php echo $footerBgColor; ?>;
			background: -webkit-linear-gradient(<?php echo $footerBgColor; ?>, <?php echo $footerBgColorEnd; ?>);
			background: -moz-linear-gradient(<?php echo $footerBgColor; ?>, <?php echo $footerBgColorEnd; ?>);
			background: -ms-linear-gradient(<?php echo $footerBgColor; ?>, <?php echo $footerBgColorEnd; ?>);
			background: -o-linear-gradient(<?php echo $footerBgColor; ?>, <?php echo $footerBgColorEnd; ?>);
			background: linear-gradient(<?php echo $footerBgColor; ?>, <?php echo $footerBgColorEnd; ?>);		}
		}
	</style>
<?php
}
add_action('wp_head', 'careta_customize_css');

function remove_recent_comments_style() 
{
 global $wp_widget_factory;
 remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'remove_recent_comments_style');


function careta_draw_transparent()
{
		$folder = get_template_directory_uri() . "/images/";
		$value = "transparent.gif";
		echo "<img src=\"$folder/$value\" class=\"post-thumb\" width=\"300px\" height=\"199px\"  >\n";
}


function careta_draw_social()
{
	echo "<div class=\"social\">";
		$folder = get_template_directory_uri() . "/images/";
		
		$value = get_theme_mod('careta_social_deviantart', '');
		if ($value != "") echo "<a href=\"http://$value.deviantart.com\"><img src=\"$folder/deviantart.png\"></a>\n";
		
		$value = get_theme_mod('careta_social_email', '');
		if ($value != "") echo "<a href=\"mailto:$value\"><img src=\"$folder/email.png\"></a>\n";

		$value = get_theme_mod('careta_social_facebook', '');
		if ($value != "") echo "<a href=\"http://facebook.com/$value\"><img src=\"$folder/facebook.png\"></a>\n";
	
		$value = get_theme_mod('careta_social_linkedin', '');
		if ($value != "") echo "<a href=\"http://linkedin.com/$value\"><img src=\"$folder/linkedin.png\"></a>\n";
	
		$value = get_theme_mod('careta_social_pintrest', '');
		if ($value != "") echo "<a href=\"http://pintrest.com/$value\"><img src=\"$folder/pintrest.png\"></a>\n";
	
		$value = get_theme_mod('careta_social_skype', '');
		if ($value != "") echo "<a href=\"http://skype.com/$value\"><img src=\"$folder/skype.png\"></a>\n";

		$value = get_theme_mod('careta_social_twitter', '');
		if ($value != "") echo "<a href=\"http://twitter.com/$value\"><img src=\"$folder/twitter.png\"></a>\n";

		$value = get_theme_mod('careta_social_vimeo', '');
		if ($value != "") echo "<a href=\"http://vimeo.com/$value\"><img src=\"$folder/vimeo.png\"></a>\n";

		$value = get_theme_mod('careta_social_youtube', '');
		if ($value != "") echo "<a href=\"http://youtube.com/$value\"><img src=\"$folder/youtube.png\"></a>\n";
	echo "</div>";
}

function careta_cut_text($title,$size)
{
	if (strlen($title) > $size)
	{
		echo substr($title,0,$size) . "...";
	}
	else
	{
		echo $title;
	}
}


?>