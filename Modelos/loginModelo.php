<?php

if ($peticionAjax == true) {
        require_once "../core/mainModel.php";
    } else {
       require_once "./core/mainModel.php";
    }

    class loginModelo extends mainModel{
        protected function iniciar_sesion_modelo($datos)
        {
            $sql = mainModel::conectar()->prepare("SELECT * FROM `cuenta` WHERE `Usuario` =:usuario and `Pass`= :pass "); 
            $sql->bindParam(":usuario",$datos["usuario"]);
            $sql->bindParam(":pass",$datos["pass"]);
            $sql->execute();
            return $sql;
        }
        protected function cerrar_sesion_modelo($datos){
            if ($datos['Usuario']!="") {
                  session_unset();
                  session_destroy();
                  $respuesta = "true";
               
            } else {
               $respuesta = "false";
            }
            return $respuesta;
        }
    }