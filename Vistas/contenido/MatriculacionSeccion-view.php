
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Administración <small>Matriculacion de Secciones</small></h1>
			</div>
			<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
		</div>
		<div class="container-fluid">
<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">

						<?php if ($_SESSION['Inscripciones'] == 'Activo') {
							echo "<li style='background-color: red' class='active'><a>Inscripción: ".$_SESSION['Inscripciones']."</a></li>"; 
						}else{
						echo "<li style='background-color: green' class='active'><a>Inscripción: ".$_SESSION['Inscripciones']."</a></li>"; 
					} ?>
					  	
					  	
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form  enctype="multipart/form-data" class="FormularioAjax1" action="<?php echo SERVERURL;?>Ajax/MatriculacionAjax.php" method="POST" data-form="save">

									    	<div class="form-group ">
										      <label class="">Grado</label>
										        <select required="" id="Grado" name="Grado" onchange="buscar_datos(this.value)" class="form-control">
										        	 <option></option>
										          <option>1ro</option>
										          <option>2do</option>
										          <option>3ro</option>
										          <option>4to</option>
										        </select>
										      </div>

											<p class="form-group" id="tap">
												
											</p>

											<p class="form-group" id="tap1">
												
											</p>

											    <p class="text-center">
										    	<button type="submit" class="btn btn-info btn-raised"><i class="zmdi zmdi-floppy"></i> Save</button>
												</p>
 										</form>
									</div>
								</div>
							</div>
						</div>

<script type="text/javascript">
function buscar_datos(consultaa){
	
	var form=$(".FormularioAjax1");

        var tipo=form.attr('data-form');
        var accion=form.attr('action');
        var metodo=form.attr('method');
        console.log(tipo +"    "+ accion+"    " + metodo);
	$.ajax({
		url:accion,
		type:metodo,
		dataType:'html',
		data:{consulta: consultaa},
	})
	.done(function(respuesta){
		
		$("#tap").html(respuesta);
	})

	.fail(function(){
		console.log('error');
	});


$('.FormularioAjax1').submit(function(e){
		e.preventDefault();
		var form=$(this);

		
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
        	var a = "Finalizado";
           if( a != <?php echo "'".$_SESSION['Inscripciones']."'";?> ){
			swal({
            title: "La Inscripción aún esta activa",   
            text: "Debe acabar la Inscripción antes de comenzar a matricular los estudiantes, Porfavor valla a Inscripción de escuela y cierre las Inscripciones",   
            type: "warning"
            });
		}else
		{
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
		
		$("#tap1").html(respuesta);
		$('#loading-screen').css("display","none");
	})

	.fail(function(){
		console.log('error');
	});
        }
        });

        
    });






}
											</script>