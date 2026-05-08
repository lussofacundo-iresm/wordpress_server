<?php get_header(); ?>

<div class="content-area">
    <main class="main-content">
        <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('post-single'); ?>>

            <header class="post-header">
                <!-- Breadcrumb -->
                <div style="font-family:var(--font-mono);font-size:0.75rem;color:var(--text-muted);margin-bottom:1.5rem;">
                    <a href="<?php echo home_url('/'); ?>" style="color:var(--text-muted);">inicio</a>
                    <span style="color:var(--accent-green);margin:0 0.5rem;">/</span>
                    <?php
                    $cats = get_the_category();
                    if ($cats) {
                        echo '<a href="' . get_category_link($cats[0]->term_id) . '" style="color:var(--text-muted);">' . esc_html($cats[0]->name) . '</a>';
                        echo '<span style="color:var(--accent-green);margin:0 0.5rem;">/</span>';
                    }
                    ?>
                    <span style="color:var(--accent-cyan);"><?php the_title(); ?></span>
                </div>

                <!-- Category badge -->
                <?php
                $cats = get_the_category();
                if ($cats) {
                    echo '<span class="post-category" style="position:static;display:inline-flex;margin-bottom:1rem;">' . esc_html($cats[0]->name) . '</span>';
                }
                ?>

                <h1 class="post-title"><?php the_title(); ?></h1>

                <div class="post-meta" style="margin: 1.5rem 0;">
                    <span class="post-meta-item">
                        <i class="fas fa-user"></i> <?php the_author(); ?>
                    </span>
                    <span class="post-meta-item">
                        <i class="fas fa-calendar"></i> <?php echo get_the_date('d F Y'); ?>
                    </span>
                    <span class="post-meta-item">
                        <i class="fas fa-clock"></i>
                        <?php
                        $words = str_word_count(strip_tags(get_the_content()));
                        echo ceil($words / 200) . ' min de lectura';
                        ?>
                    </span>
                    <span class="post-meta-item">
                        <i class="fas fa-comment"></i>
                        <?php comments_number('0 comentarios', '1 comentario', '% comentarios'); ?>
                    </span>
                </div>

                <?php if (has_post_thumbnail()) : ?>
                <div style="border-radius:4px;overflow:hidden;margin-bottom:2.5rem;border:1px solid var(--border-color);">
                    <?php the_post_thumbnail('featured-large', ['style' => 'width:100%;display:block;filter:brightness(0.85) saturate(0.8);']); ?>
                </div>
                <?php endif; ?>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <!-- Tags -->
            <?php
            $tags = get_the_tags();
            if ($tags) : ?>
            <div style="margin-top:2.5rem;padding-top:1.5rem;border-top:1px solid var(--border-color);">
                <span style="font-family:var(--font-mono);font-size:0.75rem;color:var(--text-muted);margin-right:0.75rem;">TAGS:</span>
                <?php foreach ($tags as $tag) : ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>"
                   style="display:inline-flex;margin:0.2rem;font-family:var(--font-mono);font-size:0.7rem;padding:0.3rem 0.7rem;background:rgba(0,212,255,0.06);border:1px solid rgba(0,212,255,0.2);color:var(--accent-cyan);border-radius:2px;transition:all 0.2s ease;"
                   onmouseover="this.style.background='rgba(0,212,255,0.12)'"
                   onmouseout="this.style.background='rgba(0,212,255,0.06)'">
                    #<?php echo esc_html($tag->name); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Author Box -->
            <div style="margin-top:2.5rem;padding:1.5rem;background:var(--bg-card);border:1px solid var(--border-color);border-radius:4px;display:flex;gap:1.25rem;align-items:flex-start;">
                <div style="flex-shrink:0;">
                    <?php echo get_avatar(get_the_author_meta('ID'), 60, '', '', ['style' => 'border-radius:4px;border:2px solid var(--accent-green);filter:grayscale(30%)']); ?>
                </div>
                <div>
                    <div style="font-family:var(--font-display);font-size:0.85rem;color:var(--accent-green);margin-bottom:0.25rem;">
                        <?php the_author(); ?>
                    </div>
                    <p style="font-size:0.88rem;color:var(--text-muted);margin:0;">
                        <?php echo esc_html(get_the_author_meta('description') ?: 'Investigador en ciberseguridad y especialista en análisis de amenazas avanzadas.'); ?>
                    </p>
                </div>
            </div>

            <!-- Navigation prev/next -->
            <nav style="margin-top:2.5rem;display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <?php
                $prev = get_previous_post();
                $next = get_next_post();
                if ($prev) : ?>
                <a href="<?php echo get_permalink($prev); ?>" style="padding:1rem;background:var(--bg-card);border:1px solid var(--border-color);border-radius:4px;transition:all 0.3s ease;color:var(--text-secondary);"
                   onmouseover="this.style.borderColor='rgba(0,255,136,0.3)'"
                   onmouseout="this.style.borderColor='var(--border-color)'">
                    <div style="font-family:var(--font-mono);font-size:0.65rem;color:var(--text-muted);margin-bottom:0.4rem;">← ANTERIOR</div>
                    <div style="font-size:0.9rem;color:var(--text-primary);"><?php echo esc_html($prev->post_title); ?></div>
                </a>
                <?php else : echo '<div></div>'; endif; ?>

                <?php if ($next) : ?>
                <a href="<?php echo get_permalink($next); ?>" style="padding:1rem;background:var(--bg-card);border:1px solid var(--border-color);border-radius:4px;transition:all 0.3s ease;text-align:right;color:var(--text-secondary);"
                   onmouseover="this.style.borderColor='rgba(0,255,136,0.3)'"
                   onmouseout="this.style.borderColor='var(--border-color)'">
                    <div style="font-family:var(--font-mono);font-size:0.65rem;color:var(--text-muted);margin-bottom:0.4rem;">SIGUIENTE →</div>
                    <div style="font-size:0.9rem;color:var(--text-primary);"><?php echo esc_html($next->post_title); ?></div>
                </a>
                <?php endif; ?>
            </nav>

            <!-- Comments -->
            <?php comments_template(); ?>

        </article>
        <?php endwhile; ?>
    </main>

    <aside class="sidebar">
        <div class="widget">
            <h3 class="widget-title">Buscar</h3>
            <?php get_search_form(); ?>
        </div>

        <?php if (is_active_sidebar('sidebar-main')) : ?>
            <?php dynamic_sidebar('sidebar-main'); ?>
        <?php endif; ?>
    </aside>
</div>

<?php get_footer(); ?>
