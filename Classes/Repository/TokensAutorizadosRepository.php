<?php

namespace Repository;
use DB\PostgreSQL;
use Util\ConstantesGenericasUtil;
use InvalidArgumentException;

class TokensAutorizadosRepository{

    private $PostgreSQL;
    public const TABELA = 'tokens_autorizados';

    public function __construct(){
        $this->PostgreSQL = new PostgreSQL();
    }

    public function validarToken($token){

        $token = str_replace([' ', 'Bearer'], '', $token);

        if($token){

            $consultaToken = 'SELECT id FROM ' . self::TABELA . ' WHERE token = :token AND status = :status';
            $stmt = $this->getPostgreSQL()->getDb()->prepare($consultaToken);
            $stmt->bindValue(':token', $token);
            $stmt->bindValue(':status', ConstantesGenericasUtil::SIM);
            $stmt->execute();
            if($stmt->rowCount() !== 1){
                header('HTTP/1.1 401 Unauthorized');
                throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TOKEN_NAO_AUTORIZADO);
            }
            //echo 'Token Autorizado';

        }else{
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TOKEN_VAZIO);
        }

    }

    public function getPostgreSQL(){
        return $this->PostgreSQL;
    }

}