# Project

The project is divided in two parts `backend` (a symfony project) and `frontend` (an Angular project):

## Backend

first, you must have installed composer. Inside the `backend` folder, you must run this:

```
$ compose install  # any question, just press enter
$ mkdir app/data
$ php app/console doctrine:database:create # a sqlite DB
$ php app/console doctrine:migrations:migrate
$ mv parameters_default.yml app/config/parameters.yml
$ php app/console server:run # we start at localhost:8000 the server :D
```


### Versions Used:
```
$ php -v
PHP 5.6.24 (cli) (built: Jul 22 2016 02:41:22)
Copyright (c) 1997-2016 The PHP Group
Zend Engine v2.6.0, Copyright (c) 1998-2016 Zend Technologies

$ composer --version
Composer version 1.2.0 2016-07-19 01:28:52
```

## Frontend

Inside of `frontend` folder you must run:

```
$ npm install -g grunt-cli bower
$ gem install compass
$ npm install
$ bower install
$ grunt serve # to start the frontend server
```

### Versions Used:
```
$ node --version
v4.2.3

$ npm --version
3.10.3

$ grunt --version
grunt-cli v1.2.0
grunt v0.4.5

$ bower --version
1.7.9

$ compass --version
Compass 1.0.3 (Polaris)
Copyright (c) 2008-2016 Chris Eppstein
Released under the MIT License.
Compass is charityware.
Please make a tax deductable donation for a worthy cause: http://umdf.org/compass
```
