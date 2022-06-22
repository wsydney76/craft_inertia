# Changelog

## 2.3.0 2021-08-14

* Migrations will now add some Pixabay images to the `images` volume and randomly set 
featured images to all singles entries.
  
* User photos and an icon are also set.

* You can seed some post entries by running `php craft main/seed/create-posts`

## 2.2.0 2021-08-13

* Added Matrixmate plugin for better editor experience
* Added some validations (experimental. If you run into problems, you can just comment them out in MainModule.php)
* Warning/Information text styles
* Fancier blue primary color...

## 2.1.4 2021-08-08

* Update to Craft 3.7.8
* Dropped craft.bat, use php craft ... instead
* Install work plugin via packagist

## 2.1.0 2021-07-31

* Update to Craft 3.7.7
* Install 'work' functionality as plugin rather than as custom module. 

## 2.0.0 2021-07-19
* Update to Craft 3.7
* Replaced module 'drafts' with 'work', that reflects workflow changes in 3.7

## 1.9.0
* Updates to Craft 3.6.17 / Embedded Assets 2.7.0
* Updates Alpine JS to 3.0
* Updates Tailwind CSS to 2.2

## 1.8.0
* Updates to Craft 3.6.14 / Embedded Assets 2.6.1
* Added alt text field for images
* Show copyright for featured images

## 1.7.0
* Update to Craft 3.6.13
* Drop some global variables for clarity

## 1.6

* Update to Craft 3.6.12
* Update to Tailwind 2.1 (jit)

## 1.5.3 2021-02-21

* Tweaks

## 1.5.2 2021-02-16

* Update to Craft 3.6.6
* Updated drafts module, reflects drafts improvements in 3.6
* Added migration, that creates a new non-admin user.

## 1.4.3 2020-09-18

* Update to Craft 3.5.11.1
* Use @baseurl alias instead of @web, in order to avoid warnings in Campagne plugin.
* Update to Tailwind CSS 1.8.10

## 1.4.2 2020-09-11

* Update to Craft 3.5.9
* Update to Tailwind CSS 1.8.7
* Update to Alpine JS 2.7.0

### Changed

* Use module aliases correctly

## 1.4.1 2020-09-02

* Update to Craft 3.5.8
* Update to Tailwind CSS 1.7.6

## 1.4.0 2020-08-14

* Update to Craft 3.5.4

## 1.3.0 2020-08-05

* Update to Craft 3.5.0
* Added contact section with contact form

## 1.2.1 2020-07-22

* Fixpoint before changing to new project config

## 1.2 2020-06-24

* Cleanup

## 1.1 2020-06-17

* Use srcset image methods

## 1.0 2020-06-15

* Initial commit
