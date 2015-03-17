<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/estilo.css">
        <script src="<?php echo base_url()?>assets/js/jquery.chocoslider.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                $(".lock").mouseenter(function(){
                    $(this).children('i').removeClass('fa-lock').addClass('fa-unlock')
                })
                        .mouseleave(function(){
                    $(this).children('i').removeClass('fa-unlock').addClass('fa-lock')
                });
            var offset = $('.navbar-nav').offset().top;
            var $meuMenu = $('#barraMenu'); // guardar o elemento na memoria para melhorar performance
            $(document).on('scroll', function () {
                 console.log(offset);
                if (offset <= $(window).scrollTop()) {
                    
                    $meuMenu.addClass('navbar-fixed-top');
                } else {
                    $meuMenu.removeClass('navbar-fixed-top');
                }
            });
        });
         $(document).ready(function() {
  	$('#slider').chocoslider();
  });
        </script>
        <style>
            .navbar-blue {background-color: #E7FAFF; border-color: #2CD8CB;  margin-top: 0px !important;}
            .navbar-blue .navbar-nav>li>a {color: #0CC6F2;}
            .navbar-blue .navbar-nav>li>a:hover {color: #0C89F2;}
        </style>
    </head>
    <body style="">
        <div class="banner container-alternate alert alert-info hide" id="slider" style="height:200px">
            <a href="#"><img src="https://portaladventistadebaixoguandu.files.wordpress.com/2014/12/livro.png?w=350&h=200&crop=1" alt="Imagem 1" title="Texto da imagem 1"/></a>
            <a href="#"><img src="https://portaladventistadebaixoguandu.files.wordpress.com/2014/12/livro.png?w=350&h=200&crop=1" alt="Imagem 2" title="Texto da imagem 2"/></a>
            <a href="#"><img src="https://portaladventistadebaixoguandu.files.wordpress.com/2014/12/livro.png?w=350&h=200&crop=1" alt="Imagem 3" title="Texto da imagem 3"/></a>
            <a href="#"><img src="https://portaladventistadebaixoguandu.files.wordpress.com/2014/12/livro.png?w=350&h=200&crop=1" alt="Imagem 4" title="Texto da imagem 4"></a>
            <a href="#"><img src="https://portaladventistadebaixoguandu.files.wordpress.com/2014/12/livro.png?w=350&h=200&crop=1" alt="Imagem 5" title="Texto da imagem 5"/></a>
        </div>
        <!-- Fim -->
        <nav class="navbar navbar-blue" id="barraMenu" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapsible">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo-nav" href="{base_url}#section1" style="font-family: 'arial', cursive;">Club do Livro</a>

        </div>
        <div class="navbar-collapse collapse" id="navbar-collapsible">
           <div class="container">
                <ul class="nav navbar-nav">
                    <li ><a href="sobre">Link 1</a></li>
                    <li><a href="como_funciona">Link 2</a></li>
                    <li><a href="como_funciona">Link 3</a></li>
                    <!--                <li class="navbar-right"><a href="Como Funciona">Entrar</a></li>-->
                </ul>
                <?php if ($local =='home'){ ?>
                <button type="button" class="btn btn-success navbar-btn navbar-right lock"><i class="fa fa-lock"></i> &nbsp;Entrar</button>
                <?php }else{ ?>
                <button type="button" class="btn btn-danger navbar-btn navbar-right"><i class="glyphicon glyphicon-off"></i> &nbsp;Sair</button>
                <?php }?>
            </div>
            
        </div>
    </div>
</nav>
        <!-- Fim -->
<!--        <nav class="navbar navbar-blue " id="barraMenu">  
            <div class="container">
                <ul class="nav navbar-nav">
                    <li ><a href="sobre">Link 1</a></li>
                    <li><a href="como_funciona">Link 2</a></li>
                    <li><a href="como_funciona">Link 3</a></li>
                                    <li class="navbar-right"><a href="Como Funciona">Entrar</a></li>
                </ul>
                <?php if ($local =='home'){ ?>
                <button type="button" class="btn btn-success navbar-btn navbar-right lock"><i class="fa fa-lock"></i> &nbsp;Entrar</button>
                <?php }else{ ?>
                <button type="button" class="btn btn-danger navbar-btn navbar-right"><i class="glyphicon glyphicon-off"></i> &nbsp;Sair</button>
                <?php }?>
            </div>
        </nav>-->

        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        
    </body>
</html>
