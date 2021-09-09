<?php
$peticionAjax = true;
require_once "../core/ConfigGeneral.php";

if (isset($_POST["grado"]) and isset($_POST["seccion"])) {
  require_once "../controladores/BoletinControlador.php";
   $insAdmin = new BoletinControlador();
   
    echo $insAdmin->agregar_Boletines($_POST['anno'],$_POST['Semestre'],$_POST['grado'],$_POST['seccion'],$_POST['ns1']);
   

}else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="'.SERVERURL.'login" </script>';
}