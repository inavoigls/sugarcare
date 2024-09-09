<?php
require_once "session.php";
require_once "../config/configuration.php";
require_once "dbConnect.php";
if((isset($_GET["user"]) && $_GET["user"]!="") || $_GET["medicalview"]=="false"){
    $mysqli = dbConnect::connection();
    if($_GET["medicalview"]=="true"){
        $_SESSION["medicalview"]=true;
        $_SESSION["prevuser"]=$_SESSION["id"];
        $query = "SELECT u.id,u.nombre,u.email,u.fechaalta,u.activo,u.grupo,g.grupo as nombregrupo,du.fechanacimiento,du.altura,du.complexion,du.foto 
                FROM USUARIOS as u 
                INNER JOIN grupos_usuarios as gu on gu.id = u.grupo 
                LEFT JOIN datos_usuario du on du.usuario = u.id
                LEFT JOIN grupos_usuarios g on g.id = u.grupo
                WHERE u.id='".$_GET["user"]."';";
    }
    if($_GET["medicalview"]=="false"){
        $query = "SELECT u.id,u.nombre,u.email,u.fechaalta,u.activo,u.grupo,g.grupo as nombregrupo,du.fechanacimiento,du.altura,du.complexion,du.foto 
                FROM USUARIOS as u 
                INNER JOIN grupos_usuarios as gu on gu.id = u.grupo 
                LEFT JOIN datos_usuario du on du.usuario = u.id
                LEFT JOIN grupos_usuarios g on g.id = u.grupo
                WHERE u.id='".$_SESSION["prevuser"]."';";
        unset($_SESSION["medicalview"],$_SESSION["prevuser"]);
    }
    try { 
	    if(!$mysqli->connect_errno) {
      if($rs = $mysqli->query($query)){
        if($rs->num_rows!=1){echo "El usuario no existe o está bloqueado. Consulte con el administrador";}
        else {
          unset($_SESSION["id"],$_SESSION["nombre"],$_SESSION["email"],$_SESSION["fechaalta"],$_SESSION["idgrupo"],$_SESSION["grupo"],$_SESSION["fecha_nacimiento"],$_SESSION["altura"],$_SESSION["complexion"],$_SESSION["foto"]);
          $row = $rs->fetch_assoc();
          $_SESSION["id"] = $row["id"];
          $_SESSION["nombre"] = $row["nombre"];
          $_SESSION["email"] = $row["email"];
          $_SESSION["fechaalta"] = $row["email"];
          $_SESSION["idgrupo"] = $row["grupo"];
          $_SESSION["grupo"] = $row["nombregrupo"];
          $_SESSION["fecha_nacimiento"] = $row["fechanacimiento"];
          $_SESSION["altura"] = $row["altura"];
          $_SESSION["complexion"] = $row["complexion"];
          $_SESSION["foto"] = $row["foto"];
          header("Location: main.php");
        }
	    }
	    $mysqli->close();
      }
    } catch (Exception $ex) {
	    echo $ex->getMessage();
    } 
} else {header("Location: patients.php");}
?>