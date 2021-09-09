		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-font zmdi-hc-fw"></i> Administration <small>Sección</small></h1>
			</div>
			<p class="lead">En este formulario podrás insertar las difieres secciones de cada grado asignado!</p>
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
									    <form autocomplete="off" enctype="multipart/form-data" class="FormularioAjax1" action="<?php echo SERVERURL;?>Ajax/seccionAjax.php" method="POST" data-form="save">
									    	
									    	 <div class="form-group ">
										      <label class="">Grado</label>
										        <select name="Grado" class="form-control">
										          <option>1ro</option>
										          <option>2do</option>
										          <option>3ro</option>
										          <option>4to</option>
										        </select>
										      </div>

									    	<div class="form-group label-floating">
											  <label class="">Nombre de la Sección</label>
											  <input name="Nombre" class="form-control" type="text">
											</div>

											<div class="form-group label-floating">
											  <label class="">Capacidad</label>
											  <input name="Capacidad" class="form-control" type="text">
											</div>

										
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
								<table class="table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Code</th>
											<th class="text-center">Name</th>
											<th class="text-center">Capacity</th>
											<th class="text-center">Status</th>
											<th class="text-center">Update</th>
											<th class="text-center">Delete</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>001</td>
											<td>Classroom 1</td>
											<td>40</td>
											<td>Active</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
										</tr>
										<tr>
											<td>2</td>
											<td>002</td>
											<td>Classroom 2</td>
											<td>30</td>
											<td>Active</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
										</tr>
										<tr>
											<td>3</td>
											<td>003</td>
											<td>Classroom 3</td>
											<td>50</td>
											<td>Active</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
										</tr>
									</tbody>
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
	</section>

	<script type="text/javascript">
		$('.FormularioAjax1').submit(function(e){
		
		e.preventDefault();
		var form=$(this);
		//Valores Del Form
		 	

		//Valores staticos
        var tipo=form.attr('data-form');
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var respuesta=form.children('.RespuestaAjax');
		console.log(tipo +"    "+ accion+"    " + metodo);
        var formdata = new FormData(this);
       

        var textoAlerta;
        if(tipo==="save"){
            textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
        }else if(tipo==="delete"){
            textoAlerta="Los datos serán eliminados completamente del sistema";
        }else if(tipo==="update"){
        	textoAlerta="Los datos del sistema serán actualizados";
        }else{
            textoAlerta="Quieres realizar la operación solicitada";
        }
        swal({
            title: "¿Estás seguro?",   
            text: textoAlerta,   
            type: "question",   
            showCancelButton: true,     
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar"
        }).then(function () {
        	$('#loading-screen').css("display","");
           	$.ajax({
		url:accion,
		type:metodo,
		data: formdata ? formdata : form.serialize(),
        cache: false,
        contentType: false,
        processData: false,
		
	})
	.done(function(respuesta){
		
		$(".RespuestaAjax").html(respuesta);
		$('#loading-screen').css("display","none");
	})

	.fail(function(){
		console.log('error');
	});
        });
    });

	</script>

	<!-- Notifications area -->
	