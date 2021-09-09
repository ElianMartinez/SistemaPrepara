<?php
$peticionAjax = true;
require_once "../core/ConfigGeneral.php";

if (isset($_POST["Nombre1"])) {
   require_once "../controladores/asignaturaControlador.php";
   $insAdmin = new asignaturaControlador();
   
    echo $insAdmin->agregar_asignatura_controlador();

}else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="'.SERVERURL.'login" </script>';
}