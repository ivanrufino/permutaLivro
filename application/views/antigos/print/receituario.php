<?php
$codigo= $receita['cod_hash'];
$this->load->view('phpqrcode/qrlib.php');
QRcode::png("Olá Visitante!!!","assets/qrcodes/".$codigo.".png");
?>
<script src="<?= base_url('assets/js/jquery-1.10.2.js') ?>" type="text/javascript"></script>
<link href="<?= base_url('assets/css/bootstrap.css') ?>" rel="stylesheet" type="text/css">
<link href="<?= base_url('assets/css/comuns.css') ?>" rel="stylesheet" type="text/css">
<script>
$(document).ready(function(){
    window.print();
    $(".fechar").click(function(){
        window.location.href="<?php echo base_url().$local ?>"
    })
    //window.location.href="<?php echo base_url().$local ?>"
})
</script>
<style>
    @media print {

  body {
font: 12pt Arial,Georgia, "Times New Roman", Times, serif;
color: #000;
} 
h1 {
font-size: 24pt;
}
 
h2 {
font-size: 18pt;
}
 
h3 {
font-size: 14pt;
}
@page {
margin: 0.5cm;
}
    }
</style>

<div class="receita col-xs-8 col-xs-offset-2" >
    Receita gerada em: <?= date("d/ m/ Y H:i",  strtotime($receita['data']));?>
    <a href="#" class="btn btn-danger hidden-print fechar" style="float:right">Fechar</a>
    <!--<a href="" class="btn btn-success hidden-print " style="float:right">Imprimir</a>-->
    
    <div class="rec_logo col-md-2  col-xs-12 text-center"><img src="<?=  base_url()?>assets/qrcodes/<?=$receita['cod_hash']?>.png"></div>
             
            <div class="rec_head col-md-10 col-xs-12 text-center">
                <h1><?= $receita['empresa']?></h1>
                   
                   
                <h2><b>Dr(a).</b> <?= $receita['medico']?> </h2>
               
                
                <h3><b>Paciente: </b><label id="labelPaciente"><?= $receita['paciente']?></label></h3>
            </div>
            <div class="clearfix"></div>
            <hr>
           
                
                <div id="listaReceita">
                    <?php
                    foreach ($listagem as $key => $lista) { ?>
                        <!--echo $lista['medicamento'];-->
                        <div class='medicamentos col-md-11 col-xs-10'>
                            <label class='medicamento col-md-10 col-xs-12'><i class='glyphicon glyphicon-ok-circle'></i>   <?= $lista['MEDICAMENTO']?></label>
                            <label class='medicamento col-md-10 col-xs-12'>  <?= $lista['FORMA']?></label>
                            <label class='prescricao col-md-10 col-xs-12'><?= $lista['PRESCRICAO']?></label>
                            <br class='clearfix '>
                        </div>
                    <?php }
                    ?>
                    
                </div>
            
           
           <div class='clearfix '></div>
           <br><br><br>
            <div class="col-xs-11 rec_footer text-center">
                
                  <p class="ident"><b>Dr(a).</b> <?= $receita['medico']?> (carimbo)</p>
            </div>
           <div class='clearfix'id="base"></div>
        </div>
