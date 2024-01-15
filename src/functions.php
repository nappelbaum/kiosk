<?php

add_action( 'wp_enqueue_scripts', function() {

    wp_enqueue_style( 'fontLato', get_template_directory_uri() . '/fonts/Lato/stylesheet.css' );
    wp_enqueue_style( 'fontGilroy', get_template_directory_uri() . '/fonts/Gilroy/stylesheet.css' );
    wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css' );
    wp_enqueue_style( 'fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css' );
    wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css' );

    wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), 'null', true );

	wp_enqueue_script( 'header', get_template_directory_uri() . '/js/header.bundle.js', array(), 'null', ['strategy' => 'defer'] );

    if ( is_page('home') ) {
		wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.bundle.js', array('jquery'), 'null', ['strategy' => 'defer'] );
	}

    if ( is_single() ) {
		wp_enqueue_script( 'fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array(), 'null', true );
        wp_enqueue_script( 'item', get_template_directory_uri() . '/js/item.bundle.js', array(), 'null', ['strategy' => 'defer'] );
	}

});

//Menus:

add_action( 'after_setup_theme', 'theme_register_nav_menu' );

function theme_register_nav_menu() {
	register_nav_menus( [
        'primary' => 'Primary Menu',
        'secondary' => 'Secondary Menu'
    ] );
}


// Добавляем 'products' в url постов
/**
 * Changes post type permalink.
 */
final class Kama_Change_Post_Permalink {

	public const POST_PERMALINK_PREFIX = 'products';
	public const CPT_REWRITES = [
		'foo'     => [
			'slug' => "products/%foo%",
		],
		'reports' => [
			'slug'       => "our-reports/%reports%",
			'with_front' => false,
		],
	];

	public static function init(): void {
		self::change_post_permalink();
		add_filter( 'register_post_type_args', [ __CLASS__, '_cpt_rewrite_args' ], 10, 2 );
	}

	/**
	 * Change 'post' post type permalink.
	 * Applies for 'post' post type only.
	 *
	 * @return void
	 */
	private static function change_post_permalink(): void {
		add_filter( 'post_rewrite_rules', [ __CLASS__, '_post_rewrite_rules' ] );
		add_filter( 'pre_post_link', [ __CLASS__, '_post_type_link' ], 10, 3 );
	}

	public static function _post_type_link( $permalink, $post, $leavename ) {
		$permalink = '/' . self::POST_PERMALINK_PREFIX . $permalink;
		return $permalink;
	}

	public static function _post_rewrite_rules( $rules ) {
		$new_rules = [];
		foreach ( $rules as $regex => $rule ) {
			$new_rules[ self::POST_PERMALINK_PREFIX . "/$regex" ] = $rule;
		}
		return $new_rules;
	}

	public static function _cpt_rewrite_args( $args, $post_type ){
		foreach ( self::CPT_REWRITES as $ptype => $rewrite ) {
			if( $post_type === $ptype ){
				$args['rewrite'] = $rewrite;
			}
		}
		return $args;
	}
}

Kama_Change_Post_Permalink ::init();

///////////////////////////////////////////////////

add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'custom-logo' );

?>