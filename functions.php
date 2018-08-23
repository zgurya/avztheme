<?php 
/**
 * Setup main theme options
 */
add_action('after_setup_theme', 'avztheme_theme_setup');
function avztheme_theme_setup(){
	
	load_theme_textdomain('avztheme', get_template_directory() . '/languages');
	
	// Let WordPress manage the document title.
	add_theme_support('title-tag');
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');
	
	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support('post-thumbnails');
	
	// Enable support WooCommerce
	add_theme_support( 'woocommerce' );
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'mainmenu' => __( 'Main Menu', 'avztheme' )
	) );
	
	add_theme_support( 'html5', array('comment-form','comment-list','gallery','caption',) );
	
	if ( ! isset( $content_width ) ) {
		$content_width = 600;
	}
	
	// Enable support for Post Formats.
	//add_theme_support( 'post-formats', array('aside','image','video','quote','link','gallery','status','audio','chat',));
}

/**
 * Setup additional media sizes
 */
add_action('init', 'avztheme_add_image_sizes');
function avztheme_add_image_sizes() {
	
	// Crop TRUE medium image size
	/* 
	$medium=get_image_size('medium');
	remove_image_size('medium');
	add_image_size('medium', $medium['width'], $medium['height'], true);
	*/

	add_image_size('thumbnail-archive', 70, 70, true);
}

/**
 * Setup additional media size names
 */
add_filter('image_size_names_choose', 'avztheme_image_sizes_names');
function avztheme_image_sizes_names($sizes) {
	$new_sizes = array(
		'thumbnail-archive' => __( 'Thumbnail archive size','avztheme')
	);
	return array_merge( $sizes, $new_sizes );
}

/**
 * Allow upload svg
 */
add_filter('upload_mimes', 'avztheme_mime_types');
function avztheme_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

/**
 * Change upload filename
 */
add_filter('sanitize_file_name', 'avztheme_rename_upfile', 10, 2);
function avztheme_rename_upfile($filename, $filename_raw) {
	//date_default_timezone_set('Europe/Kiev');
	$info=pathinfo($filename);
	$ext=empty($info['extension']) ? '' : '.' . $info['extension'];
	$ext=str_replace('jpeg','jpg',$ext);
	$new=time().$ext;
	if( $new != $filename_raw ) {
		$new = sanitize_file_name( $new );
	}
	return $new;
}

/**
 * Register sidebar
 */
add_action( 'widgets_init', 'avztheme_widgets_init' );
function avztheme_widgets_init(){
	register_sidebar( array(
		'name' => __('Right sidebar', 'avztheme'),
		'id' => 'right-sidebar',
		'description' => __('There are you can place additional widgets', 'avztheme'),
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
}

/**
 * Load Scripts
 */
add_action('wp_enqueue_scripts', 'avztheme_scripts');
function avztheme_scripts() {
    /* Basic WP styles */
    wp_enqueue_style('basic-css', get_template_directory_uri().'/css/basic.css', false, '');
    
    /* Bootstrap */
    if(function_exists('acf_add_options_page') && get_field('theme_options_bootstrap','option')){
        if(get_field('theme_options_bootstrap_v','option')==3){
            wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false, '');
            wp_enqueue_style('bootstrap-theme-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css', false, '');
            wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), null, true );
        }else{
        	wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', false, '');
            wp_enqueue_script('jquery-slim-js', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', array('jquery'), null, true );
            wp_enqueue_script('popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'), null, true );
            wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), null, true );
        }
    }else{
        wp_enqueue_style('normalize-css', get_template_directory_uri().'/css/normalize.css', false, '');
    }
    
    /* Custom Grids */
    if(function_exists('acf_add_options_page') && get_field('theme_options_custom_grids','option')){
        wp_enqueue_style('grids-css', get_template_directory_uri().'/css/grids.css', false, '');
    }
    
	/* Magnific Popup */
    if(function_exists('acf_add_options_page') && get_field('theme_options_magnific_popup','option')){
	   wp_enqueue_script('magnific-popup-js', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js', array('jquery'), null, true );
	   wp_enqueue_style('magnific-popup-css', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css', false, '');
    }
	
	/* Masonry */
    if(function_exists('acf_add_options_page') && get_field('theme_options_masonry','option')){
	   wp_enqueue_script( 'masonry', '//cdnjs.cloudflare.com/ajax/libs/masonry/3.1.2/masonry.pkgd.js', array('jquery'), null, true );
	   wp_enqueue_script( 'imagesloaded', 'https://unpkg.com/imagesloaded@4.1/imagesloaded.pkgd.min.js', array('jquery'), null, true );
    }
	
	/* Google Maps API for ACF */
	if(function_exists('acf_add_options_page') && get_field('theme_options_google_maps','option') && is_singular()){
		wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key='.get_field('theme_options_google_maps','option').'&v=3.exp', array(), '3', true );
		wp_enqueue_script( 'google-map-init', get_template_directory_uri() . '/js/google-maps-init.js', array('google-map', 'jquery'), '0.1', true );
		wp_localize_script( 'google-map-init', 'marker_img',  get_template_directory_uri().'/images/icon-map.png');
	}
	

	/* Theme scripts*/
	wp_enqueue_style('avztheme-css', get_stylesheet_uri(), false, '');
	wp_enqueue_script( 'avztheme-js', get_template_directory_uri() . '/js/avztheme.js', array('jquery'), null, true );
	wp_localize_script( 'avztheme-js', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	
	if ( is_singular() && comments_open()) {
		wp_enqueue_script( 'comment-reply' );
	}
}

if(function_exists('acf_add_options_page') && get_field('theme_options_google_maps','option')){
	add_action('acf/init', 'avztheme_acf_google_api_key');
	function avztheme_acf_google_api_key() {
		acf_update_setting('google_api_key', get_field('google_map_api_key','option'));
	}
}


/**
 * Edit Main Loop 
 */
add_filter( 'pre_get_posts', 'avztheme_posts' );
function avztheme_posts( $query ) {
	if(!is_admin() && !is_single()){
	}
}

/**
 * Edit Custom Post Type archive title
 */
add_filter( 'get_the_archive_title', function ( $title ) {
	if(is_category()){
		$title = single_cat_title();
		return $title;
	}
	if( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
		return $title;
	}
	if ( is_tax() ) {
		$title = single_term_title( '', false );
		return $title;
	}
});

/**
 * Pagination
 */
function avztheme_pagination() {
	global $wp_query;
	$big = 9999;
	echo paginate_links(array('base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), 'format' => '?paged=%#%', 'current' => max(1, get_query_var('paged')), 'prev_next' => true, 'prev_text' => __('&laquo;', 'avztheme'), 'next_text' => __('&raquo;', 'avztheme'), 'total' => $wp_query->max_num_pages));
}

function avztheme_pagination2() {
	global $wp_query;
	$big = 9999; // need an unlikely integer
	$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'type'  => 'array',
			'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
	) );
	if( is_array( $pages ) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<ul class="pagination  justify-content-center">';
		foreach ( $pages as $page ) {
			$current='';
			if(strpos($page,'current')!==false){
				$current='active';
				$page='<a class="page-link" href="#">'.$page.'</a>';
			}elseif(strpos($page,'fa-chevron-left')!==false){
				$page=preg_replace('/<a /', '<a class="page-link page-previously"', $page);
			}elseif(strpos($page,'fa-chevron-right')!==false){
				$page=preg_replace('/<a /', '<a class="page-link page-next"', $page);
			}else{
				$page=preg_replace('/<a /', '<a class="page-link"', $page);
			}

			echo '<li class="page-item '.$current.'">'.$page.'</li>';
		}
		echo '</ul>';
	}
}

/**
 * Add options page
 */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> __('Theme options','avztheme'),
        'menu_title'	=> __('Theme options','avztheme'),
        'menu_slug' 	=> 'avztheme-theme-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));
    
	acf_add_options_sub_page(array(
		'page_title' 	=> __('Developers','fassco'),
		'menu_title' 	=> __('Developers','fassco'),
		'parent_slug' 	=> 'avztheme-theme-settings',
	));
}

/**
 * Remove ?ver
 */
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
function _remove_script_version( $src ) {
	if( strpos( $src, '?ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

/**
 * Remove emoji
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


/*--------------------------------------------------------------
	Some specific additional functions 
 --------------------------------------------------------------*/

/**
 * Get size information for all currently-registered image sizes.
 */
function get_image_sizes() {
	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}

	return $sizes;
}

/**
 * Get size information for a specific image size.
 */
function get_image_size( $size ) {
	$sizes = get_image_sizes();

	if ( isset( $sizes[ $size ] ) ) {
		return $sizes[ $size ];
	}
	return false;
}
?>