<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- Page Loader -->
<div class="page-loader" id="pageLoader">
    <div class="loader-logo"><?php bloginfo('name'); ?></div>
    <div class="loader-bar"><div class="loader-fill"></div></div>
    <div class="loader-text">INITIALIZING SECURE CONNECTION...</div>
</div>

<!-- Custom Cursor -->
<div class="cursor" id="cursor"></div>
<div class="cursor-follower" id="cursorFollower"></div>

<!-- Header -->
<header class="site-header" id="siteHeader">
    <div class="site-branding">
        <div class="site-logo-icon">
            <i class="fas fa-shield-halved"></i>
        </div>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">
            <?php
            $name = get_bloginfo('name');
            $half = intval(strlen($name) / 2);
            echo esc_html(substr($name, 0, $half));
            echo '<span>' . esc_html(substr($name, $half)) . '</span>';
            ?>
        </a>
    </div>

    <nav class="main-navigation" id="mainNav">
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'fallback_cb'    => function() {
                echo '<ul>';
                echo '<li><a href="' . home_url('/') . '"><i class="fas fa-house"></i> Inicio</a></li>';
                echo '<li><a href="' . home_url('/blog') . '"><i class="fas fa-terminal"></i> Blog</a></li>';
                echo '<li><a href="' . home_url('/servicios') . '"><i class="fas fa-lock"></i> Servicios</a></li>';
                echo '<li><a href="' . home_url('/contacto') . '"><i class="fas fa-envelope"></i> Contacto</a></li>';
                echo '<li class="nav-cta"><a href="' . home_url('/auditoria') . '">Auditoría Gratis</a></li>';
                echo '</ul>';
            }
        ]);
        ?>
    </nav>

    <div class="header-status">
        <span class="status-dot"></span>
        <span>SISTEMA SEGURO</span>
    </div>

    <button class="menu-toggle" id="menuToggle" aria-label="Menú">
        <span></span><span></span><span></span>
    </button>
</header>

<div class="site-content">
