# Craft Inertia

Updated older Proof of Concept for a Vue 2/Inertia app powered by Craft CMS.

Intertia Adapter based on [Yii2 Adapter](https://www.yiiframework.com/extension/tebe/yii2-inertia).

App based on [Demo App](https://pingcrm-yii2.tebe.ch/) (simplified).

Hint: Not all configured sections/fields/block types are covered by the app.

## Done:

* Updated to Craft 4
* Updated to Tailwind 3.1
* Updated to Vue3
* Changed build process to Laravel Mix
* Live Preview is now working
* Added blocks to entry view.
* Added a simple (fake) contact form

## Todos:

* Security: Check/fix CSRF protection (see in adapter description) and check for possible conflicts with Crafts Control Panel.
* Remove unused stuff.
* Redesign layout, now it looks more than an application than a pretty website.


## Out of scope

* It is not a goal of this PoC to demonstrate how to build well-designed, well-structured Vue components. It is just to show how routing works and how data is sent back and forth between client and server.
* Best CSS practices
* Also, the app does not support multiple sites.

## Getting started (Short version)

* Prepare database / web server
* Clone this repository
* Run `composer install`
* Update `config/Env.php` with your settings.
* Run `php craft install`
* Update Globals Site Info (Use `/posts` and `/contact`) as urls for Site Intro Buttons
* Upload some images
* Run `php craft main/seed/create-entries 30` in order to create some fake posts.
