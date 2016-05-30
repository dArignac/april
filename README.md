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
    * it will copy the theme into a dist folder with all sass and js compiled and minified (see ``Gruntfile.js`` for more info)
```
npm install
grunt
```
* the version number is the version in ``package.json``
    * as the ``style.css`` is created by sass and then minified, Grunt inserts the required Wordpress header into the minified ``style.css``
* *the theme does not meet the Wordpress requirements for a theme yet* (haven't checked them)

## NextGEN gallery template
* To use the template provided with this theme, choose ``Parent Theme: gallery-april.php`` in the theme selection for ``NextGEN Basic Thumbnails`` within the gallery options.

## Changelog
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