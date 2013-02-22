# Of Course!

A [Flight](http://flightphp.com/) based front-end application for the data produced by the [Programmes Plant](http://github.com/unikent/).

Depends upon our [Programmes Plant API PHP library](https://github.com/unikent/programmes-plant-api-php) which is installed using [Composer](http://getcomposer.org/).

## Quick Deploy.

1. Checkout the [`master` of this app](http://github.com/unikent/of-course) from GitHub.
2. Run `composer.phar install` to grab [Flight](http://flightphp.com/) and the [Programmes Plant PHP API](https://github.com/unikent/programmes-plant-api-php) library.
3. Place where you would like it to live and rename `paths.sample.php` to `paths.php`. Set the XCRI WS path, base path and templating engine paths inside. We are using our home grown (closed source) Pantheon engine. If you are using Pantheon, add a Pantheon config.php to the config folder & a Pantheon menu folder within the tree.
4. Browse to the website to see the system up and running.

## Creating A Build

In order to compress the assets (CSS and JS) for a distribution (images are already optimised).

1. Install Node.js - this now includes npm by default.
2. Install Grunt. `npm install -g grunt`.
3. Run Grunt - `grunt` from the root of this code.

## Licensing

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/licenses/.
