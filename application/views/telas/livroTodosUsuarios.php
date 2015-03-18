<style>
    
     .mnblocos{border: 1px solid grey; text-align: center}
    .resultadoLivro { min-height: 250px}
    .resultadoLivro img{margin: 0 auto}
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
    $(document).ready(function () {
        $(".livrosBuscados .mnblocos").on('click', function () {
            alert($(this).attr('codigo'))
        })
        $(".mnblocos").hover(function () {
            $(".option", this).slideDown();
        }, function () {
            $(".option", this).slideUp();
        });
        

    })

</script>
<div class="container-alternate">
    <div class="container">
        {view_lateral}
        <div class="col-md-9" style="background: transparent">
            <?php 
            $legenda="Usuário que possuem o livro:";
            if(!is_null($codPedido)){
                $btn_link=array(array('link'=>'pedido/gravarUsuarioPedido/','class'=>'btn-success','titulo'=>"Solicitar Livro"));
                $codigo=$codPedido;
            }else{
                $btn_link=array(array('link'=>'pedido/novoPedido/','class'=>'btn-success','titulo'=>"Solicitar Livro"));
                $codigo=$livro['CODIGO'];
            }
            montarGrid($infoLivros, $codigo, $legenda, $btn_link) /*?>
            <div class="col-md-12 editora blocos">
                <fieldset>
                    <legend>Usuário que possuem o livro: <strong><?= $livro['TITULO']?></strong></legend>


                    <?php foreach ($infoLivros as $dados) { ?>
                        <div class="col-md-4 resultadoLivro mnblocos" >
                            <img src="<?= base_url() ?>assets/imagens/<?= $dados['FOTO']; ?>" class="capa img-responsive">
                            <?= character_limiter($dados['NOME'], 40);
                            ; ?><br>
                            <!--<span style="font-weight: bold"><?= $dados['AUTOR']; ?></span><br>-->
                            <span class="option">
                            <?php $slug = url_title($dados['NOME'], '_', TRUE) . "_" . $dados['NOME'] . ".html"; ?>
                                <a href="{base_url}pedido/novoPedido/<?=$livro['CODIGO']?>/<?=$dados['COD_USUARIO']?>" class="detalhe">Solicitar Livro</a>
                                <!--<a href="" class="tenho">Tenho</a>-->
                            </span>
                        </div>
                        <!--echo "<li><a href='{base_url}livro/buscar/editora/$editora[CODIGO]'>".url_title($editora['CODIGO'], ' ')."</a></li>";-->
<?php } ?>

                    <!--mostrar capa, titulo e autor dos livros que colocaram a disposição-->
                </fieldset>
            </div>

 */  ?>
        </div>
    </div>
    <br>
</div>

<div class="col-md-12">
    <footer>
        Direitos reservados
    </footer>
</div>

<?php 
function montarGrid($usuario,$codigo,$legenda,$botoes){ //$codigo pode ser codigo do livro ou codigo do pedido
    //print_r($usuario);
   // echo "<div class='table-responsive'>";
    echo "<div class='titulo_legenda'><span style='float:left'> $legenda</span><span style='float:right'>"
            . "<input type='radio' name='modo_entrega' value='1' id='correio' checked><label for='correio'>Correio</label> &nbsp"
            . "<input type='radio' name='modo_entrega' value='2' id='combinar'><label for='combinar'>A combinar</label>"
            . "</span> <br style='clear:both'></div>";
    
echo "<table class='table table-bordered table-striped table-hover table-condensed table-responsive'>";

    foreach ($usuario as $key => $value) {
        echo"<tr>";
        
        //$slug = url_title($value['TITULO'], '_', TRUE) .$codPedido. "_" . $value['CODIGO'] . ".html"; 
        echo "<td style='width:100px;text-align:center'>";
        if ($value['ID_REDE']){
            echo "<img src='{$value['FOTO_REDE']}' class=' img-responsive' style='width:60px'>";
        }else{
            echo "<img src='{local}imagens/foto/".$value['FOTO']." ' class=' img-responsive' style='width:60px'>";
        }
        echo "</td>";
        echo "<td>";
         if ($value['ID_REDE']!=""){
              echo "<a href='".$value['LINK_REDE']."'> ".$value['NOME']."</a>";
         }else{
              echo $value['NOME'];
         }
         echo "<br>";
         if(!is_null($value['CIDADE'])){
            echo $value['CIDADE']."/". $value['ESTADO']."</td>";
         }else{
             echo "Usuário não informou endereço";
         }
        echo "<td style='text-align:center'>";
            foreach ($botoes as $btn) {
            echo "<a href='".base_url($btn['link']) . '/' . $codigo .'/'.$value['COD_USUARIO']."' class='detalhe btn ".$btn['class']."'>".$btn['titulo']." </a>";
            }
        
        echo "</td>";
        echo"</tr>";
        
    }
echo "</table>";
 //   . "</div>";
 }
 
