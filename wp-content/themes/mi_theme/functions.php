<?php
/**
 * CyberShield Theme Functions
 */

if (!defined('ABSPATH')) exit;

// Theme setup
function cybershield_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('custom-logo');
    add_theme_support('automatic-feed-links');

    register_nav_menus([
        'primary' => __('Primary Navigation', 'cybershield'),
        'footer'  => __('Footer Navigation', 'cybershield'),
    ]);

    add_image_size('card-thumb', 680, 383, true);
    add_image_size('featured-large', 1200, 675, true);
}
add_action('after_setup_theme', 'cybershield_setup');

// Enqueue scripts & styles
function cybershield_enqueue() {
    // Google Fonts
    wp_enqueue_style('cybershield-fonts',
        'https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&family=Exo+2:ital,wght@0,300;0,400;0,600;1,400&display=swap',
        [], null
    );

    // Font Awesome
    wp_enqueue_style('font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [], '6.5.0'
    );

    // Main stylesheet
    wp_enqueue_style('cybershield-style', get_stylesheet_uri(), ['cybershield-fonts'], '1.0.0');

    // Main JS
    wp_enqueue_script('cybershield-main',
        get_template_directory_uri() . '/js/main.js',
        [], '1.0.0', true
    );
}
add_action('wp_enqueue_scripts', 'cybershield_enqueue');

// Register sidebars
function cybershield_widgets() {
    register_sidebar([
        'name'          => __('Main Sidebar', 'cybershield'),
        'id'            => 'sidebar-main',
        'description'   => __('Widgets in the main sidebar', 'cybershield'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => __('Footer Column 1', 'cybershield'),
        'id'            => 'footer-1',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-heading">',
        'after_title'   => '</h4>',
    ]);

    register_sidebar([
        'name'          => __('Footer Column 2', 'cybershield'),
        'id'            => 'footer-2',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-heading">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'cybershield_widgets');

// Excerpt length
function cybershield_excerpt_length() { return 20; }
add_filter('excerpt_length', 'cybershield_excerpt_length');

function cybershield_excerpt_more() { return '...'; }
add_filter('excerpt_more', 'cybershield_excerpt_more');

// Custom login logo
function cybershield_login_styles() { ?>
    <style>
        body.login { background: #020c0e; }
        .login h1 a {
            background-image: none !important;
            font-family: 'Orbitron', sans-serif;
            color: #00ff88;
            font-size: 1.5rem;
            width: auto;
            text-indent: 0;
            text-shadow: 0 0 20px #00ff8840;
        }
        .login form {
            background: #071318;
            border: 1px solid #0d2d35;
            border-radius: 4px;
        }
        .login input[type="text"],
        .login input[type="password"] {
            background: #020c0e;
            border-color: #0d2d35;
            color: #e0f5f5;
        }
        .login input[type="submit"] {
            background: #00ff88 !important;
            border-color: #00ff88 !important;
            color: #020c0e !important;
            font-weight: 700;
            box-shadow: none !important;
        }
        #login_error, .login .message {
            border-left-color: #00ff88;
            background: #071318;
            color: #7ab8c0;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'cybershield_login_styles');
