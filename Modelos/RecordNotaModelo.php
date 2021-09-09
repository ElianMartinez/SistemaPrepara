<?php

if ($peticionAjax == true) {
        require_once "../core/mainModel.php";
    } else {
       require_once "./core/mainModel.php";
    }

    class RecordNotaModelo extends mainModel{
        protected function Agregar_Record($datos)
        {
            $sql = mainModel::conectar()->prepare("INSERT INTO `record_nota`(`Asignatura`, `Nota`,`Fecha`,`Centro`,`Id_boletin`) VALUES (:asignatura,:nota,:fecha,:Centro,:id_boletin)"); 
            $sql->bindParam(":asignatura",$datos["asignatura"]);
            $sql->bindParam(":nota",$datos["nota"]);
            $Sql->bindParam(":fecha",$datos["fecha"]);
            $Sql->bindParam(":Centro",$datos["centro"]);
            $sql->bindParam(":id_boletin",$datos["id_boletin"]);
            $sql->execute();
            return $sql;
        }
        
    }