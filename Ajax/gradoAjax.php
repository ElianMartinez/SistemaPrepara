<?php
$peticionAjax = true;
require_once "../core/ConfigGeneral.php";

if (isset($_POST["Nombre"])) {
   require_once "../controladores/gradoControlador.php";
   $insAdmin = new gradoControlador();
   error_reporting(0);
    echo $insAdmin->agregar_grado_controlador();

}else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="'.SERVERURL.'login" </script>';
}