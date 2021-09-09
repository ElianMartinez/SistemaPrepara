<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="_width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
 
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>Vistas/css/animate.css"> 
</head>

<body>
<style type="text/css">
        *{
    margin: 0px;
padding: 0px;
}
#cabeza{
    width: 350px;
    height: 80px;
    border: 2px solid;
    font-size: 20px;
font-family: Arial, Helvetica, sans-serif;
border-radius: 10px;
box-shadow: 2px 3px 1px #00c9ff;
  margin: 25px auto; 
}
#cabeza #subcabeza{
    /* margin-left: 5px; */
    /* margin-top: 5px; */
}

#seccion1{
    margin-left: 5px;
margin-bottom: 5px;
}

#todaseccion{
    margin-left: 5px;
    margin-bottom: 5px;
}

.animated{
    width: 300px;
    height: 200px;
    border: 2px solid;
    float: left;
    margin-left: 30px;
    margin-top: 50px;
    cursor: pointer;    
}
.dentro{
    width: 300px;
    height: 40px;
    background: #00c9ff;
    border-bottom: 2px solid;
    text-align: center;
    font-size: 25px;
    font-weight: bold;
   
}

/* responsie me falta */
@media screen and (max-width : 612px){
    #cabeza{
        align-self: center;
     
    }
    .animated{
    
    } 
    .dentro{
     
    }
    .respuesta{
        width: 80%;
    }
}
    

    </style>

   <center><h1>Agregar Boletines</h1> <button class="btn btn-primary" onclick="$('.respuesta').empty(); $('.Form').css('display','none'); $('.a').css('display','')">Atras</button></center>

    <div class="animated bounceInDown a" value="1ro" onclick="desaparecer(this); " id="uno">
        <div class="dentro">
            <p>1ro</p>
        </div>
    </div>
    
    <div class="animated bounceInDown a" value="2do" onclick="desaparecer(this);" style="animation-duration: 1.3s;"  id="dos">
        <div class="dentro">
            <p>2do</p>
        </div>
    </div>

  
    <div class="animated bounceInDown a" value="3ro" onclick="desaparecer(this);" style="animation-duration: 1.6s;"  id="tres">
        <div class="dentro">
            <p>3ro</p>
        </div>
    </div>

    <div class="animated bounceInDown a" value="4to" onclick="desaparecer(this);" style="animation-duration: 1.9s;" id="cuatro">
        <div class="dentro">
            <p>4to</p>
        </div>
    </div>

    <p class="respuesta">
        
    </p>


    <div style="display: none" class="Form">
        <div class="tab-content">
            <div class="container-fluid">
            <div class="page-header">
              <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Nota <small>Boletines</small></h1>
            </div>
       
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
                        <li class="active"><a href="#new" data-toggle="tab">Grado: <b id="grado">1ro</b>  </a></li>
                        <li><a href="#list" data-toggle="tab">Sección: <b id="seccion">B</b>  </a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="new">
                            <div class="container-fluid">
                                <div class="row">
                        <div class="tab-pane fade active in" id="newSchool">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                                        <form autocomplete="off" enctype="multipart/form-data" class="FormularioAjax1" action="<?php echo SERVERURL;?>Ajax/BoletinAjax.php" method="post" data-form="update">
                                            <div class="form-group label-floating">
                                              <label class="control-label">Semestre</label>
                                              <select id="semestreF" name="Semestre" class="form-control" >
                                                <option>Primer</option>
                                                <option>Segundo</option>
                                                </select>
                                            </div>

                                            <div class="form-group label-floating">
                                              <label class="control-label">Año Escolar</label>
                                              <input id="annoEF" name="ano" class="form-control"  value="<?php echo $_SESSION['Ano_E']; ?>" type="text">
                                            </div>
                                            <div class="form-group label-floating">
                                              <label class="control-label">Grado</label>
                                              <select id="gradoF" required="" name="Grado" onchange="veri(this);" class="form-control" >
                                             <option value="1">1ro</option>
                                             <option value="2">2do</option>
                                             <option value="3">3ro</option>
                                             <option value="4">4to</option>
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
    </div>

        <script type="text/javascript">
           var datosA = new Array();



            function desaparecer(a){
                var data = $(a);
                $('.a').css("display","none");
                var cor = data.attr("value");
               buscar_grado(cor);
               datosA[0] = cor;

               if (cor == "1ro") {
                datosA[3]= 1;
               } 
               if(cor == "2do"){
                datosA[3]= 2;
               }
               if(cor == "3ro"){
                 datosA[3]= 3;
               }
               if(cor == "4to"){
                    datosA[3] = 4;
               }
               if(cor == "5to"){
                 datosA[3]= 5;
               }
               if(cor == "6to"){
                    datosA[3] = 5;
               }
            }


            function BE(a){

                var data = $(a);
                $('.d').css("display","none");
                var cor = data.attr("value");
                 var nom = data.attr("ne");
                 console.log(cor);
                  datosA[1] = cor;
                  datosA[2] = nom;
                 $(".Form").css("display","");
                 $('#grado').text(datosA[0]);
                 $('#seccion').text(datosA[2]);

            }

                    function veri(valo){
                        var a =  valo.value;
                        if( a > datosA[3]) 
                     {    

                        swal("No se puede seleccionar este grado","Esta grado no es mayor al grado actual de la seccion porfavor eliga otra opción menor","warning");  
                        valo.value = datosA[0];
                    }
                           
                             }     

                        

            function buscar_grado(grado){
        var accion="<?php echo SERVERURL;?>Ajax/studentAjax.php";
        var metodo="POST";
        console.log(accion+"    " + metodo);
    $.ajax({
        url:accion,
        type:metodo,
        dataType:'html',
        data:{grado1 : grado},
    })
    .done(function(respuesta){
        $(".respuesta").html(respuesta);
    })

    .fail(function(){
        console.log('error');
    });

}

            function buscar_grado(grado){
        var accion="<?php echo SERVERURL;?>Ajax/studentAjax.php";
        var metodo="POST";
        console.log(accion+"    " + metodo);
    $.ajax({
        url:accion,
        type:metodo,
        dataType:'html',
        data:{grado1 : grado},
    })
    .done(function(respuesta){
        $(".respuesta").html(respuesta);
    })

    .fail(function(){
        console.log('error');
    });

}


$('.FormularioAjax1').submit(function(e){
        
        e.preventDefault();
        var form=$(this);
    
        //Valores staticos
        var grado = $('#gradoF').val();
        var grado1 = "";
        if (grado == 1) {
            grado1 = "1ro";
        }
         if (grado == 2) {
            grado1 = "2do";
        }
         if (grado == 3) {
            grado1 = "3ro";
        }
         if (grado == 4) {
            grado1 = "4to";
        }
         if (grado == 5) {
            grado1 = "5to";
        }
         if (grado == 6) {
            grado1 = "6to";
        }



        var seccion1 = datosA[1];
        var anno = $('#annoEF').val();
        var ns = datosA[2];
        var semestre = $('#semestreF').val(); 
        var tipo=form.attr('data-form');
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var respuesta=form.children('.RespuestaAjax');
        console.log(seccion1+" "+anno+" "+grado1+" "+semestre);
        console.log(tipo +"    "+ accion+"    " + metodo);
               

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
            
                     
            var a = "Activo";
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
        dataType:'html',
        data:{grado: grado1,seccion: seccion1,anno:anno,Semestre:semestre,ns1:ns},
    })
    .done(function(respuesta){
      $(".RespuestaAjax").html(respuesta);
         $('#loading-screen').css("display","none");        
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