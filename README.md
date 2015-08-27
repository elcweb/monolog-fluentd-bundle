FluentdBundle
===================

[![Latest Stable Version](https://poser.pugx.org/elcweb/monolog-fluentd-bundle/v/stable.png)](https://packagist.org/packages/elcweb/monolog-fluentd-bundle)
[![Total Downloads](https://poser.pugx.org/elcweb/monolog-fluentd-bundle/downloads.png)](https://packagist.org/packages/elcweb/monolog-fluentd-bundle)

Installation
------------

### Step 1: Download using composer

```js
{
    "require": {
        "elcweb/monolog-fluentd-bundle": "0.0.*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update elcweb/monolog-fluentd-bundle
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Elcweb\Monolog\ElcwebMonologFluentdBundle(),
    );
}
```

### Step 3: configuration

config.yml

    elcweb_monolog_fluentd:
        host: %monolog_fluentd_host%
        port: %monolog_fluentd_port%
        env: %kernel.environment%
        tag: %app_name%

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE

Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/elcweb/monolog-fluentd-bundle/issues).

When reporting a bug, it may be a good idea to reproduce it in a basic project
built using the [Symfony Standard Edition](https://github.com/symfony/symfony-standard)
to allow developers of the bundle to reproduce the issue by simply cloning it
and following some steps.
