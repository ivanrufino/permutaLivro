<script>
    $(document).ready(function(){
        var optusuario="";
        var allNodes = $(".valores");
        allNodes.each(function(){
            //alert($(this).html())  
        })
        var valores = ["10", "20", "30", "40", "50", "60", "70", "80", "90", "100", "200", "300", "400", "500"];
        shuffle(valores);
        console.log(valores);
        var selecionado;
         var cont=valores.length;
       $(".valores").click(function(){ 
           cont=cont-1;
           if (cont>=0){
           var y = (this.id)-1
           
           var valor=$(this).html();
           
           if (optusuario==""){
               optusuario=valor;
               $(this).addClass("selecionado").removeClass("valores");
               selecionado=y
               
               $(".optUsuario").html("Box selecionado- "+optusuario);
               $(".optUsuario2").html("Selecione um box");
           }else{
              
               var confirmar=confirm('Gostaria de trocar seu box pelo box '+(y+1));
                    if (confirmar==true) {
                      $(".optUsuario2").html("Seu do box tinha o valor de :" +valores[selecionado]);
                      selecionado = y
                      $(".optUsuario").html("Box selecionado- "+valor);
                    } else {
                      $(".optUsuario2").html("Valor do box " + (y+1) +" é :" +valores[y]);
                    }
               $(this).addClass("selecionado").removeClass("valores");
           }
       }else{
           $(".optUsuario").html("Seu box tem o valor de "+valores[selecionado]);
       } 
                   
              
        })  
        function verificar(elemento){
            elemento.each(function(){
                if ($(this).hasClass("valores")){
                    return false
                }
            })
            $(".optUsuario").html("Seu box tem o valor de "+valores[selecionado]);
        }
        function shuffle(array) {
  var currentIndex = array.length
    , temporaryValue
    , randomIndex
    ;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}
    })
   
</script>
<style>
    .valores,.optUsuario,.optUsuario2,.selecionado{border: 1px solid blue;margin: 1px;height: 75px;line-height: 75px;font-size: 25px;cursor: pointer}
    .selecionado{background: green;color:white}
    .valores:hover{background: blue;color:white}
</style>
<div class="optUsuario2">Selecione Um box para começar </div>
<div id="1" class="col-md-1 text-center valores">1</div>
<div id="2" class="col-md-1 text-center valores">2</div>
<div id="3" class="col-md-1 text-center valores">3</div>
<div id="4" class="col-md-1 text-center valores">4</div>
<div id="5" class="col-md-1 text-center valores">5</div>
<div id="6" class="col-md-1 text-center valores">6</div>
<div id="7" class="col-md-1 text-center valores">7</div>
<div id="8" class="col-md-1 text-center valores">8</div>
<div id="9" class="col-md-1 text-center valores">9</div>
<div id="10" class="col-md-1 text-center valores">10</div>
<div id="11" class="col-md-1 text-center valores">11</div>
<div id="12" class="col-md-1 text-center valores">12</div>
<div id="13" class="col-md-1 text-center valores">13</div>
<div id="14" class="col-md-1 text-center valores">14</div>
<div class="clearfix"></div>
<div class="optUsuario">Selecione o Box </div>

