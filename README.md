## Advisory

Check your project dependencies against the [Security Advisories Checker](https://security.sensiolabs.org)

## Installation

Install this package via composer by executing the following via your terminal:

    composer require trq/advisory:1.0.*@dev

Once complete, the service provider needs to be registered. Do this by adding the following to the providers array within app/config/app.php

    'Trq\Advisory\AdvisoryServiceProvider'

Now, to check your current libraries against the advisory:

    php artisan advisory:check
