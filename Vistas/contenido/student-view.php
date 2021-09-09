
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Usuario <small>Estudiante-Inscripción</small></h1>
			</div>
			<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
		</div>
		<div class="container-fluid">
<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	
						<?php if ($_SESSION['Inscripciones'] == 'Activo') {
							echo "<li style='background-color: green' class='active'><a>Inscripción: ".$_SESSION['Inscripciones']."</a></li>"; 
						}else{
						echo "<li style='background-color: red' class='active'><a>Inscripción: ".$_SESSION['Inscripciones']."</a></li>"; 
					} ?>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form  enctype="multipart/form-data" class="FormularioAjax1" action="<?php echo SERVERURL;?>Ajax/studentAjax.php" method="POST" data-form="save">

									    	<div class="form-group label-floating">
											  <label class="control-label">Id del Estudiante</label>
											  <input required=""  id="id"  name="Id" class="form-control" type="number">
												
											</div>

									    	<div class="form-group label-floating">
											  <label class="control-label">Nombre</label>
											  <input required="" id="nombre"  name="NombreE" class="form-control" type="text">
												
											</div>

											<div class="form-group label-floating">
											  <label class="control-label">Apellido Paterno</label>
											  <input  id="ApellidoP" name="ApellidoP" class="form-control" type="text">
											</div>

											<div class="form-group label-floating">
											  <label class="control-label">Apellido Materno</label>
											  <input required=""  id="ApellidoM" name="ApellidoM" class="form-control" type="text">
											</div>
										
											<div class="form-group ">
										      <label class="">Grado</label>
										        <select id="Grado" name="Grado" onchange="buscar_datos(this.value)" class="form-control">
										        	 <option></option>
										          <option>1ro</option>
										          <option>2do</option>
										          <option>3ro</option>
										          <option>4to</option>
										        </select>
										      </div>

											<p class="form-group" id="tap">
												
											</p>

											<div class="form-group ">
										      <label class="">Sexo</label>
										        <select id="Sexo" name="Sexo" class="form-control"> 
										          <option>M</option>
										          <option>F</option>
										       
										        </select>
										      </div>

										      <div class="form-group ">
										      <label class="">Estatus</label>
										        <select id="Estatus" name="Estatus" class="form-control"> 
										          <option>Activo</option>
										          <option>Egresado</option>
										          <option>Retirado</option>
										         
										        </select>
										      </div>

											<div class="form-group ">
										      <label class="">Año Escolar</label>
										        <select id="anno" name="anno" class="form-control">
										        	 
										          <option>2018-2019</option>
										          <option>2019-2020</option>
										          <option>2021-2022</option>
										          <option>2022-2023</option>
										        </select>
										      </div>

											<div class="form-group label-floating">
											  <label class="">Fecha Nacimiento</label>
											  <input id="FechaNa" name="FechaNa" required="" class="form-control" type="Date" onchange="calculateAge(this.value);">
											</div>

											<div class="form-group label-floating">
											  <label class="">Edad</label>
											  <input id="Edad" name="Edad"  required="" class="form-control" type="number">
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
					  	
					  	</div>
					</div>
				</div>
			</div>
		</div>
	<script>
		function calculateAge(birthday) {
    var birthday_arr = birthday.split("-");
    var birthday_date = new Date(birthday_arr[0], birthday_arr[1] - 1, birthday_arr[2]);
    var ageDifMs = Date.now() - birthday_date.getTime();
    var ageDate = new Date(ageDifMs);
    
    var a = Math.abs(ageDate.getUTCFullYear() - 1970);

    document.getElementById('Edad').value = a;


}

function buscar_datos(consultaa){
	
	var form=$(".FormularioAjax1");
        
                     $('#loading-screen').css("display","");
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
		$('#loading-screen').css("display","none");
		
        
	})

	.fail(function(){
		console.log('error');
	});
}

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
       	var id = $("#id").val();
        var nombre = $("#nombre").val();
        var ApellidoP = $("#ApellidoP").val();
        var ApellidoM = $("#ApellidoM").val();
        var Fecha = $("#FechaNa").val();
        var textoAlerta;
        if(tipo==="save"){
            textoAlerta=" "+id+"    "+nombre+"    "+ApellidoP+"     "+ApellidoM+"    "+Fecha;
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
                     $('#tap').empty();
		
		
	})

	.fail(function(){
		console.log('error');
	});

}
        });
    });






	</script>

</body>
</html>
