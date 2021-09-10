<?php
require_once 'utils/habilita-cors.php';
require_once 'utils/funcoes.php';
require_once 'utils/manipula-post.php';

/*
{
  apelido: "apelido do usuario",
  fase: numero da fase,
  uuid: uuid da partida,
  pontos: total de pontos,
  tempo: total tempo gasto em segundos
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

if (NuloOuVazio($dados["uuid"])) {
  RetornaErro(400, "Identificador da partida inválido.");
}

if (NuloOuVazio($dados["pontos"]) || $dados["pontos"] < 0 || $dados["pontos"] > 10) {
  RetornaErro(400, "Pontuação inválida.");
}

if (NuloOuVazio($dados["tempo"]) || $dados["tempo"] < 1 || $dados["tempo"] > 999999) {
  RetornaErro(400, "Tempo inválido.");
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

$parametros = array("is", $codigoUsuario, $dados["uuid"]);
$resultado = execSQL("select codigo from partidas where codigo_usuario=? AND uuid=?", $parametros);
$codigoPartida = 0;

if (isset($resultado) && !($resultado==null)) {
  $resultado->bind_result($codigoPartida);

  if (!$resultado->fetch()) {
    $codigoPartida = 0;
  }

  $resultado->close();
}

if ($codigoPartida <= 0) {
  RetornaErro(400, "Partida não encontrada.");
}

$parametros = array("iiii", $codigoPartida, $dados["fase"], $dados["pontos"], $dados["tempo"]);
execSQL("insert into partida_fases (codigo_partida, fase, datahora, pontos, tempo) values (?, ?, NOW(), ?, ?)", $parametros);

$parametros = array("iiii", $dados["fase"], $dados["pontos"], $dados["tempo"], $codigoPartida);
$sql = "";

if ($dados["fase"] == 9) {
  // Ultima fase  
  $sql = "update partidas set fase=?, pontos=pontos + ?, tempo = tempo + ?, finalizado=1, datahora_fim=NOW() WHERE codigo=?";
} else {  
  $sql = "update partidas set fase=?, pontos=pontos + ?, tempo = tempo + ? WHERE codigo=?";
}

execSQL($sql, $parametros);

$conn_cli->query('COMMIT');

echo 'Pontos salvos com sucesso sucesso';
?>