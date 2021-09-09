<?php 

 if ($peticionAjax == true) {
    require_once "../Modelos/studentModelo.php";

} else {
   require_once "./Modelos/studentModelo.php";
  
}


class actaNotaControlador extends studentModelo{
 
public function getActaNota($Grado,$Semestre,$Anno,$Seccion)
{
	session_start(['name' => 'SEP']);
$annoAc = $_SESSION['Ano_E'];

$tabla ="";

	$tabla .= '<button type="button" style="background-color: green;" class="btn btn-primary btn-raised" onclick="generar_Excel();"><i class="fa fa-file-excel-o" ></i>     Exportar en Excel </button>';

$tabla .= '<button type="button" style="background-color: #ff5733;" class="btn btn-warning btn-raised" onclick=""><i class="fa fa-file-pdf-o" ></i>     Exportar en PDF </button>';
$tabla .= ' 

	<TABLE id="HTMLtoPDF"  BORDER class="table table-hover text-center mytabla">
		<thead style="">
	<TR style="font-size: 15px; background-color: #4365B3; color: white">
	<TH class="text-center" COLSPAN=3><p  >'.$Grado.' '.$Seccion.' '. $Semestre.' '.$Anno.'</p></TH>
	';

		$idGra = mainModel::ejecutar_consulta_simple("SELECT * FROM `grado` WHERE `Nombre`='$Grado' and `Semestre` = '$Semestre'");

  foreach ($idGra as $row) {
       $idGrado = $row['Id_Grado'];
  }


  $Asignaturas = mainModel::ejecutar_consulta_simple("SELECT * FROM `asignaturas` WHERE `Id_Grado` = '$idGrado'");
  $NumAsig = 0;
   foreach($Asignaturas as $rowAs) {
       $NumAsig++;
       $tabla .= '
		<TH class="text-center" COLSPAN=3><p >'.$rowAs["Nombre"].'</p></TH>
		';



  }
  $tabla .= '</TR>
	<TR style="font-size: 13px;" id="sub">
		<TH><p >No</p></TH>
		<TH><p >Apellidos</p></TH> 
		<TH><p >Nombre</p></TH>';
  for ($i=1; $i <= $NumAsig; $i++) { 
  	$tabla .= '
		<TH style="width: 6px;"><p class="vertical">GRAL.</p></TH>
		<TH style="width: 6px;"><p class="vertical">COMPL.</p></TH> 
		<TH style="width: 6px;"><p class="vertical">EXTRAOR.</p></TH>
  	';
  }

if ($annoAc != $Anno) {//revisar si el año es igual al actual para hacer la busqueda completa de todos los estudiantes


$Estudiantes = mainModel::ejecutar_consulta_simple("SELECT t2.Id_Estudiante as Id_Estudiante,  t2.No_Estudiante as No_Estudiante,t2.Nombre as Nombre,`Apellido Paterno`,`Apellido Materno`,t1.Id_Boletin as Id_Boletin FROM boletin as t1, estudiantes as t2 WHERE t1.Seccion = '$Seccion' and t1.Semestre = '$Semestre' and t1.Anno_Escolar = '$Anno' and t1.Id_Estudiante = t2.Id_Estudiante and t1.Grado = '$Grado' ORDER BY `Apellido Paterno` ASC");

}else{

	$Estudiantes = mainModel::ejecutar_consulta_simple("SELECT t2.Id_Estudiante as Id_Estudiante,  t2.No_Estudiante as No_Estudiante,t2.Nombre as Nombre,`Apellido Paterno`,`Apellido Materno`,t1.Id_Boletin as Id_Boletin FROM boletin as t1, estudiantes as t2 WHERE t1.Seccion = '$Seccion' and t1.Semestre = '$Semestre' and t1.Anno_Escolar = '$Anno' and t1.Id_Estudiante = t2.Id_Estudiante and t1.Grado = '$Grado' ORDER BY `No_Estudiante` ASC");

}
$numEs = 0;

if ($Estudiantes->rowCount()>=1) {
  foreach ($Estudiantes as $rowEs) {
	$numEs++;
	$tabla .= '</TR>
	</thead>
	<tbody>
	<TR>
		<TD>'.$numEs.'</TD>
		<TD>'.$rowEs["Apellido Paterno"]." ".$rowEs["Apellido Materno"].'</TD>
		<TD>'.$rowEs["Nombre"].'</TD> 


';
		$Asignaturas = mainModel::ejecutar_consulta_simple("SELECT * FROM `asignaturas` WHERE `Id_Grado` = '$idGrado'");
		$id = $rowEs["Id_Estudiante"];
		
	foreach($Asignaturas as $rowAs) {
		$asig = $rowAs["Codigo"];
		
		$Calificaciones = mainModel::ejecutar_consulta_simple("SELECT t2.CFS as CFS,t2.CC as CC,t2.CEx as CEx FROM estudiantes as t1, calificaciones as t2, boletin as t3 Where t3.Grado = '$Grado'and t3.Anno_Escolar = '$Anno' and t3.Seccion = '$Seccion' and t2.Asignatura = '$asig' and t3.Semestre = '$Semestre' and t2.Id_Boletin = t3.Id_Boletin and t1.Id_Estudiante = t3.Id_Estudiante and t1.Id_Estudiante = '$id' ");
      foreach ($Calificaciones as $key) {
      if ($key["CFS"] > 70 ) {
      	 $tabla .= '
		<TD>'.$key["CFS"].'</TD>
		<TD></TD>
		<TD></TD>
		';
      }elseif ($key["CFS"] != 0 and $key["CEx"] == 0 and $key["CC"] != 0 ) {
      	$tabla .= '
		<TD></TD>
		<TD style="background-color:#F7D358;" >'.$key["CC"].'</TD>
		<TD></TD>
		';
		}elseif ($key["CC"] < 70 and $key["CEx"] != 0) {
			$tabla .= '
		<TD></TD>
		<TD ></TD>
		<TD style="background-color:#F5A9A9;">'.$key["CEx"].'</TD>
		';
		}else{
			$tabla .= '
		<TD></TD>
		<TD></TD>
		<TD></TD>
		';
		}

      }
       

  }

$tabla .= '</TR> ';
}










$tabla .="	</tbody>
</TABLE>
";

echo $tabla;
}else{
	 $Alerta=[
                        "Alerta"=>"atras",
                        "Titulo"=>"No ha encontrado registros",
                        "Texto"=>"No se han encontrado ningún registro en el Año: <b>".$Anno."</b> para <b>".$Grado." ".$Seccion."</b> en el <b>".$Semestre."</b>",
                        "Tipo"=>"error"
                    ]; 
}




if (isset($Alerta)) {
  return mainModel::sweet_alert($Alerta);
}



}



 }