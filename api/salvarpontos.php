<?php
require_once 'utils/habilita-cors.php';
require_once 'utils/funcoes.php';
require_once 'utils/manipula-post.php';

/*
{
  apelido: "apelido do usuario",
  fase: numero da fase,
  personagem: numero do personagem,
  pontos: total de pontos
}
*/
$objPost = new ManipulaPost();
$dados=$objPost->getJsonPost();

// Validar campos
if (NuloOuVazio($dados["apelido"])) {
  RetornaErro(400, "Usuário inválido.");
}

if (NuloOuVazio($dados["fase"]) || $dados["fase"] < 1 || $dados["fase"] > 9) {
  RetornaErro(400, "Fase inválida.");
}

if (NuloOuVazio($dados["personagem"]) || $dados["personagem"] < 1 || $dados["personagem"] > 3) {
  RetornaErro(400, "Personagem inválido.");
}

if (NuloOuVazio($dados["pontos"]) || $dados["pontos"] < 0 || $dados["pontos"] > 15) {
  RetornaErro(400, "Pontuação inválida.");
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

$parametros = array("iiii", $codigoUsuario, $dados["fase"], $dados["pontos"], $dados["personagem"]);
execSQL("insert into pontuacao (codigo_usuario, fase, datahora, total_pontos, personagem) values (?, ?, NOW(), ?, ?)", $parametros);
$conn_cli->query('COMMIT');

echo 'Usuário inserido com sucesso';
?>