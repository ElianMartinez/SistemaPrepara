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


   <center> <h1 class="text-titles"> Buscar Estudiantes por sección</h1> <button class="btn btn-primary" onclick="$('.respuesta').empty(); $('.a').css('display','')">Atras</button></center>

    <div class="animated bounceInDown a" value="1ro" onclick="desaparecer(this);" id="uno">
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

        <script type="text/javascript">  

            function editar(){
                      var OriginalContent = $(this).text();
        $(this).addClass("cellEditing");
        $(this).html("<input type='text' value='" + OriginalContent + "' />");
        $(this).children().first().focus();
        $(this).children().first().keypress(function (e) {
            if (e.which == 13) { 
                var newContent = $(this).val();
                $(this).parent().text(newContent);
                $(this).parent().removeClass("cellEditing");
                }
            }); 
        $(this).children().first().blur(function(){
            $(this).parent().text(OriginalContent);
            $(this).parent().removeClass("cellEditing");
            }); 
            }
    
     
       

           
            function desaparecer(a){
                var data = $(a);
                $('.a').css("display","none");
                var cor = data.attr("value");
               buscar_grado(cor);
            }

            function BE(a){
                var data = $(a);
                $('.a').css("display","none");
                var cor = data.attr("value");
               buscar_seccion(cor);
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
        function buscar_seccion(seccion){
        var accion="<?php echo SERVERURL;?>Ajax/studentAjax.php";
        var metodo="POST";
        console.log(accion+"    " + metodo);
        $('#loading-screen').css("display","");
    $.ajax({
        url:accion,
        type:metodo,
        dataType:'html',
        data:{seccion1 : seccion},
    })
    .done(function(respuesta){
        $(".respuesta").html(respuesta);
         $('#loading-screen').css("display","none");
    })

    .fail(function(){
        console.log('error');
    });



}




        </script>
        
</body>

</html>