<?php
require_once 'utils/funcoes.php';
require_once 'utils/manipula-post.php';

$objPost = new ManipulaPost();
$dados=$objPost->getJsonPost();

// Validar campos
if (NuloOuVazio($dados["apelido"])) {
  RetornaErro(400, "Por favor, informe seu apelido.");
}

if (NuloOuVazio($dados["email"])) {
  RetornaErro(400, "Por favor, informe seu email.");
}

if (NuloOuVazio($dados["telefone"])) {
  RetornaErro(400, "Por favor, informe seu telefone.");
}

if (NuloOuVazio($dados["senha"])) {
  RetornaErro(400, "Por favor, informe sua senha.");
}

/*
if (email é inválido) {
  RetornaErro(400, "Esse email é inválido.");
}

if (telefone é inválido) {
  RetornaErro(400, "Esse email é inválido.");
}

if (apelido ja existe) {
  RetornaErro(400, "Esse apelido já está cadastrado.");
}

if (email ja existe) {
  RetornaErro(400, "Esse email já está cadastrado.");
}*/

require_once 'utils/mysql.php';

$parametros = array("sssis", $dados["apelido"], $dados["email"], $dados["telefone"], $dados["temWhats"], $dados["senha"]);
execSQL("insert into usuarios (apelido, email, telefone, possui_whatsapp, senha, data_cadastro) values (?, LOWER(?), ?, ?, SHA(?), NOW())", $parametros);
$conn_cli->query('COMMIT');

echo 'Usuário inserido com sucesso';
?>