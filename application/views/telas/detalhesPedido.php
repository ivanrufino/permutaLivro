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
    .row{margin-bottom: 15px !important;}
</style>
<script>
    $(document).ready(function(){
        $(".iniciar_chat").click(function(){
            $("#chat_aqui").load("<?=  base_url()?>pedido/chat/<?=$pedido['CODIGO']?>");
            return false;
        })
        $("#avaliacao").rating({
    	starCaptions: {1: "Péssimo", 2: "Ruim", 3: "Regular", 4: "Bom", 5: "Ótimo"},
    	clearCaption:"Não avaliado"
    
});
        $("#confirmar").click(function(){
            var options = {
                target: '.resultado_rastreio', // target element(s) to be updated with server response 
                resetForm: false,
                 beforeSubmit:  showRequest,  // pre-submit callback 
                success: refreshPage, // post-submit callback 
                 
            };
            $("#entrega").ajaxSubmit(options);

        });
        $('#confirmarEntrega').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var codigo = button.data('whatever'); // Extract info from data-* attributes
            var nome = button.data('nome'); // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
           
            //modal.find('.modal-title').text('New message to ' + recipient);
            modal.find('#codigo_pedido').val(codigo);
            modal.find('.nome_usuario').html(nome);
            
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
    })
      
</script>
<div class="container-alternate">
    <div class="container">
        {view_lateral}
        <div class="col-md-9" style="background: transparent">
            <div class="col-md-12  blocos">               
                <br>
                <?php echo $this->session->flashdata('msg') ?>
                
                <form action="{base_url}livro/doLivro" method="POST">
                    <div class="col-md-3">
                        <img src="<?=  base_url()?>assets/imagens/capa/<?=$livros['FOTO']?>" class="capa img-responsive" style="margin:0 auto"><br>
                        <!--<input type="file" name="foto" class="form-control" placeholder="Insira uma foto"><br>-->
                    </div>
                    <div class="col-md-9">
                        <span class="col-md-6 row"> 
                            <label for="titulo">Título</label>
                            <input type="text" name="" id="titulo"class="form-control" value="<?=$livros['TITULO']?>" readonly="" placeholder="Digite o titulo">
                        </span>   
                        
                        <span class="col-md-6 row col-md-offset-0">
                            <label for="autor">Autor</label>
                            <input type="text" name="autor" class="form-control" value="<?=$livros['AUTOR']?>" readonly="" placeholder="Digite o autor">
                        </span>
                        <span class="col-md-4 row">
                        <label for="ano">Ano</label>
                        <input type="number" name="ano" class="form-control" value="<?=$livros['ANO']?>" readonly="" placeholder="Digite o ano">
                        </span>
                         <span class="col-md-4 col-md-offset-0 row">
                        <label for="edicao">Edicao</label>
                        <input type="text" name="edicao" class="form-control" value="<?=$livros['EDICAO']?>" readonly="" placeholder="Digite o edição">
                         </span>
                         <span class="col-md-4 col-md-offset-0 row">
                        <label for="pagina">Páginas</label>
                        <input type="number" name="pagina" class="form-control" value="<?=$livros['PAGINAS']?>" readonly="" placeholder="Digite o número de paginas">
                         </span>
                         <span class="col-md-6 row">
                        <label for="editora">Editora</label>
                        <input type="text" name="editora" class="form-control" value="<?=$livros['EDITORA']?>" readonly="" placeholder="Digite o Editora">
                         </span>
                         <span class="col-md-6 col-md-offset-0 row">
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" class="form-control" value="<?=$livros['ISBN']?>" readonly="" placeholder="Digite o ISBN">
                         </span>
                        <!--<input type="submit" class="btn btn-success btn-md" value="Cadastrar Novo">-->
                        <br><br>
                    </div>
                    
                </form>
               
                <?php if (validation_errors()!= false){ ?>
                <span class="alert alert-danger col-md-12">
                    <strong>Corrija os erros encontrados:</strong>
                    <?php echo validation_errors(); ?> 
                </span>
                <?php }?>
            </div> 
            <table class="table table-hover table-bordered table-striped">
                <tr>
                    <th>Livro de:</th><th>Situação</th><th>Ação</th>
                </tr>
                <tr>
                    <td><?= $pedido['NOME']?> <a href="{base_url}maisLivrosUsuario/<?= $pedido['CODUSUARIO']?>">Mais Livros</a></td>
                    <td><?=$situacao?></td>
                    <td><?php 
                        switch ($situacao) {
                            case 'Recusado':
                            case 'Pendente':
                                echo "<a href='{base_url}pedido/removerPedido/$pedido[CODIGO]'>Remover</a>";
                                break;
                            case 'Aguardando':
                                echo "Aguardando resposta do usuário";
                                break;
                            case 'Aceito':
                                echo $pedido['NOME']." aceitou sua solicitação.<br>";
                                if ($pedido['COD_RASTREIO']!=""){
                                    echo "Código de rastreio: ".$pedido['COD_RASTREIO'];
                                    echo "<br>Clique no botão \"Confirmar Entrega\" assim que receber seu pedido<br>";
                                echo "<button type='button' class='btn btn-success btn-md' data-toggle='modal' data-target='#confirmarEntrega' data-whatever='$pedido[CODIGO]' data-nome='$pedido[NOME]'>Confirmar Entrega</button>&nbsp;";
                                echo "<button type='button' class='btn btn-primary btn-md' data-toggle='modal' data-target='#rastrearPedido' data-whatever='$pedido[CODIGO]'>Rastrear Pedido</button>";
                                }else{
                                    echo "aguardando o envio do código de rastreio"; 
                                    
                                }
                                
                                break;
                            case 'Removido':
                                echo "Será excluido do sistema ao final do dia";
                                break;

                            default:
                                break;
                        }
//                        if ($situacao=='Recusado' || $situacao =='Pendente'){
//                            echo "<a href='{base_url}pedido/removerPedido/$pedido[CODIGO]'>Remover</a>";
//                        }
                    ?>
                    </td> 
                </tr>
            </table>
            <button class="btn btn-default iniciar_chat" value="">Iniciar conversa</button>
            <div id="chat_aqui"></div>
        </div>
    </div>
    <br>
</div>

<div class="col-md-12">
    <footer>
        Direitos reservados
    </footer>
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
<div class="modal fade" id="confirmarEntrega" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirmar Entrega</h4>
      </div>
        <div class="modal-body" id="resultadoRastreio">
            <form id="entrega" method="POST" action="{base_url}pedido/confirmaEntrega">
                 <input type="hidden" name="codigo_pedido" id="codigo_pedido" readonly="" class="form-control">
                 <label for="avaliacao">Avalie o usuário <strong class="nome_usuario"></strong></label>
                 <input id="avaliacao"  type="number" name="avaliacao" step="1" data-min="0" data-max="5" data-size="md" data-show-clear="false"  ><br>
                 <label for="obs">Observação</label>
                 <textarea  name="obs" id="obs" class="form-control" placeholder="Insira alguma informação referente ao pedido, ao livro ou ao usuário. Elogios ou reclamações" ></textarea>
            </form>
            <div class="resultado_rastreio">    </div>
      </div>
      <div class="modal-footer">
          <button type="button" id="confirmar" class="btn btn-primary">Confirmar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>