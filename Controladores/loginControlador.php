<?php

if ($peticionAjax == true) {
    require_once "../Modelos/loginModelo.php";
    } else {
       require_once "./Modelos/loginModelo.php";
    }

    class loginControlador extends loginModelo {

        public function IVG(){
            $sql = mainModel::conectar()->prepare("SELECT * FROM `config` "); 
            $sql->execute();
            return $sql;
        }

        public function iniciar_sesion_controlador()
        {
            $usuario = mainModel::limpiar_cadena($_POST["user"]); 
            $pass = mainModel::limpiar_cadena($_POST["pass"]); 
            
            $pass = mainModel::encryption($pass);
            
            $datos = [
                "usuario" =>$usuario,
               "pass" => $pass  
            ];

            $datosCuenta = loginModelo::iniciar_sesion_modelo($datos);

            if($datosCuenta->rowCount()==1){

            $row = $datosCuenta->fetch();
          

            $fechaActual = date("d-m-Y");
            $yearActual = date("Y");
            $horaActual = date("h:i:s a");

                $consulta1 = mainModel::ejecutar_consulta_simple("SELECT Id FROM bitacora");
               
                $numero = $consulta1->rowCount()+1;
               
                $codigoB = mainModel::generar_codigo_aleatorio("CB",7,$numero);
                
                $datosBitacora = [
                    "Codigo" => $codigoB,
                    "Fecha" => $fechaActual,
                    "horaIniciar"=>$horaActual,
                    "horaFinal"=>"Sin registro",
                    "tipo"=>$row["Tipo_Cuenta"],
                    "Year"=>$yearActual,
                    "cuentaCodigo"=>$row["Id_Cuenta"]
                ];
                
                    $insertarBitacora = mainModel::guardar_bitacora($datosBitacora);
                    if ($insertarBitacora->rowCount()>=1) {
                        session_start(['name' => 'SEP']);
                        $_SESSION['usuario_sep'] = $row['Usuario'];
                        $_SESSION['tipo_sep'] = $row['Tipo_Cuenta'];
                        $_SESSION['foto_sep'] = $row['Cuenta_Foto'];
                        $_SESSION['token_sep'] = md5(uniqid(mt_rand(),true));
                        $_SESSION['codigo_cuenta_sep'] = $row['Id_Cuenta'];
                        $_SESSION['codigo_bitacora_sep'] = $codigoB;
                        $_SESSION['Nombre'] = $row['Nombre_User'];
                        
                        loginControlador::secciones_ins();


                        if ($row['Tipo_Cuenta'] == "Administrador") {
                            $url = SERVERURL."home/";
                        } else {
                            $url = SERVERURL."home/";
                        }
                        echo $urlLocation = '<script> window.location="'.$url.'" </script>';
                    } else {
                        
                        $Alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un Error inesperado",
                            "Texto"=>"Ahh ocurrido un error con la bitacora",
                            "Tipo"=>"error"
                        ];
                        echo mainModel::sweet_alert($Alerta);
                        return mainModel::sweet_alert($Alerta);
                    }
                    
            }else{
                $Alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un Error inesperado",
                    "Texto"=>"El usuario o la Contraseña no son validos porfavor intente nuevamente",
                    "Tipo"=>"error"
                ];
                echo mainModel::sweet_alert($Alerta);
                return mainModel::sweet_alert($Alerta);
              }
            }

            public function cerrar_sesion_controlador(){
                session_start(['name' => 'SEP']);
                
                $datos = [
                    "Usuario"=>$_SESSION['usuario_sep']
                ];

                return loginModelo::cerrar_sesion_modelo($datos);
            }

            public function forzar_Cierre_Seccion_controlador(){
                session_destroy();
                return header("Location:".SERVERURL."login");
                
            }

            public function secciones_ins(){
                  $config = loginControlador::IVG();
            $config1 = $config->fetch();  
            session_start(['name' => 'SEP']);  
                        $_SESSION['Semestre']=$config1['Semestre'];
                        $_SESSION['Ano_E']= $config1['Ano_Escolar'];
                        $_SESSION['Inscripciones']= $config1['Inscripcion'];
            }
        }