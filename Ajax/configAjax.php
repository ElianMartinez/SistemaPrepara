<?php
$peticionAjax = true;
require_once "../core/ConfigGeneral.php";

if (isset($_POST["ano"])) {
   require_once "../controladores/configControlador.php";
   $insAdmin = new configControlador();
    echo $insAdmin->config1Controlador();
    echo "<script> location.reload();</script>";
   
}else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="'.SERVERURL.'login" </script>';
}