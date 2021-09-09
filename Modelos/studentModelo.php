<?php
     if ($peticionAjax == true) {
        require_once "../core/mainModel.php";
    } else {
       require_once "./core/mainModel.php";
    }

    class studentModelo extends mainModel{
        
        public function agregar_student_modelo($datos)
        
        {
            $sql = mainModel::conectar()->prepare("INSERT INTO `estudiantes`(`Id_Estudiante`, `Apellido Paterno`, `Apellido Materno`, `Nombre`, `Sexo`, `Edad`, `Estatus`, `Grado`, `Id_Seccion`, `No_Estudiante`, `Anno_Escolar`) VALUES (:id,:apellidop,:apellidom,:nombre,:sexo,:edad,:estatus,:grado,:id_seccion,:nos,:anno)");
            $sql->bindParam(":id",$datos["Id"]);
            $sql->bindParam(":apellidop",$datos["ApellidoP"]);
            $sql->bindParam(":apellidom",$datos["ApellidoM"]);
            $sql->bindParam(":nombre",$datos["Nombre"]);
            $sql->bindParam(":sexo",$datos["Sexo"]);
            $sql->bindParam(":edad",$datos["Edad"]);
            $sql->bindParam(":estatus",$datos["Estatus"]);
            $sql->bindParam(":grado",$datos["Grado"]);
            $sql->bindParam(":id_seccion",$datos["Id_Seccion"]);
            $sql->bindParam(":nos",$datos["no"]);
            $sql->bindParam(":anno",$datos["anno"]);
            $sql->execute();
            return $sql;

        }


        }
    