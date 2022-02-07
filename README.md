
# PHP lions-software-database-manager

This is a simple library for managing database connections, results pagination and building queries in PHP.

Esta é uma biblioteca simples para gerenciar conexões de banco de dados, paginação de resultados e construção de consultas em PHP.

## Installation

Use [Composer](https://getcomposer.org/) to install lions-software-database-manager in your project

Use o [Composer](https://getcomposer.org/) para instalar o lions-software-database-manager em seu projeto:

```php
composer require lions-software/lions-software-database-manager
```

## Usage

To use this library just follow the examples below:

Para utilizar esta biblioteca basta seguir os exemplos abaixo:

#### Database
```php
<?php

require 'vendor/autoload.php';

use LionsSoftware\DatabaseManager\Database;

//DATABASE CREDENTIALS
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'pass';
$dbName = 'database';
$dbPort = 3306;
$dbDriver = 'mysql';

//CONFIG DATABASE CLASS
Database::config($dbHost,$dbUser,$dbPass,$dbName, $dbPort, $dbDriver);

//CONNECTION INSTANCE
$objDatabase = Database::Connection();

```

#### Pagination
```php
<?php

require 'vendor/autoload.php';

use LionsSoftware\DatabaseManager\Database;
use LionsSoftware\DatabaseManager\Pagination;

//DATABASE CREDENTIALS
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'pass';
$dbName = 'database';
$dbPort = 3306;
$dbDriver = 'mysql';

//CONFIG DATABASE CLASS
Database::config($dbHost,$dbUser,$dbPass,$dbName, $dbPort, $dbDriver);

//CONNECTION INSTANCE
$objDatabase = Database::Connection();

//COUNT TOTAL RESULTS
$totalResults = $objDatabase->select('id > 10',null,null,'COUNT(*) as total')->fetchObject()->total;

//CURRENT PAGE
$currentPage  = $_GET['page'] ?? 1;
$itemsPerPage = 10;

//PAGINATION
$objPagination = new Pagination($totalResults,$currentPage,$itemsPerPage);

//SELECT (return a PDOStatement object)
$results = $objDatabase->select('id > 10',null,$objPagination->getLimit());

//PAGES (array)
$pages = $objPagination->getPages();

```

## Requirements

This library needs PHP 8.0 or greater.
