<?php

namespace Validator;

use Util\ConstantesGenericasUtil;
use Util\JsonUtil;
use Repository\TokensAutorizadosRepository;
use Service\UsuariosService;
use InvalidArgumentException;

class RequestValidator {

    private $request;
    private $dadosRequest = [];
    private $TokensAutorizadosRepository;
    
    const GET = 'GET';
    const DELETE = 'DELETE';
    const USUARIOS = 'USUARIOS';
    
    public function __construct($request){
        $this->request = $request;
        $this->TokensAutorizadosRepository = new TokensAutorizadosRepository();
    }
        
    public function processarRequest(){

        $retorno = ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA;
        //$this->request['metodo'] = 'POST';
        if(in_array($this->request['metodo'], ConstantesGenericasUtil::TIPO_REQUEST, true)){
            $retorno = $this->direcionarRequest();
        }
        return $retorno;

    }

    public function direcionarRequest(){
        if($this->request['metodo'] !== self::GET && $this->request['metodo'] !== self::DELETE){
            $this->dadosRequest = JsonUtil::tratarCorpoRequisicaoJson();
        }
        $this->TokensAutorizadosRepository->validarToken(getallheaders()['Authorization']);
        $metodo = $this->request['metodo'];
        return $this->$metodo();
    }

    private function get(){

        $retorno = ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA;
        if(in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_GET)){
            
            switch ($this->request['rota']) {
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $retorno = $UsuariosService->validarGet();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }

        }

        return $retorno;
        
    }

    private function delete(){

        $retorno = ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA;
        if(in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_DELETE)){
            
            switch ($this->request['rota']) {
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $retorno = $UsuariosService->validarDelete();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }

        }

        return $retorno;
        
    }

    private function post(){

        $retorno = ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA;
        if(in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_POST)){
            
            switch ($this->request['rota']) {
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $UsuariosService->setDadosCorpoRequest($this->dadosRequest);
                    $retorno = $UsuariosService->validarPost();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }

        }

        return $retorno;
        
    }

}