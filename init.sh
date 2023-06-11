#!/usr/bin/env bash
source "./shell-utils/helper.sh"
set -e
if [ -x "$(command -v docker)" ]; then
    process_info "Spinning up containers..."
    sudo docker-compose --env-file ./.env.docker up --build -d
    success "Containers started"

    process_info "Installing dependencies..."
    sudo docker-compose exec news-backend-app sh -c "composer install"
    success "Dependencies installation completed"

    process_info "Running migrations..."
    sudo docker-compose exec news-backend-app sh -c "php artisan migrate --seed"
    success "Migration completed"

    process_info "Starting backed server"
    sudo docker-compose exec news-backend-app sh -c "php artisan app:fetch-news && php artisan serve --port 8070 --host 0.0.0.0 --env ./.env.docker"

else
  error "You need to install docker to continue this setup. To install docker, follow this link https://docs.docker.com/engine/install/"
fi
