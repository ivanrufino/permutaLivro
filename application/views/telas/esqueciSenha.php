<div class="">
    <form id="formEsqueciSenha" class="form-horizontal" method="POST" action="{base_url}login/recuperaSenha">
        <fieldset class="well text-center">                
            <!-- Mensagens de Erro-->
            <?= $this->session->flashdata('mensagem'); ?>
            <!-- Text input-->
            <div class="form-group ">
                <label class="col-md-4 control-label visible-lg" for="usuario">Usuário</label>  
                <div class="col-md-6 input-group">
                    <input id="usuario" name="usuario" type="text" placeholder="Digite seu nome de Usuário" class="form-control input-md" value="" required="">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                </div>
            </div>
            <div class="form-group ">
                <label class="col-md-4 control-label visible-lg" for="email">Email</label>  
                <div class="col-md-6 input-group">
                    <input id="email" name="email" type="email" placeholder="Digite seu email" class="form-control input-md" value="" required="">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                </div>
            </div>
        </fieldset>
        <div id="msgEsqueciSenha"></div>
    </form>
</div>

