<?php
     if ($peticionAjax == true) {
        require_once "../core/mainModel.php";
    } else {
       require_once "./core/mainModel.php";
    }

    class configModelo extends mainModel{
        protected function agregar_config_modelo($datos)
        {
            $sql = mainModel::conectar()->prepare("UPDATE `config` SET `Semestre`= :semestre,`Ano_Escolar`=:ano,`Inscripcion`=:ins WHERE `Id`= 1");
            $sql->bindParam(":semestre",$datos["semestre"]);
            $sql->bindParam(":ano",$datos["ano"]);
            $sql->bindParam(":ins",$datos["ins"]);
            $sql->execute();
            return $sql;
        }
    }