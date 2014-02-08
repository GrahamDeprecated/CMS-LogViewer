CMS LogViewer
=============


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/GrahamCampbell/CMS-LogViewer/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
[![Build Status](https://travis-ci.org/GrahamCampbell/CMS-LogViewer.png)](https://travis-ci.org/GrahamCampbell/CMS-LogViewer)
[![Coverage Status](https://coveralls.io/repos/GrahamCampbell/CMS-LogViewer/badge.png)](https://coveralls.io/r/GrahamCampbell/CMS-LogViewer)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/CMS-LogViewer/badges/quality-score.png?s=30a629f55a95e3e0b0d146b242d0e80662abb298)](https://scrutinizer-ci.com/g/GrahamCampbell/CMS-LogViewer)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/7c3d818f-dbcf-4e27-9ff4-b0c2a1fe69bd/mini.png)](https://insight.sensiolabs.com/projects/7c3d818f-dbcf-4e27-9ff4-b0c2a1fe69bd)
[![Software License](https://poser.pugx.org/graham-campbell/cms-logviewer/license.png)](https://github.com/GrahamCampbell/CMS-LogViewer/blob/master/LICENSE.md)
[![Latest Version](https://poser.pugx.org/graham-campbell/cms-logviewer/v/stable.png)](https://packagist.org/packages/graham-campbell/cms-logviewer)


## WARNING

#### This package will depreciated soon. The final release will be V0.2 Alpha. It has been replaced by my [Laravel LogViewer](https://github.com/GrahamCampbell/Laravel-LogViewer) package. This package new package will be compatible with all Laravel applications and will include native support for [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS). Note that [CMS Core](https://github.com/GrahamCampbell/CMS-Core) will also be deprecated.


## What Is CMS LogViewer?

CMS LogViewer is a [CMS Core](https://github.com/GrahamCampbell/CMS-Core) plugin that adds a LogViewer admin module.

* CMS LogViewer was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).
* CMS LogViewer is heavily based on Mike Mand's [LogViewer](https://github.com/mikemand/logviewer).
* CMS LogViewer relies on my [CMS Core](https://github.com/GrahamCampbell/CMS-Core) package.
* CMS LogViewer uses [Travis CI](https://travis-ci.org/GrahamCampbell/CMS-LogViewer) with [Coveralls](https://coveralls.io/r/GrahamCampbell/CMS-LogViewer) to check everything is working.
* CMS LogViewer uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/CMS-LogViewer) and [SensioLabsInsight](https://insight.sensiolabs.com/projects/7c3d818f-dbcf-4e27-9ff4-b0c2a1fe69bd) to run additional checks.
* CMS LogViewer uses [Composer](https://getcomposer.org) to load and manage dependencies.
* CMS LogViewer provides a [change log](https://github.com/GrahamCampbell/CMS-LogViewer/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/CMS-LogViewer/releases), and [api docs](http://grahamcampbell.github.io/CMS-LogViewer).
* CMS LogViewer is licensed under the GNU AGPLv3, available [here](https://github.com/GrahamCampbell/CMS-LogViewer/blob/master/LICENSE.md).


## System Requirements

* PHP 5.4.7+ or PHP 5.5+ is required.
* You will need a [CMS Core](https://github.com/GrahamCampbell/CMS-Core) application like [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS) because this package is designed for it.
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of CMS-LogViewer.


## Installation

Please check the system requirements before installing CMS LogViewer.

To get the latest version of CMS LogViewer, simply require it in your `composer.json` file.

`"graham-campbell/cms-logviewer": "*"`

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

You will need to register many service providers before you attempt to load the CMS LogViewer service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'Lightgear\Asset\AssetServiceProvider'`
* `'Cartalyst\Sentry\SentryServiceProvider'`
* `'GrahamCampbell\Core\CoreServiceProvider'`
* `'GrahamCampbell\Viewer\ViewerServiceProvider'`
* `'GrahamCampbell\Queuing\QueuingServiceProvider'`
* `'GrahamCampbell\HTMLMin\HTMLMinServiceProvider'`
* `'GrahamCampbell\Markdown\MarkdownServiceProvider'`
* `'GrahamCampbell\Flysystem\FlysystemServiceProvider'`
* `'GrahamCampbell\Security\SecurityServiceProvider'`
* `'GrahamCampbell\Binput\BinputServiceProvider'`
* `'GrahamCampbell\Passwd\PasswdServiceProvider'`
* `'GrahamCampbell\Throttle\ThrottleServiceProvider'`
* `'GrahamCampbell\Credentials\CredentialsServiceProvider'`
* `'GrahamCampbell\Navigation\NavigationServiceProvider'`
* `'GrahamCampbell\CMSCore\CMSCoreServiceProvider'`

Once CMS LogViewer is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\CMSLogViewer\CMSLogViewerServiceProvider'`


## Configuration

CMS LogViewer supports optional configuration.

To get started, first publish the package config file:

    php artisan config:publish graham-campbell/cms-logviewer

There are two config options:

**Log Directories**

This option (`'log_dirs'`) defines the paths to the log directories. The default value for this setting is `array('app' => storage_path().'/logs')`.

**Logs Per Page**

This option (`'per_page'`) defines how many log entries are displayed per page. The default value for this setting is `20`.


## Usage

There is currently no usage documentation besides the [API Documentation](http://grahamcampbell.github.io/CMS-LogViewer) for CMS LogViewer.

Note that [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS) already ships with CMS LogViewer.


## Updating Your Fork

The latest and greatest source can be found on [GitHub](https://github.com/GrahamCampbell/CMS-LogViewer).

Before submitting a pull request, you should ensure that your fork is up to date.

You may fork CMS LogViewer:

    git remote add upstream git://github.com/GrahamCampbell/CMS-LogViewer.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).

You can then update the branch:

    git pull --rebase upstream master
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.


## Pull Requests

Please review these guidelines before submitting any pull requests.

* When submitting bug fixes, check if a maintenance branch exists for an older series, then pull against that older branch if the bug is present in it.
* Before sending a pull request for a new feature, you should first create an issue with [Proposal] in the title.
* Please follow the [PSR-2 Coding Style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) and [PHP-FIG Naming Conventions](https://github.com/php-fig/fig-standards/blob/master/bylaws/002-psr-naming-conventions.md).


## License

GNU AFFERO GENERAL PUBLIC LICENSE

CMS LogViewer Is A CMS Core Plugin That Adds A LogViewer Admin Module
Copyright (C) 2013-2014  Graham Campbell

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
