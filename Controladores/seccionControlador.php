<?php 

 if ($peticionAjax == true) {
    require_once "../Modelos/seccionModelo.php";
} else {
   require_once "./Modelos/seccionModelo.php";
}

class seccionControlador extends seccionModelo{

public function agregar_seccion_controlador(){

    if(isset($_POST["Nombre"]) && isset($_POST["Capacidad"])) {
       
    
	$Nombre = mainModel::limpiar_cadena($_POST["Nombre"]);
	$Grado = $_POST["Grado"];
	$Capacidad = $_POST["Capacidad"];
	
	 $consulta=mainModel::ejecutar_consulta_simple("SELECT * FROM seccion WHERE Nombre = '$Nombre' AND Id_Grado = '$Grado'");
 if ($consulta->rowCount()>=1) {
	 $Alerta=[
        "Alerta"=>"simple",
        "Titulo"=>"Ya esta registrado",
        "Texto"=>"Ya esta Sección esta registrado porfavor ingrese otra",
                        "Tipo"=>"warning"
                    ];
}else{

	$datos=[
	 	"Nombre"=>$Nombre,
	 	"Capacidad"=>$Capacidad,
	 	"Id_Grado"=>$Grado
	 		 ];

	 $guardar=seccionModelo::agregar_seccion_modelo($datos);
	 if ($guardar->rowCount()>=1) {
                    $Alerta=[
                        "Alerta"=>"limpiar1",
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

         }else

         {
            $Alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Se ha producido un error",
                        "Texto"=>"No todos los Campos esta llenos porfavor llene los Campos",
                        "Tipo"=>"info"
                    ];
         }

             return mainModel::sweet_alert($Alerta);

}

}



