<?php

namespace _core\actions\debug;

function utils(){
    add_action('get_footer', function() {
        global $template;
        ob_start();
        ?>
        <span class="debug-template">
            <strong><?php echo basename($template); ?></strong>
            <br>
            <code>
            <?php var_dump(get_queried_object()); ?>
            </code>
        </span>
        <?php
        print(ob_get_clean());
    });
    flush_rewrite_rules(true);
}
