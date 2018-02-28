# OCP6_Snow
Sixth project of OpenClassrooms "Développeur d'application PHP/Symfony" cursus. 

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/1ff062f1-f99e-4d5e-8ccb-cae8d8c10eb2/big.png)](https://insight.sensiolabs.com/projects/1ff062f1-f99e-4d5e-8ccb-cae8d8c10eb2)

This is a stable Symfony development environment version.
## 1-Intro 
The aim of this project is to create a web site for the snowboarder community. A connected user can register a new snow trick, delete or update an older one, add comments on the tricks dedicated forum and customize his user profile.
  
## 2-Requirements
This project use Symfony 4 framework and Symfony 4 requires PHP version > 7.1.3 to run. 

## 3-Installation 
1. Clone this repository (Master branche)
2. Put the downloaded repository into your server root folder. You can also use the Symfony server, in this case you don't have to put the dowloaded repository in your root server folder, but after complete installation you will have to run the `$ php bin/console server:run` command.
3. Install the vendors : 
  * Download [composer](https://getcomposer.org/)
  * Put the composer.phar file into the root folder of the downloaded repository.
  * Then run `$ php composer.phar update`
  * Now all the vendors are installed.
4. Set the database :
  * In .env file customize the line :
  `DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"`
  * You may also have to configure the config/packages/doctrine.yaml file for adjust your MySQL version.
  * Create the database `$ php bin/console doctrine:database:create`
  * Create all the tables 
    * `$ php bin/console doctrine:migrations:diff`  
    * `$ php bin/console doctrine:migrations:migrate`
 5. Customize your own Swift Mailer : 
   * This is a dev environment, the application sends emails to validate a new user registration or validate a new user password. Swift Mailer is used to achieve this.
   * So, go to [Symfony 'how to send emails'](https://symfony.com/doc/current/email.html) to configure and test by your own this part.
## Optional 
Just after installation, you can fill the database with a set of tricks examples allready written in the Datafixtures folder with their respective images stored in the public/uploads/imgs folder. 
To do that, you first have to disable the Lifecycle Callbacks of Image class: 
* Go to src/Entity/Image and remove the annotation ` * @ORM\HasLifecycleCallbacks()`
* Fill the database with the data set example `$ php bin/console doctrine:fixtures:load` press `y`
* __Important__ in src/Entity/Image replace the annotation ` * @ORM\HasLifecycleCallbacks()`  
 ```
/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Image
```
## That's it !   
  



  
  
