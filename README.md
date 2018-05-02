# april
Wordpress theme based on Bootstrap 4

## Features
* Responsive design
* Sticky posts in categories
    * if there are posts marked as sticky, they are displayed as first posts on all pages of a **category** listing (e.g. if you have 5 posts per page and 2 sticky posts the page will show 7 posts)
    * the default post listing (main query/landing page) is not altered (sticky posts will be displayed only on the **first** page)
    * if a post has the tag **sticky** it will have an alternative color and no date displayed
* Custom NextGEN gallery template

## Used libraries
* [Bootstrap 4](https://getbootstrap.com/ "Bootstrap 4")

## Development
You need to have Ruby installed. Install [RVM](https://rvm.io/) and enable it: `source ~/.rvm/scripts/rvm`.
If not yet available, you need to install Sass into it: `gem install sass`.

To auto compile the SCSS to CSS, run the following in a terminal from the theme root:
```
sass -t compact --scss --watch sass/style.scss:style.css
```

## Distribution
* for distribution, Grunt is used (required npm and Grunt globally)
    * it will copy the theme into a dist folder with all sass and js compiled and minimized (see ``Gruntfile.js`` for more info)
```
npm install -g grunt-cli
npm install
grunt
```
* the version number is the version in ``package.json``
    * as the ``style.css`` is created by sass and then minified, Grunt inserts the required Wordpress header into the minified ``style.css``
* *the theme does not meet the Wordpress requirements for a theme yet* (haven't checked them)
* distribution is automatically done by TravisCI if a tag is created

## Continuous Integration
* each commit will be dealt at TravisCI, the release script is executed (this is not really CI!)
* [![Build Status](https://travis-ci.org/dArignac/april.svg?branch=master)](https://travis-ci.org/dArignac/april)

## NextGEN gallery template
* To use the template provided with this theme, choose ``Parent Theme: gallery-april.php`` in the theme selection for ``NextGEN Basic Thumbnails`` within the gallery options.

## Changelog
* TBA
    * Enhancements
        * [#40]((https://github.com/dArignac/april/pull/40) adjusted tag styling on article page
* 1.5.0
    * Enhancements
        * [#38](https://github.com/dArignac/april/pull/38) adjusted to Bootstrap 4.1 release version
    * Bugfixes
        * [#39](https://github.com/dArignac/april/issues/39) fixed Sass deprecation warnings
* 1.4.0
    * Enhancements
        * [#36](https://github.com/dArignac/april/issues/36) show sticky posts on category listings on all pages
* 1.3.1
    * Enhancements
        * [#35](https://github.com/dArignac/april/issues/35) show only sticky posts of configured categories on landing page
        * [#16](https://github.com/dArignac/april/issues/16) better way to filter front page categories
* 1.3.0
    * Enhancements
        * [#15](https://github.com/dArignac/april/issues/15) header is now fixed
    * Bugfixes
        * [#32](https://github.com/dArignac/april/issues/32) styled search page
* 1.2.0
    * Update-Info
        * several changes in settings come with this version - unfortunately **you have to configure them all again**
    * Enhancements
        * [#30](https://github.com/dArignac/april/issues/30) added additional first level navigation on desktop browsers
        * [#13](https://github.com/dArignac/april/issues/13) hamburger image and widgets open/close image is now customizable
* 1.1.1
    * Enhancements
        * [#27](https://github.com/dArignac/april/issues/27) added border between post content and comment form
        * [#26](https://github.com/dArignac/april/issues/26) removed outline on widget opening button
        * [#25](https://github.com/dArignac/april/issues/25) styled post navigation
        * [#24](https://github.com/dArignac/april/issues/24) links are no longer bold
    * Bugfixes
        * [#27](https://github.com/dArignac/april/issues/27) added margin between post preview and read more row
        * [#22](https://github.com/dArignac/april/issues/22) several gallery fixes
            * navigation with more than one gallery on a page now works
            * galleries to not autoplay any more
            * caption background is less opaque now
    * Integration
        * [#23](https://github.com/dArignac/april/issues/23) releases are now built on travis
* 1.1.0
    * Enhancements
        * [#19](https://github.com/dArignac/april/issues/19) basic template for NextGEN gallery
        * [#16](https://github.com/dArignac/april/issues/16) be able to filter categories on front page
    * Bugfixes
        * [#21](https://github.com/dArignac/april/issues/21) fixed wrong link color
        * [#20](https://github.com/dArignac/april/issues/20) added missing page title
        * [#17](https://github.com/dArignac/april/issues/17) fixed styles for tag cloud
* 1.0.1
    * Enhancements
        * [#12](https://github.com/dArignac/april/issues/12) header image now links to home page 
    * Bugfixes
        * [#14](https://github.com/dArignac/april/issues/14) post images overflow column layout
* 1.0.0
    * initial release