<script type="text/javascript">
var a = 0;
var ValorA = new Array();

function verOption(a,obje,valor) {
	 if (valor != "") {
	 	var m = a;
	    var ver = true;
	for (var i = 0; i <= 9; i++) {
		if (valor == ValorA[i]) {
			swal( "'"+valor+"'","Esta Asignatura ya esta puesta  porfavor introduzca una asignatura que no se ha selecionado","info");

			ver = false;
			m.value = "";

		}
		
		}
		if(ver == true){
			a++;
			ValorA[obje] = valor;
			console.log(ValorA);
		}
	 } else {
	 	
	 }


}

 
	 
</script>	                     
			
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-graduation-cap zmdi-hc-fw"></i> Administración  <small>Grado</small></h1>
			</div>
			<p class="lead">En este formulario podrá <b>modificar</b> los grados ya existentes que son <b>1ro, 2do, 3ro y 4to</b> de bachillerato y asignarles las distintas materias por semestre a cada grado deseado!</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">New</a></li>
					  	<li><a href="" data-toggle="tab">List</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane  fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form autocomplete="off" enctype="multipart/form-data" class="FormularioAjax" action="<?php echo SERVERURL;?>Ajax/gradoAjax.php" method="POST"  data-form="save">

									    	<div class="form-group col-md-4">
											  <label class="">Nombre</label>
											  <select required="" name="Nombre" class="form-control" type="text">
											  	<option></option>
											  	<option>1ro</option>
										        <option>2do</option>
										        <option>3ro</option>
										        <option>4to</option>

											  </select>
											</div>
											
											<div class="form-group col-md-4">
										      <label class="">Semestre</label>
										        <select name="Semestre" class="form-control">
										          <option>Primer</option>
										          <option>Segundo</option>
										        </select>
										    </div>
										    <div class="form-group col-md-4">
										      <label class="">Año</label>
										        <select name="anno" class="form-control">
										          <option>2017</option>
										          <option>2016</option>
										        </select>
										    </div>
										    <br/>
										    <br/>
									
									<h2 class="text-center"> Asignaturas </h2>

										<?php require_once "./Controladores/gradoControlador.php";
						$insGrado = new gradoControlador();
						 
							 $insGrado->combobox_controlador();

						 ?>
						  <br>
										    <div class="RespuestaAjax"></div>
									    </form>
									</div>
								</div>
							</div>
						</div>
					  	

<script type="text/javascript">
	function desabilitar_1(value){
		if(value != ""){
		$('#Materia-2').removeAttr('disabled');
			console.log("klk");
		}

	}
	<?php
	for ($i=2; $i <= 13 ; $i++) { 
		$a = $i+1;
		echo 'function desabilitar_'.$i.'(value){
		if(value != ""){
			$("#Materia-'.$a.'").removeAttr("disabled");
		}

	}';
	 	
	 }
	
	

	 ?>
</script>