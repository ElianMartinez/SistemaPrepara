<?php 

 if ($peticionAjax == true) {
    require_once "../Modelos/configModelo.php";
} else {
   require_once "./Modelos/configModelo.php";
}

class configControlador extends configModelo
{
public function config1Controlador(){
	$ano = $_POST['ano'];
	$ins = $_POST['Inscripcion'];
	$semestre = $_POST['Semestre'];


	$Datos = [
		"semestre" => $semestre,
		"ano" => $ano,
		"ins" => $ins
	];


	$guardar=configModelo::agregar_config_modelo($Datos);
if ($guardar->rowCount()>=1){
		$Alerta=[
        "Alerta"=>"limpiar",
        "Titulo"=>"Se ha ingresado Correctamente",
              "Texto"=>"El Registro se Actualizo correctamente en el sistema",
        "Tipo"=>"success"
         ];
         	
          $peticionAjax = true;
          require_once "loginControlador.php";

      $lc =  new loginControlador();
      $lc->secciones_ins();
         	 
		
      }else {
      	$Alerta=["Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un Error inesperado",
                        "Texto"=>"Ah Ocurrido un error porfavor recarge la página",
                        "Tipo"=>"error"
                    ];
      }

	
	

return mainModel::sweet_alert($Alerta);
			




}

}

