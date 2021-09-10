<?php
require_once 'utils/habilita-cors.php';
//require_once 'utils/funcoes.php';
//require_once 'utils/manipula-post.php';
require_once 'utils/mysql.php';

$fase = null;
$params = $_SERVER["QUERY_STRING"];
$sql = "";

if ($params != null ) {
  $fase = str_replace("fase=", "", $params);
} 

$params = array();

if ($fase != null && $fase > 0) {
  $params = array("i", $fase);
  $sql = 
  "select u.apelido, f.datahora, p.personagem, f.pontos, f.tempo 
  from partidas p, partida_fases f, usuarios u 
  where f.codigo_partida = p.codigo
    and f.fase = ?
    and u.codigo = p.codigo_usuario 
  order by f.pontos desc, f.tempo limit 10";  
}
else {
  $params = array("i", 1);
  $sql = 
  "select u.apelido, p.datahora_fim, p.personagem, p.pontos, p.tempo 
  from partidas p, usuarios u 
  where p.finalizado = 1 and u.codigo = p.codigo_usuario and 1=? 
  order by p.pontos desc, p.tempo limit 10";  
}

$resultado = execSQL($sql, $params);

$resultadoPlacar = array();

if (isset($resultado) && !($resultado==null)) {
  $resultado->bind_result($apelido, $datahora_fim, $personagem, $pontos, $tempo);

  while ($resultado->fetch()) {
    array_push($resultadoPlacar, array('apelido' => $apelido, 'data' => $datahora_fim, 'personagem' => $personagem, 'pontos' => $pontos, 'tempo' => $tempo));    
  }

  $resultado->close();
}

echo json_encode($resultadoPlacar);
