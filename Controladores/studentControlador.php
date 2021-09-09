<?php 

 if ($peticionAjax == true) {
    require_once "../Modelos/studentModelo.php";
} else {
   require_once "./Modelos/studentModelo.php";
}


class studentControlador extends studentModelo{
  
public function agregar_student_controlador(){

       $Id = mainModel::limpiar_cadena($_POST["Id"]);
        $Nombre = mainModel::limpiar_cadena($_POST["NombreE"]);
        $ApellidoP = mainModel::limpiar_cadena($_POST["ApellidoP"]);
        $ApellidoM = mainModel::limpiar_cadena($_POST["ApellidoM"]);
        $Apellido = $ApellidoP." ".$ApellidoM;
        $Grado = mainModel::limpiar_cadena($_POST["Grado"]);
        $Seccion = mainModel::limpiar_cadena($_POST["seccion"]);
        $Sexo = mainModel::limpiar_cadena($_POST["Sexo"]);
        $Estatus = mainModel::limpiar_cadena($_POST["Estatus"]);
        $anno = $_POST["anno"];
        $FechaNa = mainModel::limpiar_cadena($_POST["FechaNa"]);
        $Edad = mainModel::limpiar_cadena($_POST["Edad"]);
        if ($Sexo == "M") {
          $Foto = "boy.png";
        }else
        {
          $Foto = "women.png";
        }
       

         $consulta=mainModel::ejecutar_consulta_simple("SELECT * FROM estudiantes Where `Id_Estudiante` = '$Id'");
           if ($consulta->rowCount()>=1) {
            $Alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un Error inesperado",
                "Texto"=>"El  Id <b>".$Id."</b> ya esta registrado a una cuenta porfavor ingrese otro",
                "Tipo"=>"warning"
            ];
           }
            else {
              $consulta=mainModel::ejecutar_consulta_simple("SELECT * FROM estudiantes Where `Nombre` = '$Nombre' and `Apellido Paterno` = '$ApellidoP' And `Apellido Materno` = '$ApellidoM'; ");
           if ($consulta->rowCount()>=1) {
            $Alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un Error inesperado",
                "Texto"=>"El  Nombre <b>".$Nombre."</b> y los Apellidos <b>".$Apellido."</b> ya esta registrado a una cuenta porfavor ingrese otro",
                "Tipo"=>"warning"
            ];
           }else{

               $conexion = mainModel::conectar();
                 $datos = $conexion->query("
                 SELECT * FROM `seccion` WHERE `Id_Seccion` = '$Seccion'");
                 $datos = $datos->fetchAll();
                 foreach ($datos as $rows) {

                  $CapacidadA = $rows['Capacidad'];
                  
                 }

                 $Clave=mainModel::encryption("prepara");
                 $datosAC=[
                       "Usuario"=>$Nombre,
                       "Pass" =>$Clave,
                       "Tipo_Cuenta" => "Estudiante",
                       "Foto" => $Foto,
                       "Nombre_user" => $Nombre." ".$Apellido
                   ];
                   
                   $guardarSt=mainModel::agregar_cuenta($datosAC);
                   if ($guardarSt->rowCount()>=1) {
                       
                       $datosAS = [
                       "Id"=> $Id,
                       "ApellidoP" => $ApellidoP,
                       "ApellidoM" => $ApellidoM,
                       "Nombre" => $Nombre,
                       "Sexo" => $Sexo,
                       "Edad" => $Edad,
                       "Estatus" => $Estatus,
                       "Grado" => $Grado,
                       "Id_Seccion" => $Seccion,
                       "no" => "0",
                       "anno" => $anno

                   ];

                   echo $datosAS['Id'];
                    
                    $guardarStudent = studentModelo::agregar_student_modelo($datosAS); 
                   if ($guardarStudent->rowCount()>=1) {
                        $Alerta=[
                        "Alerta"=>"limpiar1",
                        "Titulo"=>"Se ha ingresado Correctamente",
                        "Texto"=>"Se registro   ".$Nombre." ".$ApellidoP." ".$ApellidoM." ".$Sexo." ".$Grado." ".$anno." ",
                        "Tipo"=>"success"
                    ];
                    $CapacidadA = $CapacidadA - 1;
                    $consulta=mainModel::ejecutar_consulta_simple("UPDATE `seccion` SET `Capacidad`= '$CapacidadA' WHERE Id_Seccion = '$Seccion'");
                   }

                 else {
                     mainModel::eliminiar_Cuenta($Nombre);
                     echo "Se elimino la cuenta ";

                    $Alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"No ha ingresado Correctamente",
                        "Texto"=>"El Registro del administrador no se inserto correctamente en el sistema",
                        "Tipo"=>"error"
                    ]; 
                }

                   }
               
            

           }

         }
                


                
               
                return mainModel::sweet_alert($Alerta);
                     }


public function student_seccion_controlador12($dato){ 
$tabla ="";

    $conexion = mainModel::conectar();

    $datos = $conexion->query("
      SELECT * FROM `seccion` WHERE `Id_Grado` = '$dato'
      ");
    $datos = $datos->fetchAll();

    
      
    

  
                         $tabla.=   '
                                             <div class="btn-group">
                        ';

                        foreach ($datos as $rows) {
                         
                              $tabla.= '<label class="btn btn-info">
                              <input type="radio" required="" value='.$rows["Nombre"].'  name="seccion" onclick="aaaa(this.value);" cautocomplete="off"><b>'.$rows["Nombre"].'</b></label>';
                              }

                            


                                           $tabla.= '
                          
                        
                      </div>
                                                   ';
                                                  

                                                   return $tabla;
      

}
        
       
public function student_seccion_controlador($dato){ 
$tabla ="";

    $conexion = mainModel::conectar();

    $datos = $conexion->query("
      SELECT * FROM `seccion` WHERE `Id_Grado` = '$dato'
      ");
    $datos = $datos->fetchAll();

    
    	
    

  
    							       $tabla.=   '
                                             <div class="btn-group">
												';

    										foreach ($datos as $rows) {
    											if ($rows["Capacidad"] == 0) {
    												$tabla.= '	 <label class="btn btn-danger">
										        	<input type="radio" disabled value='.$rows["Id_Seccion"].'  name="seccion" autocomplete="off"><b> '.$rows["Nombre"].'</b> No Disponible Para estudiantes </label>';
										        	
										        	}else{
    											
										        	$tabla.= '	 <label class="btn btn-info">
										        	<input type="radio"  value='.$rows["Id_Seccion"].'  name="seccion" autocomplete="off"><b> '.$rows["Nombre"].'</b> Disponible Para <b>'.$rows["Capacidad"].'</b>  estudiantes </label>';
										        	}

										        	}


                                           $tabla.= '
													
												
	 										</div>
                                                   ';
                                                  

                                                   return $tabla;
			

}

public function student_seccion_controlador1($dato){ 
$tabla ="";

    $conexion = mainModel::conectar();

    $datos = $conexion->query("
      SELECT * FROM `seccion` WHERE `Id_Grado` = '$dato'
      ");

    $datos = $datos->fetchAll();

    
      
    

  
                         $tabla.=   '
                                             <div class="btn-group">
                        ';

                        foreach ($datos as $rows) {
                          
                              $tabla.= '   <label class="btn btn-info">
                              <input type="radio"  value='.$rows["Id_Seccion"].'  name="seccion" autocomplete="off"> '.$dato.' <b>'.$rows["Nombre"].'</b></label>';
                              }

                              


                                           $tabla.= '
                          
</div>
                                                   ';
                                                  
return $tabla;
      

}


public function Matricular_controlador($dato){
   $conexion = mainModel::conectar();
    $tabla ="";


  $datos = $conexion->query("SELECT * FROM `estudiantes` WHERE `Id_Seccion` = '$dato' and Estatus <> 'Retirado'   and Estatus <> 'Abandono' order by `Apellido Paterno` Asc ");
  $datos = $datos->fetchAll(); 
  $num = 0;
  foreach ($datos as $rows) {
    $num++;
    $nm = $rows["Nombre"];
    $consulta=mainModel::ejecutar_consulta_simple("UPDATE `estudiantes` SET `No_Estudiante`='$num' WHERE `Nombre` = '$nm' ");
  }
   

    $datos = $conexion->query("SELECT * FROM `estudiantes` WHERE `Id_Seccion` = '$dato'  order by `No_Estudiante` Asc ");
  $datos = $datos->fetchAll(); 

    $tabla.='<div class="table-responsive">
                <table class="table table-hover text-center">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      
                      <th class="text-center">Id</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Apellido Paterno</th>
                      <th class="text-center">Grado</th>
                    </tr>
                  </thead>
                  <tbody>';

          $contador=0;
                foreach ($datos as $rows) {
                   $contador++;
                    $tabla.=' 
                    <tr>
                      <td class="">'.$rows['No_Estudiante'].'</td>
                      <td class="">'.$rows['Id_Estudiante'].'</td>
                      <td class="">'.$rows['Nombre'].'</td>
                      <td class="">'.$rows['Apellido Paterno'].'</td>
                      <td class="">'.$rows['Grado'].'</td>
                    </tr>
                           ';
                           
                  }
      
                  $tabla.="</tbody></table></div>";          


    return $tabla;

   }

public function Matricular_controlador1($dato)
{
    $tabla ="";

session_start(['name' => 'SEP']);
$anno = $_SESSION['Ano_E'];
  
   
$conexion1 = mainModel::conectar();
    $datos1 = $conexion1->query("SELECT * FROM `estudiantes` WHERE `Id_Seccion` = '$dato' and `Anno_Escolar` = '$anno' and Estatus <> 'Retirado' and Estatus <> 'Egresado' order by `No_Estudiante` Asc");
  $datos1 = $datos1->fetchAll(); 

    $tabla.='<div class="table-responsive">
                <table class="table table-hover text-center">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      
                      <th class="text-center">Id</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Apellidos</th>
                      <th class="text-center">Grado</th>
                      <th class="text-center">Estatus</th>
                    </tr>
                  </thead>
                  <tbody>';

          $contador=0;
                foreach ($datos1 as $rows) {
                   $contador++;
                   
                   if ($rows['Estatus'] != "Activo") {
                     $tabla.=' 
                    <tr>
                      <td  style="color:red" ondblclick="editar(this);" class="edit">'.$rows['No_Estudiante'].'</td>
                      <td style="color:red" ondblclick="editar(this);" class="edit">'.$rows['Id_Estudiante'].'</td>
                      <td style="color:red" ondblclick="editar(this);" class="edit">'.$rows['Nombre'].'</td>
                      <td style="color:red" ondblclick="editar(this);" class="edit">'.$rows['Apellido Paterno']. " ".$rows['Apellido Materno'].'</td>
                      <td style="color:red"  ondblclick="editar(this);" class="edit">'.$rows['Grado'].'</td>
                      <td style="color:red" ondblclick="editar(this);" class="edit">'.$rows['Estatus'].'</td>
                    </tr>
                           ';
                   }else{
                    $tabla.=' 
                    <tr>
                      <td ondblclick="editar();" class="edit">'.$rows['No_Estudiante'].'</td>
                      <td ondblclick="editar();" class="edit">'.$rows['Id_Estudiante'].'</td>
                      <td ondblclick="editar();" class="edit">'.$rows['Nombre'].'</td>
                      <td  ondblclick="editar();" class="edit">'.$rows['Apellido Paterno']." ".$rows['Apellido Materno'].'</td>
                      <td ondblclick="editar();" class="edit">'.$rows['Grado'].'</td>
                      <td  ondblclick="editar();" class="edit">'.$rows['Estatus'].'</td>
                    </tr>
                           ';
                     }      
                  }
      
                  $tabla.="</tbody></table></div>";          


    return $tabla;

   }

public function Secciones($dato)
{

  $conexion = mainModel::conectar();
    $tabla ="";
  $datos = $conexion->query("SELECT * FROM `seccion` WHERE `Id_Grado` = '$dato'");
  $datos = $datos->fetchAll();
    foreach ($datos as $rows) {
      $tabla .='<div class="animated bounceInDown d"
     onclick="BE(this);" ne='.$rows['Nombre'].' value='.$rows['Id_Seccion'].' id="seccion_'.$rows['Nombre'].'" >
            <div class="dentro">
                <section> '.$dato.' '.$rows['Nombre'].'</section>
            </div>
        </div>
        ';

}

        return $tabla;
}


public function Asignatura($grado,$semestre)
{


      $idGra = mainModel::ejecutar_consulta_simple("SELECT * FROM `grado` WHERE `Nombre`='$grado' and `Semestre` = '$semestre'");

  foreach ($idGra as $row) {
       $idGrado = $row['Id_Grado'];
  }


  $conexion = mainModel::conectar();
    $tabla ="";
  $datos = $conexion->query("SELECT * FROM `asignaturas` WHERE `Id_Grado` = '$idGrado'");
  $datos = $datos->fetchAll();
    foreach ($datos as $rows) {
      $tabla .='<div class="animated bounceInDown asig"
     onclick="TE(this);" codigo='.$rows['Codigo'].'>
            <div class="dentro">
                <section>'.$rows['Nombre'].'</section>


            </div>
        </div>
        ';

}

        return $tabla;
}



public function calificaciones($seccion,$grado,$semestre,$asignatura,$anno){
$tabla = "";

  $tabla .='
<div class="table-responsive">
                <table id="table"  class="table table-hover text-center">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Apellido</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                      <th class="text-center">E1</th>
                      <th class="text-center">E2</th>
                      <th class="text-center">E3</th>
                      <th class="text-center">E4</th>
                      <th class="text-center">PCP</th>
                      <th class="text-center">Ex</th>
                      <th class="text-center">E30</th>
                      <th class="text-center">E70</th>
                      <th  style="background-color:yellow" class="text-center">CFS</th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                      <th class="text-center">C50</th>
                      <th class="text-center">CPC</th>
                      <th class="text-center">50CPC</th>
                      <th  style="background-color:yellow" class="text-center">CC</th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                      <th class="text-center">30E</th>
                      <th class="text-center">PEx</th>
                      <th class="text-center">70E</th>
                      <th style="background-color:yellow" class="text-center">CEx</th>
                      <th class="text-center">Estatus</th>
                    </tr>
                  </thead>
                  <tbody>
              
  ';
session_start(['name' => 'SEP']);
$annoAc = $_SESSION['Ano_E'];


  if ($annoAc != $anno) {
     
          $consulta1 = mainModel::ejecutar_consulta_simple("SELECT t1.Nombre as Nombre, `Apellido Paterno`,`Apellido Materno`, t2.E1 as E1,t2.E2 as E2, t2.E3 as E3,t2.E4 as E4,t2.PCP as PCP,t2.Examen as Examen,t2.E30 as E30,t2.E70 as E70,t2.CFS as CFS,t2.C50 as C50,t2.50CPC as 50CPC,t2.CPC as CPC,t2.CC as CC,t2.30E as 30E,t2.PEx as PEx,t2.70E as 70E,t2.CEx as CEx,t3.Id_Boletin,t2.Id_calificacion as Id_calificacion ,t2.Asignatura FROM estudiantes as t1, calificaciones as t2, boletin as t3 Where t3.Grado = '$grado'and t3.Anno_Escolar = '$anno' and t3.Seccion = '$seccion' and t2.Asignatura = '$asignatura' and t3.Semestre = '$semestre' and t2.Id_Boletin = t3.Id_Boletin and t1.Id_Estudiante = t3.Id_Estudiante ORDER BY `Apellido Paterno` ASC"); 
 //background-color:#FFBF00;
          $numeroE = 0;

          if ($consulta1->rowCount()>=1) {
            
          
          foreach ($consulta1 as $rowCa) {
            
            $numeroE++;
          if ($rowCa['CFS'] == 0 or $rowCa['CFS'] >= 70) {
           $tabla .='
           <tr  style="cursor:pointer; ">
                      <td class="text-center" >'.$numeroE.'</td>
                      <td class="text-center">'.$rowCa["Apellido Paterno"].' '.$rowCa["Apellido Materno"].'</td>
                      <td class="text-center">'.$rowCa["Nombre"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,5,'.$rowCa["Id_calificacion"].');">'.$rowCa["E1"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,6,'.$rowCa["Id_calificacion"].');">'.$rowCa["E2"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,7,'.$rowCa["Id_calificacion"].');">'.$rowCa["E3"].'</td>
                      <td style="background-color:#BDBDBD";   class="text-center" onclick="Veri(this,8,'.$rowCa["Id_calificacion"].');">'.$rowCa["E4"].'</td>
                      <td  class="text-center" >'.$rowCa["PCP"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,10,'.$rowCa["Id_calificacion"].');">'.$rowCa["Examen"].'</td>
                      <td  class="text-center" >'.$rowCa["E30"].'</td>
                      <td  class="text-center">'.$rowCa["E70"].'</td>
                      <td style="background-color:yellow";  class="text-center">'.$rowCa["CFS"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center">'.$rowCa["C50"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,17,'.$rowCa["Id_calificacion"].');" class="text-center ">'.$rowCa["CPC"].'</td>
                      <td  class="text-center">'.$rowCa["50CPC"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CC"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center ">'.$rowCa["30E"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,23,'.$rowCa["Id_calificacion"].');" class="text-center onclick="Veri(this);"">'.$rowCa["PEx"].'</td>
                      <td  class="text-center">'.$rowCa["70E"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CEx"].'</td>

                      <td ; class="text-center" id="Estado">GENERAL</td>
                      </tr>
           ';
              
          }elseif ($rowCa['CFS'] < 70  and $rowCa['C50'] != 0 and $rowCa['30E'] == 0 ) {
                $tabla .='
           <tr  style="cursor:pointer; background-color:#F7D358;">
                      <td class="text-center" >'.$numeroE.'</td>
                      <td class="text-center">'.$rowCa["Apellido Paterno"].' '.$rowCa["Apellido Materno"].'</td>
                      <td class="text-center">'.$rowCa["Nombre"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      
                       <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,5,'.$rowCa["Id_calificacion"].');">'.$rowCa["E1"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,6,'.$rowCa["Id_calificacion"].');">'.$rowCa["E2"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,7,'.$rowCa["Id_calificacion"].');">'.$rowCa["E3"].'</td>
                      <td style="background-color:#BDBDBD";   class="text-center" onclick="Veri(this,8,'.$rowCa["Id_calificacion"].');">'.$rowCa["E4"].'</td>
                      <td  class="text-center" >'.$rowCa["PCP"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,10,'.$rowCa["Id_calificacion"].');">'.$rowCa["Examen"].'</td>
                      <td  class="text-center" >'.$rowCa["E30"].'</td>
                      <td  class="text-center">'.$rowCa["E70"].'</td>
                      <td style="background-color:yellow";  class="text-center">'.$rowCa["CFS"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center">'.$rowCa["C50"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,17,'.$rowCa["Id_calificacion"].');" class="text-center ">'.$rowCa["CPC"].'</td>
                      <td  class="text-center">'.$rowCa["50CPC"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CC"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center ">'.$rowCa["30E"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,23,'.$rowCa["Id_calificacion"].');" class="text-center onclick="Veri(this);"">'.$rowCa["PEx"].'</td>
                      <td  class="text-center">'.$rowCa["70E"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CEx"].'</td>

                      <td ; class="text-center" id="Estado">COMPLETIVO</td>
                      </tr>
           ';
              
          }elseif($rowCa['30E'] != 0 ){
            $tabla .='
           <tr  style="cursor:pointer; background-color:#F5A9A9;">
                      <td class="text-center" >'.$numeroE.'</td>
                      <td class="text-center">'.$rowCa["Apellido Paterno"].' '.$rowCa["Apellido Materno"].'</td>
                      <td class="text-center">'.$rowCa["Nombre"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      
                       <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,5,'.$rowCa["Id_calificacion"].');">'.$rowCa["E1"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,6,'.$rowCa["Id_calificacion"].');">'.$rowCa["E2"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,7,'.$rowCa["Id_calificacion"].');">'.$rowCa["E3"].'</td>
                      <td style="background-color:#BDBDBD";   class="text-center" onclick="Veri(this,8,'.$rowCa["Id_calificacion"].');">'.$rowCa["E4"].'</td>
                      <td  class="text-center" >'.$rowCa["PCP"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,10,'.$rowCa["Id_calificacion"].');">'.$rowCa["Examen"].'</td>
                      <td  class="text-center" >'.$rowCa["E30"].'</td>
                      <td  class="text-center">'.$rowCa["E70"].'</td>
                      <td style="background-color:yellow";  class="text-center">'.$rowCa["CFS"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center">'.$rowCa["C50"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,17,'.$rowCa["Id_calificacion"].');" class="text-center ">'.$rowCa["CPC"].'</td>
                      <td  class="text-center">'.$rowCa["50CPC"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CC"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center ">'.$rowCa["30E"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,23,'.$rowCa["Id_calificacion"].');" class="text-center onclick="Veri(this);"">'.$rowCa["PEx"].'</td>
                      <td  class="text-center">'.$rowCa["70E"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CEx"].'</td>
                      <td ; class="text-center" id="Estado">EXTRAORDINARIO</td>
                      </tr>
           ';
          }else{
            $tabla .='
           <tr  style="cursor:pointer; ">
                      <td class="text-center" >'.$numeroE.'</td>
                      <td class="text-center">'.$rowCa["Apellido Paterno"].' '.$rowCa["Apellido Materno"].'</td>
                      <td class="text-center">'.$rowCa["Nombre"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,5,'.$rowCa["Id_calificacion"].');">'.$rowCa["E1"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,6,'.$rowCa["Id_calificacion"].');">'.$rowCa["E2"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,7,'.$rowCa["Id_calificacion"].');">'.$rowCa["E3"].'</td>
                      <td style="background-color:#BDBDBD";   class="text-center" onclick="Veri(this,8,'.$rowCa["Id_calificacion"].');">'.$rowCa["E4"].'</td>
                      <td  class="text-center" >'.$rowCa["PCP"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,10,'.$rowCa["Id_calificacion"].');">'.$rowCa["Examen"].'</td>
                      <td  class="text-center" >'.$rowCa["E30"].'</td>
                      <td  class="text-center">'.$rowCa["E70"].'</td>
                      <td style="background-color:yellow";  class="text-center">'.$rowCa["CFS"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center">'.$rowCa["C50"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,17,'.$rowCa["Id_calificacion"].');" class="text-center ">'.$rowCa["CPC"].'</td>
                      <td  class="text-center">'.$rowCa["50CPC"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CC"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center ">'.$rowCa["30E"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,23,'.$rowCa["Id_calificacion"].');" class="text-center onclick="Veri(this);"">'.$rowCa["PEx"].'</td>
                      <td  class="text-center">'.$rowCa["70E"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CEx"].'</td>

                      <td ; class="text-center" id="Estado">""</td>
                      </tr>
           ';
          }

        
        }
    }else{
       $Alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"No ha encontrado registros",
                        "Texto"=>"Al parecer no hay notas registradas a este año en esta sección porfavor intente nuevamente darte click al boton ATRAS",
                        "Tipo"=>"error"
                    ]; 
    }

  }else
  {
    $consulta1 = mainModel::ejecutar_consulta_simple("SELECT t1.No_Estudiante as No_Estudiante,t1.Nombre as Nombre, `Apellido Paterno`,`Apellido Materno`, t2.E1 as E1,t2.E2 as E2, t2.E3 as E3,t2.E4 as E4,t2.PCP as PCP,t2.Examen as Examen,t2.E30 as E30,t2.E70 as E70,t2.CFS as CFS,t2.C50 as C50,t2.50CPC as 50CPC,t2.CPC as CPC,t2.CC as CC,t2.30E as 30E,t2.PEx as PEx,t2.70E as 70E,t2.CEx as CEx,t3.Id_Boletin,t2.Id_calificacion as Id_calificacion ,t2.Asignatura FROM estudiantes as t1, calificaciones as t2, boletin as t3 Where t3.Grado = '$grado'and t3.Anno_Escolar = '$annoAc' and t3.Seccion = '$seccion' and t2.Asignatura = '$asignatura' and t3.Semestre = '$semestre' and t2.Id_Boletin = t3.Id_Boletin and t1.Id_Estudiante = t3.Id_Estudiante ORDER BY t1.No_Estudiante ASC"); 
 //background-color:#FFBF00;
          $numeroE = 0;

          if ($consulta1->rowCount()>=1) {
            
          
          foreach ($consulta1 as $rowCa) {
            
            $numeroE++;
          if ($rowCa['CFS'] == 0 or $rowCa['CFS'] >= 70) {
           $tabla .='
           <tr  style="cursor:pointer; ">
                      <td class="text-center" >'.$rowCa["No_Estudiante"].'</td>
                      <td class="text-center">'.$rowCa["Apellido Paterno"].' '.$rowCa["Apellido Materno"].'</td>
                      <td class="text-center">'.$rowCa["Nombre"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,5,'.$rowCa["Id_calificacion"].');">'.$rowCa["E1"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,6,'.$rowCa["Id_calificacion"].');">'.$rowCa["E2"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,7,'.$rowCa["Id_calificacion"].');">'.$rowCa["E3"].'</td>
                      <td style="background-color:#BDBDBD";   class="text-center" onclick="Veri(this,8,'.$rowCa["Id_calificacion"].');">'.$rowCa["E4"].'</td>
                      <td  class="text-center" >'.$rowCa["PCP"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,10,'.$rowCa["Id_calificacion"].');">'.$rowCa["Examen"].'</td>
                      <td  class="text-center" >'.$rowCa["E30"].'</td>
                      <td  class="text-center">'.$rowCa["E70"].'</td>
                      <td style="background-color:yellow";  class="text-center">'.$rowCa["CFS"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center">'.$rowCa["C50"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,17,'.$rowCa["Id_calificacion"].');" class="text-center ">'.$rowCa["CPC"].'</td>
                      <td  class="text-center">'.$rowCa["50CPC"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CC"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center ">'.$rowCa["30E"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,23,'.$rowCa["Id_calificacion"].');" class="text-center onclick="Veri(this);"">'.$rowCa["PEx"].'</td>
                      <td  class="text-center">'.$rowCa["70E"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CEx"].'</td>

                      <td ; class="text-center" id="Estado">GENERAL</td>
                      </tr>
           ';
              
          }elseif ($rowCa['CFS'] < 70  and $rowCa['C50'] != 0 and $rowCa['30E'] == 0 ) {
                $tabla .='
           <tr  style="cursor:pointer; background-color:#F7D358;">
                      <td class="text-center" >'.$rowCa["No_Estudiante"].'</td>
                      <td class="text-center">'.$rowCa["Apellido Paterno"].' '.$rowCa["Apellido Materno"].'</td>
                      <td class="text-center">'.$rowCa["Nombre"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      
                       <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,5,'.$rowCa["Id_calificacion"].');">'.$rowCa["E1"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,6,'.$rowCa["Id_calificacion"].');">'.$rowCa["E2"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,7,'.$rowCa["Id_calificacion"].');">'.$rowCa["E3"].'</td>
                      <td style="background-color:#BDBDBD";   class="text-center" onclick="Veri(this,8,'.$rowCa["Id_calificacion"].');">'.$rowCa["E4"].'</td>
                      <td  class="text-center" >'.$rowCa["PCP"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,10,'.$rowCa["Id_calificacion"].');">'.$rowCa["Examen"].'</td>
                      <td  class="text-center" >'.$rowCa["E30"].'</td>
                      <td  class="text-center">'.$rowCa["E70"].'</td>
                      <td style="background-color:yellow";  class="text-center">'.$rowCa["CFS"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center">'.$rowCa["C50"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,17,'.$rowCa["Id_calificacion"].');" class="text-center ">'.$rowCa["CPC"].'</td>
                      <td  class="text-center">'.$rowCa["50CPC"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CC"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center ">'.$rowCa["30E"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,23,'.$rowCa["Id_calificacion"].');" class="text-center onclick="Veri(this);"">'.$rowCa["PEx"].'</td>
                      <td  class="text-center">'.$rowCa["70E"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CEx"].'</td>

                      <td ; class="text-center" id="Estado">COMPLETIVO</td>
                      </tr>
           ';
              
          }elseif($rowCa['30E'] != 0 ){
            $tabla .='
           <tr  style="cursor:pointer; background-color:#F5A9A9;">
                      <td class="text-center" >'.$rowCa["No_Estudiante"].'</td>
                      <td class="text-center">'.$rowCa["Apellido Paterno"].' '.$rowCa["Apellido Materno"].'</td>
                      <td class="text-center">'.$rowCa["Nombre"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      
                       <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,5,'.$rowCa["Id_calificacion"].');">'.$rowCa["E1"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,6,'.$rowCa["Id_calificacion"].');">'.$rowCa["E2"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,7,'.$rowCa["Id_calificacion"].');">'.$rowCa["E3"].'</td>
                      <td style="background-color:#BDBDBD";   class="text-center" onclick="Veri(this,8,'.$rowCa["Id_calificacion"].');">'.$rowCa["E4"].'</td>
                      <td  class="text-center" >'.$rowCa["PCP"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,10,'.$rowCa["Id_calificacion"].');">'.$rowCa["Examen"].'</td>
                      <td  class="text-center" >'.$rowCa["E30"].'</td>
                      <td  class="text-center">'.$rowCa["E70"].'</td>
                      <td style="background-color:yellow";  class="text-center">'.$rowCa["CFS"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center">'.$rowCa["C50"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,17,'.$rowCa["Id_calificacion"].');" class="text-center ">'.$rowCa["CPC"].'</td>
                      <td  class="text-center">'.$rowCa["50CPC"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CC"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center ">'.$rowCa["30E"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,23,'.$rowCa["Id_calificacion"].');" class="text-center onclick="Veri(this);"">'.$rowCa["PEx"].'</td>
                      <td  class="text-center">'.$rowCa["70E"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CEx"].'</td>
                      <td ; class="text-center" id="Estado">EXTRAORDINARIO</td>
                      </tr>
           ';
          }else{
            $tabla .='
           <tr  style="cursor:pointer; ">
                      <td class="text-center" >'.$rowCa["No_Estudiante"].'</td>
                      <td class="text-center">'.$rowCa["Apellido Paterno"].' '.$rowCa["Apellido Materno"].'</td>
                      <td class="text-center">'.$rowCa["Nombre"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,5,'.$rowCa["Id_calificacion"].');">'.$rowCa["E1"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,6,'.$rowCa["Id_calificacion"].');">'.$rowCa["E2"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,7,'.$rowCa["Id_calificacion"].');">'.$rowCa["E3"].'</td>
                      <td style="background-color:#BDBDBD";   class="text-center" onclick="Veri(this,8,'.$rowCa["Id_calificacion"].');">'.$rowCa["E4"].'</td>
                      <td  class="text-center" >'.$rowCa["PCP"].'</td>
                      <td style="background-color:#BDBDBD"; class="text-center" onclick="Veri(this,10,'.$rowCa["Id_calificacion"].');">'.$rowCa["Examen"].'</td>
                      <td  class="text-center" >'.$rowCa["E30"].'</td>
                      <td  class="text-center">'.$rowCa["E70"].'</td>
                      <td style="background-color:yellow";  class="text-center">'.$rowCa["CFS"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center">'.$rowCa["C50"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,17,'.$rowCa["Id_calificacion"].');" class="text-center ">'.$rowCa["CPC"].'</td>
                      <td  class="text-center">'.$rowCa["50CPC"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CC"].'</td>
                      <td  class="text-center"></td>
                      <td  class="text-center"></td>
                      <td  class="text-center ">'.$rowCa["30E"].'</td>
                      <td style="background-color:#BDBDBD"; onclick="Veri(this,23,'.$rowCa["Id_calificacion"].');" class="text-center onclick="Veri(this);"">'.$rowCa["PEx"].'</td>
                      <td  class="text-center">'.$rowCa["70E"].'</td>
                      <td style="background-color:yellow"; class="text-center">'.$rowCa["CEx"].'</td>

                      <td ; class="text-center" id="Estado">""</td>
                      </tr>
           ';
          }

        
        }
    }else{
       $Alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"No ha encontrado registros",
                        "Texto"=>"Todavia no ha insertado los boletines a esta sección porfavor dirijase al modulo de notas y entre a boletines y inserte el boletin al grado correspondiente",
                        "Tipo"=>"error"
                    ]; 
    }

  }
          

        
$tabla.= "</tbody>
</table>
";


echo $tabla;
if (isset($Alerta)) {
  return mainModel::sweet_alert($Alerta);
}

}

public function guardar_calificaciones($id,$E1,$E2,$E3,$E4,$PCP,$Ex,$E30,$E70,$CFS,$C50,$CPC,$CPC50,$CC,$Ex30,$PEx,$Ex70,$CEx){
 
  $consulta=mainModel::ejecutar_consulta_simple("UPDATE `calificaciones` SET `E1`='$E1',`E2`='$E2',`E3`='$E3',`E4`='$E4',`PCP`='$PCP',`Examen`='$Ex',`E30`='$E30',`E70`='$E70',`CFS`='$CFS',`C50`='$C50',`50CPC`='$CPC50',`CPC`='$CPC',`CC`='$CC',`30E`='$Ex30',`PEx`='$PEx',`70E`='$Ex70',`CEx`='$CEx' WHERE `Id_calificacion` = '$id'");


}


}
