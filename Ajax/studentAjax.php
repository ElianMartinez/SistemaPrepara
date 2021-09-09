<?php
$peticionAjax = true;
require_once "../core/ConfigGeneral.php";


if (isset($_POST['Id']) && isset($_POST['NombreE']) &&  isset($_POST['Edad'])) {
	require_once "../controladores/studentControlador.php";
    $insAdmin = new studentControlador();
   echo $insAdmin->agregar_student_controlador();
   
}

if (isset($_POST['consulta'])) {
    require_once "../controladores/studentControlador.php";
    $insAdmin = new studentControlador();
    echo $insAdmin->student_seccion_controlador($_POST['consulta']);  
}

if (isset($_POST['consulta12'])) {
    require_once "../controladores/studentControlador.php";
    $insAdmin = new studentControlador();
    echo $insAdmin->student_seccion_controlador12($_POST['consulta12']);  
}

if(isset($_POST['grado1'])){
    require_once "../controladores/studentControlador.php";
    $insAdmin = new studentControlador();
    echo $insAdmin->Secciones($_POST['grado1']); 
	 
}

if (isset($_POST['seccion1'])) {
    require_once "../controladores/studentControlador.php";
$insAdmin = new studentControlador();
    echo $insAdmin->Matricular_controlador1($_POST['seccion1']); 
    

}
if (isset($_POST['semestre3']) and isset($_POST['grado3'])) {
  require_once "../controladores/studentControlador.php";
    $insAdmin = new studentControlador();
    echo $insAdmin->Asignatura($_POST["grado3"],$_POST['semestre3']); 
    
   
}

if (isset($_POST["grado4"])) {
     require_once "../controladores/studentControlador.php";
    $insAdmin = new studentControlador();
    echo $insAdmin->calificaciones($_POST["seccion4"],$_POST["grado4"],$_POST["semestre4"],$_POST["asignatura4"],$_POST["anno"]); 
}

if (isset($_POST["E1"])) {
    require_once "../controladores/studentControlador.php";
    $insAdmin = new studentControlador();
    echo $insAdmin->guardar_calificaciones($_POST['Id'],$_POST['E1'],$_POST['E2'],$_POST['E3'],$_POST['E4'],$_POST['PCP'],$_POST['Ex'],$_POST['E30'],$_POST['E70'],$_POST['CFS'],$_POST['C50'],$_POST['CPC50'],$_POST['CPC'],$_POST['CC'],$_POST['Ex30'],$_POST['Pex'],$_POST['Ex70'],$_POST['CEx']);

}
if (isset($_POST['semestre12'])) {
     require_once "../controladores/ActaNotaControlador.php";
    $insAdmin = new actaNotaControlador();
   echo $insAdmin->getActaNota($_POST['Grado'],$_POST['semestre12'],$_POST['anno'],$_POST['seccion']);

}
