<?php 

 if ($peticionAjax == true) {
    require_once "../Modelos/RecordNotaModelo.php";
} else {
   require_once "./Modelos/RecordNotaModelo.php";
}

class RecordNotaControlador extends RecordNotaModelo{
public function agregar_RecordNota_Controlador($Asignatura,$Nota,$Fecha,$Centro,$IDBoletin){

                    
                   
                   $guardarCuenta=mainModel::ejecutar_consulta_simple("INSERT INTO `record_nota`(`Asignatura`, `Nota`,`Fecha`,`Centro`,`Id_boletin`) VALUES ('$Asignatura','$Nota','$Fecha','$Centro','$IDBoletin')");
                   if ($guardarCuenta->rowCount()>=1) {
                     
                     
                   }else{
                    $consulta=mainModel::ejecutar_consulta_simple("DELETE FROM record_nota where Id_boletin = '$IDBoletins'");
                    

                   }

}

public function Buscar_Estudiante_Controlador($valor){

   $tabla = "";
   $tabla = '<div class="table-responsive">
                <table class="table table-hover text-center">
                  <thead>
                    <tr>
                      <th onclick="toggle();" class="text-center">Id</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Apellido</th>
                      <th class="text-center">Grado</th>
                      <th class="text-center">Sección</th>
                      <th class="text-center">Editar</th>
                    </tr>
                  </thead>
                  <tbody>';
        
     $consulta=mainModel::ejecutar_consulta_simple(" SELECT * FROM `estudiantes` WHERE `Id_Estudiante` LIKE '%$valor%' OR `Apellido Paterno` LIKE '%$valor%' OR `Apellido Materno` LIKE '%$valor%' OR `Nombre` LIKE '%$valor%' LIMIT 10");
           if ($consulta->rowCount()>=1) {
              foreach ($consulta as $row) {
               $tabla .='<tr>
                      <td>'.$row["Id_Estudiante"].'</td>
                      <td>'.$row["Nombre"].'</td>
                      <td>'.$row["Apellido Paterno"]." ".$row["Apellido Materno"].'</td>
                      <td>'.$row["Grado"].'</td>
                      <td>'.$row["Id_Seccion"].'</td>
                      <td ><a onclick="ocultarForm(); buscar_record(this)" idE="'.$row["Id_Estudiante"].'" grado="'.$row["Grado"].'" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                      
                    </tr>'; 
              }
              


           }else{
                $tabla .='
                      <td>No hay datos disponobles</td>
                    
                      
                    '; 
              }

              $tabla .=' </tbody></table></div>';

              return $tabla;
 



}
  
 


 public function CrearRecord($grado,$id){
    $idB_Primer = 0;
    $idB_Segundo = 0;
    $record ="";
$record .="<div style='display:flex;'>";
     $consultaP=mainModel::ejecutar_consulta_simple("SELECT * FROM `boletin` WHERE `Id_Estudiante` = '$id' and `Grado` = '$grado' AND Semestre = 'Primer'"); 

     if ($consultaP->rowCount()>=1) {
       foreach ($consultaP as $row) {
        $idB_Primer = $row['Id_Boletin'];
        }
        if (isset($idB_Primer)) {
          $confirmarB=mainModel::ejecutar_consulta_simple("SELECT * FROM `record_nota` WHERE `Id_boletin` = '$idB_Primer'");
   if ($confirmarB->rowCount()>=1) {
    //primer semestre  tiene boletin
    $record.= self::buscarRecordNota1($id,$grado,$idB_Primer);
    }else{

    $CaliP=mainModel::ejecutar_consulta_simple("SELECT t3.Estado,t1.CFS as CFS,t1.CC as CC,t1.CEx as CEx,t2.Nombre,t3.Seccion,t3.Anno_Escolar FROM calificaciones as t1, asignaturas as t2, boletin as t3  WHERE t1.Id_Boletin = '$idB_Primer' and t2.Codigo = t1.Asignatura and t1.Id_Boletin = t3.Id_Boletin");
      foreach ($CaliP as $row1)
       {

        $centro = $row1["Estado"];
        if ($centro  == "activo") {
        $centro="PREPARA ESCUELA REPÚBLICA DE PERÚ";
       }
          RecordNotaControlador::agregar_RecordNota_Controlador($row1["Nombre"],$row1["CFS"],"",$centro,$idB_Primer);
       
       
       }
       $record.= self::buscarRecordNota1($id,$grado,$idB_Primer);
           }  
      
      }  else{
        $Alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"No se encontraron Registros para el Primer Semstre",
                "Texto"=>"Todavia no se han registrado los boletines del Primer Semestre, Porfavor dirijase a boletines en el modulo de notas",
                "Tipo"=>"warning"
            ];
      }




      $consultaS=mainModel::ejecutar_consulta_simple("SELECT * FROM `boletin` WHERE `Id_Estudiante` = '$id' and `Grado` = '$grado' AND Semestre = 'Segundo'");

     if ($consultaS->rowCount()>=1) {

       foreach ($consultaS as $row) {
        $idB_Segundo = $row['Id_Boletin'];
        
      }
      if (isset($idB_Segundo)) {
$confirmarA=mainModel::ejecutar_consulta_simple("SELECT * FROM `record_nota` WHERE `Id_boletin` = '$idB_Segundo'");
   
   if ($confirmarA->rowCount()>=1) {
    //segundo semestre  tiene boletin
   $record.= self::buscarRecordNota2($id,$grado,$idB_Segundo);
    
 }
   else{

  
    $CaliP=mainModel::ejecutar_consulta_simple("SELECT t3.Estado,t1.CFS as CFS,t1.CC as CC,t1.CEx as CEx,t2.Nombre,t3.Seccion,t3.Anno_Escolar FROM calificaciones as t1, asignaturas as t2, boletin as t3  WHERE t1.Id_Boletin = '$idB_Segundo' and t2.Codigo = t1.Asignatura and t1.Id_Boletin = t3.Id_Boletin");
      foreach ($CaliP as $row1)
       {
        $nota = 0;
         if ($row1["CFS"] > 70 ) {
          $nota = $row1["CFS"];

      }elseif ($row1["CFS"] != 0 and $row1["CEx"] == 0 and $row1["CC"] != 0 ) {
      $nota = $row1["CC"];
      }elseif ($row1["CC"] < 70 and $row1["CEx"] != 0) {
      $nota = $row1["CEx"];
      }else{
        $nota =0;
    }
        
        $centro = $row1["Estado"];
        if ($centro  == "activo") {
        $centro="PREPARA ESCUELA REPÚBLICA DE PERÚ";
       }
         RecordNotaControlador::agregar_RecordNota_Controlador($row1["Nombre"],$nota,"",$centro,$idB_Segundo);
      

         
       }
       $record.= self::buscarRecordNota2($id,$grado,$idB_Segundo);
       


   }
      }else{
        $Alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"No se encontraron Registros para el Segundo Semstre",
                "Texto"=>"Todavia no se han registrado los boletines del Segundo Semestre, Porfavor dirijase a boletines en el modulo de notas",
                "Tipo"=>"warning"
            ];
      }

      }


$record .="</div>";

   
      echo $record;
   
  


}

 


if (isset($Alerta)) {
  return mainModel::sweet_alert($Alerta);
}



 } 

  public function buscarRecordNota2($id,$grado,$idB_Segundo)
 {
  $record = "";
  $confirmarA=mainModel::ejecutar_consulta_simple("SELECT * FROM `record_nota` WHERE `Id_boletin` = '$idB_Segundo'");
  $consultaS=mainModel::ejecutar_consulta_simple("SELECT * FROM `boletin` WHERE `Id_Estudiante` = '$id' and `Grado` = '$grado' AND Semestre = 'Segundo'");
  $CaliP=mainModel::ejecutar_consulta_simple("SELECT t1.CFS as CFS,t1.CC as CC,t1.CEx as CEx,t2.Nombre,t3.Seccion,t3.Anno_Escolar FROM calificaciones as t1, asignaturas as t2, boletin as t3  WHERE t1.Id_Boletin = '$idB_Segundo' and t2.Codigo = t1.Asignatura and t1.Id_Boletin = t3.Id_Boletin");
  $anno = "";
 foreach ($CaliP as $row3) {$anno = $row3["Anno_Escolar"];}
 $Seccion = "";
 $CaliP=mainModel::ejecutar_consulta_simple("SELECT t3.Estado,t1.CFS as CFS,t1.CC as CC,t1.CEx as CEx,t2.Nombre,t3.Seccion,t3.Anno_Escolar FROM calificaciones as t1, asignaturas as t2, boletin as t3  WHERE t1.Id_Boletin = '$idB_Segundo' and t2.Codigo = t1.Asignatura and t1.Id_Boletin = t3.Id_Boletin");
 $centro = "";
 foreach ($CaliP as $row1) {$Seccion = $row1["Seccion"];
          $centro = $row1["Estado"];
}
 $record .= '
<div style="class="record-2"> <div  style="width:550px;" class="table-responsive">
<table  border="" class="table table-hover">
<thead>
    <tr style="font-size:18px ">
      <th class="text-center" colspan="6">'.$grado.' GRADO '.$anno.'   SEC.:'.$Seccion.'  SEGUNDO SEMESTRE</th>
    </tr>
    <tr style="font-size:15px;">
      <th class="text-center">ASIGNATURAS SEGUNDO SEMESTRE</th>
      <th class="text-center">Nota</th>
      <th class="text-center">Fecha</th>
      <th class="text-center">Editar</th>
    </tr>
  </thead>
  <tbody>';

foreach ($confirmarA as $row) {
$record .= ' <tr style="font-size:13px;" > 
<td>'.$row["Asignatura"].'</td>
<td>'.$row["Nota"].'</td>
<td><input type="text" value="'.$row["Fecha"].'"></td>
      <td ><a href="#!" class="btn btn-success btn-raised btn-xs"><i idRN="'.$row["Id"].'" onclick="" class="zmdi zmdi-refresh"></i></a></td>

</tr>'; 
}
if ($centro  == "activo"){
$record .='<tr > <td colspan="3">Centro Educativo: <input style="width="80px";" type="text" placehoder="" value="PREPARA ESCUELA REPÚBLICA DE PERÚ"></td></tr>';
}else{
$record .='<tr ><td colspan="3">Centro Educativo: <input type="text" placehoder="" value='.$centro.'></td></tr>';
}
$record .='
<tr ><td colspan="3">Ordenanza <input type="text" placehoder="" value=""></td></tr>

';

$record .="</tbody></table></div> <button class='btn btn-success'></button> </div>";

return $record;
 }


 public function buscarRecordNota1($id,$grado,$idB_Primer){
   $record = "";
  $confirmarB=mainModel::ejecutar_consulta_simple("SELECT * FROM `record_nota` WHERE `Id_boletin` = '$idB_Primer'");
  $consultaP=mainModel::ejecutar_consulta_simple("SELECT * FROM `boletin` WHERE `Id_Estudiante` = '$id' and `Grado` = '$grado' AND Semestre = 'Primer'");
  $CaliP=mainModel::ejecutar_consulta_simple("SELECT t1.CFS as CFS,t1.CC as CC,t1.CEx as CEx,t2.Nombre,t3.Seccion,t3.Anno_Escolar FROM calificaciones as t1, asignaturas as t2, boletin as t3  WHERE t1.Id_Boletin = '$idB_Primer' and t2.Codigo = t1.Asignatura and t1.Id_Boletin = t3.Id_Boletin");
                  $anno = "";
                 foreach ($CaliP as $row3) {$anno = $row3["Anno_Escolar"];}
                 $Seccion = "";
                 $CaliP=mainModel::ejecutar_consulta_simple("SELECT t3.Estado,t1.CFS as CFS,t1.CC as CC,t1.CEx as CEx,t2.Nombre,t3.Seccion,t3.Anno_Escolar FROM calificaciones as t1, asignaturas as t2, boletin as t3  WHERE t1.Id_Boletin = '$idB_Primer' and t2.Codigo = t1.Asignatura and t1.Id_Boletin = t3.Id_Boletin");
                 $centro = "";
                 foreach ($CaliP as $row1) {$Seccion = $row1["Seccion"];
                          $centro = $row1["Estado"];
               }
                 $record .= '
                <div class="record-1"> <div  style=" width:550px;">

                <table  border="" class="table table-hover ">
                <thead>
                    <tr style="font-size:18px ">
                      <th class="text-center" colspan="6">'.$grado.' GRADO '.$anno.'   SEC.:'.$Seccion.' PRIMER SEMESTRE</th>
                    </tr>
                    <tr style="font-size:15px;">
                      <th class="text-center">ASIGNATURAS PRIMER SEMESTRE</th>
                      <th class="text-center">Nota</th>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">Editar</th>
                    </tr>
                  </thead>
                  <tbody>';

    foreach ($confirmarB as $row) {
      $record .= ' <tr style="font-size:13px;" > 
       <td>'.$row["Asignatura"].'</td>
       <td>'.$row["Nota"].'</td>
       <td><input type="text" value="'.$row["Fecha"].'"></td>
       <td ><a href="#!" class="btn btn-success btn-raised btn-xs"><i idRN="'.$row["Id"].'" class="zmdi zmdi-refresh"></i></a></td>
       </tr>'; 

    }
     if ($centro  == "activo") {
         $record .='<tr ><td colspan="3">Centro Educativo <input type="text" placehoder="" value="PREPARA ESCUELA REPÚBLICA DE PERÚ"></td></tr>';
       }else{
           $record .='<tr ><td colspan="3">Centro Educativo <input type="text" placehoder="" value='.$centro.'></td></tr>';
        }
 $record .='
         <tr ><td colspan="3">Ordenanza <input type="text" placehoder="" value=""></td></tr>
         
      ';
$record .="</tbody></table></div> 
<button class=''></button>
</div>";

   return $record;
 }

}


//clase

