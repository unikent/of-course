# Of Course!

A [Flight](http://flightphp.com/) based front-end application for the data produced by the [Programmes Plant](http://github.com/unikent/).
The application communicates with the back end system via the [programmes-plant-api-php](https://github.com/unikent/programmes-plant-api-php) library (A thin wrapper around [guzzle}(https://github.com/guzzle/guzzle) ). After pulling the data, the application then renders the data in a variety of views, before passing it through the pantheon templating engine in order to produce finalized markup for the University of Kent course pages.

![of-course sample course page screenshot](https://raw.github.com/unikent/of-course/develop/screenshot.jpg "of-course sample course page screenshot")

Depends upon our [Programmes Plant API PHP library](https://github.com/unikent/programmes-plant-api-php) which is installed using [Composer](http://getcomposer.org/).

## Quick Deploy.

1. Checkout the [`master` of this app](http://github.com/unikent/of-course) from GitHub.

2. Run `composer.phar install` to grab [Flight](http://flightphp.com/) and the [Programmes Plant PHP API](https://github.com/unikent/programmes-plant-api-php) library.

3. Place where you would like it to live and rename `public/config/paths.sample.php` to `public/config/paths.php`. Set the URI of the Programmes Plant API, base path and templating engine paths inside.
 
4. We are using our home grown (closed source) Pantheon engine. If you are using Pantheon, copy `public/config/config.sample.php` to `public/config/config.php`. This is a file which is specific to Pantheon, and sets up some basic configuration options like the theme to use. Then add a Pantheon menu folder within the tree to allow for a left-hand navigation menu.

5. Browse to the website to see the system up and running.

## Creating A Build

In order to compress the assets (CSS and JS) for a distribution (images are already optimised).

1. Install Node.js - this includes npm by default.

2. Install Grunt globally - its quite useful! `npm install -g grunt` or `npm install -g grunt-cli` for the cli version. 

4. Install the dependencies of our Grunt task - `npm install` from directory.

3. Run Grunt - `grunt` from the root of this code.

## Notes.
- Flight has been extended with some useful helper functions. You can find these in main/methods.php

## Notes on filtering search results in the URL

the url structure is:

* campus/{campus name}
* study_mode/{mode name}
* subject_category/{category name}
* award/{award name}
* programme_type/{type}
* course_options/{option}

eg  http://www.kent.ac.uk/courses/postgraduate/search/subject_category/testtest/


## Licensing

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/licenses/.
