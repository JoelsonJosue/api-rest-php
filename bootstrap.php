<?php 

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR);

define(HOST, 'localhost');
define(PORTA, '5432');
define(BANCO, 'api');
define(USER, 'postgres');
define(SENHA, 'joelson');
define(DS, DIRECTORY_SEPARATOR);
define(DIR_APP, __DIR__);
define(DIR_PROJETO, 'api');

if (file_exists('autoload.php')){
    include 'autoload.php';
}else{
    echo 'Erro ao incluir o bootstrap';
    exit;
}