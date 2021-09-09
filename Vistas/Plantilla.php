			<!DOCTYPE html>
		<html lang="es">
		<head>
			<title><?php echo COMPANY; ?></title>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
			<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>Vistas/css/font-awesome.css">
			<link rel="stylesheet" href="<?php echo SERVERURL; ?>Vistas/css/main.css">
			<script src="<?php echo SERVERURL; ?>Vistas/js/sweetalert2.min.js"></script>
			<?php include "Vistas/modulos/scripts.php"; ?>

		
		</head>

	<style type="text/css">
		
#loading-screen {
  background-color: rgba(25,25,25,0.7);
  height: 100%;
  width: 100%;
  position: fixed;
  z-index: 9999;
  margin-top: 0;
  top: 0;
  text-align: center;
}
#loading-screen img {
  width: 100px;
  height: 100px;
  position: relative;
  margin-top: -50px;
  margin-left: -50px;
  top: 50%;
}

		
	</style>
		<body>
			<div id="loading-screen">
 
   <img  src="<?php echo SERVERURL; ?>Vistas/assets/img/loadin.svg">  
		
</div> 

<script type="text/javascript">
	$('#loading-screen').css("display","none");
</script>
		<?php 

		$peticionAjax = false;
		require_once "./controladores/vistasControlador.php";

		$vt = new vistasControlador();
		$ruta = $vt->obtener_vistas_controlador();
		if($ruta =="login" || $ruta == "404"):
			if($ruta =="login"){
				require_once "./Vistas/contenido/login-view.php";
			}else{
				require_once "./Vistas/contenido/404-view.php";
			}
			
		else:
			session_start(['name' => 'SEP']);
			require_once "./Controladores/loginControlador.php";

			$lc =  new loginControlador();
			if(!isset($_SESSION['token_sep']) || !isset($_SESSION['usuario_sep'])){
				$lc->forzar_Cierre_Seccion_controlador();
			}
			
		?>
			<!-- SideBar -->
			<?php include "Vistas/modulos/navlateral.php"; ?>
			<!-- Content page-->
			<section class="full-box dashboard-contentPage">
			<!-- NavBar -->
				<?php include "Vistas/modulos/navbar.php"; ?>
			
				<!-- Content page -->
				
				<?php  require_once $ruta; ?>

			</section>
			<?php 
			
				include "Vistas/modulos/logoutScript.php"; ?>
			
			
		<?php endif; ?>
		<script>
		$.material.init();
	</script>
		
		</body>
		</html>