<!DOCTYPE html>
<html lang="es">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

</head>
<body class="cover" style="background-image: url(<?php echo SERVERURL; ?>Vistas/assets/img/loginFont.jpg);">
	<form action=""  method="POST" autocomplete="off" class="full-box logInForm">
		<p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
		<p class="text-center text-muted text-uppercase">Inicia sesión con tu cuenta</p>
		<div class="form-group label-floating">
		  <label class="control-label" for="UserEmail">Usuario</label>
		  <input class="form-control" require="" id="UserEmail" name="user" type="text">
		  <p class="help-block">Escribe tú Usuario</p>
		</div>
		<div class="form-group label-floating">
		  <label class="control-label" for="UserPass">Contraseña</label>
		  <input class="form-control" require="" id="UserPass" name="pass" type="password">
		  <p class="help-block">Escribe tú contraseña</p>
		</div>
		<div class="form-group text-center">
			<input type="submit" value="Iniciar sesión" class="btn btn-raised btn-danger">
		</div>
	</form>
	
	<?php 

		session_start(['name' => 'SEP']);
		if ($_SESSION['token_sep']) {
			
			header("Location:".SERVERURL."home");
		}else{

	$peticionAjax = false;
		if (isset($_POST['user']) && isset($_POST['pass'])) {
			require_once "./Controladores/loginControlador.php";
			$login = new loginControlador();
			$login->iniciar_sesion_controlador();
		
		}

		 else {
			
		}
	}	
	 
	?>
	

	<!--====== Scripts -->
	
</body>
</html>