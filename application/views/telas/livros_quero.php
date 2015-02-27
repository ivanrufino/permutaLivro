<style>
    .blocos{
        border:1px dashed grey;
        margin:15px 5px ;
    }
    .blocos:first-child{margin-top: 0px}
    /*.livrosBuscados .mnblocos{background: rgba(5, 212, 249, 0.16);border: 1px solid green; height: 200px;text-align: center}*/
    .ultimosInseridos .mnblocos{border: 1px solid #fff; min-height: 200px;text-align: center;margin-bottom: 10px}
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
    .c_pendente{ border: 1px solid blue !important;  }
    .c_recusado{border: 1px solid red !important;}
    .c_aguardando{border: 1px solid yellow !important;}
    .c_aceito{border: 1px solid green !important;}
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
           
            <div class="col-md-12 livrosBuscados blocos alert alert-info">
                <fieldset class="alert">
                    <legend>Encontre mais livros</legend>
                    Use a tela de busca para encontrar mais livros <br>
                    <a href="{base_url}meus_livros/buscar" class="btn btn-info btn-md">ir para "Buscar Livro"</a>
                    
                    <?php 
                        
                    ?>
                    <!--mostrar capa, titulo e autor dos livros que colocaram a disposição-->
                </fieldset>
                </div>
            <div class="col-md-12 ultimosInseridos blocos">
                <fieldset>
                    <legend>Meus Pedidos</legend>
                     <?php 
                     if ($livrosDesejados){
                   foreach ($livrosDesejados as $key => $value) { ?>
                    <div class="col-md-4 mnblocos"   >
                        <div class="<?= $value['class']; ?>">
                        <img src="{local}imagens/capa/<?= $value['FOTO']; ?>" class="capa img-responsive">
                        <?=  character_limiter($value['TITULO'], 40); ; ?><br>
                        <strong> <?= $value['AUTOR']; ?></strong><br>
                        
                        <span class="option">
                           <?php $slug = url_title($value['TITULO'], '_', TRUE)."_".$value['CODIGO'].".html";?>
                            <a href="<?=  base_url('pedido/detalhes/').'/'.$slug?>" class="detalhe">Detalhe</a>
                            <!--<a href="" class="tenho">Tenho</a>-->
                        </span>
                        </div>
                    </div>
                        <!--echo $value['id'];-->
                     <?php } }else{
                        echo "<div class='col-md-12 alert alert-warning '><strong>Atenção</br></strong>Não há livros em sua lista de pedidos.</div>";
                     }
                    ?>
                    
                </fieldset>
            </div>
            <br>
        </div>
    </div>
    <br>
</div>

<div class="col-md-12">
    <footer>
        Direitos reservados
    </footer>
</div>
