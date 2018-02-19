# OCP6_Snow
Sixth project of OpenClassrooms "Développeur d'application PHP/Symfony" cursus. 

## 1-Intro 
This project is an exercice of the OpenClassrooms's cursus "Php/symfony developper".
The aim is to create a web site for the snowboarder community. A connected user can register a new snow trick or update an older one,    add comments on the tricks dedicated forum and customize his user profile.
  
## 2-Requirements
This project use Symfony 4 framework and Symfony 4 requires PHP version > 7.1.3 to run. 

## 4-Installation 
1. Clone this repository (Master or Production branches)
2. Put the downloaded repository into your server root folder. You can also use the Symfony server, in this case you don't have to put the dowloaded repository in your root server folder, but after complete installation you will have to run the `$ php bin/console server:run`command.
3. Install the vendors : 
  * Download composer `https://getcomposer.org/`
  * Put the composer.phar file into the root folder of the downloaded repository.
  * Then run `$ composer.phar update`. Now all the vendors are installed.
4. Set the database :
  * In .env file customize the line :
  `DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"`
  * You may also have to configure the `config/packages/doctrine.yaml`file for customize your MySQL version.
  * Create the database : '$ php bin/console doctrine:database:create`
  * Create all the tables : `$ php bin/console doctrine:migrations:diff` and `$ php bin/console doctrine:migrations:migrate`
5. Fill the database with a data set example : `$ php bin/console doctrine:fixtures:load`

## That's it :) 
  



  
  