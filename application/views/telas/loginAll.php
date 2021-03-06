<style>
    /*
        Note: It is best to use a less version of this file ( see http://css2less.cc
        For the media queries use @screen-sm-min instead of 768px.
        For .omb_spanOr use @body-bg instead of white.
    */

    @media (min-width: 768px) {
        .omb_row-sm-offset-3 div:first-child[class*="col-"] {
            margin-left: 25%;
        }
    }

    .omb_login .omb_authTitle {
        text-align: center;
        line-height: 300%;
    }

    .omb_login .omb_socialButtons a {
        color: white; // In yourUse @body-bg 
        opacity:0.9;
    }
    .omb_login .omb_socialButtons a:hover {
        color: white;
        opacity:1;    	
    }
    .omb_login .omb_socialButtons .omb_btn-facebook {background: #3b5998;}
    .omb_login .omb_socialButtons .omb_btn-twitter {background: #00aced;}
    .omb_login .omb_socialButtons .omb_btn-google {background: #c32f10;}


    .omb_login .omb_loginOr {
        position: relative;
        font-size: 1.5em;
        color: #aaa;
        margin-top: 1em;
        margin-bottom: 1em;
        padding-top: 0.5em;
        padding-bottom: 0.5em;
    }
    .omb_login .omb_loginOr .omb_hrOr {
        background-color: #cdcdcd;
        height: 1px;
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
    .omb_login .omb_loginOr .omb_spanOr {
        display: block;
        position: absolute;
        left: 50%;
        top: -0.6em;
        margin-left: -1.5em;
        background-color: white;
        width: 3em;
        text-align: center;
    }			

    .omb_login .omb_loginForm .input-group.i {
        width: 2em;
    }
    .omb_login .omb_loginForm  .help-block {
        color: red;
    }
    .omb_socialButtons>div{ margin-bottom: 5px}

    @media (min-width: 768px) {
        .omb_login .omb_forgotPwd {
            text-align: right;
            margin-top:10px;
        }		
    }
</style>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<div class="">

    <?= $this->session->flashdata('mensagem_erro'); ?>
    <div class="omb_login">
        <h3 class="">Entre ou  <a href="#">Cadastre-se</a></h3>
        <div class="row omb_socialButtons ">
            <?php if (isset($btn_rede['Facebook'])){?>
            <div class="col-xs-4 col-sm-3 ">
                <a href="<?= $btn_rede['Facebook']['link'] ?>" class="btn btn-md btn-block btn-facebook">
                    <i class="fa fa-facebook  "></i>
                    <span class="hidden-xs">Facebook</span>
                </a>
            </div>
            <?php } ?>
            <?php if (isset($btn_rede['Google'])){?>
            <div class="col-xs-4 col-sm-3">
                <a href="<?= $btn_rede['Google']['link'] ?>" class="btn btn-md btn-block btn-google-plus">
                    <i class="fa fa-google-plus "></i>
                    <span class="hidden-xs">Google+</span>
                </a>
            </div>
            <?php } ?>
            <?php if (isset($btn_rede['Instagram'])){?>
            <div class="col-xs-4 col-sm-3">
                <a href="<?= $btn_rede['Instagram']['link'] ?>" class="btn btn-md btn-block btn-instagram">
                    <i class="fa fa-instagram "></i>
                    <span class="hidden-xs">Instagram</span>
                </a>
            </div>
            <?php } ?>
            <?php if (isset($btn_rede['Linkedin'])){?>
            <div class="col-xs-4 col-sm-3">
                <a href="<?= $btn_rede['Linkedin']['link'] ?>" class="btn btn-md btn-block btn-linkedin">
                    <i class="fa fa-linkedin "></i>
                    <span class="hidden-xs">Linkedin</span>
                </a>
            </div>
            <?php } ?>
            <?php if (isset($btn_rede['Windowslive'])){?>
            <div class="col-xs-4 col-sm-3">
                <a href="<?= $btn_rede['Windowslive']['link'] ?>" class="btn btn-md btn-block btn-microsoft">
                    <i class="fa fa-windows "></i>
                    <span class="hidden-xs">Windows</span>
                </a>
            </div>
            <?php } ?>
            <?php if (isset($btn_rede['Github'])){?>
            <div class="col-xs-4 col-sm-3">
                <a href="<?= $btn_rede['Github']['link'] ?>" class="btn btn-md btn-block btn-github">
                    <i class="fa fa-github "></i>
                    <span class="hidden-xs">GitHub</span>
                </a>
            </div>
            <?php } ?>
            
        </div>

        <div class="row  omb_loginOr">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                <hr class="omb_hrOr">
                <span class="omb_spanOr">or</span>
            </div>
        </div>

        <div class="row ">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2">	
                <form class="omb_loginForm" action="{base_url}login/efetuarLogin" autocomplete="off" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="usuario" placeholder="Digite seu email">
                    </div>
                    <span class="help-block"></span>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input  type="password" class="form-control" name="senha" placeholder="Digite sua senha">
                    </div>
<!--<span class="help-block">Password error</span>-->
                    <br>
                    <button class="btn btn-md btn-primary " type="submit">Entrar</button>
                </form>
            </div>
        </div>
<!--        <div class="row ">
            
            <div class="col-xs-12 col-sm-3">
                <p class="omb_forgotPwd">
                    <a href="#">Esqueci minha senha</a>
                </p>
            </div>
        </div>	    	-->
    </div>



</div>