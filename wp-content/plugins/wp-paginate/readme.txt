=== WP-Paginate ===
Contributors: maxfoundry, emartin24, AlanP57
Tags: paginate, pagination, navigation, page, wp-paginate, comments, rtl, seo, usability
Requires at least: 2.6.0 (2.7.0 for comments pagination)
Tested up to: 6.7.2
Stable tag: 2.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP-Paginate is a simple and flexible pagination plugin which provides users with better navigation on your WordPress site.

== Description ==

= Latest News =
WP-Paginate is a simple and flexible pagination plugin which provides users with better navigation on your WordPress site.

In addition to increasing the user experience for your visitors, it has also been widely reported that pagination increases the SEO of your site by providing more links to your content.

You can add custom CSS for your pagination links with the Custom CSS tab in WP-Paginate Settings.

Starting in version 1.1, WP-Paginate can also be used to paginate post comments!

Translations: http://plugins.svn.wordpress.org/wp-paginate/I18n (check the version number for the correct file)

== Installation ==

*Install and Activate*

1. Unzip the downloaded WP-Paginate zip file
2. Upload the `wp-paginate` folder and its contents into the `wp-content/plugins/` directory of your WordPress installation
3. Activate WP-Paginate from Plugins page

*Implement*

You can now configure the location and appearance of pagination links through WP-Paginate Settings rather than edit your theme files. See the Configure section.

For posts pagination:
* Open the theme files where you'd like pagination to be used. Depending on your theme, this could be in a number of files, such as `index.php`, `archive.php`, `categories.php`, `search.php`, `tag.php`, or the `functions.php` file(s).The `twentyeleven` theme places the pagination code in `functions.php` in the `twentyeleven_content_nav()` function.

Examples:

For the `Twenty Seventeen` theme, in `index.php`, replace:

	the_posts_pagination( array(
		'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
		'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
	) );

With:

	if(function_exists('wp_paginate')):
		wp_paginate();	
	else :
		the_posts_pagination( array(
			'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
		) );
	endif;

For the `Twenty Sixteen` theme, in `index.php`, replace:

		the_posts_pagination( array(
			'prev_text'          => __( 'Previous page', 'twentysixteen' ),
			'next_text'          => __( 'Next page', 'twentysixteen' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
		) );

With:

		if(function_exists('wp_paginate')):
			wp_paginate();	
		else :
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
			) );
		endif;

For the `Twenty Fifteen` theme, in `index.php`, replace:

			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			) );

With:

			if(function_exists('wp_paginate')):
				wp_paginate();	
			else :
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			) );
		  endif;

For comments pagination:
1) Open the theme file(s) where you'd like comments pagination to be used. Usually this is the `comments.php` file.

2) Replace your existing `previous_comments_link()` and `next_comments_link()` code block with the following:

    <?php if(function_exists('wp_paginate_comments')) {
        wp_paginate_comments();
    } ?>


*Configure*

1) Configure the WP-Paginate settings, if necessary, from the WP-Paginate option in the Settings menu

2) The styles can be changed with the following methods:

* Add a `wp-paginate.css` file in your theme's directory and place your custom CSS there
* Add your custom CSS to your theme's `styles.css`
* Modify the `wp-paginate.css` file in the wp-paginate plugin directory

*Note:* The first two options will ensure that WP-Paginate updates will not overwrite your custom styles.

*Upgrading*

To 1.1.1+:

* Update WP-Paginate settings, change `Before Markup` to `<div class="navigation">`
* Update `wp-paginate.css`, change `.wp-paginate ol` to `.wp-paginate`

== Frequently Asked Questions ==

= How can I override the default pagination settings? =

The `wp_paginate()` and `wp_paginate_comments()` functions each takes one optional argument, in query string format, which allows you to override the global settings. The available options are:

* title - The text/HTML to display before the pagination links
* nextpage - The text/HTML to use for the next page link
* previouspage - The text/HTML to use for the previous page link
* before - The text/HTML to add before the pagination links and title
* after - The text/HTML to add after the pagination links
* empty - Display before markup and after markup code even when the page list is empty
* range - The number of page links to show before and after the current page
* anchor - The number of links to always show at beginning and end of pagination
* gap - The minimum number of pages before a gap is replaced with an ellipsis (...)

You can even control the current page and number of pages with:

* page - The current page. This function will automatically determine the value
* pages - The total number of pages. This function will automatically determine the value

Example (also applies to `wp_paginate_comments()`):

    <?php if(function_exists('wp_paginate')) {
        wp_paginate('range=4&anchor=2&nextpage=Next&previouspage=Previous');
    } ?>


= How can I style the comments pagination differently than the posts pagination? =

When calling `wp_paginate_comments()`, WP-Paginate adds an extra class to the `ol` element, `wp-paginate-comments`.

== Changelog ==
= 2.2.4 =
* Added class 'ellipse-gap' to the pagination HTML

= 2.2.3 =
* Tested with Wordpress 6.7
* Fixed issue with calling _load_textdomain_just_in_time function

= 2.2.2 =
* Tested with Wordpress 6.5

= 2.2.1 =
* Tested with Wordpress 6.4

= 2.2.0 =
* Tested with Wordpress 6.1

= 2.1.9 =
* Added code to prevent script injection into a hidden field on the settings page 

= 2.1.8 =
* Add the <nav> tag to the list of allowed tags for pagination markup

= 2.1.7 =
* Tested with Wordpress 5.8

= 2.1.6 =
* Improved accessibility by adding aria-label attributes

= 2.1.5 =
* Updated jQuery function calls
* Replaced old color picker with newer version

= 2.1.4 =
* Fixed potential XSS Vulnerabilities

= 2.1.3 =
* Tested with Wordpress 5.6
* Updated readme.txt with note to use WP-Paginate Settings rather than editing theme files
* Added Portuguese translation

= 2.1.2 =
* Added code to fix PHP warning message

= 2.1.1 =
* Added setting to remove ellipses from pagination links
* Added code to load jquery-migrate

= 2.1.0 =
* Tested with WordPress 5.5

= 2.0.9 =
* Fix inserting of empty style tag

= 2.0.8 =
* Tested with Wordpress 5.4.1

= 2.0.7 =
* Fixed issue with not applying before and after function arguments

= 2.0.6 =
* Fixed issue with slashes added to URLs containing query strings

= 2.0.5 =
* Added option to add trailing slash to pagination links when needed

= 2.0.4 =
* Removed trailing slash from pagination links

= 2.0.3 =
* Added neon pink button style

= 2.0.2 =
* Added new preset
* Updated setting page screen shots

= 2.0.1 =
* fixed undefined index notices 

= 2.0.0 =
* Added new button styles
* Added the ability to select the font
* Updated the translation file
* Added the ability to add pagination without editing theme files. This applies to posts but not to comments.
* Added the ability to hide the standard theme pagination. This applies to posts but not to comments.
* Added a review notice

= 1.3.4=
* Tested with WordPress 4.7.1

= 1.3.3 =
* Added settings tab for entering custom CSS code

= 1.3.2 =
* Tested with WordPress 4.7

= 1.3.1 =
* Fixed bug that prevented a wp-paginate.css stylesheet from loading from a child theme (reported by sunamumaya)
* Tested plugin against WordPress 4.1

= 1.3 =
* Plugin ownership transfered to Studio Fuel (http://studiofuel.com) - no functional changes were made
* Tested plugin against WordPress 4.0.1

= 1.2.6 =
* Removed final closing PHP tag
  Github pull request via DeanMarkTaylor
* Do not add the title element if the title is empty
  Github pull request via Claymm / chaika-design

= 1.2.5 =
* Remove PHP4 support to resolve PHP Strict warning
  Github pull request via DeanMarkTaylor
* Test with latest version of WordPress

= 1.2.4 =
* Ensure pagination of posts when wp_paginate() is called
  Github pull request via whacao
* Support loading on https pages (plugin now requires WordPress 2.6+)
  Github pull request via hadvig 

= 1.2.3 =
* Fixed deprecated parameter to the WordPress add_options_page() function
  Github pull request via alexwybraniec

= 1.2.2 =
* Fixed a XSS vulnerability reported by Andreas Schobel (@aschobel)

= 1.2.1 =
* Added is_rtl function check to prevent errors with older version of WordPress

= 1.2 =
* Added RTL language support
* Fixed comments pagination bug
* Changed language domain name from wp_paginate to wp-paginate (this will affect translation file names)

= 1.1.2 =
* Fixed comment pagination bug (nested comments caused blank page)
* Enabled HTML for Pagination Label, Previous Page, and Next Page
* Localization changes were made, Translations need to be updated

= 1.1.1 =
* Changed output to include `wp-paginate` and `wp-paginate-comments` class names on the `ol` element
* Changed the `before` option from `<div class="wp-paginate">` to `<div class="navigation">`
* Added `.wp-paginate-comments` styles to `wp-paginate.css`
* Changed styles in `wp-paginate.css`

= 1.1 =
* Added `wp_paginate_comments()` function for pagination of post comments

= 1.0.1 =
* Added I18n folder and wp-paginate.pot file
* Fixed some internationalization and spelling errors
* Updated readme.txt and added more details

= 1.0 =
* Initial release