<br>
<div class="container">
    <div class="col-lg-8 col-lg-offset-2">
        <form class="form-horizontal" method="POST" action="{base_url}login/confirmaAlteracao">
            <fieldset class="well text-center">  
                <!-- Form Name -->
                <legend></legend>
                <!-- Mensagens de Erro-->                
                <input type="hidden" name="id" value="{id}" readonly="">
                <?= $this->session->flashdata('mensagem'); ?>
                <!-- Text input-->
                <div class="form-group ">
                    <label class="col-md-4 control-label visible-lg" for="senha">Senha</label>  
                    <div class="col-md-6 input-group">
                        <input id="senha" name="senha" type="password" placeholder="Digite sua nova senha" class="form-control input-md" required="">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label visible-lg" for="repitasenha">Repita Senha</label>
                    <div class="col-md-6 input-group">
                        <input id="Repita_Senha" name="Repita_Senha" type="password" placeholder="**********" class="form-control input-md" required="">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">

                    <div class="col-md-8 col-lg-offset-2">
                        <input type="submit" id="entrar" name="entrar" class="btn btn-success" value="Confirmar alteração">
                        
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>

