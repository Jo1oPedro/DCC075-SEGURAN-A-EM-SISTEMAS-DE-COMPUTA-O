<?php

use Seguranca\Rbac\Database\Connection;

require_once __DIR__ . "/vendor/autoload.php";

$connection = Connection::getConnection();
$connection->exec("CREATE TABLE users (
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(50)
);");

$connection->exec("CREATE TABLE teachersData (
    email VARCHAR(255),
    nome VARCHAR(100)
);");

$connection->exec("CREATE TABLE studentsData (
    email VARCHAR(255),
    nome VARCHAR(100)
);");

$connection->exec("INSERT INTO teachersData (email, nome)
VALUES ('teacher1@example.com', 'Professor 1'),
       ('teacher2@example.com', 'Professor 2');");

$connection->exec("INSERT INTO studentsData (email, nome)
VALUES ('student1@example.com', 'Estudante 1'),
       ('student2@example.com', 'Estudante 2');");