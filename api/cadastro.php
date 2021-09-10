<?php
require_once 'utils/habilita-cors.php';
require_once 'utils/funcoes.php';
require_once 'utils/manipula-post.php';

function validaUsuario($usuario) {
  $parametros = array("s", $usuario);
  $resultado = execSQL("select codigo from usuarios where UPPER(apelido) = UPPER(?)", $parametros);
  $codigoUsuario = 0;

  if (isset($resultado) && !($resultado==null)) {
    $resultado->bind_result($codigoUsuario);

    if (!$resultado->fetch()) {
      $codigoUsuario = 0;
    }

    $resultado->close();
  }

  if ($codigoUsuario > 0) {
    RetornaErro(400, "Este apelido já está cadastrado.");
  }
}

function validaEmail($email) {
  $parametros = array("s", $email);
  $resultado = execSQL("select codigo from usuarios where email = LOWER(?)", $parametros);
  $codigoUsuario = 0;

  if (isset($resultado) && !($resultado==null)) {
    $resultado->bind_result($codigoUsuario);

    if (!$resultado->fetch()) {
      $codigoUsuario = 0;
    }

    $resultado->close();
  }

  if ($codigoUsuario > 0) {
    RetornaErro(400, "Este e-mail já está cadastrado.");
  }
}

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

require_once 'utils/mysql.php';
validaUsuario($dados["apelido"]);
validaEmail($dados["email"]);
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

$parametros = array("sssis", $dados["apelido"], $dados["email"], $dados["telefone"], $dados["temWhats"], $dados["senha"]);
execSQL("insert into usuarios (apelido, email, telefone, possui_whatsapp, senha, data_cadastro) values (?, LOWER(?), ?, ?, SHA(?), NOW())", $parametros);
$conn_cli->query('COMMIT');

echo 'Usuário inserido com sucesso';
?>