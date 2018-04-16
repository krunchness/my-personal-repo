<?php
require_once get_template_directory() . '/inc/metabox.php';
require_once get_template_directory() . '/inc/BFI_Thumb.php';
require_once get_template_directory() . '/admin/admin-init.php';
require_once get_template_directory() . '/inc/Mobile_Detect.php';
require_once get_template_directory() . '/inc/aq_resizer.php';
require_once get_template_directory() . '/inc/functions-custom.php';


function fx_script_enqueue() {
	// css
	wp_enqueue_style('foundation', get_template_directory_uri() . '/assets/foundation/foundation.min.css', array(), '5', 'all');
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all');
	wp_enqueue_style('lightslidercss', get_template_directory_uri() . '/assets/lightslider/lightslider.css', array(), '2', 'all');	
	wp_enqueue_style('remodalcss', get_template_directory_uri() . '/assets/remodal/remodal.css', array(), '1.1.0', 'all');	
	wp_enqueue_style('remodal-default-theme-css', get_template_directory_uri() . '/assets/remodal/remodal-default-theme-css.css', array(), '1.1.0', 'all');
	wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,500,600,700|Open+Sans+Condensed:300,400', array(), '1.0.0', 'all');
	wp_enqueue_style('hamburglercss', get_template_directory_uri() . '/assets/hamburgler/hamburgler.css', array(), '1.1.0', 'all');
	wp_enqueue_style('responsivecss', get_template_directory_uri() . '/css/responsive.css', array(), '1.0.0', 'all');		
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all');
	//js
	wp_enqueue_script('lightsliderjs', get_template_directory_uri() . '/assets/lightslider/lightslider.js', array(), '5', true);
	wp_enqueue_script('jquery');						
	wp_enqueue_script('foundationjs', get_template_directory_uri() . '/assets/foundation/foundation.min.js', array(), '5', true);	
	wp_enqueue_script('remodaljs', get_template_directory_uri() . '/assets/remodal/remodal.js', array(), '1', true);	
	wp_enqueue_script('lightbox.min.js', get_template_directory_uri() . '/assets/lightbox/lightbox.min.js', array(), '1', true);			
	wp_enqueue_script('mainjs', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);	
	wp_localize_script( 'mainjs', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );	
}


add_action( 'wp_enqueue_scripts', 'fx_script_enqueue');

/*
	==========================================
	 Activate menus
	==========================================
*/

function fx_theme_setup() {
	
	add_theme_support('menus');
	
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'fx' ),
		'mobile-menu' => esc_html__( 'Mobile Menu', 'fx' )
	) );	
}

add_action('init', 'fx_theme_setup');

/*
	==========================================
	 Theme support function
	==========================================
*/
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');

// // Create Slider
// function create_slider() {

// 	$labels = array(
// 		'name'                  => _x( 'Slides', 'Post Type General Name', 'text_domain' ),
// 		'singular_name'         => _x( 'Slide', 'Post Type Singular Name', 'text_domain' ),
// 		'menu_name'             => __( 'Slider', 'text_domain' ),
// 		'name_admin_bar'        => __( 'Slider', 'text_domain' ),
// 		'archives'              => __( 'Item Archives', 'text_domain' ),
// 		'attributes'            => __( 'Item Attributes', 'text_domain' ),
// 		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
// 		'all_items'             => __( 'All Items', 'text_domain' ),
// 		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
// 		'add_new'               => __( 'Add New', 'text_domain' ),
// 		'new_item'              => __( 'New Item', 'text_domain' ),
// 		'edit_item'             => __( 'Edit Item', 'text_domain' ),
// 		'update_item'           => __( 'Update Item', 'text_domain' ),
// 		'view_item'             => __( 'View Item', 'text_domain' ),
// 		'view_items'            => __( 'View Items', 'text_domain' ),
// 		'search_items'          => __( 'Search Item', 'text_domain' ),
// 		'not_found'             => __( 'Not found', 'text_domain' ),
// 		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
// 		'featured_image'        => __( 'Featured Image', 'text_domain' ),
// 		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
// 		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
// 		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
// 		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
// 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
// 		'items_list'            => __( 'Items list', 'text_domain' ),
// 		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
// 		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
// 	);
// 	$args = array(
// 		'label'                 => __( 'Slide', 'text_domain' ),
// 		'labels'                => $labels,
// 		'supports'              => array( 'title', 'thumbnail', ),
// 		'hierarchical'          => false,
// 		'public'                => true,
// 		'show_ui'               => true,
// 		'show_in_menu'          => true,
// 		'menu_position'         => 5,
// 		'menu_icon'             => 'dashicons-format-gallery',
// 		'show_in_admin_bar'     => true,
// 		'show_in_nav_menus'     => true,
// 		'can_export'            => true,
// 		'has_archive'           => true,		
// 		'exclude_from_search'   => false,
// 		'publicly_queryable'    => true,
// 		'capability_type'       => 'page',
// 	);
// 	register_post_type( 'slide', $args );

// }
// add_action( 'init', 'create_slider', 0 );


add_action('init', 'fx_option_init', 0);
// Register Custom Post Type
function create_testimonial() {

	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Testimonial', 'text_domain' ),
		'name_admin_bar'        => __( 'Testimonial', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Testimonial', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-comments',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'testimonial', $args );

}
add_action( 'init', 'create_testimonial', 0 );


/*
	==========================================
	 Widget
	==========================================
*/


function wcsidebar() {
	register_sidebar(array(				
		'id' => 'wcsidebar', 				
		'name' => 'Woocommerce Sidebar',			
		'before_widget' => '<div class="left-sidebar sidebar">',	
		'after_widget' => '</div>',	
		'before_title' => '<h3 class="sidebar-title">',	
		'after_title' => '</h3>',			
		'empty_title'=> '',					
	));
}

add_action( 'widgets_init', 'wcsidebar' );


function sidebar_contactus() {
	register_sidebar(array(				
		'id' => 'sidebar-contactus', 				
		'name' => 'Contact Page Sidebar',			
		'before_widget' => '<div class="sidebar sidebar-contact">',	
		'after_widget' => '</div>',	
		'before_title' => '<h3 class="sidebar-title">',	
		'after_title' => '</h3>',			
		'empty_title'=> '',					
	));
}

add_action( 'widgets_init', 'sidebar_contactus' );

function footer_widget_1() {
	register_sidebar(array(				
		'id' => 'first_widget', 				
		'name' => 'Footer Area #1',			
		'before_widget' => '<div class="footer-widget widget">',	
		'after_widget' => '</div>',	
		'before_title' => '<h4 class="footer-widget-title">',	
		'after_title' => '</h4>',			
		'empty_title'=> '',					
	));
} 

add_action( 'widgets_init', 'footer_widget_1' );

function footer_widget_2() {
	register_sidebar(array(				
		'id' => 'second_widget', 					
		'name' => 'Footer Area #2',				
		'before_widget' => '<div class="footer-widget widget">',	
		'after_widget' => '</div>',	
		'before_title' => '<h4 class="footer-widget-title">',	
		'after_title' => '</h4>',		
		'empty_title'=> '',					
	));
} 

add_action( 'widgets_init', 'footer_widget_2' );

function footer_widget_3() {
	register_sidebar(array(				
		'id' => 'third_widget', 					
		'name' => 'Footer Area #3',				
		'before_widget' => '<div class="footer-widget widget">',	
		'after_widget' => '</div>',	
		'before_title' => '<h4 class="footer-widget-title">',	
		'after_title' => '</h4>',							
	));
} 

add_action( 'widgets_init', 'footer_widget_3' );

function footer_widget_4() {
	register_sidebar(array(				
		'id' => 'fourth_widget', 					
		'name' => 'Footer Area #4',				
		'before_widget' => '<div class="footer-widget widget">',	
		'after_widget' => '</div>',	
		'before_title' => '<h4 class="footer-widget-title">',	
		'after_title' => '</h4>',							
	));
} 

add_action( 'widgets_init', 'footer_widget_4' );

/**
 * Add HTML5 theme support.
 */

function wpdocs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );


/**
 * Get Attachment ID
 */

function get_attachment_id_from_src ($src) {
  global $wpdb;
  $reg = "/-[0-9]+x[0-9]+?.(jpg|jpeg|png|gif)$/i";
  $src1 = preg_replace($reg,'',$src);
  if($src1 != $src){
      $ext = pathinfo($src, PATHINFO_EXTENSION);
      $src = $src1 . '.' .$ext;
  }
  $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$src'";
  $id = $wpdb->get_var($query);
  return $id;
}

/**
 * Mobile detect for mobile.
 */
function is_mobile(){
	$detect = new Mobile_Detect;
	$result = false;
	
	if ( $detect->isMobile() && !$detect->isTablet()  ):
		$result = true;
	endif;
	
	return $result;
}

/**
 * Mobile detect for iPad.
 */
function is_tablet_ipad(){
	$detect = new Mobile_Detect;
	$result = false;
	
	if ( $detect->version('iPad') && $detect->isTablet()  ):
		$result = true;
	endif;
	
	return $result;
}

// Add Favicon
function add_favicon() {
	global $fx_data;
  	$favicon_url = $fx_data['favicon']['url'];
	echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';
}
