<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search"
           class="search-field"
           value="<?php echo esc_attr(get_search_query()); ?>"
           name="s"
           autocomplete="off">
    <button type="submit" class="search-submit">
        <i class="fas fa-magnifying-glass"></i>
    </button>
</form>
