# Sample Login Application

This app demonstrates how to use the PHP Facebook API to authenticate users.

## Installing

You will need your own `config.php`. This can be derived from the `config.sample.php` file. All dependencies are checked into this repo.

There is a working instance running on OpenShift. You can access here: https://facebook-davserve.rhcloud.com/ (but may not be able to login, because the fb-app is not published)

## Files

* `index.php` is the main application which does most of the action
* `logout.php` does the logout process
* `deauth.php` is called by facebook to tell the application about deauthentification
* `functions.php` is a collection of used functions
* `fb-callback.php` will be called in the authentification flow
* `schema.sql` contains the MySQL Schema

# LICENSE

This software is licensed under the Apache License, Version 2.0