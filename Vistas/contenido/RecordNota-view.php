<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Notas <small>Record de Notas</small></h1>
			</div>
			<p class="lead"></p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab" onclick="$('#Busqueda').css('display',''); 
					  	$('.RecordB').empty();" >Atrás</a></li>
					  	
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row" id="Busqueda">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    
												
									    	 
									    	<div class="form-group label-floating">
											  <label class="control-label">Id, Nombre, Apellido Parterno, Apellido Materno </label>
											  <input required="" oninput="buscar_estudiantes(this.value)" class="form-control" type="text">
												
											</div>
											<br>
											<br>
											<br>
										    
												<div class="RespuestaAjax">
													
												</div>

									   
									</div>
								</div>
							</div>

							<p  class="RecordB">
								

							</p>
						</div>
					</div>



<script type="text/javascript">
	
	 function buscar_estudiantes(texto){
      
	 	  var accion="<?php echo SERVERURL;?>Ajax/RecordAjax.php";
        var metodo="POST";
        console.log(accion+"    " + metodo);
       
    $.ajax({
        url:accion,
        type:metodo,
        dataType:'html',
        data:{valor : texto},
    })
    .done(function(respuesta){
        $(".RespuestaAjax").html(respuesta);
       
    })

    .fail(function(){
        console.log('error');
    });
}


function ocultarForm() {
	$("#Busqueda").css("display","none");
}

 function buscar_record(a){
      $('#loading-screen').css("display","");
	 	  var accion="<?php echo SERVERURL;?>Ajax/RecordAjax.php";
        var metodo="POST";
        console.log(accion+"    " + metodo);
       var idE = $(a).attr("idE");
       var Grado1 = $(a).attr("grado");
     
    $.ajax({
        url:accion,
        type:metodo,
        dataType:'html',
        data:{id : idE,Grado : Grado1},
    })
    .done(function(respuesta){
        $(".RecordB").html(respuesta);

        $('#loading-screen').css("display","none");
		
       
    })

    .fail(function(){
        console.log('error');
    });
}

</script>
						