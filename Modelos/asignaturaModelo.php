<?php
     if ($peticionAjax == true) {
        require_once "../core/mainModel.php";
    } else {
       require_once "./core/mainModel.php";
    }

    class asignaturaModelo extends mainModel{
        protected function agregar_asignatura_modelo($datos)
        {
            $sql = mainModel::conectar()->prepare("INSERT INTO `asignaturas`(`Nombre`, `Id_Profesor`, `Id_Grado`, `Codigo`) VALUES (:Nombre,:Id_Profesor,:Id_Grado,:Codigo)");
            $sql->bindParam(":Nombre",$datos["Nombre"]);
            $sql->bindParam(":Id_Profesor",$datos["Id_Profesor"]);
            $sql->bindParam(":Id_Grado",$datos["Id_Grado"]);
            $sql->bindParam(":Codigo",$datos["Codigo"]);
            $sql->execute();
            return $sql;
        }
    }