# Craft Inertia

Updated older Proof of Concept for a Vue/Inertia app powered by Craft CMS.

Adapter `modules\inertia` based on [Yii2 Adapter](https://www.yiiframework.com/extension/tebe/yii2-inertia).

App based on [Demo App](https://pingcrm-yii2.tebe.ch/) (simplified).

Hint: Not all configured sections/fields/block types are covered by the app.

DONE:

* Updated to Craft 4
* Updated to Tailwind 3.1
* Live Preview is now working
* Added some images/matrix blocks to entry view stub.

TODOS:

* Updating Vue / Inertia to current versions without changing code breaks the app. More Vue/Inertia knowledge is needed here.
* Add some user interaction via POST requests (see 'CSRF protection' in adapter description) and check for possible conflicts with Crafts Control Panel.
* Remove unused stuff.
* Clean up build process (currently there are two separate jobs for creating JS and CSS. Also check for unused components)
* Redesign layout, now it looks more than an application than a pretty web site.
