<?php 

 if ($peticionAjax == true) {
    require_once "../Modelos/gradoModel.php";
} else {
   require_once "./Modelos/gradoModel.php";
}

class gradoControlador extends gradoModelo{

public function agregar_grado_controlador(){
	 $Nombre = mainModel::limpiar_cadena($_POST["Nombre"]);
	 $Semestre = $_POST["Semestre"];
	 $anno = $_POST["anno"];

$consulta=mainModel::ejecutar_consulta_simple("SELECT * FROM grado WHERE Nombre ='$Nombre' AND Semestre ='$Semestre' AND Anno_Escolar='$anno'");
 if ($consulta->rowCount()>=1) {
	 $Alerta=[
        "Alerta"=>"simple",
        "Titulo"=>"Ya esta registrado",
        "Texto"=>"Ya este Grado esta registrado porfavor ingrese otro",
                        "Tipo"=>"warning"
                    ];
}else{
	$datos=[
	 	"Nombre"=>$Nombre,
	 	"Semestre"=>$Semestre,
	 	"Anno"=>$anno,
	 	"A1"=>$_POST['A1'],
	 	"A2"=>$_POST['A2'],
	 	"A3"=>$_POST['A3'],
	 	"A4"=>$_POST['A4'],
	 	"A5"=>$_POST['A5'],
	 	"A6"=>$_POST['A6'],
	 	"A7"=>$_POST['A7'],
	 	"A8"=>$_POST['A8'],
	 	"A9"=>$_POST['A9'],
	 	"A10"=>$_POST['A10'],
	 	"A11"=>$_POST['A11'],
	 	"A12"=>$_POST['A12']
	 ];

	 $guardarGrado=gradoModelo::agregar_grado_modelo($datos);
	 if ($guardarGrado->rowCount()>=1) {
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

    $conexion = mainModel::conectar();

    $datos = $conexion->query("
      SELECT `Nombre` FROM `asignaturas`
      ");

    $datos = $datos->fetchAll();
 	

					

											echo '  <div class="form-group col-md-4" >
										      <label  class=""> Asignatura 1</label>
										        <select id="Materia-1" name="A1" onchange="desabilitar_1(this.value); verOption(this,1,this.value);" class="form-control">
										        	<option></option>';
										        	foreach ($datos as $rows) {
										        		echo "<option>";
										        		echo $rows["Nombre"];
										        		echo "</option>";
										        	}
										         echo' </select>
										          </div>
										    ';
                    
											for ($i=2; $i <= 12; $i++) {
												
										 	if ($i!=11) {

										  echo '  <div class="form-group col-md-4" >
										      <label class=""> Asignatura '.$i.'</label>
										        <select id="Materia-'.$i.'" name="A'.$i.'" disabled onchange=" desabilitar_'.$i.'(this.value); verOption(this,'.$i.',this.value);" class="form-control">
										        	<option></option>';
										        	foreach ($datos as $rows) {
										        		echo "<option>";
										        		echo $rows["Nombre"];
										        		echo "</option>";
										        	}
										         echo' </select>
										          </div>
										    ';

										    	}else
										    	{
										    			 echo '  <div class="form-group col-md-4" >
										      <label class=""> Materia '.$i.'</label>
										        <select id="Materia-'.$i.'" disabled onchange="desabilitar_'.$i.'(this.value); verOption(this,'.$i.',this.value);" class="form-control">
										        	<option></option>';
										        foreach ($datos as $rows) {
										        		echo "<option>";
										        		echo $rows["Nombre"];
										        		echo "</option>";
										        	}

										    echo '</select>
										    <br/>
										    <br/>
										     <p class="text-center">
										    	<button href="#!" class="btn btn-info btn-raised "><i class="zmdi zmdi-floppy"></i>   Save</button>
										    </p>
										          </div>

										    ';

										    	}

										    

										    }

        
                                           
          
    return $tabla;

   }

}