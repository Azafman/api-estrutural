<?php 


header('Access-Control-Allow-Origin: *');//permmite requisição de todos os domínios
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); //e desses domínios quais são permitidos
header('Content-Type: application/json');//o tipo de retorno

echo json_encode($array);//json_encode()transforma o atual array em um json
exit;