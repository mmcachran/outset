# "Outset" - Pyxl's Starter WordPress Build

### Project Details
* __Local:__ `pyxl.test`
* __Development:__ `pyxldev.wpengine.com`
* __Staging:__ `pyxlstag.wpengine.com`
* __Production:__ `pyxlprod.wpengine.com`

### Intro
Welcome to a heavily opinionated MVC-ish Twig based WordPress build that balances ACF flexible content layouts while balancing the new WordPress block based editor ("Gutenberg").

### Requirements
* PHP 7.2+
* Composer
* WP CLI

#### Body Attributes
* `data-scroll-enabled`
    * Used for disabling scolling

### Timber
Please note the custom Twig/Timber functions available in `wp-content/themes/view/classes/Timber/CustomFunctions.php`

#### Notable Functions:
* `svg_inline`
    * Usage `svg_inline('logo')`
    * Will look for SVG files in `dist/svgs`
* `menu`
    * Just a wrapper for `wp_nav_menu`
* `site`
    * Usage `site('url')`
    * Wrapper for `get_bloginfo`

### Getting started
Helpful info on getting a local development set up.
* Rename `.env.example` to `.env`
* Rename `index.php.example` to `index.php`
* Rename `wp-config.php.example` to `wp-config.php`
* __IMPORTANT:__ 
    * update variables in `.env`
    * Make sure the email you use for the admin account is an `@pyxl.com` address. The core plugin hides many WordPress menus and regions from any user without a `@pyxl.com` address.
* Run `composer run-script setup`
    * Will install plugins

## Post Types
* Posts
* Pages
* Testimonials

## ACF Layouts
Blurbs
CallToAction
Carousel
ComparisonTable
Featurette
FeaturetteSlider
Form
General
Hero
Posts
RegisterLayout
Slider
Testimonial
Video



