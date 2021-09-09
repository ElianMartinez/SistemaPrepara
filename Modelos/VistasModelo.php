<?php

        class vistasModelo{
            protected function obtener_vistas_modelo($vistas){
                $listaBlanca =["admin","home","MatriculacionSeccion","period","registration","representative","salon","school","grado","BEstudiante","asignatura","Boletin","ActaNota","Sesion","student","SeccionACTIVE","NotaAsignatura","RecordNota"];
                if (in_array($vistas,$listaBlanca)) {
                  if (is_file("./Vistas/contenido/".$vistas."-view.php")) {
                    $contenido = "./Vistas/contenido/".$vistas."-view.php";
                  } else {
                    $contenido = "login";   
                  }
                  
                } elseif($vistas == "login"){
                   $contenido = "login";
                }elseif($vistas == "index"){
                    $contenido = "login";
                }else{
                    $contenido = "404";
                }
                return $contenido;
            }
        }

