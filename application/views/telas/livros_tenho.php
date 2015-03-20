<style>
    a.detalhe:not(:first-child){margin-left: 10px}
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
//        $(".livrosBuscados .mnblocos").on('click',function(){
//            alert($(this).attr('codigo'))
//        })
         $(".livrosBuscados .mnblocos").hover(function(){
            $(".option",this).slideDown();
        },function(){
             $(".option",this).slideUp();
        });
        $('#edit_livro_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var titulo = button.data('titulolivro');
            var codLivro = button.data('codlivro'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Alterar configuração do livro: ' + titulo);
            modal.find('.modal-body #codLivro').val(codLivro);
        });
        
    });
      
</script>
<div class="container-alternate">
    <div class="container">
        {view_lateral}
        <div class="col-md-9" style="background: transparent">
           
            <div class="col-md-12 livrosBuscados blocos">
                <?php 
                $btn_link=array(
                    array('link'=>'pedido/selecionarUsuarioPedido/','class'=>'btn-info','mostrar'=>'1','titulo'=>"Editar"),
                  
                );
                montarGrid($queroLivros, "" , $titulo_legenda, $btn_link) ?>
<!--                <fieldset>
                    <legend>{titulo_legenda}</legend>
                    <?php 
                    foreach ($queroLivros as $key => $value) {  ?>
                    
                    <div class="col-md-4 mnblocos"   >
                        <div class="<?= $value['class']; ?>">
                        <img src="{local}imagens/capa/<?= $value['CAPA']; ?>" class="capa img-responsive">
                        <?=  character_limiter($value['TITULO'], 40); ; ?><br>
                        <strong> <?= $value['AUTOR']; ?></strong><br>
                        
                        <span class="option">
                           <?php $slug = url_title($value['TITULO'], '_', TRUE)."_".$value['CODIGO'].".html";?>
                            <a href="<?=  base_url('pedido/detalhes/').'/'.$slug?>" class="detalhe">Detalhe</a>
                            <a href="" class="tenho">Tenho</a>
                        </span>
                        </div>
                    </div>
                        echo $value['id'];
                    <?php }
                    ?>
                    mostrar capa, titulo e autor dos livros que colocaram a disposição
                </fieldset>-->
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
<?php 
function montarGrid($livros,$classe,$legenda,$botoes){ 
     
    echo "<div class='table-responsive'>";
    echo "<h1>$legenda</h1>";
echo "<table class='table table-bordered table-striped table-hover table-condensed table-responsive'>";

    foreach ($livros as $key => $value) {
      $codlivro = isset($value['COD_LIVRO'])?$value['COD_LIVRO']:$value['CODIGO'];
        echo"<tr>";
        $codPedido=isset($value['COD_PEDIDO'])?"_".$value['COD_PEDIDO']:"";
        $slug = url_title($value['TITULO'], '_', TRUE) .$codPedido. "_" . $codlivro . ".html"; 
        echo "<td style='width:100px;text-align:center'><img src='{local}imagens/capa/".$value['CAPA']." ' class=' img-responsive' style='width:60px'> </td>";
        echo "<td style='vertical-align: middle;'>".$value['TITULO']."<br>". $value['AUTOR'];
        if (isset($value['QUANTIDADE'])){echo "<br><strong class=' alert-info'>".$value['QUANTIDADE']." usuários leram ou estão lendo este livro</strong>";}
        echo "</td>";
        echo "<td  style='text-align:center;vertical-align: middle;'>";
        $linkEdita="";
        switch ($value['STATUS']) {
            case '0':
                echo "<span class='alert alert-danger'>Livro ainda não lido.</span>";                
//                $linkEdita="<a href='".base_url('pedido/selecionarUsuarioPedido/') . '/' . $slug ."' class='detalhe btn btn-success'>Eu já li </a>";
                break;
            case '1':
                echo "<span class='alert alert-success'>Você já leu este livro.</span>";
                break;
            case '2':
                echo "<span class='alert alert-info'>Você esta lendo este livro.</span>";
                break;
            default:
                break;
        }
      
        echo "</td>";
        echo "<td style='text-align:center;vertical-align: middle;'>";
//        echo $linkEdita;
        echo '<button type="button"  data-toggle="modal" data-target="#edit_livro_modal" data-codLivro="'.$codlivro.'" data-tituloLivro="'.$value['TITULO'].'" class="btn btn-success btn-lg navbar-btn  "><i class="fa fa-edit"></i> &nbsp;Editar</button>'; 
            foreach ($botoes as $btn) {
              
                    //echo "<a href='".base_url($btn['link']) . '/' . $slug ."' class='detalhe btn ".$btn['class']."'>".$btn['titulo']." </a>";
               
            }
        echo "</td>";
        
        echo"</tr>";
        
    }
echo "</table></div>";
 }
?>
<div class="modal fade" id="edit_livro_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edição de Livro</h4>
      </div>
      <div class="modal-body">
          <input type="hidden" id="codLivro" name="codLivro"> 
          <fieldset>
              <legend>Leitura</legend>
              <input type="radio" name="STATUS" id="nao_lido" value="0"><label for="nao_lido">Não Lido</label>
              <input type="radio" name="STATUS" id="lido" value="1"><label for="lido">Lido</label>
              <input type="radio" name="STATUS" id="lendo" value="2"><label for="lendo">Lendo</label>
          </fieldset>
          <fieldset>
              <legend>Visualização</legend>
               <input type="radio" name="ESCOPO" id="disponivel" value="1"><label for="disponivel">Disponível</label>
              <input type="radio" name="ESCOPO" id="indisponivel" value="2"><label for="indisponivel">Indisponível</label>
          </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>