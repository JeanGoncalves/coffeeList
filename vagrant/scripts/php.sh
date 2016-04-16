#!/bin/bash

echo "Installing PHP..."

apt-get install -y language-pack-en-base
export LC_ALL=en_US.UTF-8

add-apt-repository ppa:ondrej/php5-5.6
apt-get update
apt-get install python-software-properties
apt-get update

apt-get install -y php5

echo "Installing PHP extensions..."

apt-get install -y php5-cli
apt-get install -y php5-fpm
apt-get install -y php5-mysql

echo "Enabling PHP errors..."

sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/fpm/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/fpm/php.ini

if [ ! -e "/usr/local/bin/composer" ]; then
    echo "Installing Composer..."
    curl -sS https://getcomposer.org/installer | php
    sudo cp -iv composer.phar /usr/local/bin/composer
    rm -f composer.phar
fi
sudo composer self-update

echo "Configuring PHP FPM..."

sed -i 's#listen = /var/run/php5-fpm.sock#listen = 127.0.0.1:9000#' /etc/php5/fpm/pool.d/www.conf
