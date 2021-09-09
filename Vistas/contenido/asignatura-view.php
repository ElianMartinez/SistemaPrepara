
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Administracion <small>Asignatura</small></h1>
			</div>
			<p class="lead">En este formulario podrá registrar las distintas asignaturas dependiendo el grado a la que pertenece!</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Nuevo</a></li>
					  	<li><a href="#list" data-toggle="tab">Lista</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form autocomplete="off" enctype="multipart/form-data" class="FormularioAjax" action="<?php echo SERVERURL;?>Ajax/asignaturaAjax.php" method="post" data-form="save">
									    	
							                  <label class="">Materia</label>
											  <input type="text" required="" name="Nombre1"  id="NMateria" class="form-control" type="text">

						<?php require_once "./Controladores/asignaturaControlador.php";
						$insAsig = new asignaturaControlador();
						 
							echo $insAsig->combobox_controlador();

						 ?>

											<button  type="button" style="margin-top:50px; margin-bottom:100px;" class="btn-success" onclick="generar_Codigo();">Generar</button>
											

										    <p class="text-center">
										    	<button href="#!" class="btn btn-info btn-raised "><i class="zmdi zmdi-floppy"></i> Guardar</button>
										    </p>

										   <div class="RespuestaAjax"></div> 
									    </form>
									</div>
								</div>
							</div>
						</div>
					
					  	<div class="tab-pane fade" id="list">
								<div class="table-responsive">
								<div class="btn-group">
								<label class="btn btn-info">
								<input type="button" name="" value="1ro Primer Semestre" onclick="toggle('togg1roPrimer');">
								</label>
								<label class="btn btn-info">
								<input type="button" name="" value="1ro Segundo Semestre" onclick="toggle('togg1roSegundo');">
								</label>
								<label class="btn btn-info">
								<input type="button" name="" value="2do Primer Semestre" onclick="toggle('togg2doPrimer');">
								</label>
								<label class="btn btn-info">
								<input type="button" name="" value="2do Segundo Semestre" onclick="toggle('togg2doSegundo');">
								</label>
								<label class="btn btn-info">
								<input type="button" name="" value="3ro Primer Semestre" onclick="toggle('togg3roPrimer');">
								</label>
								<label class="btn btn-info">
								<input type="button" name="" value="3ro Segundo Semestre" onclick="toggle('togg3roSegundo');">
								</label>
								<label class="btn btn-info">
								<input type="button" name="" value="4to Primer Semestre" onclick="toggle('togg4toPrimer');">
								</label>
								<label class="btn btn-info">
								<input type="button" name="" value="4to Segundo Semestre" onclick="toggle('togg4toSegundo');">
								</label>
</div>
								
							
								<table class="table table-hover text-center">
							<?php require_once "./Controladores/asignaturaControlador.php";
						$insAsig = new asignaturaControlador();
							echo $insAsig->paginador_asignatura_controlador();
						 ?>

								</table>
								<ul class="pagination pagination-sm">
								  	<li class="disabled"><a href="#!">«</a></li>
								  	<li class="active"><a href="#!">1</a></li>
								  	<li><a href="#!">2</a></li>
								  	<li><a href="#!">3</a></li>
								  	<li><a href="#!">4</a></li>
								  	<li><a href="#!">5</a></li>
								  	<li><a href="#!">»</a></li>
								</ul>
							</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	

<script type="text/javascript">
	function toggle(a){
		$("td").css("display","none");
	 $("."+a).css("display","");
}
$("td").css("display","none");
	function generar_Codigo(){
		 	var grado = $('#Grado').val();
		 	var Materia = $('#NMateria').val();
		 	var Anno = $('#Anno').val();
		 	var Semestre = $('#Semestre').val();
		 	var codi ="";
		 	if(grado!="" && Materia != "" && Anno!="" && Semestre != "") {
		 	if(Materia != "Ciencias Naturales"){
		 		codi = Materia.substr(0,3);
		 		var codigo = codi.toUpperCase()+'_'+grado+Semestre+'_'+Anno;
		 	$('#Codigo').val(codigo);
		 	 
		 	}else{
		 	codi ="CN";
		 	var codigo = codi.toUpperCase()+'_'+grado+Semestre+'_'+Anno;
		 	$('#Codigo').val(codigo);
		 	}
		 	

		 	 
		 	
		 	
		 	}else{
		 		swal("No se puede generar el Cogido!","Hay algunos campos vacios porfavor complete los campos","info");
		 	}

		}

		

</script>