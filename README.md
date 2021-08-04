# Must Use Local

An MU Plugin that makes a few adjustments to make local development friendlier (for me).

## Setup

* Clone this directory into `wp-content/mu-plugins/must-use-local/`
* Setup `mu-plugins/index.php` to load `wp-content/mu-plugins/must-use-local/must-use-local.php` somehow _or_ copy the `mu-autoloader.php` file in this plugin to your `mu-plugins/` directory.

## Adjustments

* Disable SSL verification locally to avoid any annoying issues with self-signed certs for `.test` domains.
* Treat requests to local domains as external so that things like cron actually work.

### Authentication

* Increase session time for authenticated users to 365 days.

### Mail

* Filter PHPMailer so that Mailhog is used to send (and capture) emails locally.

### Jetpack

#### Related Posts

I want to be able to export a production database, set it up locally, and then adjust the display of Jetpack related posts without much hassle.

* Related posts does not work in development mode, so set that to false.
* Nothing should think it's in production, so enable staging mode.
* Except! When retrieving image URLs, Jetpack should think it's in development mode so that it doesn't use Photon.

#### SSO

When I configure a production database locally, I want to be able to run `wp user update 123 --user_pass=password` and immediately login to the site.

* Unhook Jetpack SSO locally so that no attempt to use WordPress.com to sign-in is made.

## Other tools

### Proxy remote images

This [gist](https://gist.github.com/mishterk/a8f19eeb514cf77ad333fb67b3c7aeb9) and this article include a `LocalValetDriver.php` file that when placed in the project root and configured properly will proxy remote images from a domain when they are not available locally.

I would include this file in the repo, but I can't find an explicit license, so copy it from one of those sources. :)
