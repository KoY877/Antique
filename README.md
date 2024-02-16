# Quai_Antique

is a [Symfony](https://symfony.com/doc/current/index.html) project bootstrapped with **'composer create-project symfony/skeleton:"6.4.*" Antique'**.


## Getting Started
First, if you need to get our project code, install the dependencies with Composer. 
Setup the project with the following commands:

```bash
# clone the project to download its contents
cd antique/
git clone ...

# make Composer install the project´s dependencies into vendor/
cd antique/
composer install

```

Second, run the development server:
```bash
php -S localhost:8000 -t public/
```

Open [http://localhost:8000](http://localhost:8000) with your browser to see the result.

## Test Unit

```bash
# Install the packages
composer require --dev symfony/test-pack

# After the library is installed, try running PHPUnit:
php bin/phpunit

# Load the fixtures in the database:
php bin/console doctrine:fixtures:load --env=test
```
With this account, you can get access to the backend of the application from the same login page for the visitor with an account. 

Enjoy :smiley: !!!
