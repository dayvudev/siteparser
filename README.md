### What is this? ###

This repository contain application written in Symfony for parsing web pages, but not only. 

### How do I get set up? ###

* Clone this repository
* Run `composer install`
* Run `bin/bdi detect drivers`
* Set up your database in `.env` file
* Run `bin/console doctrine:migrations:migrate`
* Run `bin/console site-parser:execution`

Now, You can check application result in `var/export` directory.