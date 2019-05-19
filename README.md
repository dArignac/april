# april
Wordpress theme based on Bootstrap 4

## Features
* Responsive design
* Sticky posts in categories
    * if there are posts marked as sticky, they are displayed as first posts on all pages of a **category** listing (e.g. if you have 5 posts per page and 2 sticky posts the page will show 7 posts)
    * the default post listing (main query/landing page) is not altered (sticky posts will be displayed only on the **first** page)
    * if a post has the tag **sticky** it will have an alternative color and no date displayed

## Used libraries
* [Bootstrap 4](https://getbootstrap.com/ "Bootstrap 4")

## Development
You need to have Ruby installed. Install [RVM](https://rvm.io/) and enable it: `source ~/.rvm/scripts/rvm`.
If not yet available, you need to install Sass into it: `gem install sass`.

To auto compile the SCSS to CSS, run the following in a terminal from the theme root:
```
sass -t compact --scss --watch sass/april.scss:css/april.css
```

To create the languages, do the following (needs the `wordpress-core` checked out):
```
/home/alex/php /home/alex/projects/wordpress-core/tools/i18n/makepot.php wp-theme /home/alex/projects/github/april/
```
`/home/alex/php` in this case references to the Docker image [darignac/php:alpine](https://hub.docker.com/r/darignac/php/):
```
#!/bin/bash
docker run --rm -i -v /home/alex:/home/alex -v $PWD:/code -w /code darignac/php:alpine php "$@"
```

## Distribution
* for distribution, Grunt is used (required yarn and Grunt globally)
    * it will copy the theme into a dist folder with all sass and js compiled and minimized (see ``Gruntfile.js`` for more info)
```
yarn install
node_modules/.bin/grunt
```
* the version number is the version in ``package.json``
    * as the ``style.css`` is created by sass and then minified, Grunt inserts the required Wordpress header into the minified ``style.css``
* *the theme does not meet the Wordpress requirements for a theme yet* (haven't checked them)
* distribution is automatically done by TravisCI if a tag is created

### Create a release
* adjust the version in `package.json`
* ensure that all changes are added to the changelog in the `README.md` file with the correct version number
* check if to update translations, if so, update the `pot` file and the translations
* commit with a release message
* tag and push the tag and wait until TravisCI has released it

## Continuous Integration
* each commit will be dealt at TravisCI, the release script is executed
* [![Build Status](https://travis-ci.org/dArignac/april.svg?branch=master)](https://travis-ci.org/dArignac/april)

## Changelog
* 2.0.1
    * Bugfixes
        * [#51](https://github.com/dArignac/april/issues/51) Article date is always today
* 2.0.0
    * **Breaking**
        * [#49](https://github.com/dArignac/april/issues/49) removed nggallery support
    * Enhancements
      * changed from `npm` to `yarn` as package manager for local development
    * Bugfixes
      * [50](https://github.com/dArignac/april/issues/50) fixed menu display if there is no primary menu
      * [48](https://github.com/dArignac/april/issues/48) avoided caching of style upon new release
* 1.8.0
    * Enhancements
        * [#46](https://github.com/dArignac/april/issues/46) footer is now sticky
        * [#47](https://github.com/dArignac/april/issues/47) fixed some minor German translations
* 1.7.0
    * Enhancements
        * [#45](https://github.com/dArignac/april/pull/45) limit search results to posts only
    * Bugfixes
        * [#44](https://github.com/dArignac/april/pull/44) hide comment submit form if plugin _Google's No Captcha reCaptcha_ is installed to avoid two submit buttons
* 1.6.0
    * Enhancements
        * [#40](https://github.com/dArignac/april/pull/40) adjusted tag styling on article page
        * [#42](https://github.com/dArignac/april/pull/42) added previous and next post links to posts page
    * Bugfixes
        * [#34](https://github.com/dArignac/april/issues/34) fixed scrolling to anchors
        * [#43](https://github.com/dArignac/april/issues/43) fixed invalid bundled javascript file
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