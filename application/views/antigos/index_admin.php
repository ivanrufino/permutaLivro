<div class="container">
    <?php if ($empresa['segmento']=='1' || $empresa['segmento']=='3'){ 
          $classe=$empresa['segmento']=='1'? "col-md-6 col-sm-6 col-xs-12":"col-md-4 col-sm-6 col-xs-12";
        ?>
    <div class="<?=$classe?> text-center ">
        <a href="{base_url}admin/listaAtendente.html">
             <figure class="imglink">
                <legend>Atendente </legend>
                <img src="{base_url}assets/imagens/atendente.png" class="img-responsive img-thumbnail"></figure>
        </a>
    </div>
    <div class="<?=$classe?> text-center">
        <a href="{base_url}admin/listaMedico.html"> <figure class="imglink">
                <legend>Medico </legend>
                <img src="{base_url}assets/imagens/medico2.png" class="img-responsive img-thumbnail"></figure>
        </a>
    </div>
    <?php }?>
    <?php if ($empresa['segmento']=='2' || $empresa['segmento']=='3'){ 
        $classe=$empresa['segmento']=='2'? "text-center":"col-md-4 col-sm-6 col-xs-12";
        ?>
    <div class="<?=$classe?> text-center ">
        <a href="{base_url}admin/listaAtendenteF.html">
             <figure class="imglink">
                <legend>Atendente de Farm&aacute;cia </legend>
                <img src="{base_url}assets/imagens/atendentef.png" class="img-responsive img-thumbnail"></figure>

        </a>
    </div>
    <?php }?>
</div>