#!/bin/sh

#chown -R www-data:www-data /var
#php bin/console cache:clear

#composer install;
#
##php-fpm;
#
## default TESTING to false
#${TESTING:=0}
#if [ "$TESTING" = "0" ]
#then
#    # not testing, start php-fpm
php-fpm;
#else
#    # run tests
#    ./bin/phpunit -c app/phpunit.xml;
#
#    # test with selenium-chrome
#    php-fpm -D && ./bin/phpunit -c app/phpunit.xml --group selenium;
#fi

