<?php
/**
 * Custom Search Form for Kawiarnia Theme
 *
 * @package Kawiarnia
 */
?>
<form role="search" method="get" class="coffee-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text" for="coffee-search-input"><?php esc_html_e( 'Szukaj...', 'kawiarnia' ); ?></label>
    <div class="search-input-wrapper">
        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input 
            type="search" 
            id="coffee-search-input" 
            class="coffee-search-field" 
            placeholder="<?php echo esc_attr__( 'Wyszukaj ziarna, wpis lub poradnik...', 'kawiarnia' ); ?>" 
            value="<?php echo get_search_query(); ?>" 
            name="s" 
        />
        <button type="submit" class="coffee-search-submit btn btn-primary">
            <span>Szukaj</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </div>
</form>
