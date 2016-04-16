#!/bin/bash

# git clone git@bitbucket.org:diogocavilha/curso-tdd.git /www/curso-tdd
cd /www/curso-tdd && composer install

sudo service nginx restart
sudo service php5-fpm restart
