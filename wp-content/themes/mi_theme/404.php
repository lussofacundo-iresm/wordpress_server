<?php get_header(); ?>

<div class="container" style="min-height:70vh;display:flex;align-items:center;justify-content:center;padding:4rem 2rem;">
    <div style="text-align:center;max-width:600px;">

        <div style="font-family:var(--font-display);font-size:8rem;font-weight:900;color:var(--accent-red);text-shadow:0 0 40px rgba(255,0,60,0.4);line-height:1;margin-bottom:1rem;">
            404
        </div>

        <div class="terminal" style="margin:2rem 0;text-align:left;">
            <div class="terminal-header">
                <span class="terminal-dot red"></span>
                <span class="terminal-dot yellow"></span>
                <span class="terminal-dot green"></span>
                <span class="terminal-title">error_handler.sh</span>
            </div>
            <div class="terminal-body">
                <div class="terminal-line">
                    <span class="terminal-prompt">root@cybershield:~$</span>
                    <span class="terminal-cmd">locate "<?php echo esc_html($_SERVER['REQUEST_URI'] ?? '/página'); ?>"</span>
                </div>
                <div class="terminal-output error">ERROR 404: Recurso no encontrado en el sistema.</div>
                <div class="terminal-output warning">Posibles causas: URL incorrecta, recurso eliminado, acceso denegado.</div>
                <div class="terminal-output info">Iniciando protocolo de recuperación...</div>
                <div class="terminal-line" style="margin-top:0.5rem;">
                    <span class="terminal-prompt">root@cybershield:~$</span>
                    <span class="cursor-blink"></span>
                </div>
            </div>
        </div>

        <h1 style="font-size:1.5rem;margin-bottom:1rem;">Página no encontrada</h1>
        <p style="color:var(--text-muted);margin-bottom:2rem;">
            La página que buscás no existe o fue movida. Podés volver al inicio o usar el buscador.
        </p>

        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
            <a href="<?php echo home_url('/'); ?>" class="btn btn-primary">
                <i class="fas fa-house"></i> Volver al Inicio
            </a>
            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Página Anterior
            </a>
        </div>

    </div>
</div>

<?php get_footer(); ?>
