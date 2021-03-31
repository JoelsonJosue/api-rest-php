<?php

namespace Repository;
use DB\PostgreSQL;
//use Util\ConstantesGenericasUtil;
//use InvalidArgumentException;

class UsuariosRepository{

    private $PostgreSQL;
    public const TABELA = 'usuarios';

    public function __construct(){
        $this->PostgreSQL = new PostgreSQL();
    }

    public function getPostgreSQL(){
        return $this->PostgreSQL;
    }

}