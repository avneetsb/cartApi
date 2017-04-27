
# Simple RESTful API for Managing Cart

### Setup Instructions

* Assumes `git`, `php`, `mysql` and `composer` are required as prerequisites.

* Process to setup project
```
$ git clone https://github.com/avneetsb/cartApi.git
$ cd cartApi
$ mysql -u<your-username> -p<your-password> < tableDump.sql
$ composer dump-autoload

* in case you get error composer not found run following two commands before it

$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

* Update database configurations in `App/Config/database.php` file
* Run command to start the server on localhost listening to 8000 port
```
$ php -S localhost:8000 index.php
```

### Documentation for Project Folders and Methods

* Used PHPDocumentor to generate Docs (assumes GraphViz installed)

* To view documentation, open the following file in your browser
```
file://<documentRoot>/docs/index.html
```

* To generate new documentation edit the following in /index.php
```
$generateNewDocs = false; // Skips document generation
$generateNewDocs = true; // Generates new PHP Doc
```

### Login Credentials

    Username  :avneet
    Password  :avneet

### RestfulAPI methods for Login Management

| paths | params | methods | description
|---|---|---|---|
| `/login` | username, password | POST | authenticate user

### RestfulAPI methods for Item Management

| paths | params | methods | description
|---|---|---|---|
| `/item`  |  | GET | lists all the items 
| `/item/{id}` | itemId | GET | shows details of item of given itemId 
| `/item` | price, itemName | POST | adds a new item 
| `/item/{id}` | itemId | POST | updates existing details of item
| `/item/{id}` | itemId | DELETE | deletes a specific item 

### RestfulAPI methods for Cart Management

| paths | params | methods | description
|---|---|---|---|
| `cart/items`  |  | GET | lists all the items 
| `cart/item/{id}` | itemId | POST | adds specific item
| `cart/item/{id}` | itemId | DELETE | deletes specfic item
| `cart/items`  |  | DELETE | deletes all items


### POSTMAN Link

here is [link to postman][] for more details


[link to postman]: https://www.getpostman.com/collections/4d1da3bddce3a377cc60