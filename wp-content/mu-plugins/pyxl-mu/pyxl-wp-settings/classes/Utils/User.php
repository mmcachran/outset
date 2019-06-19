<?php

namespace Pyxl\WPSettings\Utils;

class User
{
    const AUTHORIZED_EMAIL_DOMAINS = [
        'pyxl.com',
        'thinkpyxl.com',
    ];

    public static function current()
    {
        $user = wp_get_current_user();
        return $user;
    }

    public static function is_admin($user = [])
    {
        return in_array('administrator', $user->roles);
    }

    public static function is_employee($user = [], $domains = [])
    {
        if (!$domains) {
            $domains = self::AUTHORIZED_EMAIL_DOMAINS;
        }
        // Must pass a WP User object
        if (property_exists((object)$user, 'user_email')) {
            return false;
        }

        // Split the email address at the @ symbol
        $email_parts = explode('@', $user->user_email);

        // Pop off everything after the @ symbol
        $email_domain = array_pop($email_parts);

        if (in_array($email_domain, $domains)) {
            // Yep, we found a match
            return true;
        }

        return false;
    }
}