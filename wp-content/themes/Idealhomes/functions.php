<?php
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see https://codex.wordpress.org/Theme_Development and
 * https://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see https://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

/*
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/* Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support()        To add support for post thumbnails, custom headers and backgrounds, and automatic feed links.
 * @uses register_nav_menus()       To add support for navigation menus.
 * @uses add_editor_style()         To style the visual editor.
 * @uses load_theme_textdomain()    For translation/localization support.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size()  To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'twentyten', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
		'secondary' => __( 'Footer Navigation', 'twentyten' ),
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', array(
		// Let WordPress know what our default background color is.
		'default-color' => 'f1f1f1',
	) );

	// The custom header business starts here.

	$custom_header_support = array(
		/*
		 * The default image to use.
		 * The %s is a placeholder for the theme template directory URI.
		 */
		'default-image' => '%s/images/headers/path.jpg',
		// The height and width of our custom header.
		/**
		 * Filter the Twenty Ten default header image width.
		 *
		 * @since Twenty Ten 1.0
		 *
		 * @param int The default header image width in pixels. Default 940.
		 */
		'width' => apply_filters( 'twentyten_header_image_width', 940 ),
		/**
		 * Filter the Twenty Ten defaul header image height.
		 *
		 * @since Twenty Ten 1.0
		 *
		 * @param int The default header image height in pixels. Default 198.
		 */
		'height' => apply_filters( 'twentyten_header_image_height', 198 ),
		// Support flexible heights.
		'flex-height' => true,
		// Don't support text inside the header image.
		'header-text' => false,
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => 'twentyten_admin_header_style',
	);

	add_theme_support( 'custom-header', $custom_header_support );

	if ( ! function_exists( 'get_custom_header' ) ) {
		// This is all for compatibility with versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR', '' );
		define( 'NO_HEADER_TEXT', true );
		define( 'HEADER_IMAGE', $custom_header_support['default-image'] );
		define( 'HEADER_IMAGE_WIDTH', $custom_header_support['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $custom_header_support['height'] );
		add_custom_image_header( '', $custom_header_support['admin-head-callback'] );
		add_custom_background();
	}

	/*
	 * We'll be using post thumbnails for custom header images on posts and pages.
	 * We want them to be 940 pixels wide by 198 pixels tall.
	 * Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	 */
	set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );

	// ... and thus ends the custom header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/berries.jpg',
			'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Berries', 'twentyten' )
		),
		'cherryblossom' => array(
			'url' => '%s/images/headers/cherryblossoms.jpg',
			'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Cherry Blossoms', 'twentyten' )
		),
		'concave' => array(
			'url' => '%s/images/headers/concave.jpg',
			'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Concave', 'twentyten' )
		),
		'fern' => array(
			'url' => '%s/images/headers/fern.jpg',
			'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Fern', 'twentyten' )
		),
		'forestfloor' => array(
			'url' => '%s/images/headers/forestfloor.jpg',
			'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Forest Floor', 'twentyten' )
		),
		'inkwell' => array(
			'url' => '%s/images/headers/inkwell.jpg',
			'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Inkwell', 'twentyten' )
		),
		'path' => array(
			'url' => '%s/images/headers/path.jpg',
			'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Path', 'twentyten' )
		),
		'sunset' => array(
			'url' => '%s/images/headers/sunset.jpg',
			'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Sunset', 'twentyten' )
		)
	) );
}
endif;

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
/**
 * Style the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function twentyten_admin_header_style() {
?>
<style type="text/css" id="twentyten-admin-header-css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If header-text was supported, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Show a home link for our wp_nav_menu() fallback, wp_page_menu().
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 *
 * @param array $args An optional array of arguments. @see wp_page_menu()
 */
function twentyten_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Set the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 *
 * @param int $length The number of excerpt characters.
 * @return int The filtered number of excerpt characters.
 */
function twentyten_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

if ( ! function_exists( 'twentyten_continue_reading_link' ) ) :
/**
 * Return a "Continue Reading" link for excerpts.
 *
 * @since Twenty Ten 1.0
 *
 * @return string "Continue Reading" link.
 */
function twentyten_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
}
endif;

/**
 * Replace "[...]" with an ellipsis and twentyten_continue_reading_link().
 *
 * "[...]" is appended to automatically generated excerpts.
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $more The Read More text.
 * @return string An ellipsis.
 */
function twentyten_auto_excerpt_more( $more ) {
	if ( ! is_admin() ) {
		return ' &hellip;' . twentyten_continue_reading_link();
	}
	return $more;
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Add a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $output The "Coninue Reading" link.
 * @return string Excerpt with a pretty "Continue Reading" link.
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() && ! is_admin() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Twenty Ten 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Twenty Ten 1.0
 * @deprecated Deprecated in Twenty Ten 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 *
 * @param object $comment The comment object.
 * @param array  $args    An array of arguments. @see get_comment_reply_link()
 * @param int    $depth   The depth of the comment.
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->

			<div class="comment-body"><?php comment_text(); ?></div>

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
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 *
 * @uses register_sidebar()
 */
function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Add widgets here to appear in your sidebar.', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	
register_sidebar( array(
		'name' => __( 'Add  section', 'twentyten' ),
		'id' => 'add',
		'description' => __( 'An optional widget area for your site footer.', 'twentyten' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

		// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'footer Area', 'twentyten' ),
		'id' => 'footer-Area',
		'description' => __( 'An optional widget area for your site footer.', 'twentyten' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

	

	

	
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );

/**
 * Remove the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentyten' ), get_the_author() ) ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Print HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/**
 * Retrieve the IDs for images in a gallery.
 *
 * @uses get_post_galleries() First, if available. Falls back to shortcode parsing,
 *                            then as last option uses a get_posts() call.
 *
 * @since Twenty Ten 1.6.
 *
 * @return array List of image IDs from the post gallery.
 */

function mytheme_custom_styles() {

    
    wp_enqueue_style( 'custom-style1', get_template_directory_uri() . '/styles/bootstrap.min.css');
    wp_enqueue_style( 'custom-style2',  'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css');
	wp_enqueue_style( 'custom-style3', get_template_directory_uri() . '/styles/owl.carousel.min.css');
	wp_enqueue_style( 'custom-style4', get_template_directory_uri() . '/styles/style.css');

   
}
add_action( 'wp_enqueue_scripts', 'mytheme_custom_styles' );


function collectiveray_load_js_script() {
  
   

wp_enqueue_script( 'myscript1', get_template_directory_uri() . '/scripts/jquery.min.js', array(), false, true );
wp_enqueue_script( 'myscript2', get_template_directory_uri() . '/scripts/bootstrap.bundle.min.js', array(), false, true );
wp_enqueue_script( 'myscript3', get_template_directory_uri() . '/scripts/owl.carousel.min.js', array(), false, true );
wp_enqueue_script( 'myscript4', get_template_directory_uri() . '/scripts/script.js', array(), false, true );	
 

}

add_action('wp_enqueue_scripts', 'collectiveray_load_js_script');


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));


	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	

}

function add_extra_class_to_menu_items($classes, $item, $args, $depth) {
    // Check if the item has children
    if (in_array('menu-item-has-children', $classes)) {
        $classes[] = 'nav-item dropdown'; // Add your custom class
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_extra_class_to_menu_items', 10, 4);

function add_extra_class_to_submenu($classes, $args, $depth) {
    // Add a custom class to the sub-menu
    $classes[] = 'dropdown-menu';
    return $classes;
}
add_filter('nav_menu_submenu_css_class', 'add_extra_class_to_submenu', 10, 3);

function custom_pagination($query = null) {
    if (!$query) {
        global $wp_query; // Use the global query if no custom query is passed
        $query = $wp_query;
    }

    $big = 999999999; // A large number for pagination
    $pagination_links = paginate_links(array(
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $query->max_num_pages,
        'type'      => 'array', // Return the links as an array
        'prev_text' => '<i class="fa fa-angle-left"></i>',
        'next_text' => '<i class="fa fa-angle-right"></i>',
    ));

    if (is_array($pagination_links)) {
        echo '<ul class="nav">';

        // Previous button
        if (get_query_var('paged') > 1) {
            echo '<li class="btn-arrow btn-prev me-auto">' . $pagination_links[0] . '</li>';
            array_shift($pagination_links); // Remove the "Previous" link from the main array
        }

        // Pagination links.
        $n=1;
        foreach ($pagination_links as $link) {
			
            $active = strpos($link, 'current') !== false ? 'class="active"' : '';
            echo '<li><a href="page/'.$n.'" ' . $active . '>' . wp_strip_all_tags($link) . '</a></li>';
			$n++;
        }

        // Next button
        if (get_query_var('paged') < $query->max_num_pages) {
            echo '<li class="btn-arrow btn-next ms-auto">' . end($pagination_links) . '</li>';
        }

        echo '</ul>';
    }
}




// Add the custom column

function add_extra_column_after_title($columns) {
	 $new_columns = [];
	if (isset($columns['cb'])) {
        $new_columns['cb'] = $columns['cb'];
    }


	$columns['custom_taxonomy'] = __('Property Type', 'textdomain');
    $columns['custom_taxonomy1'] = __('Property Rooms', 'textdomain');
	$columns['custom_taxonomy2'] = __('Developer', 'textdomain');
	
	   foreach ($columns as $key => $value) {
        if ($key !== 'cb' && $key !== 'date') {
            $new_columns[$key] = $value;
        }
    }

    // Finally, add the date column at the end
    if (isset($columns['date'])) {
        $new_columns['date'] = $columns['date'];
    }

    return $new_columns;
   
}
add_filter('manage_property_posts_columns', 'add_extra_column_after_title');


// Populate the custom column
function populate_extra_column_after_title($column, $post_id) {
    if ($column === 'custom_taxonomy') {
        $terms = get_the_terms($post_id, 'property-type');
        if ($terms && !is_wp_error($terms)) {
            $terms_list = array();
            foreach ($terms as $term) {
                $terms_list[] = $term->name;
            }
            echo '<strong>'.implode(', ', $terms_list).'</strong>';
        } else {
            _e('No Custom Categories');
        }
    }
	if ($column === 'custom_taxonomy1') {
        $terms = get_the_terms($post_id, 'property-room');
        if ($terms && !is_wp_error($terms)) {
            $terms_list = array();
            foreach ($terms as $term) {
                $terms_list[] = $term->name;
            }
            echo '<strong>'.implode(', ', $terms_list).'</strong>';
        } else {
            _e('No Custom Categories');
        }
    }
	if ($column === 'custom_taxonomy2') {
         $terms = get_field('selected_developer',$post_id);
		echo get_the_title($terms);
       
    }
}
add_action('manage_property_posts_custom_column', 'populate_extra_column_after_title', 10, 2);




// Add featured image column to galleryes post type
function add_featured_image_column_galleryes($columns) {
    $new_columns = array();

    // Loop through existing columns
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;

        // Insert the 'featured_image' column after the 'title' column
        if ('title' === $key) {
            $new_columns['featured_image'] = __('Featured Image');
        }
    }

    return $new_columns;
}
add_filter('manage_galleryes_posts_columns', 'add_featured_image_column_galleryes');

// Display featured image in the column for galleryes
function display_featured_image_column_galleryes_after_title($column, $post_id) {
    if ($column === 'featured_image') {
        $featured_image = get_the_post_thumbnail($post_id, array(150, 150));
        echo $featured_image ? $featured_image : __('No Image');
    }
}
add_action('manage_galleryes_posts_custom_column', 'display_featured_image_column_galleryes_after_title', 10, 2);

// Make the featured image column sortable for galleryes
function sortable_featured_image_column_galleryes($columns) {
    $columns['featured_image'] = 'featured_image';
    return $columns;
}
add_filter('manage_edit-galleryes_sortable_columns', 'sortable_featured_image_column_galleryes');

// Handle sorting by featured image for galleryes
function sort_featured_image_column_galleryes($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    if ('featured_image' === $query->get('orderby')) {
        $query->set('meta_key', '_thumbnail_id');
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'sort_featured_image_column_galleryes');

function change_menu_item_class($classes, $item, $args, $depth) {
    $classes = array_map(function($class) {
        return str_replace('menu-item', 'nav-item', $class);
    }, $classes);

    return $classes;
}
add_filter('nav_menu_css_class', 'change_menu_item_class', 10, 4);
function change_menu_link_class($atts, $item, $args, $depth) {
    // Add the 'nav-link' class to all links
    $atts['class'] = 'nav-link';

    // Check if the current menu item is active
    if (in_array('current-menu-item', $item->classes) || in_array('current_page_item', $item->classes)) {
        $atts['class'] .= ' active';
    }
    
    if (in_array('menu-item-has-children', $item->classes)) {
        $atts['class'] .= ' dropdown-toggle';
        $atts['role'] = 'button';
        $atts['data-bs-toggle'] = 'dropdown';
        $atts['href'] = '#.'; // Set href to prevent unwanted clicks
    }

    return $atts;

    return $atts;
}
add_filter('nav_menu_link_attributes', 'change_menu_link_class', 10, 4);




function modify_acf_taxonomy_ui() {
    $taxonomy = 'property-room'; // Replace with your actual taxonomy name
    $post_types = ['property']; // Add your post type(s)

    // Re-register taxonomy with checkbox UI
     $labels = [
        'name'              => 'Property Rooms',
        
    ];
    $args = [
        'labels'            => $labels,
        'hierarchical'      => true, // Enables checkbox UI
       
        'show_ui'           => true,
        'query_var'         => true,
        'meta_box_cb'       => 'post_categories_meta_box', // Forces checkbox UI
    ];

    register_taxonomy($taxonomy, $post_types, $args);
}
add_action('init', 'modify_acf_taxonomy_ui', 11);



function custom_enqueue_scripts() {
    wp_enqueue_script('custom-ajax-script', get_template_directory_uri() . '/scripts/custom-ajax.js', array('jquery'), null, true);

    wp_localize_script('custom-ajax-script', 'ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');



function custom_ajax_function() {
    // Get the data from AJAX
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : 0;
	$term_ids2 = isset($_POST['pid']) ? intval($_POST['pid']) : 0;
    
    $term_array = explode(",", $post_id);
    
    $term_ids = $term_array; // Your term IDs
    $taxonomy = 'property-room'; // Replace with your taxonomy name
    $post_type = 'property'; // Replace with your custom post type
    $taxonomy2 = 'property-type';
$args = array(
    'post_type'      => $post_type,
    'posts_per_page' => -1, // Get all posts
    'tax_query'      => array(
		'relation' => 'AND',
        array(
            'taxonomy' => $taxonomy,
            'field'    => 'term_id',
            'terms'    => $term_array,
            'operator' => 'IN', // Matches any of the term IDs
        ),
		 array(
            'taxonomy' => $taxonomy2,
            'field'    => 'term_id',
            'terms'    => $term_ids2,
            'operator' => 'IN',
        ),
    ),
);
	


$query = new WP_Query($args);
$a='';
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
		$img = get_the_post_thumbnail_url( get_the_ID(),'full');
		$link=get_permalink();
		$title=get_the_title();
		$rera=get_field('approved_by_rera'); 
        if($rera[0]=='Yes'){
		$rera='<span class="reratext">RERA <i class="bi bi-check-lg"></i></span>';
		}
		 $status=get_field('project_status_p');
		 $terms = get_field('selected_developer');
		 $add= get_field('paddress');
		 $dev= get_the_title($terms);
		 $terms = get_the_terms(get_the_ID(), 'property-room');
         if ($terms && !is_wp_error($terms)) {
          $terms_list = array();
          foreach ($terms as $term) {
          $terms_list[] = $term->name;
          }  
		 }
         $tm= '<p>'.implode(', ', $terms_list).'</p>';
		 $sq=get_field('area_sq_ft');
		 $price=get_field('pprice');
		 $clink=get_page_link(26);
         $a.= '<div class="project-grid" data-type="1bhk"><div class="project-listing-box">';
         $a.= '<div class="img"><a href="'.$link.'"><img src="'.$img.'" /></a><span class="new-launch">'.$status.'</span></div>';
		 $a.= '<div class="content"><a href="'.$link.'"><div class="top-content"><h3 class="title">'.$title.'</h3>';
		 $a.= $rera.'</div>';
		 $a.= '<p>By '.$dev.'</p>';
		 $a.= '<p>By '.$add.'</p>';
         $a.='<div class="mid-content">'.$tm.'<p>'.$sq.'</p></div></a><div class="bottom-content"><p class="price"><i class="bi bi-currency-rupee">               </i>'.$price.'</p>';
			  
		$a.= '<span class="btn enqbtn" ><a href="'.$clink.'">Contact us</a></span></div></div></div></div>';
    }
    wp_reset_postdata();
} else {
     $a= '<p class="ppp">No Property Found For Sale.</p>';
}


    if ($post_id) {
        $post = get_post($post_id);
        if ($post) {
            echo json_encode(array(
                'status' => 'success',
                'title' => 1,
                'content' => $a
            ));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'No Property Found For Sale.'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'No Property Found For Sale.'));
    }

    wp_die(); // Always include this to end AJAX requests properly
}

add_action('wp_ajax_custom_action', 'custom_ajax_function'); // For logged-in users
add_action('wp_ajax_nopriv_custom_action', 'custom_ajax_function'); // For guests


function custom_ajax_function1() {
    // Get the data from AJAX
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : 0;
	$term_ids2 = isset($_POST['pid']) ? $_POST['pid'] : 0;
    
    $term_array = explode(",", $post_id);
    
    $term_ids = $term_array; // Your term IDs
    $taxonomy = 'property-room'; // Replace with your taxonomy name
    $post_type = 'property'; // Replace with your custom post type
    $taxonomy2 = 'property-type';
$args = array(
    'post_type' => 'property', // Change to your post type
    'posts_per_page' => -1, // Adjust as needed
    'tax_query' => array(
        array(
            'taxonomy' => 'property-room', // Change to your taxonomy
            'field'    => 'term_id',
            'terms'    => $term_ids, // Replace with your term IDs
            'operator' => 'IN',
        ),
    ),
    'meta_query' => array(
        array(
            'key'   => 'selected_developer', // Change to your meta key
            'value' => $term_ids2, // Change to your meta value
            'compare' => '=' // Change comparison if needed
        ),
    ),
);

$query = new WP_Query($args);



$a='';
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
		$img = get_the_post_thumbnail_url( get_the_ID(),'full');
		$link=get_permalink();
		$title=get_the_title();
		$rera=get_field('approved_by_rera'); 
        if($rera[0]=='Yes'){
		$rera='<span class="reratext">RERA <i class="bi bi-check-lg"></i></span>';
		}
		 $status=get_field('project_status_p');
		 $terms = get_field('selected_developer');
		 $add= get_field('paddress');
		 $dev= get_the_title($terms);
		 $terms = get_the_terms(get_the_ID(), 'property-room');
         if ($terms && !is_wp_error($terms)) {
          $terms_list = array();
          foreach ($terms as $term) {
          $terms_list[] = $term->name;
          }  
		 }
         $tm= '<p>'.implode(', ', $terms_list).'</p>';
		 $sq=get_field('area_sq_ft');
		 $price=get_field('pprice');
		 $clink=get_page_link(26);
         $a.= '<div class="project-grid" data-type="1bhk"><div class="project-listing-box">';
         $a.= '<div class="img"><a href="'.$link.'"><img src="'.$img.'" /></a><span class="new-launch">'.$status.'</span></div>';
		 $a.= '<div class="content"><a href="'.$link.'"><div class="top-content"><h3 class="title">'.$title.'</h3>';
		 $a.= $rera.'</div>';
		 $a.= '<p>By '.$dev.'</p>';
		 $a.= '<p>By '.$add.'</p>';
         $a.='<div class="mid-content">'.$tm.'<p>'.$sq.'</p></div></a><div class="bottom-content"><p class="price"><i class="bi bi-currency-rupee">               </i>'.$price.'</p>';
			  
		$a.= '<span class="btn enqbtn" ><a href="'.$clink.'">Contact us</a></span></div></div></div></div>';
    }
    wp_reset_postdata();
} else {
     $a= '<p class="ppp">No Property Found For Sale.</p>';
}


    if ($post_id) {
        $post = get_post($post_id);
        if ($post) {
            echo json_encode(array(
                'status' => 'success',
                'title' => 1,
                'content' => $a
            ));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'No Property Found For Sale.'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'No Property Found For Sale.'));
    }

    wp_die(); // Always include this to end AJAX requests properly
}

add_action('wp_ajax_custom_action1', 'custom_ajax_function1'); // For logged-in users
add_action('wp_ajax_nopriv_custom_action1', 'custom_ajax_function1'); // For guests
