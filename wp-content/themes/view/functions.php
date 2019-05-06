<?php
namespace Pyxl\View;

define(__NAMESPACE__ . '\PATH', trailingslashit(dirname(__FILE__)));
define(__NAMESPACE__ . '\URI', trailingslashit(get_template_directory_uri()));
define(__NAMESPACE__ . '\VERSION', '1.0.0');
define(__NAMESPACE__ . '\DEBUG', false);

require_once 'lib/autoload.php';

add_action('after_setup_theme', function () {
    Setup\General::init();
    Setup\Enqueues::init();
    Setup\Menus::init();
    Setup\Images::init();
    Setup\Sidebars::init();
    Markup\Wrappers::init();
    Markup\SocialMenu::init();
    Markup\CriticalAssets::init();
    Compatibility\Timber\TemplateRouting::init();
    Compatibility\Timber\CustomFunctions::init();
    Compatibility\Timber\Notices::init();
    Compatibility\GravityForms\InlineScripts::init();
    Utils\Debug::init();
    StaticPages\StyleGuide::init();
    StaticPages\Tester::init();
});


