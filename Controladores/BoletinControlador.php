<?php
error_reporting(0);
 
 
// Notificar solamente errores de ejecución
 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
 
 
// Mostrar todos los errores menos el E_NOTICE
 
// Valor predeterminado ya descrito en php.ini
 
error_reporting(E_ALL ^ E_NOTICE);
 
 
//Notificar todos los errores de PHP
 
error_reporting(E_ALL);
 
 
// Notificar todos los errores de PHP
error_reporting(-1);
 
 
 
// Lo mismo que error_reporting(E_ALL);
 
ini_set('error_reporting', E_ALL);
     if ($peticionAjax == true) {
        require_once "../core/mainModel.php";
    } else {
       require_once "./core/mainModel.php";
    }


class BoletinControlador extends mainModel {

public function agregar_Boletines($anno,$semestre,$grado,$seccion,$ns){
$Insertados="";
$conexion = mainModel::conectar();
$existe = false;
$sql = "SELECT * FROM `estudiantes` WHERE `Id_Seccion` = '$seccion' and Estatus <> 'Retirado' order by `No_Estudiante` Asc";

    $EstudiantesBus = $conexion->query($sql);
  $Estudia = $EstudiantesBus->fetchAll(); 

  

   foreach ($Estudia as $row1){
     $idee = $row1['Id_Estudiante'];
     

   		$consulta = mainModel::ejecutar_consulta_simple("SELECT * FROM `boletin` WHERE `Grado` = '$grado' and `Semestre` = '$semestre' and `Id_Estudiante` = '$idee' and Anno_Escolar = '$anno' "); 
       
   		if ($consulta->rowCount()>=1) {
  	$existe = true;

   }
   else{
   	
   		$consultaB = mainModel::ejecutar_consulta_simple("INSERT INTO `boletin` (`Id_Estudiante`, `Grado`, `Anno_Escolar`, `Semestre`, `Estado`,`Seccion`) VALUES ('$idee','$grado','$anno','$semestre','activo','$ns')"); 

   			$Insertados .= " <br> #".$row1['No_Estudiante']." ".$row1['Nombre']."";

   		$idBel = mainModel::ejecutar_consulta_simple("SELECT * FROM `boletin` WHERE `Id_Estudiante`= '$idee' and `Grado` = '$grado' and `Semestre` = '$semestre'");

   		foreach ($idBel as $rowss) {
   			
   			$idboletin=$rowss["Id_Boletin"];
   			

   		}

   		$idGra = mainModel::ejecutar_consulta_simple("SELECT * FROM `grado` WHERE `Nombre`='$grado' and `Semestre` = '$semestre'");

  foreach ($idGra as $row) {
  	   $idGrado = $row['Id_Grado'];
  	   
  }


  $asignaturas = $conexion->query("SELECT * FROM `asignaturas` WHERE `Id_Grado` = '$idGrado'");

   		foreach ($asignaturas as $rows) {
   			 $asig = $rows["Codigo"];
   		 $sql1 = "INSERT INTO `calificaciones`( `Asignatura`, `Id_Estudiante`, `E1`, `E2`, `E3`, `E4`, `PCP`, `Examen`, `E30`, `E70`, `CFS`, `C50`, `50CPC`, `CPC`, `CC`, `30E`, `PEx`, `70E`, `CEx`, `Id_Boletin`) VALUES ('$asig',$idee,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,$idboletin)";
   				$estudiantesIB = mainModel::ejecutar_consulta_simple($sql1);
   				
   		}

   


   }


   }

   if ($existe != true) {

   	if ($Insertados!=""){

   	
   	 $Alerta=[
        "Alerta"=>"limpiar1",
        "Titulo"=>"Se ha ingresado Correctamente",
              "Texto"=>"El Registro de boletin a los estudiantes ".$Insertados." Se registro Correctamente",
        "Tipo"=>"success"
         ];

     }else{
     	$Alerta=[
        "Alerta"=>"simple",
        "Titulo"=>"No hay estudiantes en esta sección",
              "Texto"=>"Al parecer no hay estudiantes registrados a esta sección",
        "Tipo"=>"warning"
         ];
     }
   }else
   {
   	  $Alerta=[
        "Alerta"=>"simple",
        "Titulo"=>"Este boletin ya existe",
              "Texto"=>"Al parecer ya este boletin esta registado para esta seccion",
        "Tipo"=>"error"
         ];
   }
   


 
return mainModel::sweet_alert($Alerta);

}
	


	}
