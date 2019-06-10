<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label'); ?></span>
        <input type="search" class="search-field"
               placeholder="<?php echo esc_attr_x('What can we help you find?', 'placeholder'); ?>"
               value="<?php echo esc_attr(get_search_query()); ?>" name="s"
               title="<?php echo esc_attr_x('Search for:', 'label'); ?>"/>
    </label>
    <div class="search-form__icon">
        <svg class="icon">
            <use xlink:href="#icon-search"/>
        </svg>
    </div>
</form>