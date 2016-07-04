# april
Wordpress theme based on Bootstrap 4

## Used libraries
* [Bootstrap 4 alpha 2](https://github.com/twbs/bootstrap "Bootstrap 4.0 alpha 2")

## Development
* setup required libs with bower for development
```
bower install
```

## Distribution
* for distribution, Grunt is used (required npm and Grunt globally)
    * it will copy the theme into a dist folder with all sass and js compiled and minimized (see ``Gruntfile.js`` for more info)
```
npm install
grunt
```
* the version number is the version in ``package.json``
    * as the ``style.css`` is created by sass and then minified, Grunt inserts the required Wordpress header into the minified ``style.css``
* *the theme does not meet the Wordpress requirements for a theme yet* (haven't checked them)
* distribution is automatically done by TravisCI if a tag is created

## Continouos Integration
* each commit will be dealt at TravisCI, the release script is executed (this is not really CI!)
* [![Build Status](https://travis-ci.org/dArignac/april.svg?branch=master)](https://travis-ci.org/dArignac/april)

## NextGEN gallery template
* To use the template provided with this theme, choose ``Parent Theme: gallery-april.php`` in the theme selection for ``NextGEN Basic Thumbnails`` within the gallery options.

## Changelog
* TBA
    * Update-Info
        * several changes in settings come with this version - unfortunately **you have to configure them all again**
    * Enhancements
        * [#30](https://github.com/dArignac/april/issues/30) added additional first level navigation on desktop browsers
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