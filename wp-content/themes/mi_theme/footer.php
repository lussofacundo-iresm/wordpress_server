</div><!-- .site-content -->

<footer class="site-footer">
    <div class="footer-grid">
        <!-- Brand -->
        <div class="footer-brand">
            <div class="site-branding" style="margin-bottom:1rem;">
                <div class="site-logo-icon">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <span class="site-title">
                    <?php
                    $name = get_bloginfo('name');
                    $half = intval(strlen($name) / 2);
                    echo esc_html(substr($name, 0, $half));
                    echo '<span>' . esc_html(substr($name, $half)) . '</span>';
                    ?>
                </span>
            </div>
            <p class="footer-description">
                <?php bloginfo('description'); ?>
                Protegemos tu infraestructura digital con las últimas técnicas en ciberseguridad ofensiva y defensiva.
            </p>
            <div class="footer-social">
                <a href="#" class="social-link" title="Twitter/X"><i class="fab fa-x-twitter"></i></a>
                <a href="#" class="social-link" title="GitHub"><i class="fab fa-github"></i></a>
                <a href="#" class="social-link" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-link" title="RSS"><i class="fas fa-rss"></i></a>
            </div>
        </div>

        <!-- Navigation -->
        <div>
            <h4 class="footer-heading">Navegación</h4>
            <?php
            wp_nav_menu([
                'theme_location' => 'footer',
                'container'      => false,
                'menu_class'     => 'footer-links',
                'fallback_cb'    => function() {
                    echo '<ul class="footer-links">';
                    $pages = [
                        'Inicio'      => home_url('/'),
                        'Blog'        => home_url('/blog'),
                        'Servicios'   => home_url('/servicios'),
                        'Sobre Mí'    => home_url('/sobre'),
                        'Contacto'    => home_url('/contacto'),
                    ];
                    foreach ($pages as $label => $url) {
                        echo "<li><a href='" . esc_url($url) . "'>" . esc_html($label) . "</a></li>";
                    }
                    echo '</ul>';
                }
            ]);
            ?>
        </div>

        <!-- Sidebar Footer 1 -->
        <div>
            <?php if (is_active_sidebar('footer-1')) : ?>
                <?php dynamic_sidebar('footer-1'); ?>
            <?php else : ?>
                <h4 class="footer-heading">Recursos</h4>
                <ul class="footer-links">
                    <li><a href="#">CVE Database</a></li>
                    <li><a href="#">Herramientas</a></li>
                    <li><a href="#">Writeups CTF</a></li>
                    <li><a href="#">Cheatsheets</a></li>
                    <li><a href="#">Cursos</a></li>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Sidebar Footer 2 -->
        <div>
            <?php if (is_active_sidebar('footer-2')) : ?>
                <?php dynamic_sidebar('footer-2'); ?>
            <?php else : ?>
                <h4 class="footer-heading">Legal</h4>
                <ul class="footer-links">
                    <li><a href="#">Política de Privacidad</a></li>
                    <li><a href="#">Términos de Uso</a></li>
                    <li><a href="#">Divulgación Responsable</a></li>
                    <li><a href="#">Cookies</a></li>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer-bottom">
        <span>
            © <?php echo date('Y'); ?> <?php bloginfo('name'); ?> — Todos los derechos reservados.
        </span>
        <div class="footer-status">
            <span class="status-dot"></span>
            <span>TODOS LOS SISTEMAS OPERATIVOS</span>
        </div>
        <span style="font-size:0.7rem; color: var(--text-muted);">
            <i class="fas fa-code" style="color:var(--accent-green)"></i>
            Powered by WordPress + CyberShield
        </span>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
