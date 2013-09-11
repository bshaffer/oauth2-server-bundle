# OAuth2 Server Bundle

OAuth2 Server Bundle for Symfony 2.

## Overview

The following grant types are supported out the box:

- Client Credentials
- Authorization Code
- Refresh Token

You can make token requests to the `/token` path via POST.

You can restrict the grant types available per client, or in your own TokenController you could do something like:

``` php
public function tokenAction()
{
    $server = $this->get('oauth2.server');

    // Override default grant types to authorization code only
    $server->addGrantType($this->get('oauth2.grant_type.authorization_code'));

    return $server->handleTokenRequest($this->get('oauth2.request'), $this->get('oauth2.response'));
}
```

Some grant types allow for further configuration, like the refresh token. To take advantage of this you'll need you a CompilerPass to redefine the service definition.

## Installation

### Step 1: Add package to Composer

Add the bundle to your composer.json:

``` js
{
    "require": {
        "bshaffer/oauth2-server-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update bshaffer/oauth2-server-bundle
```

Composer will install the bundle to your project's `vendor/bshaffer` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new OAuth2\ServerBundle\OAuth2ServerBundle(),
    );
}
```

### Step 3: Install database

You'll need to update your schema to setup the Entities provided by this module.

``` bash
$ php app/console doctrine:schema:update --force
```

### Step 4: Add routes

You'll need to add the following to your routing.yml

``` yaml
# app/config/routing.yml

oauth2_server:
    resource: "@OAuth2ServerBundle/Controller/"
    type:     annotation
    prefix:   /
```

## Optional Configuration

You can override any of the built-in components in your own bundle by adding new parameters in your config.yml:

``` yaml
# app/config/config.yml

parameters:
    oauth2.storage.client_credentials.class: Amce\OAuth2ServerBundle\Storage\ClientCredentials
```

Where `Amce\OAuth2ServerBundle\Storage\ClientCredentials` is your own implementation of the ClientCredentials interface.

If you provide your own storage managers then you'll be able to hook everything up to your own custom Entities.
