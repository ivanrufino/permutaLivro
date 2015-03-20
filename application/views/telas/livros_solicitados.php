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
        
        $("#salvarCodigo").click(function(){
            var options = {
                target: '.resultado_rastreio', // target element(s) to be updated with server response 
                resetForm: false,
                 beforeSubmit:  showRequest,  // pre-submit callback 
                success: refreshPage, // post-submit callback 
                 
            };
            $("#updateRastreio").ajaxSubmit(options);

        });
        $('#inserirCodigo').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var codigo = button.data('whatever'); // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
           
            //modal.find('.modal-title').text('New message to ' + recipient);
            modal.find('#codigo_pedido').val(codigo);
        });
    
    $('#rastrearPedido').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var codigo = button.data('whatever'); // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
           
            //modal.find('.modal-title').text('New message to ' + recipient);
            modal.find('#resultadoRastreio').load("{base_url}pedido/rastrearPedido/"+codigo);
        });
         $('#rastrearPedido').on('hide.bs.modal', function (event) {
            var modal = $(this);
           //modal.find('.modal-title').text('New message to ' + recipient);
            modal.find('#resultadoRastreio').html("<img src='{local}imagens/loading.gif'> Carregando...");
        });
    });
      
</script>
<div class="container-alternate">
    <div class="container">
        {view_lateral}
        <div class="col-md-9" style="background: transparent">
           
            <div class="col-md-12 livrosBuscados blocos alert alert-info">
                <fieldset class="">
                    <legend>Encontre mais livros</legend>
                    Use a tela de busca para encontrar mais livros <br>
                    <a href="{base_url}meus_livros/buscar" class="btn btn-info btn-md">ir para "Buscar Livros"</a>
                    
                    <?php 
                        
                    ?>
                    <!--mostrar capa, titulo e autor dos livros que colocaram a disposição-->
                </fieldset>
                </div>
            <div class="col-md-12 ultimosInseridos blocos">
                <fieldset>
                    <legend>Meus Pedidos Solicitados</legend>
                     
                    <!--<div class="col-md-4 mnblocos "   >-->
                         <?php 
                     if ($livrosSolicitados){ ?>
                        <table class="table table-hover table-bordered table-striped ">
                                    <tr>
                                        <th colspan="2">Livro</th><th>Solicitante:</th><th style="width: 25%;">Ação</th>
                                    </tr>
                       
                  <?php /*print_r($livrosSolicitados);die();*/ foreach ($livrosSolicitados as $key => $value) { ?>
                                    <tr>
                                        <td> <img src="{local}imagens/capa/<?= $value['FOTO']; ?>" class="capa img-responsive"></td>
                                        <td><?= $value['TITULO']; ?></td>
                                        <td><?= $value['NOME_USUARIO']; ?></td>
                                        
                                        <td>
                                            <?php if ($value['STATUS']=='1'){?>
                                            <a class="btn btn-success" href="{base_url}pedido/aceitarPedido/<?= $value['CODIGO']?>">Aceitar</a> 
                                            <a class="btn btn-danger" href="{base_url}pedido/recusarPedido/<?= $value['CODIGO']?>">Recusar</a><br><br>
                                            <a class="btn btn-default" href="{base_url}pedido/detalhes/detalhe_<?= $value['CODIGO']?>">Detalhes</a>
                                            <?php }else{
                                                    if( trim($value['COD_RASTREIO'])==""){ ?>
                                               <!--<a class="btn btn-success" href="{base_url}pedido/enviarCR/<?= $value['CODIGO']?>">Inserir Código de Rastreio</a>-->  
                                               <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#inserirCodigo" data-whatever="<?= $value['CODIGO']?>">Inserir Código de Rastreio</button>
                                            <?php }else{ ?>
                                               <button type="button" class="btn btn-primary btn-lg " data-toggle="modal" data-target="#rastrearPedido" data-whatever="<?= $value['CODIGO']?>">Rastrear Pedido</button>
                                            <?php } }?>
                                        </td>
                                    </tr>       
                   <?php }?>
                        </table>
<!--                        <img src="{local}imagens/capa/<?= $value['FOTO']; ?>" class="capa img-responsive">
                        <?=  character_limiter($value['TITULO'], 40); ; ?><br>
                        <strong> <?= $value['AUTOR']; ?></strong><br>
                        
                        <span class="option">
                           <?php $slug = url_title($value['TITULO'], '_', TRUE)."_".$value['CODIGO'].".html";?>
                            <a href="<?=  base_url('pedido/detalhes/').'/'.$slug?>" class="detalhe">Detalhe</a>
                            
                        </span>-->
                      <?php  }else{
                        echo "<div class='col-md-12 alert alert-warning '><strong>Atenção</br></strong>Nenhuma solicitação de Livros.</div>";
                     }
                    ?>  
                    </div>
                        <!--echo $value['id'];-->
                     
                    
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
<div class="modal fade" id="inserirCodigo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Inserir código de rastreio</h4>
      </div>
      <div class="modal-body">
          <form id="updateRastreio" method="POST" action="{base_url}pedido/enviarCR">
              <input type="hidden" name="codigo_pedido" id="codigo_pedido" readonly="" class="form-control">
          <label for="codigo_rastreio">Código de Rastreio</label>
          <input type="text" name="codigo_rastreio" id="codigo_rastreio" class="form-control" placeholder="Código de Rastreio" style="text-transform: uppercase;">
          </form>
          <br>
          <div class="resultado_rastreio"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" id="salvarCodigo" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="rastrearPedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Rastreio de Pedido</h4>
      </div>
        <div class="modal-body" id="resultadoRastreio">
         <img src='{local}imagens/loading.gif'> Carregando...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>