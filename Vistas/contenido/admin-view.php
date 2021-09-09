<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Usuario <small>Administrador</small></h1>
			</div>
			<p class="lead">En este formulario podrá registrar el usuario del administrador con esta cuenta tendrá acceso total al sistema del colegio. Solo tiene que ingresar los datos en cada campo solicitado y darle clic al boto que dice guardar que esta ubicado en la parte inferior.</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">New</a></li>
					  	<li><a href="#list" data-toggle="tab">List</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form autocomplete="off" enctype="multipart/form-data" class="FormularioAjax" action="<?php echo SERVERURL;?>Ajax/administradorAjax.php" method="POST" data-form="save">



									    	
									    	<div class="form-group label-floating">
											  <label class="control-label">Nombre del Administrador</label>
											  <input required=""  name="Nombre" class="form-control" type="text">
												
											</div>

											<div class="form-group label-floating">
											  <label class="control-label">Apellido del Administrador</label>
											  <input required=""  name="Apellido" class="form-control" type="text">
											</div>
										

											<div class="form-group label-floating">
											  <label class="">Correo Electronico</label>
											  <input name="Email" required="" class="form-control" type="email">
											</div>

											<div class="form-group label-floating">
											  <label class="">Nombre de Usuario</label>
											  <input name="Nombre_Usuario" required="" class="form-control" type="text">
											</div>

											<div class="form-group label-floating">
											  <label class="">Contraseña</label>
											  <input name="Password" required="" class="form-control" type="Password">
											</div>

												<div class="form-group label-floating">
											  <label class="">Confirmar Contraseña</label>
											  <input name="CPassword" required="" class="form-control" type="Password">
											</div>

											
										
											<div class="form-group">
										      <label class="">Foto</label>
										      <div>
										        <input type="text" readonly="" class="form-control" placeholder="Buscar...">
										        <input name="Foto" type="file">
										      </div>
										    </div>
										    <p class="text-center">
										    	<button type="submit" class="btn btn-info btn-raised"><i class="zmdi zmdi-floppy"></i> Save</button>
												</p>
												<div class="RespuestaAjax"></div>

									    </form>
									</div>
								</div>
							</div>
						</div>

						<?php require_once "./Controladores/administradorControlador.php";
						$insAdmin = new administradorControlador();
						 ?>

					  	<div class="tab-pane fade" id="list">
							
						<?php 
						$pagina= explode("/",$_GET['views']);

						 if($_SESSION['tipo_sep']=="Administrador"){
						 	$to = 1;
						 }else{
						 	$to = 2;
						 }
						echo $insAdmin->paginador_administrador_controlador($pagina[1],10,$to,$_SESSION['usuario_sep']);
						
						 ?>		
								
							<ul class="pagination pagination-sm">
								  	<li class="disabled"><a href="#!">«</a></li>
								  	<li class="active"><a href="#!">1</a></li>
								  	<li><a href="#list">2</a></li>
								  	<li><a href="3">3</a></li>
								  	<li><a href="#!">4</a></li>
								  	<li><a href="#!">5</a></li>
								  	<li><a href="#!">»</a></li>
								</ul>
					  	</div>
					</div>
				</div>
			</div>
		</div>