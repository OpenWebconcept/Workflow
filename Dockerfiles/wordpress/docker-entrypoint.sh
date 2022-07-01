#!/bin/sh
composer install

# prevent the container exiting
 tail -f /dev/null