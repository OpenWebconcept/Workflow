# Workflow
This repository holds a setup for developing and testings wordpress plugins


## About this template
This template provides a containerized [wordpress cli](https://developer.wordpress.org/cli/commands) instance extend with the power of PHPunit to test al your code and make sure you provide the most beutifull and stable plugins.

## Using this template to build a wordpress plugin





You can setup your first plugin by creating a 

```cli 
$ wp scaffold plugin unit-test-plugin
```  

## Local development
Requires
- GIT
- Docker


Git clone your repository
CMD navigate to your repository root
run 
```cli 
$ docker-compose up
```  

If you want to active your plugin form the commandline you can use
```cli 
$ wp plugin activate {your-plugin-name} --allow-root
```  


## Testing your code


Afther installing php unit, you can run php unit trough
```cli 
$ ./vendor/bin/phpunit tests
```  




## Workflow


## Usefull links
- [All wordpress cli commands](https://developer.wordpress.org/cli/commands)