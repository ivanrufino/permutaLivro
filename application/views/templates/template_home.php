<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Club do livro .::. Sistema de Trocas Online  </title>
        <meta name="description" content="Sistema de Troca de livro Online">
        <link rel="shortcut icon" href="{local}imagens/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--<link href="{local}css/bootstrap.min.css" rel="stylesheet">-->
        <link href="{local}css/bootstrap-social.css" rel="stylesheet">
        <link href="{local}font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Meddon' rel='stylesheet' type='text/css'>
        <meta name="author" content="Ivan Rufino Martins">
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="{local}css/styles.css" rel="stylesheet">

        <!-- script references -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!--<script src="{local}js/bootstrap.min.js"></script>-->
        <!--<script src="{local}js/scripts.js"></script>-->
        {css_list}
        {js_list}
        
        <script>
            $(document).ready(function() {
                var offset = $('.navbar').offset().top;
            var $meuMenu = $('#barraMenu'); // guardar o elemento na memoria para melhorar performance
            $(document).on('scroll', function () {
                if (offset <= $(window).scrollTop()) {                    
                    $meuMenu.addClass('navbar-fixed-top');
                } else {
                    $meuMenu.removeClass('navbar-fixed-top');
                }
            });
       
                $(".ttEsqueciSenha").tooltip({
                    template:'<div class="meu_tooltip tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner "></div></div>',
                    title : '<h5>Esqueci minha senha.</h5><p>Clique aqui para recupera-la</p>', 
                    html:true
                    });
                    <?php  if ($modal){ ?>
                       $('#login_modal').modal('show')
                    <?php }?>
            });
        </script>
    </head>
    <style>
        .meu_tooltip{width: 200px;}
    </style>
    <body>
        <div class="banner" style="height:00px">mostrar um banner aqui</div>
        {view_cabecalho}  
        <?php echo $this->session->flashdata('mensagem') ?>
        <section class="container-fluid" id="section1">
            <h1 class="text-center v-center"><strong>Club do Livro</strong></h1>
            <h2 class="text-center ">Sistema de trocas de livros online</h2>

            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class='apresentacao'>
                            O Projeto desenvolvido destina-se ao gerenciamento de trocas de livros entre usuário em um ambiente online, integrando estes usuários, de maneira que possam cadastras seus livros, disponibilizando-os para troca, da mesma forma que possam tambem inserir livros que desejem adquirir, o sistema verificará e alertará ao usuario que indicar que deseja um titulo quais usuário que disponibilizaram aquele titulo.
                        </h4>
                    </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-2 text-center"><h3>Facilidade</h3><p>Praticidade no seu dia-a-dia ao emitir uma receita  e essa emissão já vêm nos padrões estabelecidos pela OMS.</p><i class="fa fa-file-text-o fa-5x"></i></div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 text-center"><h3>Simpliciade</h3><p>Sua utilização é simples agilizando o processo de emissão de receitas, as receitas geradas para o paciente fica armazenada em um banco
                                    de dados, permitindo em uma nova consulta o médico verificar quais medicamentos o paciente utiliza.</p><i class="fa fa-user fa-5x"></i>&nbsp;<i class="fa fa-user fa-user-md fa-5x"></i></div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="row">
                            <div class="col-sm-10 text-center"><h3>Controle</h3><p>Médico é Paciente poderão visualizar todas as receitas geradas pelo SISCOREM.</p><i class="fa fa-desktop fa-5x"></i> &nbsp; <i class="fa fa-tablet fa-5x"></i>&nbsp;<i class="fa fa-mobile fa-5x"></i></div>
                        </div>
                    </div>
                </div>
                <!--      <div class="row">
                          <div class="col-xs-12">
                            <h4 class='apresentacao'>
                                O Sistema de Controle de Receita Médicass foi criado para suprir a necessidade de manter um histórico de receitas do paciente e tambem facilitar a leitura do receituário. 
                            </h4>
                        </div>
                          <div class="col-sm-4">
                            <div class="row">
                              <div class="col-sm-10 col-sm-offset-2 text-center"><h3>Facilidade</h3><p>Torna a emissão de receitas mais rápida, mais visualmente claro sua leitura e nos padrões estabelicidos pela OMS. </p><i class="fa fa-file-text-o fa-5x"></i></div>
                            </div>
                          </div>
                          <div class="col-sm-4 text-center">
                            <div class="row">
                              <div class="col-sm-10 col-sm-offset-1 text-center"><h3>Simpliciade</h3><p>O SISCOREM é muito simples tanto para a utilização por parte do médico assim como os atendentes e pacientes. As receitas ficaram arquivas, mantendo assim um histórico de todas as prescrições médicas. </p><i class="fa fa-user fa-5x"></i>&nbsp;<i class="fa fa-user fa-user-md fa-5x"></i></div>
                            </div>
                          </div>
                          <div class="col-sm-4 text-center">
                            <div class="row">
                              <div class="col-sm-10 text-center"><h3>Controle</h3><p>Com a utilização do SISCOREM, médico e paciente terão um total controle sobre todas as suas receitas geradas. Podendo ser visualizado tanto de um computador como em tablets e/ou celulares</p><i class="fa fa-desktop fa-5x"></i> &nbsp; <i class="fa fa-tablet fa-5x"></i>&nbsp;<i class="fa fa-mobile fa-5x"></i></div>
                            </div>
                          </div>
                      </div>/row-->
                <div class="row"><br></div>
            </div><!--/container-->
        </section>

        <section class="container-fluid" id="section2">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <h1>Como Utilizar</h1>
                    <br>
                    <p class="lead">A utilização do SISCOREM não exige grandes conhecimentos em informática, bastando apenas um dispersivo conectado a web e seguindo estes simples passos, todos os clientes do sistema aproveitam ao máximo todas as funcionalidades.</p>
                    <ul class="nav" style="text-align: left">
                        <li>A princípio é necessário que um administrador responsável pela empresa (clínica médica, hospital, farmácia) realize o cadastro.</li>
                        <li>O administrador é responsável pelo cadastro do(s) atendente(s) de sua empresa e a vinculação de médicos</li>
                        <li>Também é de sua reponsabilidade manter os horários do médico atualizados.</li>
                        <li><br></li>
                        <li>O atendente previamente cadastrado pelo administrador, é responsável por cadastrar novos paciente.</li>
                        <li>O paciente para ter acesso às suas receitas basta apenas entrar no sistema utilizando o Login e a senha definidos no cadastro.</li>
                    </ul>
                    <p class="lead">O SISCOREM é muito simples, mas se tiver alguma dúvida entre em nossa seção de<a href="#section4" >perguntas frequentes</a> ou entre em <a href="#section6">contato</a>.</p>
                    <br> 
                    <!--<i style="font-size:120px" class="fa fa-camera fa-5x"></i>-->
                    <p>Clique no botão abaixo e experimente nosso sistema.</p>
                    <p><a href ="{base_url}admin/cadastro" class="btn btn-primary btn-lg">Inscreva-se agora <span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>
                </div>
            </div>
        </section>

        <section class="container-fluid hide" id="section3">
            <h1 class="text-center">Bootstrap is Responsive</h1>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h3 class="text-center">Vertical scrolling has become a popular and lasting trend in Web design.</h3>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-1">Some brand-tacular designs even have home page content that is taller that 12,000 pixels. That's a lotta content.</div>
                        <div class="col-xs-2"></div>
                        <div class="col-xs-4 text-right">Anyhoo, this is just some random blurb of text, and Bootply.com is a playground and code editor for Bootstrap.</div>
                    </div>
                    <p class="text-center">
                      <!--<img src="/assets/example/img_mtnpeople.png" class="img-responsive center-block ">-->
                    </p>
                </div>
            </div>
        </section>
        <div class="hide">
        <section class="container-fluid hide" id="section4-outro">
            <h2 class="text-center">Change this Content. Change the world.</h2>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                <!--<img src="/assets/example/bg_smartphones.jpg" class="img-responsive center-block ">-->
                    <p class="text-center">Images will scale down proportionately as browser width narrows.</p>
                </div>
            </div>
        </section>

        <section class="container-fluid hide" id="section5"><br>
            <div class="col-sm-10 col-sm-offset-1">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="list-group">
                                <a href="#" class="list-group-item active">
                                    <h2 class="list-group-item-heading">Basic</h2>
                                    <h6>Free to get started</h6>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Option 100 - more about this</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Option 2 - this is more about this</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Option 3 GB</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Option 4</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Feature</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Feature</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <button class="btn btn-primary btn-lg btn-block">Get Started</button>
                                </a>
                            </div>
                        </div><!--/left-->

                        <div class="col-sm-4 col-xs-12">
                            <div class="list-group text-center">
                                <a href="#" class="list-group-item active">
                                    <h2 class="list-group-item-heading">Better</h2>
                                    <h6>Most popular plan</h6>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Option 200 - more about this</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Option 2 - this is more about this</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Option 5 GB</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Option 6</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Feature</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Feature</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <button class="btn btn-default btn-lg btn-block">$10 per month</button>
                                </a>
                            </div>
                        </div><!--/middle-->

                        <div class="col-sm-4 col-xs-12">
                            <div class="list-group text-right">
                                <a href="#" class="list-group-item active">
                                    <h2 class="list-group-item-heading">Best</h2>
                                    <h6>For enterprise grade</h6>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Option 100 - more about this</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Option 2 - this is more about this</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Option 8 GB</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Option 10</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Unlimited</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <p class="list-group-item-text">Unlimited</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <button class="btn btn-default btn-lg btn-block">$20 per month</button>
                                </a>
                            </div>
                        </div><!--/right-->

                    </div><!--/row-->
                </div><!--/container--> 
            </div>
        </section>

        <section class="container-fluid  " id="section6">
            <h2 class="text-center">Contato</h2>
            <p class="text-center lead">Envie uma mensagem de agradecimento, dúvida ou sugestão e entraremos em contato o mais rápido possível.</p>
            <fieldset>
                <legend></legend>       
                <form action="contato" method="POST">
                    <!--                <div class="form-group col-md-6 col-md-offset-3 col-xs-12" >
                                        <label for="Nome" >Nome</label>  
                                        <input id="bairro" name="bairro" type="text" placeholder="" value="<?php echo $this->session->flashdata('bairro'); ?>" class="form-control input-md endereco" required="">
                                    </div>-->
                    <div class="col-xs-8 col-xs-offset-2">

                        <div class="form-group col-sm-6">
                            <div class="input-group">
                                <div class="input-group-addon">Nome:</div>
                                <input class="form-control" type="text" name='nome' id='nome' placeholder="Digite seu nome" required="">
                            </div>
                        </div>
                        <div class="form-group col-sm-6 ">
                            <div class="input-group">
                                <div class="input-group-addon">Telefone:</div>
                                <input class="form-control" type="tel" name="telefone" id="telefone" placeholder="Digite seu Telefone">
                            </div>
                        </div>
                        <div class="form-group col-sm-6 ">
                            <div class="input-group">
                                <div class="input-group-addon">Email:&nbsp;</div>
                                <input class="form-control " type="email" name="email" id="email" placeholder="Digite seu Email">
                            </div>
                        </div>   
                        <div class="form-group col-sm-6 ">
                            <div class="input-group">
                                <div class="input-group-addon">Cliente:&nbsp;&nbsp;&nbsp;</div>
                                <select class="form-control" name="cliente" id="cliente">
                                    <option value="0">Outros</option>
                                    <option value="5">Administrador</option>
                                    <option value="1">Médico</option>
                                    <option value="2">Atendente</option>
                                    <option value="3">Atendente de Farmácia</option>
                                    <option value="4">Paciente</option>
                                </select>

                            </div>
                        </div> 
                        <div class="form-group col-sm-12 ">
                            <div class="input-group">
                                <div class="input-group-addon">Mensagem</div>
                                <textarea class="form-control"  name="mensagem" id="mensagem" placeholder="Digite sua mensagem" style="resize: none;height: 150px"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-offset-5 col-xs-3">
                                <button type="submit" class="btn btn-default" disabled="">Enviar mensagem</button>
                            </div>
                        </div>
                    </div>

                </form>
            </fieldset>
        <!--<img src="{local}imagens/bg_iphone.png" class="img-responsive center-block ">-->

        </section>
        <section class="container-fluid " id="section4">
            <h2 class="text-center">Perguntas Frequentes:</h2>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 hide">
                <!--<img src="/assets/example/bg_smartphones.jpg" class="img-responsive center-block ">-->
                    <p class="text-center">Clique nos retangulos abaixo para ver os detalhes</p>
                </div>
                <div class="container">
                    <div class="col-md-4 col-sm-6 faq">
                        <h1>O que é o SISCOREM?</h1>
                        <p>SISCOREM ou <strong>Sis</strong>tema de <strong>Co</strong>ntrole de <strong>Re</strong>ceita é um sistema para criação de receitas médicas, evitando a má leitura da caligrafia médica.</p>
                    </div>
                    <div class="col-md-4 col-sm-6 faq">
                        <h1>Qualquer um pode usar?</h1>
                        <p>Sim, qualquer hospital, clinica ou farmacia pode usar o sistema e cadastrar seus utilizadores (médicos, atendentes, farmaceuticos e pacientes).</p>
                    </div>
                    <div class="col-md-4 col-sm-6 faq">
                        <h1>Não lembro minha senha</h1>
                        <p>Caso tenha esquecido sua senha, clique no link esqueci minha senha ou no botão <i class="fa fa-question-circle"></i> ao abrir uma nova janela digite seu email e click em ok.<br>as informações para alteração de senha serão enviadas para seu email cadastrado. </p>
                    </div>

                </div>
            </div>
        </section>
        <section class="container hide" id="section7">
            <h1 class="text-center">OUTROS</h1>
            <div class="row">
                <!--fontawesome icons-->
                <!--      <div class="col-sm-1 col-sm-offset-2 col-xs-4 text-center">
                       <i class="fa fa-github fa-4x"></i>
                      </div>-->
                <!--      <div class="col-sm-1 col-xs-4 text-center">
                       <i class="fa fa-foursquare fa-4x"></i>
                      </div>-->
                <div class="col-sm-1 col-xs-4 text-center">
                    <i class="fa fa-facebook fa-4x"></i>
                </div>
                <!--      <div class="col-sm-1 col-xs-4 text-center">
                       <i class="fa fa-pinterest fa-4x"></i>
                      </div>-->
                <!--      <div class="col-sm-1 col-xs-4 text-center">
                       <i class="fa fa-google-plus fa-4x"></i>
                      </div>
                      <div class="col-sm-1 col-xs-4 text-center">
                       <i class="fa fa-twitter fa-4x"></i>
                      </div>
                      <div class="col-sm-1 col-xs-4 text-center">
                       <i class="fa fa-dribbble fa-4x"></i>
                      </div>
                      <div class="col-sm-1 col-xs-4 text-center">
                       <i class="fa fa-instagram fa-4x"></i>
                      </div>-->
            </div><!--/row-->
            <div class="row">
                <div class="col-md-12 text-center">
                    <br><br>
                    <p>
                    <form action="contato" method="POST">
                        <label>Nome</label><input type="text" id="nome" name="nome" placeholder="Digite seu nome"><br>
                        <label>Telefone</label><input type="tel" id="nome" name="nome" placeholder="Digite seu telefone"><br>
                        <label>Email</label><input type="mail" id="nome" name="nome" placeholder="Digite seu Email"><br>
                        <label>Cliente</label>
                        <select>
                            <option value="0">Outros</option>
                            <option value="5">Administrador</option>
                            <option value="1">Médico</option>
                            <option value="2">Atendente</option>
                            <option value="3">Atendente de Farmácia</option>
                            <option value="4">Paciente</option>

                        </select><br>
                        <label>Mensagem</label>
                        <textarea></textarea>
                    </form>
                    </p>
                </div>
            </div>
        </section> 
</div>
        <footer id="footer" style="display:none">
            <div class="container">
                <div class="row">    
                    <div class="col-xs-6 col-sm-6 col-md-3 column">          
                        <h4>Information</h4>
                        <ul class="nav">
                            <li><a href="about-us.html">Products</a></li>
                            <li><a href="about-us.html">Services</a></li>
                            <li><a href="about-us.html">Benefits</a></li>
                            <li><a href="elements.html">Developers</a></li>
                        </ul> 
                    </div>
                    <div class="col-xs-6 col-md-3 column">          
                        <h4>Follow Us</h4>
                        <ul class="nav">
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Google+</a></li>
                            <li><a href="#">Pinterest</a></li>
                        </ul> 
                    </div>
                    <div class="col-xs-6 col-md-3 column">          
                        <h4>Contact Us</h4>
                        <ul class="nav">
                            <li><a href="#">Email</a></li>
                            <li><a href="#">Headquarters</a></li>
                            <li><a href="#">Management</a></li>
                            <li><a href="#">Support</a></li>
                        </ul> 
                    </div>
                    <div class="col-xs-6 col-md-3 column">          
                        <h4>Customer Service</h4>
                        <ul class="nav">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Delivery Information</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                        </ul> 
                    </div>
                </div><!--/row-->
            </div>
        </footer>
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Acessar SISCOREM</h4>
                    </div>
                    <div class="modal-body">
                        {view_login_modal}


                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-warning efetLogin" ><span class="glyphicon glyphicon-ok-sign"></span> Entrar</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal" ><span class="glyphicon glyphicon-remove"></span> Fechar</button>
                    </div>
                </div>
                <!-- /.modal-content --> 
            </div>
            <!-- /.modal-dialog --> 
        </div>
        
        <div class="modal fade" id="esqueciSenha" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Esqueci minha Senha</h4>
                    </div>
                    <div class="modal-body">
                        {view_esqueciSenha}


                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-warning enviarEmail" ><span class="glyphicon glyphicon-ok-sign"></span> Enviar</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal" ><span class="glyphicon glyphicon-remove"></span> Fechar</button>
                    </div>
                </div>
                <!-- /.modal-content --> 
            </div>
            <!-- /.modal-dialog --> 
        </div>

    </body>
</html>
