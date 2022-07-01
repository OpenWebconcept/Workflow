FROM wordpress
RUN chown -R www-data:www-data /var/www
RUN find /var/www/ -type d -exec chmod 0755 {} \;
RUN find /var/www/ -type f -exec chmod 644 {} \;
# Setting up wp-cli
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN php wp-cli.phar --info
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp
# Setting up PHPUnit
RUN curl -O https://phar.phpunit.de/phpunit-9.phar
#RUN php phpunit-9.phar --info
RUN chmod +x phpunit-9.phar
RUN mv phpunit-9.phar /usr/local/bin/phpunit
WORKDIR /var/www/html