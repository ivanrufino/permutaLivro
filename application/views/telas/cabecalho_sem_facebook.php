<nav class="navbar navbar-trans navbar-fixed-top" role="navigation">
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
                    
                    <?php if (!$this->session->userdata('logged_in')) { ?>
                        <li class="visible-xs visible-sm">
                            <!--<a href="{base_url}admin" class=" btn btn-info"><i class="glyphicon glyphicon-user"></i> Login</a>-->
                            <a  class="btn-link"  data-toggle="modal" data-target="#login" data-placement="top" rel="tooltip" ><b class="fa fa-key"> &nbsp;</b>Acessar</a>
                        </li>
                                         
                         <li class="visible-xs visible-sm"> <a  class="btn-link ttEsqueciSenha"  data-toggle="modal" data-toggle="tooltip"  data-placement="bottom" data-target="#esqueciSenha"   ><i class="fa fa-question-circle"> </i> Esqueci Minha senha</a></li>
                    <!--<li> <a  class="btn-link"  data-toggle="modal" data-target="#esqueciSenha" data-placement="top" rel="tooltip" ><b class="fa fa-key"> &nbsp;</b>Acessar</a></li>-->
                        <li><a href="{base_url}usuario/cadastro" class=""><i class="glyphicon  "></i> Cadastre-se</a></li>
                   <?php  }
                    ?>
                   
                   
                </ul>
            </div>
        <?php if (!$this->session->userdata('logged_in')) { ?>
                <div class="hidden-xs hidden-sm col-md-6" style="background: transparent">
                    <form class="navbar-form" action="{base_url}login/efetuarLogin" method="post">
                        <div class="form-group "style="float: right">

                            <div class="col-md-6 input-group" style="float: left;margin-right: 2%;">
                                <input type="text" class="form-control" name="email" id="usuario" required="" placeholder="usuário" value="">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            </div>
                            <div class="col-md-3 input-group" style="float: left;margin-right: 2%;">
                                <input type="password" class="form-control " name="senha" id="senha" required="" placeholder="Senha" value="">
                                <span class="input-group-addon"><i class="fa fa-key "></i></span>
                            </div>

                            <button type="submit" class="btn btn-default" style="float: left">Entrar</button>
                            <a  class="btn-link ttEsqueciSenha"  data-toggle="modal"  data-toggle="tooltip"  data-placement="bottom" data-target="#esqueciSenha"  style="float: right;font-size: 1.6em;"><i class="fa fa-question-circle"> </i> </a>
                        </div>

                    </form>
                </div>
            <?php
            } else {
                echo "<ul class='nav navbar-nav navbar-right'><li><a>ola, ".$usuario['NOME'].", seja bem vindo </a> </li><li> <a href='{base_url}sair'>Sair</a></li></ul>";
            }
            ?>

        </div>
    </div>
</nav>