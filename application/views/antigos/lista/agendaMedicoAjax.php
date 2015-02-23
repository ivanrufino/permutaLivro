<?php if(is_null($agenda)){
    echo "<div class='alert alert-info'><h2><strong>Aviso:</strong></h2>"
    . "Não foi encontrado nenhum agendamento."
    . "</div>";
}else{ ?>
<script>
$(document).ready(function(){
 
//    $(".diad").each(function(){
//        var dia=$(this).attr("dia")
//        marcarTd(dia);
//        // alert($(this).attr("dia"))
//    })
     $(".inicio").parent('td').addClass('ocupado')
        marcarTd("ocupado");
     
    
})
function marcarTd(minhatd){
    //$("."+minhatd+":contains('ocupado')").each(function(){
    $("."+minhatd).each(function(){
        var td=$(this);
        //td.css( "text-decoration", "underline" );
       var indLinha = $(td).parent().index();
        var indColuna = $(td).index();
       // alert(indColuna);
        var indLinhaFim = td.children(".fim").html();
      //  alert(td.html());
        //alert(indLinhaFim);
        //var indLinhaFim = $(td).parent().index();

        for ( var i = indLinha; i <= indLinhaFim; i++ ) {
           // alert(i)
             $('.tableAgenda tbody tr:eq('+i+') td:eq('+indColuna+')').addClass('ocupado')
        }
    })
    //        var indLinha = $("."+td+":contains('ocupado')" ).parent().index();
//        var indColuna = $("."+td+":contains('ocupado')" ).index();
//        var indLinhaFim = $("."+td+":contains('fim')" ).parent().index();
      //  alert(ind);   
//    $('.tableAgenda tbody tr:eq(4) td:eq(1)').css('color','red')
//    $('.tableAgenda tbody tr:eq(4) td:eq(1)').css('color','red')
}
</script>
<style>
    .table > tbody > tr > td{padding: 3px 8px !important;}
    .fim{display: none}
    .ocupado{border-bottom:  none !important;
             border-top: none !important;
             color: #000;
             font-weight: bolder;
             background: #ececec !important;
    }
    
    
    .ocupados{border:none !important;
             color: #000;
             font-weight: bolder;
    background: -moz-linear-gradient(90deg, #707070 0%, #ffffff 13%, #808080 51%, #ffffff 82%, #ffffff 100%); /* ff3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff), color-stop(18%, #ffffff), color-stop(49%, #808080), color-stop(87%, #ffffff), color-stop(100%, #707070)); /* safari4+,chrome */
background: -webkit-linear-gradient(90deg, #707070 0%, #ffffff 13%, #808080 51%, #ffffff 82%, #ffffff 100%); /* safari5.1+,chrome10+ */
background: -o-linear-gradient(90deg, #707070 0%, #ffffff 13%, #808080 51%, #ffffff 82%, #ffffff 100%); /* opera 11.10+ */
background: -ms-linear-gradient(90deg, #707070 0%, #ffffff 13%, #808080 51%, #ffffff 82%, #ffffff 100%); /* ie10+ */
background: linear-gradient(0deg, #707070 0%, #ffffff 13%, #808080 51%, #ffffff 82%, #ffffff 100%); /* w3c */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#707070',GradientType=0 ); /* ie6-9 */
    }
   // .ocupado:prev{border: 1px solid red !important}
</style>
<?php if(!$is_medico){ ?>
<h3><?= $agenda[0]['NOME'] ?></h3>
<?php } ?>


<div class="table-responsive">
    <table class="table-bordered table-striped table-hover tableAgenda">
        <thead>
            <tr>
                <th>Hora/dia</th><th>Dom</th><th>Seg</th><th>Ter</th><th>Qua</th><th>Qui</th><th>Sex</th><th>Sab</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            for($x=0;$x<24;$x++){
                $y=$x+1; 
               // if($y=='24'){ $y='0'; } ?>
            <tr>
                <td><?php echo $x."h - ".$y."h"  ?></td>
            
             <td class="diad dom"><?php getAgenda($agenda, 'domingo', $x,$is_medico); ?> </td>
                <td class="diad seg"><?php getAgenda($agenda, 'segunda', $x,$is_medico); ?> </td>
                <td class="diad ter"><?php getAgenda($agenda, 'terca', $x,$is_medico); ?> </td>
                <td class="diad qua"><?php getAgenda($agenda, 'quarta', $x,$is_medico); ?> </td>
                <td class="diad qui"><?php getAgenda($agenda, 'quinta', $x,$is_medico); ?> </td>
                <td class="diad sex"><?php getAgenda($agenda, 'sexta', $x,$is_medico); ?> </td>
                <td class="diad sab"><?php getAgenda($agenda, 'sabado', $x,$is_medico); ?> </td>
            </tr>
                <?php  } ?>
        </tbody>
            
    </table>
</div>

<?php } //FECHAMENTO DA CONDICIONAL, VERIFICA SE AGENGA É NULO (EXISTE OU NAO)?>
<?php

function getAgenda($agenda, $dia, $hora,$mostrar_nome_empresa) {
//    echo "<pre>";
//    print_r($agenda);
//    echo "</pre>";
//    die();
    
    foreach ($agenda as $key => $age) {
       
        if ($age['DIA'] == $dia && $age['HORA_ENTRADA'] == $hora) {
            $saida = $age['HORA_SAIDA'] - 1;
            if($mostrar_nome_empresa){
                echo $age['NOME_EMPRESA']."<i class='inicio'></i> <i class=fim>" . $saida . "</i>";
            }else{
                echo "ocupado <i class='inicio'></i> <i class=fim>" . $saida . "</i>";
            }
        }
    }
}
?>
