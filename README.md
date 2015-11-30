Jira Issue Collector
====================

[![Build Status](https://travis-ci.org/soliantconsulting/jira-issue-collector.svg?branch=master)](https://travis-ci.org/soliantconsulting/jira-issue-collector)
[![Code Climate](https://codeclimate.com/github/soliantconsulting/jira-issue-collector/badges/gpa.svg)](https://codeclimate.com/github/soliantconsulting/jira-issue-collector)
[![Test Coverage](https://codeclimate.com/github/soliantconsulting/jira-issue-collector/badges/coverage.svg)](https://codeclimate.com/github/soliantconsulting/jira-issue-collector/coverage)
[![Latest Stable Version](https://poser.pugx.org/soliantconsulting/jira-issue-collector/v/stable)](https://packagist.org/packages/soliantconsulting/jira-issue-collector)
[![Latest Unstable Version](https://poser.pugx.org/soliantconsulting/jira-issue-collector/v/unstable)](https://packagist.org/packages/soliantconsulting/jira-issue-collector)
[![Total Downloads](https://poser.pugx.org/soliantconsulting/jira-issue-collector/downloads)](https://packagist.org/packages/soliantconsulting/jira-issue-collector)
[![License](https://poser.pugx.org/soliantconsulting/jira-issue-collector/license)](https://packagist.org/packages/soliantconsulting/jira-issue-collector)


Jira Issue Collector Module is a fast, convenient and free Zend Framework Module designed by
[Soliant Consulting, Inc.][1] to dynamically add a Jira Issue Collector strictly through configuration.

Jira Issue Collector Module is a lightweight package that enables the [Jira Issue Collector][2] to be injected into the
`Zend\Mvc` response body when the standard `EVENT_FINISH` is triggered.

Jira Issue Collector Module is [Composer][3] friendly, making it a snap to add to any existing Zend Framework MVC
application.

## Easy to Integrate

* PSR-0 autoloading ([Composer][3] ready).
* Install on an environment-specific basis using strictly standard `config/autoload/` settings.

## System Requirements

* PHP 5.5+
* Zend Framework 2.5+

With minimum effort, it should theoretically work older versions of PHP and Zend Framework 2, however, backward
compatibility is not verified or maintained. If you needed to go back older than PHP 5.4, then use of short array syntax
will definitely block you unless you refactor that.

## License

Jira Issue Collector Module is free for commercial and non-commercial use, licensed under the business-friendly
standard MIT license.


# Jira Issue Collector Module Documentation

## Create Your Jira Issue Collector

See the [Jira Issue Collector][2] documentation for basic setup. Once you have it configured, you will need to copy the
url from the code snipped Jira creates for the Issue Collector. The wording in the Jira UI is subject to change, but you
will be given two options something like this:

* Embed in HTML
* Embed in JavaScript

In fact, they both use JavaScript, and it would be more explicit if they were labeled like this instead:

* Do not use Jquery
* Use Jquery

Don't worry about the details of the configs until we get to the next section, but here are the bare-bones details you
need to be aware of while setting up your Jira Issue Collector.

On the assumption that Jquery may not be part of your project, the default and most basic configuration looks like this:

    'soliant-jira-issue-collector' => [
        'enabled'       => true,
        'collector'     => [
            'url'       => "https://jira.myserver.com/really-long-url",
        ],
    ],

If you intend to use Jquery, and if you want to access the advanced options, you will need to enable Jquery support:

    'soliant-jira-issue-collector' => [
        'enabled'       => true,
        'collector'     => [
            'useJquery' => true,
            'url'       => "https://jira.myserver.com/really-long-url",
        ],
    ],

*NOTE: The url for every Issue Collector is unique and differs slightly between the two options, so be sure that if you
change the setting in the Issue Collector, you also update it in your module config. You will need to copy the url out
of the code snippet that Jira creates for you, as you won't need the rest of the code in your configuration.*

## Basic Install

The Jira Issue Collector Module installs like any standard Zend Framework module.

### Composer

Install the module via composer by adding it to your composer.json or by running

    composer require soliantconsulting/jira-issue-collector:~1.0

### Add Module Namespace

Add the `Soliant\JiraIssueCollector` module to the module section of your `config/application.config.php`

### Add Module Config

Copy `config/soliant-jira-issue-collector.local.php.dist` from this module into your project
   `config/autoload/soliant-jira-issue-collector.local.php`. Change any settings in it
   according to your needs.

## Advanced Options

The comments in `config/soliant-jira-issue-collector.local.php.dist` provide details about the advanced settings the
module provides. In short the module provides optional support for these features:

* Custom css selector for that option in the Jira Issue Selector
* Custom script template
* Injection of a custom div tag template
* Injection of a custom css style tag template

[1]: http://www.soliantconsulting.com
[2]: https://confluence.atlassian.com/adminjiracloud/using-the-issue-collector-776636529.html
[3]: https://getcomposer.org/doc/00-intro.md
[4]: http://www.php-fig.org/
[5]: http://framework.zend.com/
