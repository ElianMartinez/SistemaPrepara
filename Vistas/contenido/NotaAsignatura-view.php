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

   <center><h1 class="text-titles">Nota por Asignatura</h1> <button class="btn btn-primary" onclick=" $('#grado').text(''); $('#semestre').text(''); $('#materia').text(''); $('.respuesta').empty(); $('#seccion').text(''); $('.sem').css('display','none'); $('.a').css('display',''); $('.Calificaciones').empty(); $('.totali').css('display','none'); $('#annoEscolar').empty();">Atras</button></center>

   <div  class="Form" >
        <div class="tab-content">
            <div class="container-fluid">
            <div class="page-header" >
              <h2 class="text-titles"><i class="zmdi zmdi zmdi-library zmdi-hc-fw"></i> Grado:<b id="grado"></b>   Sección: <b id="seccion"></b>     Semestre:<b id="semestre"></b> Año Escolar:<b id="annoEscolar"></b>  Materia: <b id="materia"></b> <small></small></h2>
            </div>
 <div style="display: none;" class="totali">
<label style="color: black;"><b><h3 class="numero_E"></h3><h3 class="nombre_E"></h3>  <h2 class="nCual" style="color:red;"></h2></b></label>
            
            
            
            </div>
        </div>
   

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

    <p class="Calificaciones">
         
         


    </p>

    <div   class="semestre">
        <div class="animated bounceInDown sem" value="Primer" onclick="Traer(this);" style="animation-duration: 1.9s; display: none;  " >
        <div class="dentro">
            <p>Primer Semestre</p>
        </div>
    </div>

     <div class="animated bounceInDown sem" value="Segundo" onclick="Traer(this);" style="animation-duration: 1.9s; display: none;" >
        <div class="dentro">
            <p>Segundo Semestre</p>
        </div>
    </div>
    <div  style="  display: none; " class="animated bounceInDown  sem">
      <label style="color: black; margin-left:10px;  font-size:30px; ">Año Escolar</label>
    <select onchange="annadir(this.value);" style="width: 200px; margin-left:10px; font-size:20px; " required=""  class="form-control " id="annoEscolarValor">
      <option><?php echo $_SESSION['Ano_E']; ?></option>
    <option>2011-2012</option>
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
    </div>

    

    
        <script type="text/javascript">  
        var datosA = new Array();


            function desaparecer(a){
                var data = $(a);

                $('.a').css("display","none");
                var cor = data.attr("value");
               buscar_grado(cor);
               datosA[0] = cor;
               $("#grado").text(cor);

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

            }
            


            function BE(a){
                var data = $(a);
                $('.d').css("display","none");
                var cor = data.attr("value");
                 var nom = data.attr("ne");
                 console.log(cor);
                  datosA[1] = cor;
                  datosA[2] = nom;
                  $(".sem").css("display","block");

                  $('#seccion').text(datosA[2]);
            }
            function TE(a){
                  var data = $(a);
                  $('.asig').css("display","none");
                  var cor = data.text();
                datosA[5] = cor; 
                $('#materia').text(datosA[5]); 
                var codigo = data.attr("codigo");
                    buscar_calificacion(datosA[2],datosA[0],codigo,datosA[4],datosA[6]);
            }     

           function annadir(valor){
              $("#annoEscolar").text(valor);
              datosA[6] = $("#annoEscolarValor").val();
            }
            function Traer(a){
              if ($("#annoEscolarValor").val() != "") {


              var data = $(a);
                datosA[4] = data.attr("value");
                $("#semestre").text(datosA[4]);
                $('.sem').css('display','none');
                datosA[6] = $("#annoEscolarValor").val();
                console.log($("#annoEscolarValor").val());
               $("#annoEscolar").text($("#annoEscolarValor").val());
                buscar_asignatura(datosA[0],datosA[4]);
                }else{
                  $("#annoEscolarValor").focus();
                  swal("Ingrese un año escolar","Porfavor ingrese el año escolar el cual queire buscar las calificaciones","warning");



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

            function buscar_asignatura(grado,semestre){
        var accion="<?php echo SERVERURL;?>Ajax/studentAjax.php";
        var metodo="POST";
        console.log(accion+"    " + metodo);
    $.ajax({
        url:accion,
        type:metodo,
        dataType:'html',
        data:{grado3 : grado,semestre3:semestre},
    })
    .done(function(respuesta){
        $(".respuesta").html(respuesta);
    })

    .fail(function(){
        console.log('error');
    });

}

function guardar_calificacion(id,E1,E2,E3,E4,PCP,Ex,E30,E70,CFS,C50,CPC50,CPC,CC,Ex30,Pex,Ex70,CEx){
        var accion="<?php echo SERVERURL;?>Ajax/studentAjax.php";
        var metodo="POST";
        console.log(accion+"    " + metodo);
    $.ajax({
        url:accion,
        type:metodo,
        dataType:'html',
        data:{Id:id,E1:E1,E2:E2,E3:E3,E4:E4,PCP:PCP,Ex:Ex,E30:E30,E70:E70,CFS:CFS,C50:C50,CPC50:CPC50,CPC:CPC,CC:CC,Ex30:Ex30,Pex:Pex,Ex70:Ex70,CEx:CEx},
    })
    .done(function(respuesta){
        $(".respuesta").html(respuesta);
    })

    .fail(function(){
        console.log('error');
    });

}

 function buscar_calificacion(seccion,grado,codigo,semestre,anno){
        var accion="<?php echo SERVERURL;?>Ajax/studentAjax.php";
        var metodo="POST";


        console.log(accion+"    " + metodo);
    $.ajax({
        url:accion,
        type:metodo,
        dataType:'html',
        data:{grado4 : grado,seccion4:seccion,asignatura4:codigo,semestre4:semestre,anno:anno},
    })
    .done(function(respuesta){
        $(".Calificaciones").html(respuesta);
    })

    .fail(function(){
        console.log('error');
    });

}


    $("td").click(function(){
        console.log($(this).text());
    });




var numeroE = 0;
var nnn = 0;
var idE = 0;
function Veri(a,cual,id){
  
    
var columna = $(a).index();
idE = id;
console.log(idE);
var fila = $(a).parent('tr').index();
numeroE = fila + 1;
var table = document.getElementById("table"),rIndex;

var nCual = "";
//$(".nombre_E").text("  "+table.rows[numeroE].cells[2].innerHTML+" "+table.rows[numeroE].cells[1].innerHTML);
//$(".numero_E").text("#"+numeroE);
nnn = cual;
if (cual == 5) {
 nCual = "E1";
}
if(cual == 6){
   nCual = "E2";
}
if(cual == 7){
   nCual = "E3";
}
if(cual == 8){
   nCual = "E4";
}
if(cual == 10){
   nCual = "Examen";
}
if(cual == 17){
     nCual = "CPC";
}
if(cual == 23){
 nCual = "PEx";
}

Sweetalert2({
            title:  "#"+numeroE+" "+table.rows[numeroE].cells[2].innerHTML+" "+table.rows[numeroE].cells[1].innerHTML ,
            text:  '<h2>'+nCual+'</h2>  <input min="1" max="100" value="" style= "width: 60px;"  type="number" name="valor" id="valores">',
            type: 'info',
            confirmButtonText: 'Guardar'
          }).then(function() {
             Guardar_Calcular(numeroE,$('#valores').val())
          });



}

function Guardar_Calcular(numero,valor){
  Vnumero = parseInt(valor);
  if (Number.isInteger(Vnumero) == true) {
    if (Vnumero > 100 || Vnumero < 0 ) {

      swal("El número "+Vnumero+" no esta dentro der rango","Porfavor ingrese un valor numerico que este dentro del rango 1 a 100 no puede ser mayor a 100 ni menor a 0","warning");
    }else{
       var table = document.getElementById("table"),rIndex;
       
  $(".totali").css("display","none");
  table.rows[numero].cells[nnn].style.background = "#BDBDBD";
  table.rows[numero].cells[nnn].style.color = "black";
  table.rows[numero].cells[nnn].innerHTML = Vnumero;
  var E1,E2,E3,E4,PCP,Ex,E30,E70,CFS,C50,CPC50,CPC,CC,Ex30,Pex,Ex70,CEx;
  E1 = 0;
  E1 = parseInt(table.rows[numero].cells[5].innerHTML);
  E2 = parseInt(table.rows[numero].cells[6].innerHTML);
  E3 = parseInt(table.rows[numero].cells[7].innerHTML);
  E4 = parseInt(table.rows[numero].cells[8].innerHTML);
  Ex = parseInt(table.rows[numero].cells[10].innerHTML);

  PCP = Math.round((E1+E2+E3+E4)/4);
  E30 = Math.round(Ex * 0.3);
  E70 = Math.round(PCP * 0.7);
  CFS = E30 + E70;


  table.rows[numero].cells[9].innerHTML = PCP;
  table.rows[numero].cells[11].innerHTML = E30;
  table.rows[numero].cells[12].innerHTML = E70;
  table.rows[numero].cells[13].innerHTML = CFS; 
    if (E1 != 0 && E2 != 0 && E3 != 0 && E4 != 0 && Ex != 0 ) {
    if (CFS < 70) {
      table.rows[numero].cells[26].innerHTML = "COMPLETIVO";
      table.rows[numero].style.background = "#F7D358";
      C50 = Math.round(PCP * 0.5);
      table.rows[numero].cells[16].innerHTML = C50;
      CPC = parseInt(table.rows[numero].cells[17].innerHTML);
      CPC50 = Math.round(CPC * 0.5);
      CC = Math.round(C50 + CPC50);
      table.rows[numero].cells[18].innerHTML = CPC50;
      table.rows[numero].cells[19].innerHTML = CC;
      if (CPC != 0) {
      if(CC < 70){

        table.rows[numero].cells[26].innerHTML = "EXTRAORDINARIO";
      table.rows[numero].style.background = "#F5A9A9";
      Ex30 = Math.round(PCP * 0.3);
       
      Pex = parseInt(table.rows[numero].cells[23].innerHTML);
      Ex70 = Math.round(Pex * 0.7);
      Cex = Ex30 + Ex70;
       table.rows[numero].cells[22].innerHTML = Ex30;
      
       table.rows[numero].cells[24].innerHTML = Ex70;
      table.rows[numero].cells[25].innerHTML =  Cex;

      }
      else{

         table.rows[numero].cells[26].innerHTML = "COMPLETIVO";
       table.rows[numero].style.background = "#F7D358";
       table.rows[numero].cells[22].innerHTML = "0";
      table.rows[numero].cells[23].innerHTML =  "0";
       table.rows[numero].cells[24].innerHTML = "0";
      table.rows[numero].cells[25].innerHTML =  "0";
    }

      }else{
      table.rows[numero].cells[26].innerHTML = "COMPLETIVO";
       table.rows[numero].style.background = "#F7D358";
       table.rows[numero].cells[22].innerHTML = "0";
      table.rows[numero].cells[23].innerHTML =  "0";
       table.rows[numero].cells[24].innerHTML = "0";
      table.rows[numero].cells[25].innerHTML =  "0";
    }
    
    }else{
      table.rows[numero].cells[26].innerHTML =  "GENERAL";
       table.rows[numero].style.background =    "white";
      table.rows[numero].cells[16].innerHTML =  "0";
      table.rows[numero].cells[17].innerHTML =  "0";
      table.rows[numero].cells[18].innerHTML =  "0";
      table.rows[numero].cells[19].innerHTML =  "0";
       table.rows[numero].cells[22].innerHTML = "0";
      table.rows[numero].cells[23].innerHTML =  "0";
       table.rows[numero].cells[24].innerHTML = "0";
      table.rows[numero].cells[25].innerHTML =  "0";
      table.rows[numero].cells[19].innerHTML = "0";
      }
    }else{
      table.rows[numero].cells[26].innerHTML =  "GENERAL";
       table.rows[numero].style.background =    "white";
      table.rows[numero].cells[16].innerHTML =  "0";
      table.rows[numero].cells[17].innerHTML =  "0";
      table.rows[numero].cells[18].innerHTML =  "0";
      table.rows[numero].cells[19].innerHTML =  "0";
       table.rows[numero].cells[22].innerHTML = "0";
      table.rows[numero].cells[23].innerHTML =  "0";
       table.rows[numero].cells[24].innerHTML = "0";
      table.rows[numero].cells[25].innerHTML =  "0";
    }
  }
  
  E1 = parseInt(table.rows[numero].cells[5].innerHTML);
  E2 = parseInt(table.rows[numero].cells[6].innerHTML);
  E3 = parseInt(table.rows[numero].cells[7].innerHTML);
  E4 = parseInt(table.rows[numero].cells[8].innerHTML);
  PCP = parseInt(table.rows[numero].cells[9].innerHTML);
  Ex = parseInt(table.rows[numero].cells[10].innerHTML);
  E30 = parseInt(table.rows[numero].cells[11].innerHTML);
  E70 = parseInt(table.rows[numero].cells[12].innerHTML);
  CFS = parseInt(table.rows[numero].cells[13].innerHTML);
  C50 = parseInt(table.rows[numero].cells[16].innerHTML);
  CPC50 = parseInt(table.rows[numero].cells[18].innerHTML);
  CPC = parseInt(table.rows[numero].cells[17].innerHTML);
  CC = parseInt(table.rows[numero].cells[19].innerHTML);
  Ex30 = parseInt(table.rows[numero].cells[22].innerHTML);
  Pex = parseInt(table.rows[numero].cells[23].innerHTML);
  Ex70 = parseInt(table.rows[numero].cells[24].innerHTML);
  CEx = parseInt(table.rows[numero].cells[25].innerHTML);






  guardar_calificacion(idE,E1,E2,E3,E4,PCP,Ex,E30,E70,CFS,C50,CPC,CPC50,CC,Ex30,Pex,Ex70,CEx);
     }else{
    swal("No es un numero","Porfavor ingrese un valor numerico","warning");
         }

           } 

           


        </script>
        
</body>

</html>