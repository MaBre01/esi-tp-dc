# ESI TP DC

My application is using this my [server configuration](https://github.com/MaBre01/docker-toolkit) to working.

## Application

This application contains 3 pieces of software.

- **Nginx**: a server web.
- **MariaDB**: a database server.
- **PHP**: my PHP application.

The application is just used to test continuous deployment, so it is not a complex application.

There are two Git branches:
- One for the development environment
- An other for the production environment

When we push on the dev branch, GitHub will test the application with PHPUnit, create Docker images with `dev` tag, push the Docker images on DockerHub and deploy the application on a server.
When we push on the master branch, GitHub will test the application with PHPUnit, create Docker images with `latest` tag and push the Docker images on DockerHub. My choice is to not deploy the prod environment automatically, to leave the mainteners choose when they want to deploy the application.

## Set Up

You must use [Traefik](https://docs.traefik.io/) to use this application in this state.

### Local environment

You should run this command to up the application in Docker:

    docker-compose up -d

Then, you can install the PHP dependencies with:

    docker-compose run --rm php composer install

and launch the Symfony migration with:

    docker-compose run --rm php php bin/console doctrine:migrations:migrate

Once it has started, you can browse `esi-tp-dc.local` to find the application.

### Development environment

You should save 7 variables on your GitHub project secrets:
2 for login on DockerHub to save your images:

    DOCKERHUB_USERNAME
    DOCKERHUB_PASSWORD

and 5 for the SSH connexion with the server deployment:

    HOST
    USERNAME
    PASSWORD
    PORT
    TARGET_FOLDER

Then, when you push on dev branch, the application will be deployed on your server.

### Production environment

You should save 2 variables on your GitHub project secrets:

    DOCKERHUB_USERNAME
    DOCKERHUB_PASSWORD

Then, when you push on master branch, the applications images will be push on your DockerHub account.

## Configuration

If you want to change the application configuration you can edit different files.

### MariaDB

You can put SQL file in the `./.docker/mariadb/db-dumps` folder. When you up the application, Docker will run this files in the database. 

### Nginx

You can edit the config of Nginx by editing the `./.docker/nginx/nginx.conf` file.

### PHP

You can add or remove PHP extensions or Linux packages in the `./.docker/php/Dockerfile` file.
You can edit the PHP FPM configuration by editing the `./.docker/php/php-fpm-pool.conf` file.
You can edit the PHP configuration by editing the `./.docker/php/php.ini` file.

### GitHub Actions workflows

The continuous deployment is  configured in the `./.github/workflows` folder.
The file `dev.yml` contains the deployment for the `dev` branch.
The file `master.yml` contains the deployment for the `master` branch.

### .env

You can add a `.env` file in the application directory to configure access to external services with sensitives variables (like database).