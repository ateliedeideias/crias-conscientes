<?php
// Create connection MySqli
/*$db_local = "localhost";
$db_user = "crias";
$db_passwd = "crias";
$db_nome = "crias";*/

$db_local = "mysql.bonino.com.br";
$db_user = "c2_crias";
$db_passwd = "rh7kSPTq#m2G";
$db_nome = "c2_crias";

$conn_cli = null;
$db_conn_cli = false;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn_cli = new mysqli($db_local, $db_user, $db_passwd, $db_nome);

// Check connection
if ($conn_cli->connect_error) {
  throw new Exception('Erro ao conectar ao banco de dados');
}

$conn_cli->autocommit(FALSE);

function execSQL($txSql, $arrParamsSQL) {
  global $conn_cli;

  $res = $conn_cli->prepare($txSql);
  if ($res) {
    $arrayTempParam=Array();
    for ($d=0; $d<count($arrParamsSQL); $d++) {
      $arrayTempParam[] = &$arrParamsSQL[$d];
    }

    $ref    = new ReflectionClass('mysqli_stmt');
    $method = $ref->getMethod("bind_param");
    if ($method->invokeArgs($res, $arrayTempParam)) {
      $result=$res->execute();

      //$result=$res->get_result();
      if ($result==false) {
        //echo "Erro ao executar SQL.$res->error<br />";
        return null;
      } else {
        return $res;
      }
    } else {
      //echo "Erro ao criar SQL.".$res->error."<br />";
      return null;
    }
  } else {
    //echo "Erro ao preparar SQL".$res->error.".<br />";
    return null;
  }

  //return $ret;
}
?>