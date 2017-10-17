# SIWECOS Webhost Service Tool

This tool is developed as the primary mailing tool for the [SIWECOS Project](http://www.siwecos.de/) webhost service.

It is a web-based tool running on the AMP stack, built with the Laravel PHP Framework

## Basic concepts
The tool is used to send out information mails about CMS-related security issues. Webhost employees can invite colleagues from their own or other webhosting companies, that are interested in WAF filter rules for popular opensource CMS.

When a new issue is found, a CMS security team member can use the application to create a mail template, can sign this template text locally using the SIWECOS PGP key and paste back the signed mail into the tool. Once the signature has been verified, the sending process can be started.

Within the sending process, each mail will encrypted using the webhost employees PGP key.

## Setting up your local environment

This project ships with a local development environment based upon docker-compose, that will bring you up to speed pretty fast.

1. Download and install [Docker](https://www.docker.com/).

2. Clone this repo

	`git clone git@github.com:CMS-Garden/siwecos-webhostservice.git`
	
3. Install dependencies

	`npm install`  
	`composer install`

4. Switch into `devenv` folder and fire up the docker processes:

	`cd devenv`   
	`docker-compose up -d`

5. Run the database migrations and seeders in the docker environment

	`docker exec -it siwecoswebhostservice-php-fpm bash`   
	`su -s /bin/bash www-data`   
	`php artisan migrate`   
	`php artisan db:seed`

6. Create your user account by connecting to the DB instance running on localhost:4822, use `3` for the role column to gain the highest privileges

7. Connect to the application running on localhost: 4820