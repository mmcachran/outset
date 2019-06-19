<?php

namespace Pyxl\WPSettings\AdminMenu;

use Pyxl\WPSettings\Utils\User;

class Redirects
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
        add_action('admin_init', [self::instance(), 'restrict_with_redirect']);
    }

    public function restrict_with_redirect()
    {
        $restrictions = [
            // 'widgets.php',
            // 'user-new.php',
            'upgrade-functions.php',
            'upgrade.php',
            'themes.php',
            // 'theme-install.php',
            // 'theme-editor.php',
            // 'setup-config.php',
            'plugins.php',
            // 'plugin-install.php',
            // 'options-writing.php',
            // 'options-reading.php',
            // 'options-privacy.php',
            // 'options-permalink.php',
            'options-media.php',
            // 'options-head.php',
            // 'options-general.php.php',
            // 'options-discussion.php',
            // 'options.php',
            // 'network.php',
            // 'ms-users.php',
            // 'ms-upgrade-network.php',
            // 'ms-themes.php',
            // 'ms-sites.php',
            // 'ms-options.php',
            // 'ms-edit.php',
            // 'ms-delete-site.php',
            // 'ms-admin.php',
            // 'moderation.php',
            // 'menu-header.php',
            // 'menu.php',
            // 'edit-tags.php',
            // 'edit-tag-form.php',
            // 'edit-link-form.php',
            'edit-comments.php',
            // 'credits.php',
            // 'about.php',
            'edit.php?post_type=acf-field-group' // ACF
        ];

        if (User::is_admin(User::current())) {
            return;
        }

        if (!in_array(basename($_SERVER['PHP_SELF']), $restrictions)) {
            return;
        }
        wp_redirect(admin_url());
        exit;
    }
}