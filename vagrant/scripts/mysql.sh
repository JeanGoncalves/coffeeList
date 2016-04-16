#!/bin/bash

DB_PASSWORD="admin"
CONFIG_PROVISION_PATH="/temp/config"

echo "Installing MySQL..."

apt-get install -y debconf-utils > /dev/null

echo "mysql-server mysql-server/root_password password $DB_PASSWORD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $DB_PASSWORD" | debconf-set-selections

apt-get install -y mysql-server

echo "Configuring database..."

mysql -u root -p$DB_PASSWORD -e 'CREATE DATABASE IF NOT EXISTS `curso_tdd` CHARACTER SET `utf8` COLLATE `utf8_unicode_ci`;'
mysql -u root -p$DB_PASSWORD -e 'CREATE DATABASE IF NOT EXISTS  `curso_tdd_unittest` CHARACTER SET `utf8` COLLATE `utf8_unicode_ci`;'
mysql -u root -p$DB_PASSWORD curso_tdd < /www/curso-tdd/docs/curso_tdd.sql
mysql -u root -p$DB_PASSWORD curso_tdd_unittest < /www/curso-tdd/docs/curso_tdd.sql
