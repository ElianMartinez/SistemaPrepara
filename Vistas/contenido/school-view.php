


<div class="container-fluid">


			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Settings <small>School Data</small></h1>
			</div>
			<p class="lead">Configure el estado actual de la cuenta</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#newSchool" data-toggle="tab"><i class="zmdi zmdi-balance"></i> Configuración Actual</a></li>
					  	
					</ul>
					
					<div class="tab-content">
						<div class="tab-pane fade active in" id="newSchool">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form autocomplete="off" enctype="multipart/form-data" class="FormularioAjax" action="<?php echo SERVERURL;?>Ajax/configAjax.php" method="post" data-form="update">
									    	<div class="form-group label-floating">
											  <label class="control-label">Semestre</label>
											  <select name="Semestre" class="form-control" >
											  	<?php 

											  	if ($_SESSION['Semestre'] == "Primer") {
											  	 	echo "<option>Primer</option>";
											  	 	echo "<option>Segundo</option>";
											  	 } else{
											  	 	echo "<option>Segundo</option>";
											  	 	echo "<option>Primer</option>";
											  	 }
											  	 ?>
											  	</select>
											</div>
											<div class="form-group label-floating">
											  <label class="control-label">Año Escolar</label>
											  <input name="ano" class="form-control"  value="<?php echo $_SESSION['Ano_E']; ?>" type="text">
											</div>
											<div class="form-group label-floating">
											  <label class="control-label">Estado de Inscripción</label>
											  <select name="Inscripcion" class="form-control" >
											  	<?php 

											  	if ($_SESSION['Inscripciones'] == "Activo") {
											  	 	echo "<option>Activo</option>";
											  	 	echo "<option>Finalizado</option>";
											  	 } else{
											  	 	echo "<option>Finalizado</option>";
											  	 	echo "<option>Activo</option>";
											  	 }
											  	 ?>
											  	
											  </select>
											</div>

										<div class="RespuestaAjax"></div>
										
										    <p class="text-center">
										    	<button href="#!" class="btn btn-info btn-raised "><i class="zmdi zmdi-floppy"></i> Guardar</button>
										    </p>
									    </form>
									</div>
								</div>
							</div>
						</div>

						<script type="text/javascript">
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
           if( a == <?php echo "'".$_SESSION['Inscripciones']."'";?> ){
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
		
		$(".RespuestaAjax").html(respuesta);
		$('#loading-screen').css("display","none");
		
		location.reload();

		
	})

	.fail(function(){
		console.log('error');
	});

}
        });
    });
							

						</script>
						