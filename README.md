# Craft Starter

Simple multilingual pre configured starter template. Useful for demos, learning, hobby projects.

(Only tested on Windows 10)

For a bit more complex stuff see wsydney76/workshop

## Installation

* Check the [Server Requirements](https://craftcms.com/docs/3.x/requirements.html#minimum-system-specs)

* Create a MySQL database. You can also reuse an existing database, just make sure 
you select a different db prefix.
  
* Clone this repository, e.g. `git clone https://github.com/wsydney76/craft-starter yourprojectdir` 

* Set up a virtual web server pointing to the `/web` directory. You can use 
the build in server, which can be started with `php craft serve` and will be 
  available at `http://localhost:8080`.
  
* Check composer.json for custom plugin repositories, in case you want to install
custom plugins from a different location.

* Cd into your project directory and run `composer install`

* Open `/config/Env.php` and edit the settings for your installation, especially the
database connection details and credentials, and your base url.
  
* Run `php craft install` Enter your admin user infos and confirm all other questions as is.

* Run `php craft migrate/all` and confirm all migrations. This will setup some basic translated content, some images, a non admin user and preferences.

* You may want to copy more images as a starting point to `/web/images` and run `php craft index-assets/all`
to make them available for Craft.
  
* If you want to create some fake posts, run `php craft main/seed/create-entries <number=5>`.
* Run `php craft main/seed/delete-faked-posts` to delete them.
  
## Run it

* If you haven't set up a dedicated virtual web server, run `php craft serve` to start the embedded server.
* Call `http(s):://yourdomain` and you should see, well, not much, but a basic home page.
* Call `http(s):://yourdomain/admin` to open Craft's control panel.

## Explore the Project

* Update your user name, upload a user photo (upper right corner...)
* Update your project infos in Globals > Site Info, add a featured image that will be used as a fallback.

A simple information model to play around with is pre configured, just click through the settings and add some content to explore it:

* The most always needed `Single` sections, like Home, Contact, Search, Post Index, Topics
* Some basic `channel/structure` sections, like Page, Post, (hello WordPress), Topics
* No categories. We like to see them as full featured entries.
* Asset volumes for images, documents, and embeds
* Basic fields, like featured image, a content matrix field with blocks like text, image, heading, embeds.
* Plugins: 
  * Asset Rev, allows to use the cache busting stuff of the frontent css/js build
  * Control Panel CSS, makes the control panel loop a bit friendlier.
  * Contact Form. The name says it all.
  * Embedded Assets. Embed videos, social media etc.
* A user group `editors` with limited permissions. Add a user to it and see how simple the cp looks
for non admins.
* A 'Work' custom module, that will show all active edits/draft for an entry, and lets you compare them with 
the current version. It also lets you transfer a provisional draft from another user to your account 
  (because people can get ill or go on vacation...) .

## Frontend

* Templates: Checkout a section's template in `templates/_sections` and follow the path...
* CSS/JS: a development build is included (Tailwind CSS, Alpine JS, Baguette lightbox). Run 
`npm install` to install all needed dependencies (wait, pray..). Then run `npm run dev` for a new development build, 
  `npm run build` for an optimized production build.
  or `npm run hot`..




