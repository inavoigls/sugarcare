<?php
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["nombre"]!=""){
  header("Location: logout.php");
}
if(isset($_POST['email']) && isset($_POST['password'])){
  if($_POST['email']!="" && $_POST['password'] != ""){
    require_once "app/dbConnect.php";
    $mysqli = dbConnect::connection();
    $query = "SELECT u.id,u.nombre,u.email,u.fechaalta,u.activo,u.grupo,g.grupo as nombregrupo,du.fechanacimiento,du.altura,du.complexion,du.foto 
    FROM USUARIOS as u 
    INNER JOIN grupos_usuarios as gu on gu.id = u.grupo 
    LEFT JOIN datos_usuario du on du.usuario = u.id
    LEFT JOIN grupos_usuarios g on g.id = u.grupo
    WHERE u.email='".$_POST['email']."' and u.password='".md5($_POST['password'])."' and u.activo = 1;";
    try { 
	    if(!$mysqli->connect_errno) {
      if($rs = $mysqli->query($query)){
        if($rs->num_rows!=1){echo "El usuario no existe o está bloqueado. Consulte con el administrador";}
        else {
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
          header("Location: app/main.php");
        }
		  }
	    $mysqli->close();
      }
    } catch (Exception $ex) {
	    echo $ex->getMessage();
    } 
  }
}
?>