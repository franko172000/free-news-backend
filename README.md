## Simple Laravel News Curator Backend Application

## App Set up
Clone this repository, navigate to the repository root and run the following commands.
- Note: You need to have docker installed for the setup to work. To install docker, follow this link https://docs.docker.com/engine/install/

## Set up for Linux system
1. Grant permission to shell scripts
```bash
    chmod +x ./init.sh
    chmod +x ./stop.sh
```
2. If you are running a Linux system, start containers by running the script below. Note: it might require you to input your system admin/root user password
```bash
    ./init.sh
```
3. Stop containers
```bash
    ./stop.sh
```

## Set up Windows
If you are on a windows machine, you will have to start the containers yourself. Please follow these easy steps to the app up and running.

1. ``cd`` in to the cloned repository and run
2. ```bash
    docker-compose --env-file ./.env.docker up --build -d
    ```
3. ```bash
    docker-compose exec news-backend-app sh -c "composer install && php artisan migrate --seed && php artisan app:fetch-news &&  php artisan serve --port 8070 --host 0.0.0.0 --env ./.env.docker"
    ```
If you followed the steps above, you should be able to access the laravel app on your browser with the base url below

## Base url
Open [http://localhost:8070](http://localhost:8070)
