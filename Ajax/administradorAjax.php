<?php
$peticionAjax = true;
require_once "../core/ConfigGeneral.php";

if (isset($_POST["Nombre"])) {
   require_once '../Controladores/administradorControlador.php';
   $insAdmin = new administradorControlador();
   if (isset($_POST["Nombre"]) && isset($_POST["Apellido"])) {
    echo $insAdmin->agregar_administrador_controlador();
}
}else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="'.SERVERURL.'login" </script>';
}