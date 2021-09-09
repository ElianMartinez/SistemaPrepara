<?php
    require_once "./Modelos/VistasModelo.php";

    class vistasControlador extends VistasModelo{
            Public function obtener_plantilla_controlador(){
                return require_once "./Vistas/Plantilla.php";
            }
             public function obtener_vistas_controlador()
            {
                if (isset($_GET['views'])) {
                    $ruta = explode('/',$_GET['views']);
                    $respueta = self::obtener_vistas_modelo($ruta[0]);
                } else {
                   $respueta ="login";
                }
                return $respueta;
                

            }
            
    }