# Contributing

We love pull requests from everyone! Here are some basic tips and tricks for constructive contribution.

## Prerequisites

* npm (https://www.npmjs.org) (e.g. `brew install node`)
* Composer (https://getcomposer.org) (e.g. `brew install composer`)
* Ability to switch versions of PHP CLI for unit testing purposes (e.g. `brew uninstall php70 & brew install php55`)

## Fork, Clone and Install

Fork, then clone the repo and cd into the project root:

    git clone git@github.com:your-username/jira-issue-collector.git
    cd jira-issue-collector

We suggest you always use [Composer](https://getcomposer.org/) `update` in the project (as opposed to `install`):

    composer update
    
Note: Since this is a library, we `.gitignore` the `composer.lock`, as the lock file is the domain of the consuming
application, not the library.

## Unit Tests and Coding Style Tests

The project is setup to run all the tests via [grunt](http://gruntjs.com/getting-started). (See
`package.json` and `Gruntfile.js` in the project root.)

Before you start, make sure that you have Node installed on your system, and install the required packages:

    npm install

Make sure the tests run using grunt:

    grunt

The default grunt task is aliased to test, so it is the same as running test explicitly:

    grunt test

The Gruntfile is setup to generate clover XML coverage reports for use in the CI environment like this:

    grunt test:ci

Alternatively, you can run the tests directly like this:

    php ./vendor/bin/phpunit -c phpunit.xml.dist
    php ./vendor/bin/phpcs -p --standard=PSR2 src/ tests/ config/

## Branch, Change and Test

Before you make your changes, please create a new branch. Example:

    git checkout -b feature/my-thing

Make your change. Add tests for your change. Make sure the tests pass (or run manually as above):

    grunt

## Create Pull Request

Push your new branch to your fork and [submit a pull request][pr].

[pr]: https://github.com/soliantconsulting/jira-issue-collector/compare/

At this point you're waiting on us. We try to at least comment on pull requests within three business days (and,
typically, one business day). If you don't get any response within three days, feel free to bump it with a comment. We
may suggest some changes or improvements or alternatives.

## Tips

Some things that will increase the chance that your pull request is accepted:

* Don't break existing tests.
* Write test coverage for your change(s).
* Follow the PSR-2 [coding standards][style].
* Write [good commit messages][commit].
* Explain and/or justify the reason for the change in your PR description.

[style]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[commit]: https://git-scm.com/book/ch5-2.html#Commit-Guidelines
