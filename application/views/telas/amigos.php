<!--<div class="table-responsive">
    <table class="table table-bordered   table-hover table-striped">
<?php foreach ($amigos as $key => $amigo) { ?>
                <tr>
                    <td >
                        <img class="img-responsive img-thumbnail img-circle" style="width: 80px" src="<?= $amigo['ID_REDE'] == "" ? base_url() . "assets/imagens/foto/" . $amigo['FOTO'] : $amigo['FOTO_REDE']; ?> ">
                    </td>
                    <td><a hre="" class="btn btn-info">Ver Livro</a></td>
    <?php if ($amigo['ID_REDE'] != "") { ?>
                        <td>Acessar <a href="<?= $amigo['LINK_REDE'] ?> "><?= $amigo['NOME_REDE'] ?></a></td>
    <?php } else { ?>
                        <td></td>
    <?php } ?>
                </tr>
<?php
}
//print_r($amigos)
?>
    </table>
</div>-->

<?php foreach ($amigos as $key => $amigo) { ?>
    <div class="col-xs-4 col-md-3  text-center">
         <?php if ($amigo['ID_REDE'] != "") { ?>
        <a target="_blank" href="<?= $amigo['LINK_REDE']?> "class="btn btn-<?= rede($amigo['NOME_REDE'])=='windows' ? 'microsoft':rede($amigo['NOME_REDE']); ?> "><i class=" fa fa-<?= rede($amigo['NOME_REDE'])?>"></i>
            <?=$amigo['NOME_REDE']?> </a> <br>  
            <img class="img-responsive img-thumbnail img-circle" style="width: 80px" src="<?= $amigo['FOTO_REDE'];?> ">
       
         <?php }else{ ?>
        <br>
             <img class="img-responsive img-thumbnail img-circle" style="width: 80px" src="<?= base_url() . "assets/imagens/foto/" . $amigo['FOTO']; ?> ">
         <?php }
         ?>
        <a hre="" class="btn btn-link"><?= $amigo['NOME'];?> <br>Ver Livro</a>

    </div>       
<!--<i class="fa-google-plus fa-facebook fa-github fa-instagram btn-facebook btn-microsoft btn-github btn-instagram"></i>-->


<?php } 
 function rede($rede) {
    $dados['facebook']='facebook';
    $dados['windowslive']='windows';    
    $dados['github']='github';
    $dados['instagram']='instagram';
    $dados['google']='google-plus';
    return $dados[$rede];
}
?>
<div class="clearfix"></div>