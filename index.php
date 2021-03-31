<?php

use Util\RotasUtil;
use Validator\RequestValidator;
use Util\ConstantesGenericasUtil;
use Util\JsonUtil;

include 'bootstrap.php';

try {
    $RequestValidator = new RequestValidator(RotasUtil::getRotas());
    $retorno = $RequestValidator->processarRequest();
    
    $JsonUtil = new JsonUtil();
    $JsonUtil->processarArrayParaRetornar($retorno);
} catch (\Throwable $th) {
    header('Content-Type: application/json');
    echo json_encode([
        ConstantesGenericasUtil::TIPO => ConstantesGenericasUtil::TIPO_ERRO,
        ConstantesGenericasUtil::RESPOSTA => $th->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}