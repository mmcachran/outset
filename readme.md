# "Outset" - Pyxl's Starter WordPress Build

### Project Details
* __Local:__ `outset.test`
* __Development:__ `outset.wpengine.com`
* __Staging:__ `outsetstag.wpengine.com`
* __Production:__ `outsetprod.wpengine.com`

### Intro
Welcome to a heavily opinionated MVC-ish Twig based WordPress build that balances ACF flexible content layouts while balancing the new WordPress block based editor ("Gutenberg").

### Requirements
* PHP 7.3+
* Composer
* WP CLI

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

#### Body Attributes
* `data-scroll-enabled`
* Used for disabling scollingQ

## Post Types
* Posts
* Pages
* Testimonials
* Careers

## Blocks
* Accordion
* Basic
* Blurbs
* Call To Action
* Comparison Cards
* Featurette
* Hero Basic
* Hero Form
* Image Grid
* Posts
* Tabs
* Testimonials
