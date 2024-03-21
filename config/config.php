<?php
session_start();
if($_SERVER['HTTP_HOST'] == 'localhost')
{
    define("base_url","http://localhost/Php-Programs/Library-Management-System/");
    define("dir_url", $_SERVER['DOCUMENT_ROOT'] . "/Php-Programs/Library-Management-System/");

    define("server_name","localhost");
    define("username","root");
    define("password","root");
    define("database","library");

}