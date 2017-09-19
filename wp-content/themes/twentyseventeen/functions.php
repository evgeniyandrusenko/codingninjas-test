<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyseventeen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'twentyseventeen-featured-image', 2000, 1200, true );

	add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'twentyseventeen' ),
		'social' => __( 'Social Links Menu', 'twentyseventeen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'twentyseventeen' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'twentyseventeen' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'twentyseventeen_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( twentyseventeen_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
add_action( 'template_redirect', 'twentyseventeen_content_width', 0 );

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentyseventeen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyseventeen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'twentyseventeen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'twentyseventeen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'twentyseventeen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyseventeen_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function twentyseventeen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_uri() );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'twentyseventeen-style' ), '1.0' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'twentyseventeen-style' ), '1.0' );
		wp_style_add_data( 'twentyseventeen-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentyseventeen-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'twentyseventeen-style' ), '1.0' );
	wp_style_add_data( 'twentyseventeen-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentyseventeen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$twentyseventeen_l10n = array(
		'quote'          => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'twentyseventeen-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$twentyseventeen_l10n['expand']         = __( 'Expand child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['collapse']       = __( 'Collapse child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['icon']           = twentyseventeen_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}

	wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentyseventeen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function twentyseventeen_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'twentyseventeen_front_page_template' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );









/**
 * Регистрирую новый post type "film"
 */
add_action('init', 'register_post_type_film', 1);
function register_post_type_film() {
  register_post_type('film', array(
    'label'              => 'Фильм',
    'labels'             => array(
      'name'               => 'Фильм',
      'singular_name'      => 'Фильм',
      'menu_name'          => 'Фильмы',
      'add_new'            => 'Создать фильм',
      'add_new_item'       => 'Создать фильм',
      'new_item'           => 'Создать фильм',
      'edit_item'          => 'Редактировать фильм',
      'view_item'          => 'Просмотреть фильм',
      'all_items'          => 'Все фильмы',
      'search_items'       => 'Искать фильм',
      'not_found_in_trash' => 'В корзине не найдено фильмов'
    ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'taxonomies'         => array('film_cat'),
    'menu_icon'          => 'dashicons-format-video',
    'hierarchical'       => false,
    // 'menu_position'      => 86,
    'supports'           => array('title', 'excerpt', 'editor', 'thumbnail')
  ));

  register_taxonomy('film_cat', array('film'), array(
    'hierarchical'      => true,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => true,
    'capabilities'      => array(
      'manage_terms'  => 'edit_posts',
      'edit_terms'    => 'edit_posts',
      'delete_terms'  => 'edit_posts',
      'assign_terms'  => 'edit_posts'
    ),
    'labels'            => array(
      'name'                       => 'Категория фильмов',
      'singular_name'              => 'Категории фильмов', 
      'taxonomy general name'      => 'Категории фильмов',
      'search_items'               => 'Искать категории фильмов',
      'popular_items'              => 'Популярные категории фильмов',
      'all_items'                  => 'Все категории фильмов',
      'parent_item'                => 'Родительская категория',
      'parent_item_colon'          => 'Родительская категория:',
      'edit_item'                  => 'Редактировать категорию',
      'update_item'                => 'Обновить категорию',
      'add_new_item'               => 'Новая категория фильмов',
      'new_item_name'              => 'Добавить категорию фильмов',
      'add_or_remove_items'        => 'Добавить или удалить категорию фильмов',
      'choose_from_most_used'      => 'Выбрать из самых популярных категорий',
      'menu_name'                  => 'Категории',
    ),
  ) );
  flush_rewrite_rules( false );
}


add_action('add_meta_boxes', function(){
	add_meta_box( 'film_price', 'Цена', 'film_price_callback', 'film', 'side');
});

function film_price_callback($post) {
	wp_nonce_field( plugin_basename(__FILE__), 'film_noncename' );
	$currency_symbol = get_woocommerce_currency_symbol();
	$regular_price = get_post_meta( $post->ID, '_price', true );

	echo '<p class="form-field"><label for="_price">'.__('Regular price', 'woocommerce').' ('.$currency_symbol.')</label>';
	echo '<input type="number" name="_price" id="_price" value="'.$regular_price.'"></p>';
}

/**
 * Сохраняем данные, когда пост сохраняется
 */
add_action('save_post', function($post_id){
	// проверяем nonce нашей страницы, потому что save_post может быть вызван с другого места.
	if (!isset($_POST['film_noncename']) || !wp_verify_nonce( $_POST['film_noncename'], plugin_basename(__FILE__) ) )
		return $post_id;

	// проверяем, если это автосохранение ничего не делаем с данными нашей формы.
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;

	// проверяем разрешено ли пользователю указывать эти данные
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	if ( !isset( $_POST['_price'] ) )
		return;
	$price = sanitize_text_field( $_POST['_price'] );
	update_post_meta( $post_id, '_price', $price );
});

/**
 * Добавим форму добавления в корзину сразу после контента
 */
add_filter('the_content','film_add_to_cart_button', 20,1);
function film_add_to_cart_button($content){
	global $post;
	if ($post->post_type !== 'film') {return $content; }

	$price = get_post_meta($post->ID, '_price', 1);
	
	ob_start();?>
	<h3 style="display: inline-block; padding-top: 5px; margin-bottom: 10px;"><?php echo __('Price', 'woocommerce').': '.$price.get_woocommerce_currency_symbol(); ?></h3>
	<form action="" method="post" style="float: right;">
		<input name="add-to-cart" type="hidden" value="<?php echo $post->ID ?>">
		<input name="quantity" type="number" value="1" min="1" style="max-width: 60px; display: inline-block; padding: 8px;
    line-height: normal;">
		<input name="submit" type="submit" value="<?php _e('Add to cart', 'woocommerce') ?>" >
	</form>
<?php
	return $content . ob_get_clean();
}

/**
 * Переопределим WC_Product_Data_Store_CPT на MY_Product_Data_Store_CPT
 */
add_filter( 'woocommerce_data_stores', function($stores){
  $stores['product'] = 'MY_Product_Data_Store_CPT';
  return $stores;
});

class My_Product_Data_Store_CPT extends WC_Product_Data_Store_CPT implements WC_Object_Data_Store_Interface, WC_Product_Data_Store_Interface {

  public function read( &$product ) {
    $product->set_defaults();
    $id = $product->get_id();
    $post_object = get_post($id);

    $product->set_props( array(
      'name'              => $post_object->post_title,
      'slug'              => $post_object->post_name,
      'date_created'      => 0 < $post_object->post_date_gmt ? wc_string_to_timestamp( $post_object->post_date_gmt ) : null,
      'date_modified'     => 0 < $post_object->post_modified_gmt ? wc_string_to_timestamp( $post_object->post_modified_gmt ) : null,
      'status'            => $post_object->post_status,
      'description'       => $post_object->post_content,
      'short_description' => $post_object->post_excerpt,
      'parent_id'         => $post_object->post_parent,
      'menu_order'        => $post_object->menu_order,
      'reviews_allowed'   => 'open' === $post_object->comment_status,
    ) );

    $this->read_attributes( $product );
    $this->read_downloads( $product );
    $this->read_visibility( $product );
    $this->read_product_data( $product );
    $this->read_extra_data( $product );
    $product->set_object_read( true );
  }
}

/**
 * Добавление поля Skype в форму регистрации
 */
add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );
function wooc_extra_register_fields() {?>
	<p class="form-row form-row-wide">
		<label for="billing_skype"><?php _e( 'Skype', 'woocommerce' ); ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="skype" id="billing_skype" value="<?php if ( ! empty( $_POST['skype'] ) ) esc_attr_e( $_POST['skype'] ); ?>" />
	</p>
<?php
}

/**
 * Валидация поля Skype
 */
add_action('woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );
function wooc_validate_extra_register_fields($username, $email, $validation_errors){
  if ( isset( $_POST['skype'] ) && empty( $_POST['skype'] ) ) {
    $validation_errors->add( 'billing_skype_error', __( '<strong>Error</strong>: Skype is required!', 'woocommerce' ));
  }
  return $validation_errors;
}

/**
* Сохранение поля Skype
*/
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
add_action( 'woocommerce_save_account_details', 'my_save_extra_profile_fields' );
add_action( 'woocommerce_created_customer', 'my_save_extra_profile_fields');
function my_save_extra_profile_fields( $user_id ) { 
	if ( isset( $_POST['skype'] ) ) { 
		update_user_meta( $user_id, 'skype', sanitize_text_field( $_POST['skype'] ) );
	}
}

/**
* Вывод на экран поля Skype в админ панели Wordpress
*/
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { ?>
<table class="form-table">
	<tr>
		<th><label for="skype">Skype</label></th>
		<td>
		 	<input type="text" name="skype" id="skype" value="<?php echo esc_attr( get_the_author_meta( 'skype', $user->ID ) ); ?>" class="regular-text"> 
		</td>
	</tr>
</table>
<?php }

/**
* Вывод на экран поля Skype на странице my-account/edit-account
*/
add_action( 'woocommerce_edit_account_form', function(){
	$user_id = get_current_user_id(); 
	$current_user = get_userdata( $user_id ); 
	if (!$current_user) return; 
	$skype = get_user_meta( $user_id, 'skype', true ); 
?>
	<p class="form-row form-row-wide">
		<label for="billing_skype"><?php _e( 'Skype', 'woocommerce' ); ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="skype" id="billing_skype" value="<?php echo esc_attr($skype); ?>">
	</p>
<?php
} );

/**
* Редирект после входа
*/
add_filter( 'woocommerce_login_redirect', 'filter_woocommerce_login_redirect', 10, 2 ); 
function filter_woocommerce_login_redirect( $redirect, $user ) { 
  if(!is_wp_error($url = get_term_link('favorites', 'film_cat'))){
		$redirect = $url;
	}
  return $redirect; 
}; 

/**
* Редирект после регистрации
*/
add_filter( 'woocommerce_registration_redirect', 'filter_woocommerce_registration_redirect', 10, 1 ); 
function filter_woocommerce_registration_redirect( $var ) { 
  if(!is_wp_error($url = get_term_link('favorites', 'film_cat'))){
		$var = $url;
	} 
  return $var; 
}; 

add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout() {
	return WC()->cart->get_checkout_url();

	//'https://www.sandbox.paypal.com/cgi-bin/webscr?test_ipn=1&cmd=_cart&business=evgeniyandrusenko%40gmail.com&no_note=1&currency_code=USD&charset=utf-8&rm=1&upload=1&return=http%3A%2F%2Fcodingninjas-test%2Fcheckout%2Forder-received%2F24%3Fkey%3Dwc_order_59bbe5a04a31e%26utm_nooverride%3D1&cancel_return=http%3A%2F%2Fcodingninjas-test%2Fcart%2F%3Fcancel_order%3Dtrue%26order%3Dwc_order_59bbe5a04a31e%26order_id%3D24%26redirect%26_wpnonce%3Db70ac0cc60&page_style=&image_url=&paymentaction=sale&bn=WooThemes_Cart&invoice=WC-24&custom=%7B%22order_id%22%3A24%2C%22order_key%22%3A%22wc_order_59bbe5a04a31e%22%7D&notify_url=http%3A%2F%2Fcodingninjas-test%2Fwc-api%2FWC_Gateway_Paypal%2F&first_name=Evgeniy&last_name=Andrusenko&address1=Naberegnaya+92&address2=&city=Ichnya&state=Chernigov&zip=16703&country=UA&email=evgeniyandrusenko%40gmail.com&night_phone_b=&no_shipping=1&item_name_1=Spider+man+3+x+1&quantity_1=1&amount_1=60&item_number_1=24#/checkout/login';
}









