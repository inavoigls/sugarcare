<?php
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["nombre"]!=""){
    return true;
} else {
    header("Location: logout.php");
}
?>