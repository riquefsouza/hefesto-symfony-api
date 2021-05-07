# Commands

```
composer create-project symfony/skeleton hefesto-symfony-api "^4.2"

php -S localhost:8080 -t public

composer require annotation
composer require symfony/orm-pack
composer require maker

php bin/console doctrine:mapping:import "App\Entity" annotation --path=src/Entity

// generates getter/setter methods for all Entities
php bin/console make:entity --regenerate App

composer require zircote/swagger-php
composer require nelmio/api-doc-bundle
composer require symfony/twig-bundle
composer require symfony/asset

http://localhost:8080/swagger

composer require security
composer require firebase/php-jwt

cd bin
php console make:controller
name -> LoginController
```