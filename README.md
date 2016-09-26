# REST API Symfony application

FOSRESTBundle, Doctrine, Cors Security, Translation, Fixtures, NelmioApiDocBundle...

*API Documentation: [`http://.../api/doc`](http://.../api/doc)*

## Instructions

```
composer install
```

### Setting and managing the database

* If you have not created the database yet, run `php bin/console doctrine:database:create`
* Drop a previous version of the database `php bin/console doctrine:database:drop --force`
* Create the schema `php bin/console doctrine:schema:create`
* Generate entities (with getters and setters, repositoryClass and constructor) `php bin/console doctrine:generate:entities ApiBundle`
* Creating the database tables `php bin/console doctrine:schema:update --force`

### Fixtures

* Once your fixtures have been written, you can load them by using the following command `php bin/console doctrine:fixtures:load`

### OAuth configuration

This is the security layer to access the API. To set up for the first time the application, you need to create a client with the following command :
```
php bin/console oauth:client:create [--redirect-uri] [--grant-type]
```

With the required parameters : `php bin/console oauth:client:create --redirect-uri="http://localhost:8000/" --grant-type="authorization_code" --grant-type="password" --grant-type="refresh_token" --grant-type="token" --grant-type="client_credentials"`

Then check if it works by executing the following request in your browser (replace CLIENT_ID and CLIENT_SECRET by the output of the previous command)
```
http://.../app_dev.php/oauth/v2/token?client_id=CLIENT_ID&client_secret=CLIENT_SECRET&grant_type=client_credentials
```

If you see a response like this one, then everything works fine.
```
{"access_token":"NTRjNmMyMGFlMTBiYTViZGM5YWIyZTExNThmZTY0NTEyMDUzM2ZjYjE0NTc1YzVhMTRjYzA0YTQ5OTU4YjZkZg","expires_in":3600,"token_type":"bearer","scope":null}
```
