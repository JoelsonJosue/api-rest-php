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

    public function insertUser($login, $senha){
        $consultaInsert = 'INSERT INTO '. self::TABELA . '(login, senha) VALUES (:login, :senha)';
        $this->PostgreSQL->getDb()->beginTransaction();
        $stmt = $this->PostgreSQL->getDb()->prepare($consultaInsert);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getPostgreSQL(){
        return $this->PostgreSQL;
    }

}