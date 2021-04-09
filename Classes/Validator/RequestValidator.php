<?php

namespace Validator;

use Util\ConstantesGenericasUtil;
use Util\JsonUtil;
use Repository\TokensAutorizadosRepository;
use Service\UsuariosService;
use InvalidArgumentException;

class RequestValidator {

    private $request;    
    /**
     * dadosRequest
     *
     * @var array
     */
    private $dadosRequest = [];    
    /**
     * TokensAutorizadosRepository
     *
     * @var object
     */
    private $TokensAutorizadosRepository;
    
    const GET = 'GET';
    const DELETE = 'DELETE';
    const USUARIOS = 'USUARIOS';
        
    /**
     * __construct
     *
     * @param  mixed $request
     * @return void
     */
    public function __construct($request){
        $this->request = $request;
        $this->TokensAutorizadosRepository = new TokensAutorizadosRepository();
    }
            
    /**
     * processarRequest
     *
     * @return mixed
     */
    public function processarRequest(){

        $retorno = ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA;
        //$this->request['metodo'] = 'POST';
        if(in_array($this->request['metodo'], ConstantesGenericasUtil::TIPO_REQUEST, true)){
            $retorno = $this->direcionarRequest();
        }
        return $retorno;

    }
    
    /**
     * direcionarRequest
     *
     * @return mixed
     */
    public function direcionarRequest(){
        if($this->request['metodo'] !== self::GET && $this->request['metodo'] !== self::DELETE){
            $this->dadosRequest = JsonUtil::tratarCorpoRequisicaoJson();
        }
        $this->TokensAutorizadosRepository->validarToken(getallheaders()['Authorization']);
        $metodo = $this->request['metodo'];
        return $this->$metodo();
    }
    
    /**
     * get
     *
     * @return mixed
     */
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
    
    /**
     * delete
     *
     * @return mixed
     */
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
    
    /**
     * post
     *
     * @return mixed
     */
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
    
    /**
     * put
     *
     * @return mixed
     */
    private function put(){

        $retorno = ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA;
        if(in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_PUT)){
            
            switch ($this->request['rota']) {
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $UsuariosService->setDadosCorpoRequest($this->dadosRequest);
                    $retorno = $UsuariosService->validarPut();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }

        }

        return $retorno;
        
    }

}