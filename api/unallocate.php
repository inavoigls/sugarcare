<?php
require_once "../config/configuration.php";
require_once "../app/dbConnect.php";
//echo $_GET["key"];
$user=base64_decode($_GET["key"]);
$user=explode('_',$user);
$medico = $user[1];
$user = $user[2];
$mysqli = dbConnect::connection();
$query = "DELETE FROM usuarios_medicos WHERE usuario=$user AND medico=$medico";
try {
  if(!$mysqli->connect_errno) {$rs = $mysqli->query($query);}
  $mysqli->close();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
header("Location: ../app/main.php");
?>