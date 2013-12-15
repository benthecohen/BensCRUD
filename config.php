<?php

//DB Connection Info
define("DB_NAME", "bensCRUD");
define("DB_HOST", "localhost");
define("DB_USERNAME", "ben");
define("DB_PASSWORD", "hmmXn7cuEc35a8HX");

try {
$dsn = 'mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock' . ';dbname=' . DB_NAME ;
$db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
file_put_contents("php.log",  "Database Connection Established");
} catch (PDOException $e) {
    error_log("Error!: " . $e->getMessage());
    die();
}

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/BensCRUD/session/'));
session_start();

?>