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