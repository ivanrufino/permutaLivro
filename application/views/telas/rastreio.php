<script>
$(document).ready(function(){
    $('.collapse').on('show.bs.collapse', function () {
   $(this).parent().find(".icone_collapse").removeClass("glyphicon-collapse-down").addClass("glyphicon-collapse-up");
});

$('.collapse').on('hide.bs.collapse', function () {
    $(this).parent().find(".icone_collapse").removeClass("glyphicon-collapse-up").addClass("glyphicon-collapse-down");
   
});
})
</script>
<?php if (!$erro){ ?>
<div class="panel-group" id="rastreios_collapse" role="tablist" aria-multiselectable="true">
<?php

$caminho = array_reverse($caminho, true);
$in='in';
$down='up';
foreach ($caminho as $key => $via) { ?>
    <div class="panel panel-default">
        <div class="panel-heading" >
            <h4 class="panel-title">
                <i class="icone_collapse glyphicon glyphicon-large glyphicon-collapse-<?=$down?>"></i>
                <a data-toggle="collapse" data-parent="#rastreios_collapse" href="#div_rastreio_<?=$key?>" >
                     &nbsp; <?=$via['acao']?> - <?=$via['data']?>
                </a>
            </h4>
        </div>
        <div id="div_rastreio_<?=$key?>" class="panel-collapse collapse <?= $in;?>" >
            <div class="panel-body alert alert-info">
                <strong> Data:</strong> <?=$via['data']?><br>
                <strong> Local: </strong><?=$via['local']?><br>
                <strong> Data: </strong><?=$via['detalhes']?><br>
            </div>
        </div>
    </div>
    
<?php $in=""; 
$down='down';
}
/*for ($i = count($caminho) - 1; $i > 0; $i--) {
    print_r($caminho[$i]);
    exit;
}*/
?>     
</div>
<?php 

}else{
echo "<div class='alert alert-danger'><strong>Código: </strong> $cod_rastreio<br>$erro_msg</div>";    
}
?>
