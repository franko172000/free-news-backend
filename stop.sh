#!/usr/bin/env bash
source "./shell-utils/helper.sh"
set -e
if [ -x "$(command -v docker)" ]; then
    process_info "Stopping containers..."
    sudo docker-compose down
    success "Containers Stopped."

else
  error "You need to install docker to continue this setup. To install docker, follow this link https://docs.docker.com/engine/install/"
fi
