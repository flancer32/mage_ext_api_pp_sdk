# Development and Testing

Development and testing environment is deployed into this location.

## Development Environment Installation

### Linux

    $ cd ./test/
    $ composer install
    $ ./vendor/bin/composerCommandIntegrator.php magento-module-deploy

### Windows

    > cd .\test\
    > composer install
    > vendor\bin\composerCommandIntegrator.php.bat magento-module-deploy

### Setup DNS

#### Local DNS
C:\Windows\System32\drivers\etc

127.0.0.1	paypal_api.local.net

### Setup Web Server

#### Apache

    <VirtualHost *:80>
        ServerName paypal_api.local.net
        ServerAdmin alex@flancer.lv
        DocumentRoot "C:\work\github\mage_ext_api_pp_sdk\test\mage"
        ErrorLog "logs/paypal_api-error.log"
        CustomLog "logs/paypal_api-access.log" combined
        <Directory "C:\work\github\mage_ext_api_pp_sdk\test\mage">
            Options FollowSymLinks Indexes 
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>