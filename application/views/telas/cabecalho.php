

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
                    
                    
                   
                   
                </ul>
            </div>
            <div class="col-md-4">
         <?php        if (! $this->session->userdata('logged_in')) {?>
                  <a href="" class="btn btn-info" data-toggle="modal" data-target="#login_modal">Acessar</a> 
            <?php }else{ ?>
                <a href="{base_url}login/efetuarLogout" class="btn btn-danger" >Sair</a>
            <?php }
        ?>
                
                <?php /*if (isset($login_face)){ ?>
        <form class="form-signin" role="form">
            <?php if (@$user_profile):  // call var_dump($user_profile) to view all data ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <!--
                     <img class="img-thumbnail" data-src="holder.js/140x140" alt="140x140" src="https://graph.facebook.com/<?=$user_profile['id']?>/picture?type=large" style="width: 140px; height: 140px;">
                           <h2><?=$user_profile['name']?></h2>
                        <a href="<?=$user_profile['link']?>" class="btn btn-lg btn-default btn-block" role="button">View Profile</a>-->
                        <!--<a href="<?= $logout_url ?>" class="btn btn-lg btn-primary btn-block" role="button">Logout</a>-->
                        <a href="<?= $logout_url ?>" class="btn btn-block btn-social btn-md btn-facebook" role="button"><i class="fa fa-facebook"></i> Sair</a>
                    </div>
                </div>
            <?php else: ?>
            
                <!--<h2 class="form-signin-heading">Acessar com Facebook</h2>-->
                <br>
                <a href="<?= $login_url ?>" class="btn btn-block btn-social btn-md btn-facebook" role="button"><i class="fa fa-facebook"></i> Acessar com Facebook</a>
                
            <?php endif; ?>
            <!--<a href="https://github.com/puneetkay/Facebook-PHP-CodeIgniter" class="btn btn-lg btn-success btn-block" target="_blank" role="button">View Source on Github</a>-->

            <div class="footer hidden">
                <p>With <i class="fa fa-heart"></i> by <a href='http://puneetk.com/' target="_blank" title="Puneet Kalra">Puneet Kalra</a>.</p>
            </div>
        </form>
                <?php }*/?>
        </div>
        </div>
    </div>
</nav>
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
