# coffeeList

### Virtual Host

    Listen 8081
    <VirtualHost *:8081>
        DocumentRoot /www/coffeeList/public
        #ServerName coffeelist.conf.local
        SetEnv APPLICATION_ENV  "development"
        <Directory /www/coffeeList/public/>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Order allow,deny
            allow from all
        </Directory>
    </VirtualHost>
