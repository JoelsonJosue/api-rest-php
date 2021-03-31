<?php

namespace Service;

use Repository\UsuariosRepository;
use Util\ConstantesGenericasUtil;
use InvalidArgumentException;

class UsuariosService{

    public const TABELA = 'usuarios';
    public const RECURSOS_GET = ['listar'];

    private $dados;

    private $UsuariosRepository;

    public function __construct($dados = []){
        $this->dados = $dados;
        $this->UsuariosRepository = new UsuariosRepository();
    }

    public function validarGet(){

        $retorno = null;
        $recurso = $this->dados['recurso'];
        if(in_array($recurso, self::RECURSOS_GET)){
            $retorno = $this->dados['id'] > 0 ? $this->getOneByKey() : $this->$recurso();
        }else{
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        if($retorno === null){
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;

    }

    private function getOneByKey(){
        return $this->UsuariosRepository->getPostgreSQL()->getOneByKey(self::TABELA, $this->dados['id']);
    }

    private function listar(){
        return $this->UsuariosRepository->getPostgreSQL()->getAll(self::TABELA);
    }

}