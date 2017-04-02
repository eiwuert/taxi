#!/bin/bash

# We need to install dependencies only for Docker
[[ ! -e /.dockerinit ]] && exit 0
set -xe

# Install git (the php image doesn't have it) which is required by composer
apt-get update -yqq
apt-get install git -yqq
sudo apt-get install -y postgresql postgresql-client libpq-dev
sudo -u postgres psql -d template1
CREATE USER postgres WITH PASSWORD 'root' CREATEDB;
CREATE DATABASE saamtaxi OWNER postgres;
\q
psql -U postgres -h localhost -d saamtaxi -W


# Install mysql driver
# Here you can install any other extension that you need
# docker-php-ext-install pdo_mysql

