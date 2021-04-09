<?php

namespace Repository;
use DB\PostgreSQL;
//use Util\ConstantesGenericasUtil;
//use InvalidArgumentException;

class UsuariosRepository{
    
    /**
     * PostgreSQL
     *
     * @var object
     */
    private $PostgreSQL;
    public const TABELA = 'usuarios';
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){
        $this->PostgreSQL = new PostgreSQL();
    }
    
    /**
     * insertUser
     *
     * @param  mixed $login
     * @param  mixed $senha
     * @return int
     */
    public function insertUser($login, $senha){
        $consultaInsert = 'INSERT INTO '. self::TABELA . '(login, senha) VALUES (:login, :senha)';
        $this->PostgreSQL->getDb()->beginTransaction();
        $stmt = $this->PostgreSQL->getDb()->prepare($consultaInsert);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    /**
     * updateUser
     *
     * @param  mixed $id
     * @param  mixed $dados
     * @return int
     */
    public function updateUser($id, $dados){
        $consultaUpdate = 'UPDATE '. self::TABELA . ' SET login = :login, senha = :senha WHERE id = :id';
        $this->PostgreSQL->getDb()->beginTransaction();
        $stmt = $this->PostgreSQL->getDb()->prepare($consultaUpdate);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':login', $dados['login']);
        $stmt->bindParam(':senha', $dados['senha']);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    /**
     * getPostgreSQL
     *
     * @return object
     */
    public function getPostgreSQL(){
        return $this->PostgreSQL;
    }

}