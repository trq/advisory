## Advisory

Check your project dependencies against the [Security Advisories Checker](https://security.sensiolabs.org)

## Installation

Install this package via composer by adding the following to your composer.json file:

    "trq/advisory": "1.0.*@dev"

Currently, there is no stable version tagged.

Next, update Composer from the Terminal:

    composer update

Once complete, the service provider needs to be registered. Do this by adding the following to the providers array within app/config/app.php

    'Trq\Advisory\AdvisoryServiceProvider'

Now, to check your current libraries against the advisory:

    php artisan advisory:check
