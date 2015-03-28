<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de Receituario Online projeto de tcc">
        <link rel="shortcut icon" href="{local}imagens/favicon.ico" type="image/x-icon">
        <meta name="author" content="Ivan Rufino Martins">
        <link href="{local}css/styles.css" rel="stylesheet">
        <link href="{local}css/bootstrap.min.css" rel="stylesheet">
        <link href="{local}font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Meddon' rel='stylesheet' type='text/css'>
        <title>Sistema de troca de livros Online</title>

        <!-- Bootstrap core CSS -->
        {css_list}
        {js_list}
        <!-- JavaScript 
     <script src="{local}js/jquery-1.10.2.js"></script>
     <script src="{local}js/bootstrap.js"></script>
        <!--    <link href="css/bootstrap.css" rel="stylesheet">--> 

        <!-- Add custom CSS here -->
        <!--    <link href="css/small-business.css" rel="stylesheet">-->
        <script>
            $(document).ready(function () {
                var offset = $('.navbar').offset().top;
                var $meuMenu = $('#barraMenu'); // guardar o elemento na memoria para melhorar performance
                $(document).on('scroll', function () {
                    if (offset <= $(window).scrollTop()) {
                        $('body').css('marginTop','90px')
                        $meuMenu.addClass('navbar-fixed-top');
                    } else {
                        $('body').css('marginTop','0px')
                        $meuMenu.removeClass('navbar-fixed-top');
                    }
                });
                $("#salvarEndereco").click(function () {
                    var options = {
                        target: '#retornoEndereco', // target element(s) to be updated with server response 
                        resetForm: false,
                        beforeSubmit: function () {
                            $('#retornoEndereco').html("<img src='{local}imagens/loading.gif'> Enviando...")
                        }, // pre-submit callback 
                        success: refreshPage, // post-submit callback 

                    };
                    $("#formEndereco").ajaxSubmit(options);
                });

                $('#meuendereco').on('shown.bs.modal', function (event) {

                });
                $('#meuendereco').on('hide.bs.modal', function (event) {
                    var modal = $(this);
                    //modal.find('.modal-title').text('New message to ' + recipient);
                    // modal.find('#retornoEndereco').html("<img src='{local}imagens/loading.gif'> Carregando...");
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
    </head>

    <body >
        {view_cabecalho}
        <div id="top" class="container-alternate">
            <!--    <div class="container">
                    {view_topo}
                </div>-->

            <div class="container">
                {view_faixa_horizontal}
            </div>
        </div>
        <!--<div class="container">-->
        {view_conteudo}
        <!--</div>-->  
        <!--   <div class="container"> 
          <footer>
            <hr>
            <div class="row">
              <div class="col-lg-12">
                <p>Copyright &copy; Sistema de Receitu&aacute;rio Online, projeto de TCC 2014</p>
              </div>
            </div>
          </footer>
    
        </div>/.container -->

        <footer class="navbar-fixed-bottom hide">
            <div class="container clearfix ">
                <p class="pull-left">
                    Sistema de troca de livros <?= date('Y') ?> 
                </p>
                <p class="pull-right" style="color:transparent">
                    Desenvolvido por  <a href="http://about.me/ivanrufino" target="_blank" style="color:transparent">Ivan Rufino Martins</a>
                </p>
                <p class="pull-right">
                    Projeto de tcc | powered by Codeigniter <?= CI_VERSION ?> 
                </p>
            </div> <!-- /.container -->
        </footer>



        <div class="modal fade" id="updateImage" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Alterar imagem de exibição</h4>
                    </div>
                    <!-- -->
                    <form id="formUpload" method="post" enctype="multipart/form-data">
                        <div class="modal-body" id="">

                            <div class="alert alert-info">
                                <h4><span class="glyphicon glyphicon-upload"></span>Faça o upload da nova Imagem!</h4>
                                <span> Tipos Permitidos: <b>jpg e png</b>.</span><br>
                                <span> Tamanho Máximo: <b>500px X 500px</b>.</span><br>

                            </div>

                            <input type="file" name="foto" id="foto">
                            <br>

                            <div id="conteudo_upFoto"></div>

                        </div>
                        <div class="modal-footer ">
                            <button type="button" id="btnUpdateFoto" class="btn btn-info" ><span class="glyphicon glyphicon-ok-sign"></span> Alterar</button>
                            <button type="button" class="btn btn-warning " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Fechar</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content --> 
            </div>
            <!-- /.modal-dialog --> 
        </div>
<?php if (isset($usuario)) { ?>
            <div class="modal fade" id="meuendereco" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Dados Cadastrais : Endereço</h4>
                        </div>
                        <!-- -->
                        <?php
                        if (!is_null($usuario['ENDERECO'])) {
                            $acao = 'inserirEndereco';
                            $lblbotao = "Inserir";
                        } else {
                            $acao = 'alterarEndereco';
                            $lblbotao = "Salvar";
                        }
                        ?>
                        <form id="formEndereco" method="post" action="{base_url}usuario/<?= $acao ?>" enctype="multipart/form-data">
                            <div class="modal-body" id="">
                                <div class="row col-md-4">
                                    <div class="input-group ">
                                        <span class="input-group-addon">Cep</span>
                                        <input type="text" name="CEP" id="CEP" class="form-control" placeholder="Cep" aria-describedby="cep" value="<?= $usuario['CEP'] ?>">
                                    </div>
                                </div>
                                <div class="row col-md-8 col-md-offset-1">
                                    <div class="input-group">
                                        <span class="input-group-addon">Endereço</span>
                                        <input type="text" name="ENDERECO" id="endereco" class="form-control" placeholder="Endereço" aria-describedby="Endereço" value="<?= $usuario['ENDERECO'] ?>">
                                    </div>
                                </div>
                                <div class="row col-md-4">  
                                    <div class="input-group">
                                        <span class="input-group-addon">Número</span>
                                        <input type="text" name="NUMERO" id="numero" class="form-control" placeholder="Número" aria-describedby="Número" value="<?= $usuario['NUMERO'] ?>">
                                    </div>
                                </div>
                                <div class="row col-md-8 col-md-offset-1">  
                                    <div class="input-group">
                                        <span class="input-group-addon">Bairro</span>
                                        <input type="text" name="BAIRRO" id="bairro" class="form-control" placeholder="Bairro" aria-describedby="cep" value="<?= $usuario['BAIRRO'] ?>">
                                    </div>
                                </div>
                                <div class="row col-md-4">  
                                    <div class="input-group">
                                        <span class="input-group-addon">Estado</span>
                                        <input type="text" name="ESTADO" id="estado" class="form-control" placeholder="Estado" aria-describedby="Estado" value="<?= $usuario['ESTADO'] ?>">
                                    </div>
                                </div>
                                <div class="row col-md-8 col-md-offset-1">  
                                    <div class="input-group">
                                        <span class="input-group-addon">Cidade</span>
                                        <input type="text" name="CIDADE" id="Cidade" class="form-control" placeholder="Cidade" aria-describedby="cep" value="<?= $usuario['CIDADE'] ?>">
                                    </div>
                                </div>

                                <br >

                                <!--[CEP] => 25.565-241 [ENDERECO] => Rua Vitoria [NUMERO] => 9188 [BAIRRO] => gardenia azul [ESTADO] => RJ [CIDADE] => Rio de Janeiro )-->
                                <div id="retornoEndereco" class="clearfix">

                                </div>

                            </div>
                            <div class="modal-footer ">
                                <button type="button" id="salvarEndereco" class="btn btn-info" ><span class="glyphicon glyphicon-ok-sign"></span> <?= $lblbotao ?></button>
                                <button type="button" class="btn btn-warning " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Fechar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>
<?php }  ?> 
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
    </body>
</html>
