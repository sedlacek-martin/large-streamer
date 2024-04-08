#!/usr/bin/env bash

# Startup commands
echo 'export PATH=$PATH:/app/bin' | sudo tee -a ~/.bashrc
sudo php /home/docker/hosts/hosts.php

docker-php-entrypoint "$@"