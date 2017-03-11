Misericordia di "Torre del lago Puccini"
===============

This app will provide functionality to manage food stock, structure, refugees attention, etc.

Table of contents
-----------------
* [Environment setup](#environment-setup)
* [Installation](#installation)
* [Add a new module](#add-a-new-module)

Environment setup
------------
Make sure you have the environment setup by executing

```
docker-compose up -d
```

Once docker is setup, we have to import a copy of the database. 

A copy of the database can be found at [database repository](https://github.com/Misericordia-TDL/project-accoglienza-database)

Alternatively in the mongo container there's a minimal copy of the db.

To import data into mongo execute:

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

To add a new module we are going to add and edit a number of files in the architecture.


1) Edit `src/routes.php` and register all route entries (with method) and link it to the correspondent action.
It is important to note that each action will live in its own class and will have a unique route attached to it.
In this example can be see
that all routes in the module will require the operator to be logged it. 
For this purpose we add the `AuthMiddleware` too all the routes. Otherwise `GuestMiddleware` would be used.

     // All routes of the operator module
     $app->group('/operator', function () {
     
         $this->get('', 'OperatorIndexAction')->setName('index-operator');
         $this->get('/create', 'EnterOperatorDataAction')->setName('enter-operator-data');
         $this->post('/create', 'CreateOperatorAction')->setName('create-operator');
         $this->get('/update/{id}', 'EditOperatorAction')->setName('edit-operator');
         $this->post('/update/{id}', 'UpdateOperatorAction')->setName('update-operator');
         $this->post('/delete', 'DeleteOperatorAction')->setName('delete-operator');
         $this->get('/list', 'ListOperatorAction')->setName('list-operator');
     
     })->add(new AuthMiddleware($container));
     
   In case a new middleware will be required for your module, don't forget to add it to `src/middleware.php`.

2) In the case that your module requires access to a collection, add an eloquent model to your module.
See `src/app/Operator/Model/Operator.php` as an example of a basic model with a many to one relationship 
or `src/app/OperatorLevel/Model/OperatorLevel.php` with an example of one to many relationship.

3) In the case that your module requires an extended way to access to a collection, create a repository class
where all extended queries an be written. See `src/app/Operator/Repository/OperatorRepository.php` as an example.

4) Register your components and actions in the container as service. 
See `src/app/Operator/Services/Operator.php` and `src/app/Operator/Services/OperatorActions.php` as examples on how to 
inject dependencies in actions and register a model as service.

5) Edit `src/dependencies.php` and register in the container all the dependencies and services a new module
could have. In this example we are registering all Operator model and actions as service in the container. 
    
    
    
    
   First import classes
    
    
    use App\Operator\Services\Operator as OperatorService;
    use App\Operator\Services\OperatorActions as OperatorActionsService;
    
    
   Second register them into the container
    
    
    $container->register(new OperatorService());
    $container->register(new OperatorActionsService());
    
6) In the case your module will need templates, place them inside of `templates/partials/component-name`.
See `templates/partials/operator` as an example of templates for the operator module.
