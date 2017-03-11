Misericordia di "Torre del lago Puccini"
===============

This app will provide functionality to manage food stock, structure, refugees attention, etc.

Table of contents
-----------------
* [Environment setup](#environment-setup)
* [Installation](#installation)
* [Add a new module](#upgrading)

Environment setup
------------
Make sure you have the environment setup by executing

```
docker-compose up -d
```

Once docker is setup, we have to import a copy of the database. 

A copy of the database can be found at [database repository](https://github.com/Misericordia-TDL/project-accoglienza-database)

Alternatively in the mongo container there's a minimal copy of the db

```php
docker exec -it mongo mongorestore --db misericordia /root/misericordia/
```

Once environment is ready, install the application with composer.

Installation
------------
Installation using composer within the docker container:

```
docker exec -it composer install
```
Add a new module
------------

Add a new module