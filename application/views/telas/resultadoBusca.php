<style>
     .mnblocos{border: 1px solid grey; text-align: center}
    .resultadoLivro { min-height: 250px}
    .resultadoLivro img{margin: 0 auto}
     .option{position: absolute;top: 150px;left: 0;background: white;width: 100%;display: none;height: 40px;line-height: 40px}
    .option a{
        color: black;
        margin: 0px 17px;
        font-size: 20px;
        text-decoration: none;
            
    }
    .option a:hover{color: blue}
    .option a.quero{
        float: left;
    }
    .option a.tenho{
        float: right;
    }
</style>
<script>
  $(document).ready(function(){
         $(".resultadoLivro ").hover(function(){
            $(".option",this).slideDown();
        },function(){
             $(".option",this).slideUp();
        })
        
    })
</script>
<fieldset>
    <legend>Livros desejados </legend>
    <?php foreach ($livros as $key => $value) { ?>
        <div class="col-md-4 resultadoLivro mnblocos" >
            <img src="<?=  base_url()?>assets/imagens/capa/<?= $value['FOTO']; ?>" class="capa img-responsive">
            <?=  character_limiter($value['TITULO'], 40); ; ?><br>
            <span style="font-weight: bold"><?= $value['AUTOR']; ?></span><br>
            <span class="option">
                <?php $slug = url_title($value['TITULO'], '_', TRUE)."_".$value['CODIGO'].".html";?>
                <a href="<?=  base_url('livro/detalhes/').'/'.$slug?>" class="detalhe">Detalhe</a>
                <!--<a href="" class="tenho">Tenho</a>-->
            </span>
        </div>
        <!--echo $value['id'];-->
    <?php }
    ?>

</fieldset>


