<?php

use Util\RotasUtil;
use Validator\RequestValidator;
use Util\ConstantesGenericasUtil;

include 'bootstrap.php';

try {
    $RequestValidator = new RequestValidator(RotasUtil::getRotas());
    $retorno = $RequestValidator->processarRequest();
} catch (\Throwable $th) {
    echo json_encode([
        ConstantesGenericasUtil::TIPO => ConstantesGenericasUtil::TIPO_ERRO,
        ConstantesGenericasUtil::RESPOSTA => $th->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}