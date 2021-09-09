
<meta charset="UTF-8">
<?php
    if ($peticionAjax) {
        require_once "../core/configApp.php";
    } else {
       require_once "./core/configApp.php";
    }
    class mainModel{
        protected function conectar()
        {
         $enlace = new PDO(SGBD,USER,PASS);

        return $enlace;
        }

        protected function ejecutar_consulta_simple($consulta)
        {
            $respuesta = self::conectar()->prepare($consulta);
            $respuesta->execute();
            return $respuesta;
            self::conectar()->close();

        }

        protected function agregar_cuenta($datos)
        {
           $sql = self::conectar()->prepare("INSERT INTO `cuenta`(`Usuario`, `Pass`, `Tipo_Cuenta`, `Cuenta_Foto`,`Nombre_User`) VALUES (:Usuario,:Pass,:Tipo_Cuenta,:Foto,:Nombre_User)");
           $sql->bindParam(":Usuario",$datos["Usuario"]);
           $sql->bindParam(":Pass",$datos["Pass"]);
           $sql->bindParam(":Tipo_Cuenta",$datos["Tipo_Cuenta"]);
           $sql->bindParam(":Foto",$datos["Foto"]);
           $sql->bindParam(":Nombre_User",$datos["Nombre_user"]);
           $sql->execute();
           return $sql;
        }

        protected function eliminiar_Cuenta($codigo)
        {
           $sql = self::conectar()->prepare("DELETE FROM `cuenta` WHERE Usuario = :codigo");
           $sql->bindParam(":codigo",$codigo);
           $sql->execute();
           return $sql;
        }
    
        public static function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}
		public static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
    } 
    protected function generar_codigo_aleatorio($letra,$longitud,$num)
    {
        for($i = 1;$i <= $longitud;$i++){
            $numero= Rand(0,9);
            $letra.=$numero;
        }
        return $letra.$num;
    }

    protected function eliminiar_bitacora($Codigo)
    {
       $sql =self::conectar()->prepare("DELETE FROM bitacora where CuentaCodigo = :codigo");
       $sql->bindParam(":codigo",$Codigo);
       $sql->execute();
    return $sql;
    }

    protected function actualizar_bitacora($codigo,$hora)
    {
        $sql = self::conectar()->prepare("UPDATE bitacora SET HoraFinal = :hora where Codigo = :codigo");
        $sql->bindParam(":hora",$hora);
        $sql->bindParam(":codigo",$codigo);
        $sql->execute();
        return $sql;
    }

    protected function guardar_bitacora($datos){
            $sql = self::conectar()->prepare("INSERT INTO `bitacora`(`Codigo`, `Fecha`, `HoraIniciar`, `HoraFinal`, `Tipo`, `Year`, `CuentaCodigo`) VALUES (:codigo,:Fecha,:horaIniciar,:horaFinal,:tipo,:ano,:cuentaCodigo)");
            $sql->bindParam(":codigo",$datos["Codigo"]);
           $sql->bindParam(":Fecha",$datos["Fecha"]);
           $sql->bindParam(":horaIniciar",$datos["horaIniciar"]);
           $sql->bindParam(":horaFinal",$datos["horaFinal"]);
           
           $sql->bindParam(":tipo",$datos["tipo"]);
           $sql->bindParam(":ano",$datos["Year"]);
           $sql->bindParam(":cuentaCodigo",$datos["cuentaCodigo"]);
           $sql->execute();
           return $sql;
    
        }

    protected function limpiar_cadena($cadena)
    {
        $cadena=trim($cadena);
        $cadena=stripcslashes($cadena);
        $cadena=str_ireplace("/","",$cadena);
        $cadena=str_ireplace("<script>","",$cadena);
        $cadena=str_ireplace("</script>","",$cadena);
        $cadena=str_ireplace("<script src","",$cadena);
        $cadena=str_ireplace("<script type=","",$cadena);
        $cadena=str_ireplace("*","",$cadena);
        $cadena=str_ireplace(">","",$cadena);
        $cadena=str_ireplace("<","",$cadena);
        $cadena=str_ireplace("^","",$cadena);
        $cadena=str_ireplace("SELECT * FROM","",$cadena);
        $cadena=str_ireplace("DELETE FROM","",$cadena);
        $cadena=str_ireplace("--","",$cadena);
        $cadena=str_ireplace("{","",$cadena);
        $cadena=str_ireplace("}","",$cadena);
        $cadena=str_ireplace("[","",$cadena);
        $cadena=str_ireplace("]","",$cadena);
        $cadena=str_ireplace("INSERT INTO","",$cadena);
        $cadena=str_ireplace("=","",$cadena);
        $cadena=str_ireplace("==","",$cadena);
        return $cadena;
    }
    protected function sweet_alert($datos) {
        $alerta = "";
        if ($datos['Alerta']== "simple"){
        $alerta = "
        <script>
        Sweetalert2(
            '".$datos['Titulo']."',
            '".$datos['Texto']."',
            '".$datos['Tipo']."')
            
        </script>";
        }
        
     elseif($datos['Alerta']== "recargar") {
        $alerta ="
        <script>
        Sweetalert2({
            title: '".$datos['Titulo']."',
            text: '".$datos['Texto']."',
            type: '".$datos['Tipo']."',
            confirmButtonText: 'Aceptar'
          }).then(function() {
              location.reload();

          });
        </script>
        ";
     }
      elseif($datos['Alerta']== "atras") {
        $alerta ="
        <script>
        Sweetalert2({
            title: '".$datos['Titulo']."',
            text: '".$datos['Texto']."',
            type: '".$datos['Tipo']."',
            confirmButtonText: 'Aceptar'
          }).then(function() {
              atras();

          });
        </script>
        ";
     }
     elseif($datos['Alerta']== "limpiar"){
        $alerta ="
        <script>
        Sweetalert2({
            title: '".$datos['Titulo']."',
            text: '".$datos['Texto']."',
            type: '".$datos['Tipo']."',
            confirmButtonText: 'Aceptar'
          }).then(function () {
              $('.FormularioAjax')[0].reset();
          });
        </script> ";
     }
     elseif($datos['Alerta']== "limpiar1"){
        $alerta ="
        <script>
        Sweetalert2({
            title: '".$datos['Titulo']."',
            text: '".$datos['Texto']."',
            type: '".$datos['Tipo']."',
            confirmButtonText: 'Aceptar'
          }).then(function () {
              $('.FormularioAjax1')[0].reset();
          });
        </script> ";
     }

     return $alerta;
        
    }

}