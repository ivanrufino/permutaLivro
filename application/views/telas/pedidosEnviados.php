<style>
    .blocos{
        border:1px dashed grey;
        margin:15px 5px ;
    }
    .blocos:first-child{margin-top: 0px}
    .livrosBuscados .mnblocos{background: rgba(5, 212, 249, 0.16);border: 1px solid green; height: 200px;text-align: center}
    .ultimosInseridos .mnblocos{background: rgba(96, 249, 71, 0.27);border: 1px solid grey; height: 200px;text-align: center}
    .mnblocos img{width: 75px; height: 120px;margin: 0 auto;padding-top: 5px}
    
    .livrosBuscados .mnblocos:hover{background: #99ff99;font-weight: bold}
    .autor{font-weight: normal}
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
        $(".livrosBuscados .mnblocos").on('click',function(){
            alert($(this).attr('codigo'))
        })
         $(".ultimosInseridos .mnblocos").hover(function(){
            $(".option",this).slideDown();
        },function(){
             $(".option",this).slideUp();
        })
        
    })
      
</script>
<div class="container-alternate">
    <div class="container">
        {view_lateral}
        <div class="col-md-9" style="background: transparent">
           
            <div class="col-md-12 livrosBuscados blocos">
                <fieldset>
                    <legend>Encontre mais livros</legend>
                    Use a tela de busca para encontrar mais livros <br>
                    <a href="{base_url}meus_livros/buscar">ir para "Buscar Livro"</a>
                    
                    <?php 
                        
                    ?>
                    <!--mostrar capa, titulo e autor dos livros que colocaram a disposição-->
                </fieldset>
                </div>
            <div class="col-md-12 ultimosInseridos blocos">
                <fieldset>
                    <legend>Livros desejados </legend>
                     <?php 
                     if ($livrosDesejados){
                   foreach ($livrosDesejados as $key => $value) { ?>
                    <div class="col-md-3 mnblocos" >
                        <img src="{local}imagens/capa/<?= $value['FOTO']; ?>" class="capa img-responsive">
                        <?=  character_limiter($value['TITULO'], 40); ; ?><br>
                        <?= $value['AUTOR']; ?><br>
                        <span class="option">
                           <?php $slug = url_title($value['TITULO'], '_', TRUE)."_".$value['CODIGO'].".html";?>
                            <a href="<?=  base_url('livro/detalhes/').'/'.$slug?>" class="detalhe">Detalhe</a>
                            <!--<a href="" class="tenho">Tenho</a>-->
                        </span>
                    </div>
                        <!--echo $value['id'];-->
                     <?php } }else{
                        echo "Não há livros em sua lista de pedidos";
                     }
                    ?>
                    
                </fieldset>
            </div>
            
        </div>
    </div>
    <br>
</div>

<div class="col-md-12">
    <footer>
        Direitos reservados
    </footer>
</div>
