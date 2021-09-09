<?php 

 if ($peticionAjax == true) {
    require_once "../Modelos/asignaturaModelo.php";
} else {
   require_once "./Modelos/asignaturaModelo.php";
}

class asignaturaControlador extends asignaturaModelo{

public function agregar_asignatura_controlador(){
	$Nombre = mainModel::limpiar_cadena($_POST["Nombre1"]);
	$Profesor = $_POST["Profesor"];
	$Grado = $_POST["Grado"];
	$Codigo = $_POST["Codigo"];

	 $consulta=mainModel::ejecutar_consulta_simple("SELECT * FROM asignaturas WHERE Codigo = '$Codigo'");
 if ($consulta->rowCount()>=1) {
	 $Alerta=[
        "Alerta"=>"simple",
        "Titulo"=>"Ya esta registrado",
        "Texto"=>"Ya este Codigo esta registrado porfavor ingrese otro",
                        "Tipo"=>"warning"
                    ];
}else{

	$datos=[
	 	"Nombre"=>$Nombre,
	 	"Id_Profesor"=>$Profesor,
	 	"Id_Grado"=>$Grado,
	 	"Codigo"=>$Codigo
	 ];

	 $guardarAsig=asignaturaModelo::agregar_asignatura_modelo($datos);
	 if ($guardarAsig->rowCount()>=1) {
                    $Alerta=[
                        "Alerta"=>"limpiar",
                        "Titulo"=>"Se ha ingresado Correctamente",
                        "Texto"=>"El Registro se inserto correctamente en el sistema",
                        "Tipo"=>"success"
                    ];
                   }
                 else {
                 	$Alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Se ha producido un error",
                        "Texto"=>"El Registro no se inserto correctamente en el sistema; Porfavor recarge la página",
                        "Tipo"=>"error"
                    ];
                 }
             }

             return mainModel::sweet_alert($Alerta);

} 



public function combobox_controlador(){


    $tabla ="";

    $conexion1 = mainModel::conectar();

    $datos1 = $conexion1->query("
      SELECT * FROM `profesores` 
      ");

    $conexion2 = mainModel::conectar();

    $datos2 = $conexion2->query("
      SELECT * FROM `grado`
      ");

    $datos1 = $datos1->fetchAll();

    $datos2 = $datos2->fetchAll();


    											$tabla.='
                                               
									    	
											<div class="form-group">
										      <label  class="">Profesor</label>
										        <select id="Profesor" name="Profesor" class="form-control">';
										          foreach ($datos1 as $rows) {
										        		$tabla.= '<option value= "'.$rows["Id_Profesor"].'">';
										        		$tabla.= $rows["Nombre"].' '.$rows["Apellido"];
										        		$tabla.= '</option>';
										        	}

										    $tabla.= '</select>
										    </div>';

										  $tabla.= '  <div class="form-group col-md-6">
										      <label class="">Año Escolar</label>
										        <select id="Anno" name="Anno" class="form-control">
										          <option value="1819">18-19</option>
										          <option value="1920">19-20</option>
										        </select>
										    </div>

										    <div class="form-group col-md-6">
										      <label class="">Semestre</label>
										        <select id="Semestre" name="Semestre" class="form-control">
										          <option value="1">Primer</option>
										          <option value="2">Segundo</option>
										        </select>
										    </div>

										    <div class="form-group col-md-6">
										      <label class="">Grado</label>
										        <select name="Grado" id="Grado" class="form-control">';
										          
										       foreach ($datos2 as $rows) {
										        		$tabla.= '<option value="'.$rows["Id_Grado"].'">';
										        		$tabla.= $rows["Nombre"];
										        		$tabla.= '</option>';
										        	}

										   $tabla.= '</select>
										    </div>

										    

										    <div class="form-group col-md-3">
											  <label class="">Codigo de Asignatura</label>
											  <input required="" name="Codigo" id="Codigo"  class="form-control" type="text">
											  
											</div>
											';


											return $tabla;

}



public function paginador_asignatura_controlador(){
   $conexion = mainModel::conectar();
    $tabla ="";


   $datos = $conexion->query("SELECT t1.Nombre,t1.Codigo,t2.Nombre as Grado,t2.Semestre as Semestre, t3.Nombre as Profesor FROM asignaturas as t1, grado as t2, profesores as t3 Where t1.Id_Grado = t2.Id_Grado and t1.Id_Profesor = t3.Id_Profesor ");
    
     $datos = $datos->fetchAll(); 
   

    $tabla.='<div class="table-responsive">
                <table class="table table-hover text-center">
                  <thead>
                    <tr>
                      <th onclick="toggle();" class="text-center">#</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Codigo</th>
                      <th class="text-center">Grado</th>
                      <th class="text-center">Semestre</th>
                      <th class="text-center">Profesor</th>
                     
                      <th class="text-center">Update</th>
                      <th class="text-center">Delete</th>
                    </tr>
                  </thead>
                  <tbody>';

   				$contador=0;
                foreach ($datos as $rows) {
                	 $contador++;
                    $tabla.=' 
                    <tr>
                      <td class="togg'.$rows['Grado'].$rows['Semestre'].'">'.$contador.'</td>
                      <td class="togg'.$rows['Grado'].$rows['Semestre'].'">'.$rows['Nombre'].'</td>
                      <td class="togg'.$rows['Grado'].$rows['Semestre'].'">'.$rows['Codigo'].'</td>
                      <td class="togg'.$rows['Grado'].$rows['Semestre'].'">'.$rows['Grado'].'</td>
                      <td class="togg'.$rows['Grado'].$rows['Semestre'].'">'.$rows['Semestre'].'</td>
                      <td class="togg'.$rows['Grado'].$rows['Semestre'].'">'.$rows['Profesor'].'</td>
                     
                      <td class="togg'.$rows['Grado'].$rows['Semestre'].'"><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                      <td class="togg'.$rows['Grado'].$rows['Semestre'].'"><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
                    </tr>
                           ';
                           
                  }
      
                  $tabla.="</tbody></table></div>";          


    return $tabla;

   }

}
