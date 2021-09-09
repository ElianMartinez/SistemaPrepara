<?php
$peticionAjax = true;
require_once "../core/ConfigGeneral.php";

if (isset($_POST["valor"])) {
  require_once "../controladores/RecordNotaControlador.php";
  $insAdmin = new RecordNotaControlador();
   echo $insAdmin->Buscar_Estudiante_Controlador($_POST["valor"]);
  

}

if (isset($_POST["id"])) {
	
	require_once "../controladores/RecordNotaControlador.php";
  $insAdmin = new RecordNotaControlador();
  	if ($_POST['Grado'] == "4to") {
  		echo $insAdmin->CrearRecord("1ro",$_POST["id"]);
  		echo $insAdmin->CrearRecord("2do",$_POST["id"]);
  		echo $insAdmin->CrearRecord("3ro",$_POST["id"]);
        echo $insAdmin->CrearRecord("4to",$_POST["id"]);
          
           
            
         

      }elseif ($_POST['Grado'] == "3ro") {
        $tabla .= "<h2>Generar Record 3ro</h2>";
          echo $insAdmin->CrearRecord("1ro",$_POST["id"]);
  		echo $insAdmin->CrearRecord("2do",$_POST["id"]);
  		echo $insAdmin->CrearRecord("3ro",$_POST["id"]);

      }elseif ($_POST['Grado'] == "2do") {
        
       echo $insAdmin->CrearRecord("1ro",$_POST["id"]);
  		echo $insAdmin->CrearRecord("2do",$_POST["id"]);

      }elseif ($_POST['Grado'] == "1ro") {
       echo $insAdmin->CrearRecord("1ro",$_POST["id"]);
      }


   }