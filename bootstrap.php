<?php 

ini_set('display_errors', '1'); //Alterar para valor 0 quando estiver em produção 
ini_set('display_startup_errors', '1'); //Excluir linha quando estiver em produção 
error_reporting(E_ERROR); //Excluir linha quando estiver em produção 

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