<?php get_header(); ?>

<!-- Hero Section (solo en la página principal) -->
<?php if (is_front_page() && is_home()) : ?>
<section class="hero">
    <div class="hero-bg">
        <canvas id="matrixCanvas"></canvas>
        <div class="hero-glow"></div>
    </div>
    <div class="hero-content container">
        <div class="hero-badge">
            <span>// SISTEMA DE DEFENSA ACTIVO</span>
        </div>
        <h1 class="hero-title">
            <span class="glitch" data-text="Ciberseguridad">Ciberseguridad</span><br>
            <span class="line-accent">Sin Compromisos</span>
        </h1>
        <p class="hero-description">
            Análisis de vulnerabilidades, pentesting, y estrategias de defensa para proteger tu organización
            frente a las amenazas más avanzadas del panorama actual.
        </p>
        <div class="hero-actions">
            <a href="<?php echo home_url('/servicios'); ?>" class="btn btn-primary">
                <i class="fas fa-shield-halved"></i> Ver Servicios
            </a>
            <a href="<?php echo home_url('/blog'); ?>" class="btn btn-secondary">
                <i class="fas fa-terminal"></i> Leer el Blog
            </a>
        </div>
    </div>
</section>

<!-- Stats Bar -->
<div class="stats-bar">
    <div class="stats-grid">
        <div class="stat-item">
            <span class="stat-number" data-count="500">500+</span>
            <span class="stat-label">Vulnerabilidades Reportadas</span>
        </div>
        <div class="stat-item">
            <span class="stat-number" data-count="200">200+</span>
            <span class="stat-label">Clientes Protegidos</span>
        </div>
        <div class="stat-item">
            <span class="stat-number" data-count="99">99.9%</span>
            <span class="stat-label">Uptime Garantizado</span>
        </div>
        <div class="stat-item">
            <span class="stat-number" data-count="24">24/7</span>
            <span class="stat-label">Monitoreo Activo</span>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Posts -->
<div class="content-area">
    <main class="main-content">
        <?php if (!is_front_page()) : ?>
        <div class="section-header" style="padding: 2rem 0 0;">
            <div class="section-label">// ARTÍCULOS</div>
            <h2 class="section-title">Últimas Publicaciones</h2>
        </div>
        <?php else : ?>
        <div class="section-header" style="padding: 3rem 0 0;">
            <div class="section-label">// ÚLTIMAS AMENAZAS & ANÁLISIS</div>
            <h2 class="section-title">Intelligence Feed</h2>
        </div>
        <?php endif; ?>

        <?php if (have_posts()) : ?>
        <div class="posts-grid">
            <?php
            $post_count = 0;
            while (have_posts()) : the_post();
                $post_count++;
                $is_featured = ($post_count === 1 && is_home() && is_front_page());
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-card' . ($is_featured ? ' post-featured' : '')); ?>>

                <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail($is_featured ? 'featured-large' : 'card-thumb'); ?>
                    <div class="post-thumbnail-overlay"></div>
                    <?php
                    $cats = get_the_category();
                    if ($cats) {
                        echo '<span class="post-category">' . esc_html($cats[0]->name) . '</span>';
                    }
                    ?>
                </div>
                <?php endif; ?>

                <div class="post-body">
                    <div class="post-meta">
                        <span class="post-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <?php echo get_the_date('d M Y'); ?>
                        </span>
                        <span class="post-meta-item">
                            <i class="fas fa-user"></i>
                            <?php the_author(); ?>
                        </span>
                        <span class="post-meta-item">
                            <i class="fas fa-clock"></i>
                            <?php
                            $words = str_word_count(strip_tags(get_the_content()));
                            echo ceil($words / 200) . ' min';
                            ?>
                        </span>
                    </div>

                    <h2 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <p class="post-excerpt"><?php the_excerpt(); ?></p>

                    <div class="post-footer">
                        <a href="<?php the_permalink(); ?>" class="read-more">
                            Leer análisis
                        </a>
                        <?php
                        $tags = get_the_tags();
                        if ($tags) {
                            echo '<div style="display:flex;gap:0.4rem;flex-wrap:wrap;">';
                            foreach (array_slice($tags, 0, 2) as $tag) {
                                echo '<span style="font-family:var(--font-mono);font-size:0.65rem;padding:0.2rem 0.5rem;background:rgba(0,212,255,0.08);border:1px solid rgba(0,212,255,0.2);color:var(--accent-cyan);border-radius:2px;">#' . esc_html($tag->name) . '</span>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            echo paginate_links([
                'prev_text' => '<i class="fas fa-chevron-left"></i>',
                'next_text' => '<i class="fas fa-chevron-right"></i>',
            ]);
            ?>
        </div>

        <?php else : ?>
        <div class="terminal" style="max-width:600px; margin: 3rem auto;">
            <div class="terminal-header">
                <span class="terminal-dot red"></span>
                <span class="terminal-dot yellow"></span>
                <span class="terminal-dot green"></span>
                <span class="terminal-title">bash — no_results</span>
            </div>
            <div class="terminal-body">
                <div class="terminal-line">
                    <span class="terminal-prompt">root@cybershield:~$</span>
                    <span class="terminal-cmd">search --query "posts"</span>
                </div>
                <div class="terminal-output error">ERROR: No se encontraron publicaciones.</div>
                <div class="terminal-output info">Sugerencia: Crea tu primer artículo desde el panel de WordPress.</div>
                <div class="terminal-line" style="margin-top:0.5rem;">
                    <span class="terminal-prompt">root@cybershield:~$</span>
                    <span class="cursor-blink"></span>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <!-- Sidebar -->
    <aside class="sidebar">
        <!-- Search -->
        <div class="widget">
            <h3 class="widget-title">Buscar</h3>
            <?php get_search_form(); ?>
        </div>

        <!-- Threat Level Widget -->
        <div class="widget">
            <h3 class="widget-title">Nivel de Amenaza Global</h3>
            <div class="threat-meter">
                <div class="threat-label"><span>Ransomware</span><span>87%</span></div>
                <div class="threat-bar"><div class="threat-fill critical" style="width:87%"></div></div>
            </div>
            <div class="threat-meter">
                <div class="threat-label"><span>Phishing</span><span>74%</span></div>
                <div class="threat-bar"><div class="threat-fill high" style="width:74%"></div></div>
            </div>
            <div class="threat-meter">
                <div class="threat-label"><span>DDoS</span><span>52%</span></div>
                <div class="threat-bar"><div class="threat-fill medium" style="width:52%"></div></div>
            </div>
            <div class="threat-meter">
                <div class="threat-label"><span>SQLi</span><span>31%</span></div>
                <div class="threat-bar"><div class="threat-fill low" style="width:31%"></div></div>
            </div>
            <p style="font-family:var(--font-mono);font-size:0.65rem;color:var(--text-muted);margin-top:1rem;margin-bottom:0;">
                Actualizado: <?php echo date('d/m/Y H:i'); ?> UTC
            </p>
        </div>

        <!-- Mini Terminal Widget -->
        <div class="widget" style="padding:0;">
            <div class="terminal" style="border:none;box-shadow:none;">
                <div class="terminal-header">
                    <span class="terminal-dot red"></span>
                    <span class="terminal-dot yellow"></span>
                    <span class="terminal-dot green"></span>
                    <span class="terminal-title">live_monitor.sh</span>
                </div>
                <div class="terminal-body" style="min-height:auto;">
                    <div class="terminal-line">
                        <span class="terminal-prompt">$</span>
                        <span class="terminal-cmd">uptime</span>
                    </div>
                    <div class="terminal-output success">Sistema: ONLINE ✓</div>
                    <div class="terminal-line">
                        <span class="terminal-prompt">$</span>
                        <span class="terminal-cmd">threat-scan --live</span>
                    </div>
                    <div class="terminal-output warning">3 amenazas monitoreadas</div>
                    <div class="terminal-output info">Firewall: activo</div>
                    <div class="terminal-line" style="margin-top:0.25rem;">
                        <span class="terminal-prompt">$</span>
                        <span class="cursor-blink"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- WordPress sidebar -->
        <?php if (is_active_sidebar('sidebar-main')) : ?>
            <?php dynamic_sidebar('sidebar-main'); ?>
        <?php endif; ?>
    </aside>
</div>

<?php get_footer(); ?>
