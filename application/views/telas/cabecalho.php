<script>
            $(document).ready(function(){
              $('.scroll').click(function(){
                  var elemento = $(this).attr('href');
                  $('html, body').animate({
                scrollTop: $(elemento).offset().top-70
                }, 1000);
                return false;
              })
                $(".lock").mouseenter(function(){
                    $(this).children('i').removeClass('fa-lock').addClass('fa-unlock')
                })
                        .mouseleave(function(){
                    $(this).children('i').removeClass('fa-unlock').addClass('fa-lock')
                });
            });
//         $(document).ready(function() {
//  	$('#slider').chocoslider();
//  });
        </script>
        <style>
            .navbar-blue {background-color: #E7FAFF !important; border-color: #2CD8CB !important;  margin-top: 0px !important;}
            .navbar-blue .navbar-nav>li>a {color: #0CC6F2 !important;}
            .navbar-blue .navbar-nav>li>a:hover {color: #0C89F2 !important;}
        </style>
    </head>
<div class="banner container-alternate alert alert-info hide" id="slider" style="height:200px">
            <a href="#"><img src="https://portaladventistadebaixoguandu.files.wordpress.com/2014/12/livro.png?w=350&h=200&crop=1" alt="Imagem 1" title="Texto da imagem 1"/></a>
            <a href="#"><img src="https://portaladventistadebaixoguandu.files.wordpress.com/2014/12/livro.png?w=350&h=200&crop=1" alt="Imagem 2" title="Texto da imagem 2"/></a>
            <a href="#"><img src="https://portaladventistadebaixoguandu.files.wordpress.com/2014/12/livro.png?w=350&h=200&crop=1" alt="Imagem 3" title="Texto da imagem 3"/></a>
            <a href="#"><img src="https://portaladventistadebaixoguandu.files.wordpress.com/2014/12/livro.png?w=350&h=200&crop=1" alt="Imagem 4" title="Texto da imagem 4"></a>
            <a href="#"><img src="https://portaladventistadebaixoguandu.files.wordpress.com/2014/12/livro.png?w=350&h=200&crop=1" alt="Imagem 5" title="Texto da imagem 5"/></a>
        </div>
        <!-- Fim -->
        <nav class="navbar navbar-blue navbar-trans" id="barraMenu" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapsible">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo-nav" href="{base_url}#section1" style="font-family: 'arial', cursive;">Permuta Livro</a>

        </div>
        <div class="navbar-collapse collapse" id="navbar-collapsible">
           <div class="container">
                <ul class="nav navbar-nav">
                    <li><a href="#section1" class="btn btn-default btn-lg scroll"  >Home</a></li>
                  <!--<li><a href="#section2" class="btn btn-default btn-lg scroll"  >Como Utilizar?</a></li>-->
                    <!--                <li class="navbar-right"><a href="Como Funciona">Entrar</a></li>-->
                </ul>
                <?php
                $local=$this->router->fetch_class();
                $sublocal =  $this->router->fetch_method();
//                echo $local;
                switch ($local) {
                    case 'home':
                        if ($this->session->userdata('logged_in')) {
                            echo '<a href="{base_url}minhaestante.html" class="btn btn-success navbar-btn btn-lg navbar-right" ><i class="fa fa-university"></i>Acessar</a> ';
                        }else{ 
                            echo '<button type="button" data-toggle="modal" data-target="#login_modal" class="btn btn-success btn-lg navbar-btn navbar-right lock"><i class="fa fa-lock"></i> &nbsp;Entrar</button>';
                        }

                        break;
                    case 'usuario':
                         echo '<a href="{base_url}login/efetuarLogout" class="btn btn-danger  btn-lg navbar-btn navbar-right" ><i class="fa fa-power-off"></i> &nbsp;Sair</a>' ;
                        if($sublocal=='recados'){
                            echo '<a href="{base_url}minhaestante.html" class="btn btn-success btn-lg navbar-btn navbar-right" ><i class="fa fa-home fa-lg"></i>&nbsp;Minha estante</a> ';
                        }
                         break;
                    default:
                         echo '<a href="{base_url}login/efetuarLogout" class="btn btn-danger btn-lg navbar-btn navbar-right" ><i class="fa fa-power-off"></i> &nbsp;Sair</a>' ;
                        echo '<a href="{base_url}minhaestante.html" class="btn btn-success btn-lg navbar-btn navbar-right" ><i class="fa fa-home fa-lg"></i>&nbsp;Minha estante</a> ';
                       
                        break;
                    
                }
                /*if ($local =='home'){ 
                  if ($this->session->userdata('logged_in')) {?>
                   <a href="minhaestante.html" class="btn btn-info navbar-btn navbar-right" >Acessar</a> 
                   <?php }else{ ?>
                    <button type="button" data-toggle="modal" data-target="#login_modal" class="btn btn-success navbar-btn navbar-right lock"><i class="fa fa-lock"></i> &nbsp;Entrar</button>
                    
                   <?php }
                   
                   }else{ ?>
                 <a href="{base_url}login/efetuarLogout" class="btn btn-danger navbar-btn navbar-right" ><i class="glyphicon glyphicon-off"></i> &nbsp;Sair</a>
                <!--<button type="button"  class="btn btn-danger navbar-btn navbar-right"><i class="glyphicon glyphicon-off"></i> &nbsp;Sair</button>-->
                <?php }*/?>
            </div>
            
        </div>
    </div>
</nav>

<!--<nav class="navbar navbar-trans navbar-fixed-top" role="navigation">
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
            <div class="col-md-4">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="<?=  base_url()?>#section1">Home</a></li>
                    <li><a href="<?=  base_url()?>#section2">Como Utilizar?</a></li>
                    
                    
                   
                   
                </ul>
            </div>
            <div class="col-md-4">
         <?php        if (! $this->session->userdata('logged_in')) {?>
                  <a href="" class="btn btn-info" data-toggle="modal" data-target="#login_modal">Acessar</a> 
            <?php }else{ ?>
                <a href="{base_url}login/efetuarLogout" class="btn btn-danger" >Sair</a>
            <?php }
        ?>
               
                
        </div>
        </div>
    </div>
</nav>-->
<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Login</h4>
      </div>
      <div class="modal-body">
          {view_login_all}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
