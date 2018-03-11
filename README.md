# SIWECOS Webhost Service Tool

This tool is developed as the primary mailing tool for the [SIWECOS Project](http://www.siwecos.de/) webhost service.

It is a web-based tool running on an AMP stack built with the Laravel PHP Framework.

## Basic concepts
The tool is used to send out information mails about CMS-related security issues.
Webhost employees can invite colleagues from their own or other webhosting companies
that are interested in WAF filter rules for popular opensource CMS.

When a new issue is found a CMS security team member can use the application for easily do the following steps: 

* Create a mail template
* Sign this template text locally using the SIWECOS PGP key
* Paste back the signed mail into the tool.

Once the signature has been verified the sending process can be started.

Within the sending process each mail will be encrypted using the webhost employees PGP key.

## Setting up your local environment

This project ships with a local development environment based upon docker-compose 
that will bring you up to speed pretty fast.

1. Download and install [Docker](https://www.docker.com/).

2. Clone this [github repo](https://github.com/SIWECOS/siwecos-webhostservice)

    * `git clone https://github.com/SIWECOS/siwecos-webhostservice.git`

3. Install dependencies

    * `npm install`
    * `composer install`

4. Switch into `devenv` folder and fire up the docker processes (sudo might be needed):

    * `cd devenv`
    * `docker-compose up -d`

5. Copy the `.env.example` file to `.env` and set a secret key

6. Run the database migrations and seeders in the docker environment

    * `docker exec -it siwecoswebhostservice-php-fpm bash`
    * `su -s /bin/bash www-data`
    * `cd /application`
    * `php artisan migrate`
    * `php artisan db:seed`

7. Create your user account by running the command below inside of the container.
Make sure to set the users role to `3` "`CMS Garden Admin`".

    * `docker exec -it siwecoswebhostservice-php-fpm bash`
    * `php artisan user:create`

8. Open the app in your browser [localhost:4820](localhost:4820)
