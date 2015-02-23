<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de Receituario Online projeto de tcc">
        <link rel="shortcut icon" href="{local}imagens/favicon.ico" type="image/x-icon">
        <meta name="author" content="Ivan Rufino Martins">

        <title>Sistema de Receitu&aacute;rio Online</title>
<!--        <script src="<?= base_url('assets/js/jquery-1.10.2.js') ?>" type="text/javascript"></script>
        <link href="<?= base_url('assets/css/bootstrap.css') ?>" rel="stylesheet" type="text/css">-->

        {js_list}
        {css_list}

    </head>
    
 
    <body class="marginTop90">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">


                <div class="navbar-header ">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand logo-nav nav-link" href="#top"><img class="" src="{local}imagens/logo.png"  height="35">Siscorem</a>
                </div>

                <div class="collapse navbar-collapse navbar-ex1-collapse" >
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#features" class="nav-link">Características</a></li>
                        <li><a href="#tour-head" class="nav-link">Tour</a></li>
                        <li><a href="#faqs" class="nav-link">Perguntas Frequentes</a></li>
                        <li><a href="#about" class="nav-link">Sobre</a></li>
                        <!--<li><a href="#contato" class="nav-link ">Contato</a></li>-->
                        <li class="">
                            <!--<a href="{base_url}admin" class=" btn btn-info"><i class="glyphicon glyphicon-user"></i> Login</a>-->
                            <a href="#" class=" btn btn-link"  data-toggle="modal" data-target="#login" data-placement="top" rel="tooltip" >Acessar <b class="caret"></b></a>


                        </li>

                        <li><a href="{base_url}admin" class=" btn btn-info"><i class="glyphicon glyphicon-user"></i> admin</a></li>

                    </ul>
                </div> <!-- /.navbar-collapse -->
            </div> <!-- /.container -->
        </nav> <!-- /.navbar -->
        {view_tela_erros}
        <div id="top" class="jumbotron">
            <div class="container">
                <h1>SISCOREM, seu novo gerenciador de receitas Online</h1>
                <h2>Simples, prático e eficaz, sua receita médica sempre a disposição</h2>
                <p><a href ="{base_url}admin/cadastro" class="btn btn-primary btn-lg">Inscreva-se agora <span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>
            </div> <!-- /.container -->
        </div> <!-- /.jumbotron -->
        <div class="container container-blank"></div>
        
        <div class="container-alternate" >
        <div class="container" >
            <h3  id="features" class="subhead">Características </h3>
            <div class="row benefits">
                <div class="col-md-4 col-sm-6 benefit">
                    <div class="benefit-ball">
                        <span class="glyphicon glyphicon-list-alt"></span>
                    </div>
                    <h3>Médico</h3>
                    <p>Seu modo de receitar será muito mais prático dispensando todo o tempo escrevendo o nome do medicamento, o sistema conta centenas de medicamentos, bastando apenas seleciona-lo na lista </p>
                </div> <!-- /.benefit -->

                <div class="col-md-4 col-sm-6 benefit">
                    <div class="benefit-ball">
                        <span class="glyphicon glyphicon-cloud"></span>
                    </div>
                    <h3>Paciente</h3>
                    <p>Sua receita estara a disposição 24h/dia, 7 dias por semana, não havendo assim perda de receita, mantendo também um histórico de receituário. </p>
                </div> <!-- /.benefit -->

                <div class="col-md-4 col-sm-6 benefit">
                    <div class="benefit-ball">
                        <span class="glyphicon glyphicon-cloud"></span>
                    </div>
                    <h3>Farmaceutico</h3>
                    <p>Chega de tentar traduzir a caligrafia médica, todas as receitas geradas são de fácil leitura tanto em tela como impressas, evitando a erros causados por letras ilegiveis.</p>
                </div> <!-- /.benefit -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
        </div>
        <div class="container container-blank"></div>
        <div class="container-alternate">
            <div class="container">
                <h3 id="tour-head" class="subhead">Tour</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div id="tour" class="carousel slide">
                            <ol class="carousel-indicators">
                                <li data-target="#tour" data-slide-to="0" class="active"></li>
                                <li data-target="#tour" data-slide-to="1"></li>
                                <li data-target="#tour" data-slide-to="2"></li>
                                <li data-target="#tour" data-slide-to="3"></li>
                                <li data-target="#tour" data-slide-to="4"></li>
                            </ol>

                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="{base_url}assets/lighter/img/stock1.jpg">
                                    <div class="carousel-caption">
                                        Amazing photos provided by <a href="http://unsplash.com">unsplash.com</a>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="{base_url}assets/lighter/img/stock2.jpg">
                                    <div class="carousel-caption">
                                        Boat in Water
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="{base_url}assets/lighter/img/stock3.jpg">
                                    <div class="carousel-caption">
                                        Millennium Bridge in London
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="{base_url}assets/lighter/img/stock4.jpg">
                                    <div class="carousel-caption">
                                        Blurs
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="{base_url}assets/lighter/img/stock5.jpg">
                                    <div class="carousel-caption">
                                        Santorini Greece
                                    </div>
                                </div>
                            </div>

                            <a class="left carousel-control" href="#tour" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#tour" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div> <!-- #tour -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.container-alternate -->
        <div class="container container-blank"></div>
        <div class="container-alternate">
        <div class="container">
            <h3 id="faqs" class="subhead">Perguntas Frequentes</h3>
            <div class="row faqs">
                <p class="col-md-4 col-sm-6">
                    <strong>Lorem ipsum dolor sit amet?</strong><br>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                    nonummy nibh euismod tincidunt ut laoreet dolore magna.  Ut wisi enim
                    ad minim veniam, quis nostrud exerci tation ullamcorper suscipit
                    lobortis nisl ut aliquip ex ea commodo consequat.
                </p>
                <p class="col-md-4 col-sm-6">
                    <strong>Lorem ipsum dolor sit amet?</strong><br>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                    nonummy nibh euismod tincidunt ut laoreet dolore magna.  Ut wisi enim
                    ad minim veniam, quis nostrud exerci tation ullamcorper suscipit
                    lobortis nisl ut aliquip ex ea commodo consequat.
                </p>
                <p class="col-md-4 col-sm-6">
                    <strong>Lorem ipsum dolor sit amet?</strong><br>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                    nonummy nibh euismod tincidunt ut laoreet dolore magna.  Ut wisi enim
                    ad minim veniam, quis nostrud exerci tation ullamcorper suscipit
                    lobortis nisl ut aliquip ex ea commodo consequat.
                </p>
                <p class="col-md-4 col-sm-6">
                    <strong>Lorem ipsum dolor sit amet?</strong><br>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                    nonummy nibh euismod tincidunt ut laoreet dolore magna.  Ut wisi enim
                    ad minim veniam, quis nostrud exerci tation ullamcorper suscipit
                    lobortis nisl ut aliquip ex ea commodo consequat.
                </p>
                <p class="col-md-4 col-sm-6">
                    <strong>Lorem ipsum dolor sit amet?</strong><br>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                    nonummy nibh euismod tincidunt ut laoreet dolore magna.  Ut wisi enim
                    ad minim veniam, quis nostrud exerci tation ullamcorper suscipit
                    lobortis nisl ut aliquip ex ea commodo consequat.
                </p>
                <p class="col-md-4 col-sm-6">
                    <strong>Lorem ipsum dolor sit amet?</strong><br>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                    nonummy nibh euismod tincidunt ut laoreet dolore magna.  Ut wisi enim
                    ad minim veniam, quis nostrud exerci tation ullamcorper suscipit
                    lobortis nisl ut aliquip ex ea commodo consequat.
                </p>
            </div> <!-- /.faqs -->
        </div> <!-- /.container -->
        </div>
        <div class="container container-blank"></div>
        <div class="container-alternate">
            <div class="container">
                <h3 id="about" class="subhead">Sobre Nós</h3>
                <div class="row about">
                    <div class="col-md-10 col-md-offset-1 text-center">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                            nonummy nibh euismod tincidunt ut laoreet dolore magna.  Ut wisi
                            enim ad minim veniam, quis nostrud exerci tation ullamcorper
                            suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis
                            autem vel eum iriure dolor in hendrerit in vulputate velit esse
                            molestie consequat, vel illum dolore eu feugiat nulla facilisis at
                            vero eros et accumsan.
                        </p>
                        <p>
                            Nam liber tempor cum soluta nobis eleifend option congue nihil
                            imperdiet doming id quod mazim placerat facer possim assum. Typi non
                            habent claritatem insitam; est usus legentis in iis qui facit eorum
                            claritatem. Investigationes demonstraverunt lectores legere me lius
                            quod ii legunt saepius.
                        </p>
                    </div> <!-- /.col-md-10 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.container-alternate -->

        <!--  <div class="container">
             <h3 id="contato" class="subhead">Contato</h3>
             <div class="row contato">
                 tela de contato
             </div> 
         </div> /.container -->
        <div class="container container-blank"></div>
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
        
        <footer class="navbar-fixed-bottom">
            <div class="container clearfix">
                <p class="pull-left">
                    Copyright &copy; Sistema de Controle de Receita Médicass SISCOREM 2014
                </p>
                <p class="pull-right">
                    Desenvolvido por  <a href="http://tcc.bl.ee/">SISCOREM Corporation</a>
                </p>
            </div> <!-- /.container -->
        </footer>

        <!--<script src="{base_url}assets/lighter/js/jquery.js"></script>-->
        <!--<script src="{base_url}assets/lighter/js/bootstrap.min.js"></script>-->
        <script>
            $(".nav-link").click(function(e) {
                e.preventDefault();
                var link = $(this);
                var href = link.attr("href");

                $("html,body").animate({scrollTop: $(href).offset().top - 80}, 1500);
                link.closest(".navbar").find(".navbar-toggle:not(.collapsed)").click();
            });
        </script>

    </body>  
</html>
