# Must Use Local

An MU Plugin that makes a few adjustments to make local development friendlier (for me).

## Setup

* Clone this directory into `wp-content/mu-plugins/must-use-local/`
* Setup `mu-plugins/index.php` to load `wp-content/mu-plugins/must-use-local/must-use-local.php` somehow.

## Adjustments

* Disable SSL verification locally to avoid any annoying issues with self-signed certs for `.test` domains.
* Treat requests to local domains as external so that things like cron actually work.

### Jetpack

#### Related Posts

I want to be able to export a production database, set it up locally, and then adjust the display of Jetpack related posts without much hassle.

* Related posts does not work in development mode, so set that to false.
* Nothing should think it's in production, so enable staging mode.
* Except! When retrieving image URLs, Jetpack should think it's in development mode so that it doesn't use Photon.

#### SSO

When I configure a production database locally, I want to be able to run `wp user update 123 --user_pass=password` and immediately login to the site.

* Unhook Jetpack SSO locally so that no attempt to use WordPress.com to sign-in is made.
