# "Outset" - Pyxl's Starter WordPress Build

### Project Details
* __Local:__ `outset.test`
* __Development:__ `outset.example.com`
* __Staging:__ `outsetstag.example.com`
* __Production:__ `outsetprod.example.com`

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

## Actions
### Model Registrations
* `_core/post_types`
* `_core/taxonomies`
* `_core/blocks`
* `_core/field_groups`
* `_core/option_pages`
### Globals
* `_view/global/head`
* `_view/global/header`
* `_view/global/footer`
### Template Hierarchy
* `_view/index`
* `_view/archive/post-type/default`
* `_view/singular/default`
* `_view/single/post`
* `_view/four-oh-four`
### Blocks
* uses render callback directly

## Filters
### Globals
* `_view/global/head/data`
* `_view/global/header/data`
* `_view/global/footer/data`
### Template Hierarchy
* `_view/index/data`
* `_view/archive/post-type/default/data`
* `_view/singular/default/data`
* `_view/single/post/data`
* `_view/four-oh-four/data`
### Blocks
* `_view/block/$block-name/data`