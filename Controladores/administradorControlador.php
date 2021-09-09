<?php 

 if ($peticionAjax == true) {
    require_once "../Modelos/administradorModelo.php";
} else {
   require_once "./Modelos/administradorModelo.php";
}

class administradorControlador extends administradorModelo {
    //contorlador para agregar administrador 
    public function agregar_administrador_controlador()
    {
        $Nombre = mainModel::limpiar_cadena($_POST["Nombre"]);
        $Apellido = mainModel::limpiar_cadena($_POST["Apellido"]);
        $Email = mainModel::limpiar_cadena($_POST["Email"]);
        $Nombre_Usuario = mainModel::limpiar_cadena($_POST["Nombre_Usuario"]);
        $Pass = mainModel::limpiar_cadena($_POST["Password"]);
        $Pass1 = mainModel::limpiar_cadena($_POST["CPassword"]);
        $Foto = "male_Admin_Avatar.png";
        if ($Pass != $Pass1) {
            $Alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un Error inesperado",
                "Texto"=>"Las contraseñas que acabas de ingresar no coinciden, porfavor intente nuevamente",
                "Tipo"=>"warning"
            ];
        } else {
           $consulta=mainModel::ejecutar_consulta_simple("SELECT * FROM Cuenta WHERE Usuario ='$Nombre_Usuario'");
           if ($consulta->rowCount()>=1) {
            $Alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un Error inesperado",
                "Texto"=>"El  nombre de usuario <b>".$Nombre_Usuario."</b> ya esta registrado a una cuenta porfavor ingrese otro",
                "Tipo"=>"warning"
            ];
           } else {
               if ($Email != "") {
                $consulta2=mainModel::ejecutar_consulta_simple("SELECT * FROM `admin` WHERE Email ='$Email'");
                if ($consulta2->rowCount()>=1) {
                    $Alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un Error inesperado",
                        "Texto"=>"El Email <b>".$Email."</b> ya esta registrado a una cuenta porfavor ingrese otro",
                        "Tipo"=>"error"
                    ];
                } else {
                   $Clave=mainModel::encryption($Pass);
                   $datosAC=[
                       "Usuario"=>$Nombre_Usuario,
                       "Pass" => $Clave,
                       "Tipo_Cuenta" => "Administrador",
                       "Foto" => $Foto,
                       "Nombre_user" => $Nombre
                   ];
                   
                   $guardarCuenta=mainModel::agregar_cuenta($datosAC);
                   if ($guardarCuenta->rowCount()>=1) {
                    $datosAU =[
                        "Nombre"=> $Nombre,
                        "Apellido"=> $Apellido,
                        "Email"=> $Email,
                        "Usuario_Cuenta" => $Nombre_Usuario
    
                    ];
                    $guardarAdmin=administradorModelo::agregar_administrador_modelo($datosAU);
                    
                   if ($guardarAdmin->rowCount()>=1) {
                    $Alerta=[
                        "Alerta"=>"limpiar",
                        "Titulo"=>"Se ha ingresado Correctamente",
                        "Texto"=>"El Registro se inserto correctamente en el sistema",
                        "Tipo"=>"success"
                    ];
                   }
                 else {
                     mainModel::eliminiar_Cuenta($Nombre_Usuario);
                    $Alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ne ha ingresado Correctamente",
                        "Texto"=>"El Registro del administrador no se inserto correctamente en el sistema",
                        "Tipo"=>"error"
                    ]; 
                }
                
                   } else {
                    $Alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un Error inesperado",
                        "Texto"=>"No se ha podido ingresar el registro intente nuevamente",
                        "Tipo"=>"error"
                    ];
                   }
                   
                }

                
                
               } else {

                    //mensage de error de que no se puede porque ya el email exixte
               }
            }
        }
        return mainModel::sweet_alert($Alerta);
   
    } 
   //controlador para paginar administradores

   public function paginador_administrador_controlador($pagina,$registros,$privilegio,$nameU){
    $pagina = mainModel::limpiar_cadena($pagina);
    $registros = mainModel::limpiar_cadena($registros);
    $privilegio = mainModel::limpiar_cadena($privilegio);
    $nameU = mainModel::limpiar_cadena($nameU);
    $tabla ="";

    $pagina = (isset($pagina) && $pagina >= 0) ? (int) $pagina :1; 

    if ($pagina > 0) {
     $inicio = $pagina*$registros-$registros;
    } else {
     $inicio = 0;
    }
    

    $conexion = mainModel::conectar();

    $datos = $conexion->query("
      SELECT SQL_CALC_FOUND_ROWS * FROM admin WHERE Usuario_cuenta != '$nameU' AND Id !='1' ORDER BY Nombre ASC LIMIT $inicio,$registros
      ");

    $datos = $datos->fetchAll();
    $total = $conexion->query("SELECT FOUND_ROWS()");
    $total = (int) $total->fetchColumn();

    $Npaginas=ceil($total/$registros);

    $tabla.='<div class="table-responsive">
                <table class="table table-hover text-center">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Apellido</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Usuario</th>
                      <th class="text-center">Update</th>
                      <th class="text-center">Delete</th>
                    </tr>
                  </thead>
                  <tbody>';

    if ($total>=1 && $pagina<=$Npaginas) {
        $contador=$inicio+1; 
        foreach ($datos as $rows) {
                    $tabla.=' 
                    <tr>
                      <td>'.$contador.'</td>
                      <td>'.$rows['Nombre'].'</td>
                      <td>'.$rows['Apellido'].'</td>
                      <td>'.$rows['Email'].'</td>
                      <td>'.$rows['Usuario_cuenta'].'</td>
                      <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                      <td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
                    </tr>
                           ';
                           $contador++; 
                  }
      } else {
           $tabla.='
           <tr>
           <td class="text-center" colspan="5"> No hay registros en el sistema</td>
           </tr>
           ';       
      }
                  $tabla.="</tbody></table></div>";          


    return $tabla;

   }
}