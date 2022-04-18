<?php

define("WEBSITE_TITLE", "Books CRUD");

//database
define("DB_NAME", "books-crud");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_TYPE", 'mysql');
define("DB_HOST", "localhost");

define("DEBUG", true);

if (DEBUG) {
    ini_set('display_errors', 1);
} else {
    ini_set('display_errors', 0);
}