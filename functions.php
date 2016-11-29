<?php
/**
 * _tk functions and definitions
 *
 * @package _tk
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( '_tk_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _tk_setup() {
	global $cap, $content_width;

	// Add html5 behavior for some theme elements
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

    // This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	*/
	add_theme_support( 'custom-background', apply_filters( '_tk_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
		) ) );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _tk, use a find and replace
	 * to change '_tk' to the name of your theme in all the template files
	*/
	load_theme_textdomain( '_tk', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header left menu', '_tk' ),
		'secondary'  => __( 'Header right menu', '_tk' ),
		'footer'  => __( 'Footer menu', '_tk' )
		) );
	/**
	 * Selective refresh for widgets
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

}
endif; // _tk_setup
add_action( 'after_setup_theme', '_tk_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _tk_widgets_init() {
	register_widget( 'Listify_Widget_Ad' );
    register_widget( 'Listify_Widget_Features' );
    register_widget( 'Listify_Widget_Feature_Callout' );
    register_widget( 'Listify_Widget_Recent_Posts' );
    register_widget( 'Listify_Widget_Call_To_Action' );

	register_sidebar( array(
		'name'          => __( 'Sidebar', '_tk' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );
		/* Custom Homepage */
		register_sidebar( array(
			'name'          => __( 'Homepage', '_tk' ),
			'description'   => __( 'Widgets that appear on the "Homepage" Page Template', '_tk' ),
			'id'            => 'widget-area-home',
			'before_widget' => '<aside id="%1$s" class="home-widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="home-widget-section-title"><h2 class="home-widget-title">',
			'after_title'   => '</h2></div>',
		) );
		   /* Footer Column 1 */
		register_sidebar( array(
			'name'          => __( 'Footer Column 1 (wide)', '_tk' ),
			'id'            => 'widget-area-footer-1',
			'before_widget' => '<aside id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="footer-widget-title">',
			'after_title'   => '</h4>',
		) );

		/* Footer Column 2 */
		register_sidebar( array(
			'name'          => __( 'Footer Column 2', '_tk' ),
			'id'            => 'widget-area-footer-2',
			'before_widget' => '<aside id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="footer-widget-title">',
			'after_title'   => '</h4>',
		) );

		/* Footer Column 3 */
		register_sidebar( array(
			'name'          => __( 'Footer Column 3', '_tk' ),
			'id'            => 'widget-area-footer-3',
			'before_widget' => '<aside id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="footer-widget-title">',
			'after_title'   => '</h4>',
		) );
}
add_action( 'widgets_init', '_tk_widgets_init' );
add_theme_support( 'title-tag' );
/**
 * Enqueue scripts and styles
 */

 function prefix_add_footer_styles() {
     // load csg styles
	wp_enqueue_style( 'tc-style', get_stylesheet_uri() );
	// Import working stylsheet
	wp_enqueue_style( 'tc-bootstrap-wp', get_template_directory_uri() . '/assets/css/main.min.css');

    // load Font Awesome css
	wp_enqueue_style( 'tc-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');
	wp_enqueue_style( 'tc-ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
	wp_enqueue_style( 'animate', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css');

	wp_enqueue_style('google-font-montserrat','//fonts.googleapis.com/css?family=Montserrat:400,700');
	wp_enqueue_style('google-font-roboto','//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i');
	
};
add_action( 'get_footer', 'prefix_add_footer_styles' );

function _tk_scripts() {
	
    //load vendor scripts
    wp_enqueue_script('tc-vendor', get_template_directory_uri().'/assets/js/vendor.min.js', array('jquery'),'1.0', true);
   wp_enqueue_script('tc-custom-script', get_template_directory_uri().'/assets/js/bundle.min.js', array('jquery'), '1.0', true );
	$deps = array( 'jquery' );

		if ( listify_has_integration( 'wp-job-manager-regions' ) && get_option( 'job_manager_regions_filter' ) ) {
			$deps[] = 'job-regions';
		}

    wp_enqueue_script( 'listify', get_template_directory_uri() . '/js/app.min.js', $deps, 20160923, true );
    wp_enqueue_script( 'salvattore', get_template_directory_uri() . '/js/vendor/salvattore.min.js', array(), '', true );
    wp_enqueue_script( 'flexibility', get_template_directory_uri() . '/js/vendor/salvattore.min.js', array(), '', true );
	wp_script_add_data( 'flexibility', 'conditional', 'lt IE 11' );
	wp_localize_script( 'listify', 'listifySettings', apply_filters( 'listify_js_settings', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'homeurl' => home_url( '/' ),
        'archiveurl' => get_post_type_archive_link( 'job_listing' ),
        'is_job_manager_archive' => listify_is_job_manager_archive(),
		'is_rtl' => is_rtl(),
        'megamenu' => array(
            'taxonomy' => listify_theme_mod( 'nav-megamenu', 'job_listing_category' ) 
        ),
        'l10n' => array(
            'closed' => __( 'Closed', 'listify' ),
			'timeFormat' => get_option( 'time_format' ),
			'magnific' => array(
				'tClose' => __( 'Close', 'listify' ),
				'tLoading' => __( 'Loading...', 'listify' ),
				'tError' => __( 'The content could not be loaded.', 'listify' )
			)
        )
    ) ) );
    wp_enqueue_script( 'tc-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'tc-keyboard-image-navigation', get_template_directory_uri() . '/assets/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', '_tk_scripts' );


/**
 * Adds custom classes to the array of post classes.
 */
function listify_post_classes( $classes ) {
    global $post;

    if (
        in_array( $post->post_type, array( 'post', 'page' ) ) ||
        is_search() &&
        ! has_shortcode( $post->post_content, 'jobs' )
    ) {
        $classes[] = 'content-box content-box-wrapper';
    }

    return $classes;
}
add_filter( 'post_class', 'listify_post_classes' );

/**
 * Count the number of posts for a specific user.
 *
 * @since Listify 1.0.0
 *
 * @param string $post_type
 * @param int $user_id
 * @return int $count
 */
function listify_count_posts( $post_type, $user_id ) {
    global $wpdb;

    if ( false === ( $count = get_transient( $post_type . $user_id ) ) ) {
        $count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = '$user_id' AND post_type = '$post_type' and post_status = 'publish'" );

        set_transient( $post_type . $user_id, $count );
    }

    return $count;
}

/** Standard Includes */
$includes = array(
	'class-strings.php',
    'class-integration.php',
	'class-widgetized-pages.php',
	'class-widget.php',
	'template-tags.php',
	'custom-header.php',
	'extras.php',
	'customizer.php',
	'jetpack.php',
	'bootstrap-wp-navwalker.php',
	'widgets/class-widget-ad.php',
    'widgets/class-widget-home-features.php',
    'widgets/class-widget-home-feature-callout.php',
    'widgets/class-widget-home-recent-posts.php',
    'widgets/class-widget-home-cta.php',
    
);

foreach ( $includes as $file ) {
    require( get_template_directory() . '/inc/' . $file );
}

function listify_theme_mod( $key, $default = null ) {
    return get_theme_mod( $key, $default );
}

function listify_has_integration( $integration ) {
    return array_key_exists( $integration, Listify_Integration::get_integrations() );
}


/** Integrations */
$integrations = apply_filters( 'listify_integrations', array(
    'wp-job-manager' => defined( 'JOB_MANAGER_VERSION' ),
	 'wp-job-manager-bookmarks' => defined( 'JOB_MANAGER_BOOKMARKS_VERSION' ),
    'wp-job-manager-tags' => defined( 'JOB_MANAGER_TAGS_PLUGIN_URL' ),

    'wp-job-manager-field-editor' => defined( 'WPJM_FIELD_EDITOR_VERSION' ),

    'wp-job-manager-regions' => class_exists( 'Astoundify_Job_Manager_Regions' ),
    'wp-job-manager-reviews' => class_exists( 'WP_Job_Manager_Reviews' ),
    'wp-job-manager-products' => class_exists( 'WP_Job_Manager_Products' ),
    'wp-job-manager-claim-listing' => class_exists( 'WP_Job_Manager_Claim_Listing' ) || defined( 'WPJMCL_VERSION' ),
    
    'ratings' => true
) );

foreach ( $integrations as $file => $dependancy ) {
    if ( $dependancy ) {
        require( get_template_directory() . sprintf( '/inc/integrations/%1$s/class-%1$s.php', $file ) );
    }
}
/**
 * Adds WooCommerce support
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}


// custom header logo
add_action( 'customize_register', 'entangled_customsize_logo' );
function entangled_customsize_logo($wp_customize) {

    $wp_customize->add_section( 'entangled_custom_logo', array(
        'title'          => 'Logo',
        'description'    => 'Display a custom logo?',
        'priority'       => 25,
    ) );

    $wp_customize->add_setting( 'custom_logo', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_logo', array(
        'label'   => 'Custom logo',
        'section' => 'entangled_custom_logo',
        'settings'   => 'custom_logo',
    ) ) );
}

function custom_active_item_classes($classes = array(), $menu_item = false){            
        global $post;
        $classes[] = ($menu_item->url == get_post_type_archive_link($post->post_type)) ? 'current-menu-item active' : '';
        return $classes;
    }
add_filter( 'nav_menu_css_class', 'custom_active_item_classes', 10, 2 );


 //excerpt length
function excerpt_more($limit) {
  $excerpt_more = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt_more)>=$limit) {
    array_pop($excerpt_more);
    $excerpt_more = implode(" ",$excerpt_more).''. __('...', '').'';
  } else {
    $excerpt_more = implode(" ",$excerpt_more);
  }	
  $excerpt_more = preg_replace('`\[[^\]]*\]`','',$excerpt_more);
  return $excerpt_more;
}


/* Convert hexdec color string to rgb(a) string */
    function hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
        return $default; 

    //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
    }

    remove_filter('the_content', 'wpautop');


function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  //add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );


add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

add_filter( 'submit_job_form_fields', 'frontend_add_price_field' );
add_filter( 'job_manager_job_listing_data_fields', 'admin_add_price_range' );

add_filter( 'submit_job_form_fields', 'frontend_add_start_date_field' );
add_filter( 'job_manager_job_listing_data_fields', 'admin_add_start_date_field' );

function listify_cover( $class, $args = array() ) {
    $defaults = apply_filters( 'listify_cover_defaults', array(
        'images' => false,
        'object_ids' => false,
        'size' => 'large'
    ) );

    $args  = wp_parse_args( $args, $defaults );
    $image = false;
    $atts  = array();

    global $wp_query;

	$post = get_post();

    // special for WooCommerce
    if ( ( function_exists( 'is_shop' ) && is_shop() ) || is_singular( 'product' )) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( wc_get_page_id( 'shop' ) ), $args[ 'size' ] );
    } else if ( is_tax( array( 'product_cat', 'product_tag' ) ) ) {
        $thumbnail_id = get_woocommerce_term_meta( get_queried_object_id(), 'thumbnail_id', true );
        $image = wp_get_attachment_image_src( $thumbnail_id, $args[ 'size' ] );
    } else if ( ( is_home() && ! in_the_loop() ) || ( ! in_the_loop() && is_singular( 'post' ) ) ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_option( 'page_for_posts' ) ), $args[ 'size' ] );
    } else if ( ( ! did_action( 'loop_start' ) && is_archive() ) || ( $args[ 'images' ] || $args[ 'object_ids' ] ) ) {
        $image = listify_get_cover_from_group( $args );
    } else if ( is_a( $post, 'WP_Post' ) ) {
		if ( '' != $post->_thumbnail_id ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id(), $args[ 'size' ] );
        } else if ( apply_filters( 'listify_listing_cover_use_gallery_images', false ) && listify_has_integration( 'wp-job-manager' ) ) {
            $gallery = Listify_WP_Job_Manager_Gallery::get( $post->ID );

            if ( $gallery ) {
				$args[ 'images' ] = $gallery;
				unset( $args[ 'object_ids' ] );

                $image = listify_get_cover_from_group( $args );
            }
        }
    }

    $image = apply_filters( 'listify_cover_image', $image, $args );

    if ( ! $image ) {
        $class .= ' no-image';

        return sprintf( 'class="%s"', $class );
    }

    $class .= ' has-image';

    $atts[] = sprintf( 'style="background-image: url(%s);"', $image[0] );
    $atts[] = sprintf( 'class="%s"', $class );

    return implode( ' ', $atts );
}
add_filter( 'listify_cover', 'listify_cover', 10, 2 );

/**
 * Get a cover image from a "group" (WP_Query or array of IDS)
 *
 * @see listify_cover()
 *
 * @since Listify 1.0.0
 *
 * @param array|object $group
 * @return array $image
 */
function listify_get_cover_from_group( $args ) {
    $image = false;

    if ( empty( $args[ 'object_ids' ] ) && ( ! isset( $args[ 'images' ] ) || empty( $args[ 'images' ] ) ) ) {
        global $wp_query, $wpdb;

        if ( empty( $wp_query->posts ) ) {
            return $image;
        }

        $args[ 'object_ids' ] = wp_list_pluck( $wp_query->posts, 'ID' );
    }

    if ( ( ! isset( $args[ 'images' ] ) || empty( $args[ 'images' ] ) ) && ( isset( $args[ 'object_ids' ] ) && ! empty( $args[ 'object_ids' ] ) ) ) {

		$objects_hash = 'listify_cover_' . md5( json_encode( $args ) . WP_Job_Manager_Cache_Helper::get_transient_version( 'listify_cover_' . md5( json_encode( $args[ 'object_ids' ] ) ) ) );

		$image = get_transient( $objects_hash );

        if ( ! $image ) {
            $attachments = new WP_Query( array(
                'post_parent__in' => $args[ 'object_ids' ],
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'posts_per_page' => 1,
                'orderby' => 'rand',
                'update_post_term_cache' => false,
                'no_found_rows' => true
            ) );

            if ( $attachments->have_posts() ) {
                $image = wp_get_attachment_image_src( $attachments->posts[0]->ID, $args[ 'size' ] );

				$company_logo = $image[0] == $attachments->posts[0]->company_avatar;

                if ( file_exists( $image[0] ) && ! $company_logo ) {
                    set_transient( $objects_hash, $image, 6 * HOUR_IN_SECONDS );
                }
            }
        }
    } elseif ( isset( $args[ 'images' ] ) && ! empty( $args[ 'images' ] ) ) {
        shuffle( $args[ 'images' ] );

        $image = wp_get_attachment_image_src( current( $args[ 'images' ] ), $args[ 'size' ] );
    }

    return $image;
}


/* Add Price */
function frontend_add_price_field( $fields ) {
  $fields['job']['price_range'] = array(
    'label'       => __( 'Price ($)', 'job_manager' ),
    'type'        => 'text',
    'required'    => false,
    'placeholder' => 'e.g. 20000',
    'priority'    => 7
  );
  return $fields;
}

function admin_add_price_range( $fields ) {
  $fields['_price_range'] = array(
    'label'       => __( 'Price ($)', 'job_manager' ),
    'type'        => 'text',
    'placeholder' => 'e.g. 20000',
    'description' => ''
  );
  return $fields;
}

// Add start date
function frontend_add_start_date_field( $fields ) {
  $fields['job']['start_date'] = array(
    'label'       => __( 'Course Start Date (in Months)', 'job_manager' ),
    'type'        => 'text',
    'required'    => false,
    'placeholder' => '2 (Enter Number Only)',
    'priority'    => 12
  );
  return $fields;
}

function admin_add_start_date_field( $fields ) {
  $fields['_start_date'] = array(
    'label'       => __( 'Course Start Date (in Months)', 'job_manager' ),
    'type'        => 'text',
    'placeholder' => '2 (Enter Number Only)',
    'description' => 'Enter Number Only'
  );
  return $fields;
}



/* filter for search price */
add_action( 'job_manager_job_filters_search_jobs_end', 'filter_by_price_field' );
function filter_by_price_field() {
	?>
	<div class="search_prices">
		<label for="search_prices"><?php _e( 'Price Range', 'wp-job-manager' ); ?></label>
		<select name="filter_by_price" class="job-manager-filter">
			<option value=""><?php _e( 'Any Price', 'wp-job-manager' ); ?></option>
			<option value="upto20"><?php _e( 'Up to $20,000', 'wp-job-manager' ); ?></option>
			<option value="20000-40000"><?php _e( '$20,000 to $40,000', 'wp-job-manager' ); ?></option>
			<option value="40000-60000"><?php _e( '$40,000 to $60,000', 'wp-job-manager' ); ?></option>
			<option value="over60"><?php _e( '$60,000+', 'wp-job-manager' ); ?></option>
		</select>
	</div>
	<?php
}
/**
 * This code gets your posted field and modifies the job search query
 */
add_filter( 'job_manager_get_listings', 'filter_by_price_field_query_args', 10, 2 );
function filter_by_price_field_query_args( $query_args, $args ) {
	if ( isset( $_POST['form_data'] ) ) {
		parse_str( $_POST['form_data'], $form_data );
		// If this is set, we are filtering by salary
		if ( ! empty( $form_data['filter_by_price'] ) ) {
			$selected_range = sanitize_text_field( $form_data['filter_by_price'] );
			switch ( $selected_range ) {
				case 'upto20' :
					$query_args['meta_query'][] = array(
						'key'     => '_price_range',
						'value'   => '20000',
						'compare' => '<',
						'type'    => 'NUMERIC'
					);
				break;
				case 'over60' :
					$query_args['meta_query'][] = array(
						'key'     => '_price_range',
						'value'   => '60000',
						'compare' => '>=',
						'type'    => 'NUMERIC'
					);
				break;
				default :
					$query_args['meta_query'][] = array(
						'key'     => '_price_range',
						'value'   => array_map( 'absint', explode( '-', $selected_range ) ),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC'
					);
				break;
			}
			// This will show the 'reset' link
			add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
		}
	}
	return $query_args;
}



/* filter for search Date */
add_action( 'job_manager_job_filters_search_jobs_end', 'filter_by_start_date_field' );
function filter_by_start_date_field() {
	?>
	<div class="search_date">
		<label for="search_date"><?php _e( 'Start Date', 'wp-job-manager' ); ?></label>
		<select name="filter_by_date" class="job-manager-filter">
			<option value=""><?php _e( 'Any Date', 'wp-job-manager' ); ?></option>
			<option value="upto2"><?php _e( 'upto 2 Months', 'wp-job-manager' ); ?></option>
			<option value="2-4"><?php _e( '2 to 4 Months', 'wp-job-manager' ); ?></option>
			<option value="4-6"><?php _e( '4 to 6 Months', 'wp-job-manager' ); ?></option>
			<option value="over6"><?php _e( '6 Months+', 'wp-job-manager' ); ?></option>
		</select>
	</div>
	<?php
}
/**
 * This code gets your posted field and modifies the job search query
 */
add_filter( 'job_manager_get_listings', 'filter_by_start_date_field_query_args', 10, 2 );
function filter_by_start_date_field_query_args( $query_args, $args ) {
	if ( isset( $_POST['form_data'] ) ) {
		parse_str( $_POST['form_data'], $form_data );
		// If this is set, we are filtering by salary
		if ( ! empty( $form_data['filter_by_date'] ) ) {
			$selected_range = sanitize_text_field( $form_data['filter_by_date'] );
			switch ( $selected_range ) {
				case 'upto2' :
					$query_args['meta_query'][] = array(
						'key'     => '_start_date',
						'value'   => '2',
						'compare' => '<',
						'type'    => 'NUMERIC'
					);
				break;
				case 'over6' :
					$query_args['meta_query'][] = array(
						'key'     => '_start_date',
						'value'   => '6',
						'compare' => '>=',
						'type'    => 'NUMERIC'
					);
				break;
				default :
					$query_args['meta_query'][] = array(
						'key'     => '_start_date',
						'value'   => array_map( 'absint', explode( '-', $selected_range ) ),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC'
					);
				break;
			}
			// This will show the 'reset' link
			add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
		}
	}
	return $query_args;
}



/* filter for search time commitment */
add_action( 'job_manager_job_filters_search_jobs_end', 'filter_by_time_commitment_field' );
function filter_by_time_commitment_field() {
	?>
	<div class="search_time">
		<label for="search_time"><?php _e( 'Time Commitment', 'wp-job-manager' ); ?></label>
		<span><label><input type="checkbox" class="checkbox search_time" name="timec[]" value="fulltime">Full Time 40hrs/week</span>
		<span><label><input type="checkbox" class="checkbox search_time" name="timec[]" value="parttime">Part Time 20hrs/week</span>
		<span><label><input type="checkbox" class="checkbox search_time" name="timec[]" value="selfstudy">Self Study</span>
	</div>
	<script>
		jQuery( document ).ready( function( $ ) {
			// var atLeastOneIsChecked = $('input[name="timec[]"]:checked').length > 0;
			$( '.search_time' )
				.change( function() { 
					//if ($(this).is(':checked')) {
						$('#search_keywords').change(); 
					//}
			} )
				.keyup( function( e ) {
					13 === e.which && $(this).trigger("change")
				} );
			
		} );
	</script>
	<?php
}
/**
 * This code gets your posted field and modifies the job search query
 */
add_filter( 'job_manager_get_listings', 'filter_by_time_commitment_field_query_args', 10, 2 );
function filter_by_time_commitment_field_query_args( $query_args, $args ) {
	if ( isset( $_POST['form_data'] ) ) {
		parse_str( $_POST['form_data'], $form_data );

		// If this is set, we are filtering by salary
		if ( ! empty( $form_data['timec'] ) ) {

			$metaargs = array();
			$metaargs['relation'] = 'OR';
			foreach($form_data['timec'] as $key => $val) {
				//$form_data['timec'][$key] = sanitize_text_field( $val );
			

				$metaargs[] = array(
					'key'     => 'time_commitment',
					'value'   => sanitize_text_field( $val ),
					'compare' => 'LIKE'
					//'type'    => 'CHECKBOX'
				);
			}

			$query_args['meta_query'] = $metaargs;
			
			// This will show the 'reset' link
			
			add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
		}
	}
	//print_r($query_args);
	return $query_args;
}
