<?php
require_once 'utils/habilita-cors.php';
require_once 'utils/funcoes.php';
require_once 'utils/manipula-post.php';

/*
{
  apelido: "apelido do usuario",
  personagem: numero do personagem,
}
*/
$objPost = new ManipulaPost();
$dados=$objPost->getJsonPost();

// Validar campos
if (NuloOuVazio($dados["apelido"])) {
  RetornaErro(400, "Usuário inválido.");
}

if (NuloOuVazio($dados["personagem"]) || $dados["personagem"] < 1 || $dados["personagem"] > 5) {
  RetornaErro(400, "Personagem inválido.");
}


require_once 'utils/mysql.php';

$parametros = array("s", $dados["apelido"]);
$resultado = execSQL("select codigo from usuarios where UPPER(apelido) = UPPER(?)", $parametros);
$codigoUsuario = 0;

if (isset($resultado) && !($resultado==null)) {
  $resultado->bind_result($codigoUsuario);

  if (!$resultado->fetch()) {
    $codigoUsuario = 0;
  }

  $resultado->close();
}

if ($codigoUsuario <= 0) {
  RetornaErro(400, "Usuário não encontrado.");
}

// Gerar identificador único da partida
$uuid = md5(uniqid(""));

$parametros = array("isi", $codigoUsuario, $uuid, $dados["personagem"]);
execSQL("insert into partidas (codigo_usuario, datahora_inicio, uuid, personagem, fase, pontos, tempo, finalizado) values (?, NOW(), ?, ?, 0, 0, 0, 0)", $parametros);
$conn_cli->query('COMMIT');

echo $uuid;