<?php
require_once 'utils/habilita-cors.php';
require_once 'utils/funcoes.php';
require_once 'utils/manipula-post.php';

$objPost = new ManipulaPost();
$dados=$objPost->getJsonPost();

// Validar campos
if (NuloOuVazio($dados["usuario"])) {
  RetornaErro(400, "Por favor, informe seu apelido ou email.");
}

if (NuloOuVazio($dados["senha"])) {
  RetornaErro(400, "Por favor, informe sua senha.");
}

require_once 'utils/mysql.php';

$parametros = array("sss", $dados["usuario"], $dados["usuario"], $dados["senha"]);
$resultado = execSQL("select apelido from usuarios where (UPPER(apelido) = UPPER(?) or email = LOWER(?)) and senha = SHA(?)", $parametros);
if (isset($resultado) && !($resultado==null)) {
  $resultado->bind_result($apelidoUsuario);

  if ($resultado->fetch()) {
    echo $apelidoUsuario;
    exit();
  }
}

RetornaErro(401, "Usuário ou senha incorretos.");
?>