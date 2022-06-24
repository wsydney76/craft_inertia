# Craft Inertia

Updated older Proof of Concept for a Vue/Inertia app powered by Craft CMS.

Adapter `modules\inertia` based on [Yii2 Adapter](https://www.yiiframework.com/extension/tebe/yii2-inertia).

App based on [Demo App](https://pingcrm-yii2.tebe.ch/) (simplified).

Hint: Not all configured sections/fields/block types are covered by the app.

## Done:

* Updated to Craft 4
* Updated to Tailwind 3.1
* Live Preview is now working
* Added some images/matrix blocks to entry view stub.
* Added a simple contact form

## Todos:

* Security: Check/fix CSRF protection (see in adapter description) and check for possible conflicts with Crafts Control Panel.
* Remove unused stuff.
* Clean up build process (Also check for unused components)
* Redesign layout, now it looks more than an application than a pretty web site.

## Out of scope

It is not a goal of this PoC to demonstrate how to build well designed, well structured Vue components.

It is just to show how routing works and how data is sent back and forth between client and server.

Also not supporting multiple sites.
