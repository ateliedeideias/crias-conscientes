<?php
function NuloOuVazio($str){
  return (!isset($str) || trim($str) === '');
}

function RetornaErro($httpStatus, $mensagem) {
  echo $mensagem;
  http_response_code($httpStatus);
  exit();
}
?>