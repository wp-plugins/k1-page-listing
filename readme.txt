=== Klan1 WP List Subpages ===
Contributors: k1-j0hnd03
Donate link: http://klan1.com/
Tags: sub,pages, page listing, list pages, klan1
Requires at least: 2.7
Tested up to: 3.7.1
Stable tag: init
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This one will help you to list all the subpages in a list with links, this one is intented to help WP to be used as CMS.

== Description ==
**IMPORTANT**: This plugin requires **Klan1 Common WP Functions** plugin - http://wordpress.org/plugins/klan1-functions/.

USAGE: 

[k1-list-pages mode=table]
 or
[k1-list-pages mode=list]

OTHER PARAMETERS:

This are written as 'parameter' => default value

[General]

* 'exclude' => null - Coma separated list with ID numbers
* 'class' => null -CSS class to assign to the table or list
* 'mode' => "table" - html tables or ul-li link listing without thumb
* 'orderby' => "title" - order field
* 'order' => "ASC" - DESC or ASC 
        
Please read: http://codex.wordpress.org/Template_Tags/get_posts

[Thumb]

* 'thumbw' => 80 - width
* 'thumbh' => 50 - height
* 'thumbzc' => 1 - Zoom crop or not
* 'thumba' => "c" - align image on zoom or crop

        See TIMTHUMB documentation: http://www.binarymoon.co.uk/2010/08/timthumb-part-4-moving-crop-location/

[mode TABLE]

* 'thumbs' => 1 - show or not thumbs

[mode LIST]

*'depth' => 1,
* 'title' => null,
        
See http://codex.wordpress.org/Function_Reference/wp_list_pages for better explanation about this.


Example:

´[k1-list-pages mode=table orderby=date order=desc exclude=3,45]´

== Installation ==

1. Install the "Klan1 Common WP Functions" plugin. Search for it on `Plugins -> Ad new` WP control panel section or from http://wordpress.org/plugins/klan1-functions/.
2. Upload `k1-page-listing` directory to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. All ready

== Frequently Asked Questions ==

= Have some configuration file? =

No.

= I want to use better CSS =

Put on your THEME folder this file `/css/k1-list-pages.css`and it will be loaded and the default plugin css won't.

Use the `style.css` provided on the plugin folder as example. 

The FOLDER "cache" must have write access any way.

== Screenshots ==
1. easy to use
2. pretty output

== Changelog ==
= 0.3 =
* Better coding and comments.
* Using the lastest functions names on "Klan1 Common WP Functions" plugin ver 0.3.

= 0.2 =
Fixes.

= 0.1 =
First relase "as is".