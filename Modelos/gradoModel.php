<?php
     if ($peticionAjax == true) {
        require_once "../core/mainModel.php";
    } else {
       require_once "./core/mainModel.php";
    }

    class gradoModelo extends mainModel{

        protected function eliminiar_grado($codigo)
        {
           $sql = self::conectar()->prepare("DELETE FROM `grado` WHERE `Id_Grado` = :codigo");
           $sql->bindParam(":codigo",$codigo);
           $sql->execute();
           return $sql;
        }

        protected function agregar_grado_modelo($datos)
        {
            $sql = mainModel::conectar()->prepare("INSERT INTO `grado`(`Nombre`, `Asignaturas_1`, `Asignaturas_2`, `Asignaturas_3`, `Asignaturas_4`, `Asignaturas_5`, `Asignaturas_6`, `Asignaturas_7`, `Asignaturas_8`, `Asignaturas_9`, `Asignaturas_10`, `Asignaturas_11`, `Asignaturas_12`, `Semestre`, `Anno_Escolar`) VALUES (:nombre,:a1,:a2,:a3,:a4,:a5,:a6,:a7,:a8,:a9,:a10,:a11,:a12,:Semestre,:anno)");
            $sql->bindParam(":nombre",$datos["Nombre"]);
            $sql->bindParam(":a1",$datos["A1"]);
            $sql->bindParam(":a2",$datos["A2"]);
            $sql->bindParam(":a3",$datos["A3"]);
            $sql->bindParam(":a4",$datos["A4"]);
            $sql->bindParam(":a5",$datos["A5"]);
            $sql->bindParam(":a6",$datos["A6"]);
            $sql->bindParam(":a7",$datos["A7"]);
            $sql->bindParam(":a8",$datos["A8"]);
            $sql->bindParam(":a9",$datos["A9"]);
            $sql->bindParam(":a10",$datos["A10"]);
            $sql->bindParam(":a11",$datos["A11"]);
            $sql->bindParam(":a12",$datos["A12"]);
            $sql->bindParam(":Semestre",$datos["Semestre"]);
            $sql->bindParam(":anno",$datos["Anno"]);
            $sql->execute();
            return $sql;
        }
    }