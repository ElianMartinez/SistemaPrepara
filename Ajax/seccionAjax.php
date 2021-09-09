<?php
$peticionAjax = true;
require_once "../core/ConfigGeneral.php";

if (isset($_POST["Nombre"])) {
   require_once "../Controladores/seccionControlador.php";
   $ins = new seccionControlador();

   	
    echo $ins->agregar_seccion_controlador();


}else {

    session_start();
    session_destroy();
    echo '<script> window.location.href="'.SERVERURL.'login" </script>';
}