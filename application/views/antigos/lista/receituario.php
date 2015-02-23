<!--<script src="<?= base_url('assets/js/jquery-1.10.2.js') ?>" type="text/javascript"></script>
<link href="<?= base_url('assets/css/bootstrap.css') ?>" rel="stylesheet" type="text/css">
<link href="<?= base_url('assets/css/comuns.css') ?>" rel="stylesheet" type="text/css">-->




<div class="receita col-xs-10 col-xs-offset-1" >
    Receita gerada em: <?= date("d/ m/ Y H:i", strtotime($receita['data'])) ?>
            <!--<div class="rec_logo col-md-2  col-xs-12 text-center"><img src=""></div>-->

    <div class="rec_head col-md-10 col-xs-12 text-center">
        <h1><?= $receita['empresa'] ?></h1>

        <input type="hidden" name="codigoReceita" value=" <?= $receita['codigo'] ?>" >
        <h2><b>Dr(a).</b> <?= $receita['medico'] ?> </h2>


        <h3><b>Paciente: </b><label id="labelPaciente"><?= $receita['paciente'] ?></label></h3>
    </div>
    <div class="clearfix"></div>
    <hr>


    <div id="listaReceita">
        <?php 
        if(!is_null($listagem)){
        foreach ($listagem as $key => $lista) { ?>
            <!--echo $lista['medicamento'];-->
            <div class='medicamentos col-md-11 col-xs-10'>
                <label class='medicamento col-md-10 col-xs-12'><i class='glyphicon glyphicon-ok-circle'></i>   <?= $lista['MEDICAMENTO'] ?></label>
                <label class='medicamento col-md-10 col-xs-12'>  <?= $lista['FORMA'] ?></label>
                <label class='prescricao col-md-10 col-xs-12'><?= $lista['PRESCRICAO'] ?></label>
                <br class='clearfix '>
            </div>
        <?php }
            }else{ ?>
            <div class="alert alert-danger"><strong>Erro encontrado:</strong><br> Houve um erro na criação desta receita, consulte seu médico para a criação de um novo receituário. </div>
            <?php }
        ?>

    </div>


    <div class='clearfix '></div>
    <br><br><br>
    <div class="col-xs-11 rec_footer text-center">

        <p class="ident"><b>Dr(a).</b> <?= $receita['medico'] ?> (carimbo)</p>
    </div>
    
</div>
<div class='clearfix '></div>