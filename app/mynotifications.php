<?php 
require_once("session.php");
require_once("dbConnect.php");
require_once("../config/configuration.php");
$notificaciones=[];
$i=0;
$no_leidas=0;
$query = "SELECT n.id, n.orden, n.fecha, n.titulo, n.notificacion, n.leida FROM notificaciones n INNER JOIN usuarios u on u.id = n.usuario WHERE u.nombre = '".$_SESSION["nombre"]."' ORDER BY n.id ASC;";
try {
    $mysqli = dbConnect::connection();
    $cont=1;
    if(!$mysqli->connect_errno) {
        if($rs = $mysqli->query($query)){
            while($row_ntf = $rs->fetch_assoc()){
                $notificaciones[$i]["id"]=$row_ntf["id"];
                $notificaciones[$i]["fecha"]=$row_ntf["fecha"];
                $notificaciones[$i]["titulo"]=$row_ntf["titulo"];
                $notificaciones[$i]["notificacion"]=$row_ntf["notificacion"];
                $notificaciones[$i]["leida"]=$row_ntf["leida"];
                if($row_ntf["leida"]==0){$no_leidas++;}
                $i++;
            }
        }
    }
    $num_notificaciones=$i;
	$mysqli->close();
} catch (Exception $ex) {
	echo $ex->getMessage();
}
?>