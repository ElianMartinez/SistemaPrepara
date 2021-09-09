<?php
     if ($peticionAjax == true) {
        require_once "../core/mainModel.php";
    } else {
       require_once "./core/mainModel.php";
    }

    class seccionModelo extends mainModel{
        protected function agregar_seccion_modelo($datos)
        {
            $sql = mainModel::conectar()->prepare("INSERT INTO `seccion`(`Id_Grado`, `Nombre`, `Capacidad`) VALUES (:Id_Grado,:Nombre,:Capacidad)");
            $sql->bindParam(":Id_Grado",$datos["Id_Grado"]);
            $sql->bindParam(":Capacidad",$datos["Capacidad"]);
            $sql->bindParam(":Nombre",$datos["Nombre"]);
            $sql->execute();
            return $sql;
        }
    }