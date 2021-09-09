<?php
$peticionAjax = true;
require_once "../core/ConfigGeneral.php";

if(isset($_GET['token'])) {
   require_once "../Controladores/loginControlador.php";
   $logout = new loginControlador();

   return $logout->cerrar_sesion_controlador();

}else {
    session_start();
    session_destroy();

   echo '<script> window.location.href="'.SERVERURL.'login" </script>';
}