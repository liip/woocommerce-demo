# WordPress 4.4 Example

This is a no-thrills example of a minimal repository to deploy a WordPress 4.4 instance on Platform.sh

This example is based on using Composer. You can see there is not much in terms of files comitted to this repository.

This is the whole layout of the repository (it will still make for a perfectly functional web site on https://platform.sh !)
```
.platform/
         /routes.yaml
         /services.yaml
plugins/
         /README.txt
themes/
         /README.txt
.platform.app.yaml
composer.json
composer.lock
wp-config.php
```

In `.platform.app.yaml` we have the basic configuration of our applicaiton (we call it php), saying this is a Composer 
application, that we depdend on a database called `database` and that we automatically move your custom themes and plugins at the end of each deployment.

In `.platform/routes.yaml` we just say that we will redirect www to the naked domain, and that the application that 
will be serving HTTP will be the one we called `php`.

In `.platform/services.yaml` we say we want a MySQL instance.

We also give you some nice empty (and totally not required) directories, so you would know where you are supposed to put 
your custom themes and plugins. "Normal", unforked contributed themes and plugins should be put in 
the `composer.json` file  (which contains our base WordPress version).
