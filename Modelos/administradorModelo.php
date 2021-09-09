<?php
     if ($peticionAjax == true) {
        require_once "../core/mainModel.php";
    } else {
       require_once "./core/mainModel.php";
    }

    class administradorModelo extends mainModel{
        protected function agregar_administrador_modelo($datos)
        {
            $sql = mainModel::conectar()->prepare("INSERT INTO `admin`(`Nombre`, `Apellido`, `Email`, `Usuario_cuenta`) VALUES (:Nombre,:Apellido,:Email,:Usuario_Cuenta)");
            $sql->bindParam(":Nombre",$datos["Nombre"]);
            $sql->bindParam(":Apellido",$datos["Apellido"]);
            $sql->bindParam(":Email",$datos["Email"]);
            $sql->bindParam(":Usuario_Cuenta",$datos["Usuario_Cuenta"]);
            $sql->execute();
            return $sql;
        }
    }