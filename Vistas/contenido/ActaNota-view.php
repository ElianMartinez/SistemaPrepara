 <div class="container-fluid"  >
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Notas <small>Acta de Notas</small></h1>
			</div>
			<p class="lead">.</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active">  <a onclick="atras();"><i class="fa fa-arrow"></i> Atrás</a></li>
					  	
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									 <form  id="ocurtar" enctype="multipart/form-data" class="FormularioAjax1" action="<?php echo SERVERURL;?>Ajax/studentAjax.php" method="POST" data-form="save">

											<div class="form-group ">
										      <label class="">Grado</label>
										        <select required="" id="Grado" name="Grado" onchange="buscar_datos(this.value)"  class="form-control">
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
										      <label class="">Semestre</label>
										        <select id="semestre" name="semestre12" class="form-control"> 
										          <option>Primer</option>
										          <option>Segundo</option>
										        </select>
										      </div>

										  

											<div class="form-group ">
										      <label class="">Año Escolar</label>
										        <select id="anno" name="anno" class="form-control"> 
										           <option><?php echo $_SESSION['Ano_E']; ?></option>
    <option>2012-2013</option>
    <option>2013-2014</option>
    <option>2014-2015</option>
    <option>2015-2016</option>
    <option>2016-2017</option>
    <option>2017-2018</option>
    <option>2018-2019</option>
    <option>2019-2020</option>
    <option>2020-2021</option>
    <option>2021-2022</option>
    <option>2022-2023</option>
    <option>2023-2024</option>
    <option>2024-2025</option>
    <option>2025-2026</option>
    <option>2026-2027</option>
    <option>2027-2028</option>
										        </select>
										      </div>

										



									
										    <p  class="text-center">
										    	<button type="submit" class="btn btn-primary btn-raised"><i class="zmdi zmdi-search"></i> Buscar</button>
												</p>
												
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

		<div class="RespuestaAjax table-responsive" style="display: block; width: 98%; margin: auto; font-size: 12px;"></div>

	<script>
	var seccion = "";
		function aaaa(valor) {
			 seccion = valor;
		}

		function atras() {
			$(".RespuestaAjax").empty();
			$('#ocurtar').css("display","");
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
		data:{consulta12: consultaa},
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
        	
                     
        	var a = "Activa";
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
                     $('#ocurtar').css("display","none");
	})

	.fail(function(){
		console.log('error');
	});

}
        });
    });






	</script>  

			<style type="text/css">
				.vertical{
					
					writing-mode: vertical-rl;
				 rotation: 90deg;

				}
				#sub th{
					width: 15px;
				}

			</style>
 
 

	
