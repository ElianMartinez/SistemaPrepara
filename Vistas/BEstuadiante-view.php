<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="_width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo SERVERURL; ?>Vistas/css/estilo.css" />
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
    padding-top: 15px; 
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
}
    </style>


    
        <div id="cabeza">
            
            <strong>Curso:</strong> <curso id="curso"></curso><br></br>
           <strong id="seccion1">Seccion:</strong>
       
        </div>
  

    <div class="animated bounceInDown" onclick="uno()" id="uno">
        <div class="dentro">
            <primero>1ro</primero>
        </div>
    </div>
    
    <div class="animated bounceInDown" onclick="seccion_a()" id="seccion_a"style="display: none;" >
            <div class="dentro">
                <section>A</section>
            </div>
        </div>
        




    <div class="animated bounceInDown" style="animation-duration: 1.3s;" onclick="dos()" id="dos">
        <div class="dentro">
            <segundo>2do</segundo>
        </div>
    </div>

    <div class="animated bounceInDown" onclick="seccion_b()"id="seccion_b" style="display: none;">
            <div class="dentro">
                <section>B</section>
            </div>
        </div>
        

    
    <div class="animated bounceInDown" style="animation-duration: 1.6s;" onclick="tres()" id="tres">
        <div class="dentro">
            <tercero>3ro</tercero>
        </div>
    </div>

    <div class="animated bounceInDown" onclick="seccion_c()"id="seccion_c" style="display: none;" >
            <div class="dentro">
                <section>C</section>
            </div>
        </div>
        

    <div class="animated bounceInDown" style="animation-duration: 1.9s;" onclick="cuatro()" id="cuatro">
        <div class="dentro">
            <cuarto>4to</cuarto>
        </div>
    </div>

    <div class="animated bounceInDown" onclick="seccion_d()" style="display: none;" id="seccion_d" >
            <div class="dentro">
                <section>D</section>
            </div>
        </div>

        <script type="text/javascript">
            
function uno(){
document.getElementById("curso").innerHTML="1ro";
document.getElementById("seccion1").style.display ="block";
document.getElementById("uno").style.display="none";
document.getElementById("dos").style.display="none";
document.getElementById("tres").style.display="none";
document.getElementById("cuatro").style.display="none";
document.getElementById("seccion_a").style.display="block";
document.getElementById("seccion_b").style.display="block";
document.getElementById("seccion_c").style.display="block";
document.getElementById("seccion_d").style.display="block";
}

function dos(){
    document.getElementById("curso").innerHTML="2do";
    document.getElementById("seccion1").style.display ="block";
    document.getElementById("uno").style.display="none";
    document.getElementById("dos").style.display="none";
    document.getElementById("tres").style.display="none";
    document.getElementById("cuatro").style.display="none";
    document.getElementById("seccion_a").style.display="block";
    document.getElementById("seccion_b").style.display="block";
    document.getElementById("seccion_c").style.display="block";
    document.getElementById("seccion_d").style.display="block";
    }
    
function tres(){
    document.getElementById("curso").innerHTML="3ro";
    document.getElementById("seccion1").style.display ="block";
    document.getElementById("uno").style.display="none";
document.getElementById("dos").style.display="none";
document.getElementById("tres").style.display="none";
document.getElementById("cuatro").style.display="none";
document.getElementById("seccion_a").style.display="block";
document.getElementById("seccion_b").style.display="block";
document.getElementById("seccion_c").style.display="block";
document.getElementById("seccion_d").style.display="block";
    
    }
    
function cuatro(){
    document.getElementById("curso").innerHTML="4to";
    document.getElementById("seccion1").style.display ="block";
    document.getElementById("uno").style.display="none";
    document.getElementById("dos").style.display="none";
    document.getElementById("tres").style.display="none";
    document.getElementById("cuatro").style.display="none";
    document.getElementById("seccion_a").style.display="block";
    document.getElementById("seccion_b").style.display="block";
    document.getElementById("seccion_c").style.display="block";
    document.getElementById("seccion_d").style.display="block";
    }

    function seccion_a(){
        
    }
        </script>
        
</body>

</html>