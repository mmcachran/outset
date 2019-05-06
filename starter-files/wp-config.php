<?php
$env      = (object)parse_ini_file('.env'); // Simple way to get .env variables before we have access to composer
$dir_root = dirname(__FILE__);

if (defined('WP_CLI') && WP_CLI) {
    // https://github.com/wp-cli/wp-cli/issues/2431#issuecomment-178568416
    define('DB_HOST', "{$env->db_host_ip}:{$env->db_port}"); // Allows using WP CLI without having to SSH
} else {
    define('DB_HOST', 'localhost');
}

// Fixes https problems.
if (array_key_exists('HTTP_X_FORWARDED_PROTO', $_SERVER) &&
    false !== strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https')) {
    $_SERVER['HTTPS'] = 'on';
}

define('DB_NAME', $env->db_name);
define('DB_USER', $env->db_user);
define('DB_PASSWORD', $env->db_password);
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('AUTH_KEY', '.-sDA^xN>QXA+J&;S bR`3%;7)T+Dp,EU6vD2EcDlVE3NPf@@H*`{JkWt>~3Z82f');
define('SECURE_AUTH_KEY', 'bAr}qJc3lTQ)xSG&5glFY61^!ycL_$VPn1DPVa:><};).faY/7#,l5b-k>j$ih>1');
define('LOGGED_IN_KEY', 'h+zUb$H)e~[8t.;wC7Nfnc9I@S[f#~>z?F)+mo:a*l~Mo=T3Q[{{E~U^Ux*fW<#R');
define('NONCE_KEY', '({7ue,x]%0XZ7l5[I-W(Pe{1l4=,M5E8M=x{6OYwiG*hStx%j:KKE/o;E%x$&iJ!');
define('AUTH_SALT', '[xU+TpyR,o}up#F$0{}!?qq0&wKrXYlhU0qGx~]y(+~OnJ)]bwE7|Cac@0GK^1q+');
define('SECURE_AUTH_SALT', 'Vgh2X|/`_TdIqX=m6|1.q-jz`]e&^|YSP=S4OiZ=VIsbi+YESrs6,Vj^aZp32<}N');
define('LOGGED_IN_SALT', '+h*v6@Ec@b{UyI#$Xy.5T8a48a%wRR0pIPtH|?gY0LT=35Y*T--1M|^>N:PlS+ @');
define('NONCE_SALT', '=XFky[*a#>s$5-|-knh%i=f/G|TEE-zT8v:J#Fu?IB1gQG.;_G[zK4STvQ-N:h}W');

$table_prefix = $env->db_prefix;

define('WP_SITEURL', "{$env->uri_site}/{$env->dir_wp_core}");
define('WP_HOME', $env->uri_site);

define('WP_CONTENT_DIR', "{$dir_root}/{$env->dir_wp_content}");
define('WP_CONTENT_URL', "{$env->uri_site}/{$env->dir_wp_content}");

define( 'WP_DEBUG', true);
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );

if (!defined('ABSPATH')) {
    define('ABSPATH', "$dir_root/");
}

require_once ABSPATH . 'wp-settings.php';