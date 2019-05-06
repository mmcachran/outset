<?php

namespace Pyxl\WPSettings\DashboardWidgets;

use Pyxl\WPSettings\Utils\PluginLists;

class Additions
{

    private static $instance;

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function init()
    {
        add_action('wp_dashboard_setup', [self::instance(), 'additions']);
    }

    public function additions()
    {
        // Context Options [normal, side, column3, column4]
        $widgets = [
            [
                'widget_id'   => 'pyxl_info',
                'widget_name' => 'Developers Information',
                'callback'    => [self::instance(), 'info'],
                'screen'      => 'dashboard',
                'context'     => 'normal',
                'priority'    => 'low',
            ],
            [
                'widget_id'   => 'pyxl_plugins',
                'widget_name' => 'Plugins Information',
                'callback'    => [self::instance(), 'plugins'],
                'screen'      => 'dashboard',
                'context'     => 'side',
                'priority'    => 'high',
            ],
            [
                'widget_id'   => 'pyxl_server_info',
                'widget_name' => 'Server Information',
                'callback'    => [self::instance(), 'server'],
                'screen'      => 'dashboard',
                'context'     => 'column3',
                'priority'    => 'high',
            ],
        ];
        foreach ($widgets as $widget) {
            add_meta_box(
                $widget['widget_id'],
                $widget['widget_name'],
                $widget['callback'],
                $widget['screen'],
                $widget['context'],
                $widget['priority']
            );

//            wp_add_dashboard_widget(
//                $widget['widget_id'],
//                $widget['widget_name'],
//                $widget['callback'],
//                $widget['control_callback'],
//                $widget['callback_args']
//            );
        }
    }

    public function plugins()
    {
        $installed_plugins = PluginLists::installed();
        $active_plugins    = PluginLists::active();
        ?>
        <ul>
            <?php
            foreach ($installed_plugins as $plugin_slug => $plugin_details) :
                if (in_array($plugin_slug, $active_plugins)) :
                    ?>
                    <p><span><?php echo esc_html__($plugin_details['Name']); ?></span></p>
                <?php
                endif;
            endforeach;
            ?>
        </ul>
        <?php
    }

    public function info()
    {
        ?>
        <ul>
            <li><strong>Website:</strong> <a href='//pyxl.com'>https://pyxl.com</a></li>
            <li><strong>Email:</strong> <a href='mailto:development@pyxl.com'>development@pyxl.com</a></li>
        </ul>
        <?php
    }

    public function server()
    {
        global $wpdb;
        ?>
        <ul>
            <li>
                <p><strong>PHP: </strong><?php echo phpversion(); ?></p>
            </li>
            <li>
                <p><strong>MySQL: </strong><?php echo $wpdb->db_version(); ?></p>
            </li>
        </ul>
        <?php
    }
}
