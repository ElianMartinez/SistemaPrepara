<?php
$peticionAjax = true;
require_once "../core/ConfigGeneral.php";
if (isset($_POST['seccion'])) {
	require_once "../controladores/studentControlador.php";
    $insAdmin = new studentControlador();
    echo $insAdmin->Matricular_controlador($_POST['seccion']);  

}
if (isset($_POST['consulta'])) {
	require_once "../controladores/studentControlador.php";
    $insAdmin = new studentControlador();
    echo $insAdmin->student_seccion_controlador1($_POST['consulta']);  
}