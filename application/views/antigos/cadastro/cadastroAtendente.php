<div class="container">
<div class="panel panel-primary">
    <div class="panel-heading"> <h3 class="panel-title">Cadastro de Atendente</h3></div>
    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{base_url}atendente/cadastro">
            <?php if ($this->session->flashdata('errors')) { ?>
                <div class='alert alert-danger alert-dismissable'>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Por favor, corriga os erros encontrados.</strong><hr>
    <?php
    echo $this->session->flashdata('errors');
    echo "</div>";
}
?>
                <!--<fieldset class="col-md-12 col-xs-12">-->

                    <!-- Form Name -->
                    <!--<legend></legend>-->

                    <!-- Text input-->
                    <div class="row">
                        <div class="form-group col-md-5 col-xs-12 ">
                            <label class="col-md-2 control-label" for="nome">Nome</label>  
                            <div class="col-md-10">
                                <input id="nome" name="nome" type="text" placeholder="" value="<?php echo $this->session->flashdata('nome'); ?>" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group col-md-4 col-xs-8 ">
                            <label class="col-md-2 control-label" for="login">Login</label>  
                            <div class="col-md-10">
                                <input id="login" name="login" type="text" placeholder="" value="<?php echo $this->session->flashdata('login'); ?>" class="form-control input-md" required="">

                            </div>
                        </div>


                        <div class="form-group  col-md-3 col-xs-4 "> 

                            <label class="col-md-3 control-label" for="senha">Senha</label>  
                            <div class="col-md-9">
                                <input id="senha" name="senha" type="password" placeholder="" class="form-control input-md" required="">

                            </div>
                        </div>

                    </div>
                    <!-- Text input-->
                    <div class="row">
                        <div class="form-group  col-md-5 col-xs-12">
                            <label class="col-md-2 control-label" for="email">Email</label>   
                            <div class="col-md-10">
                                <input id="email" name="email" type="email" placeholder="nome@exemplo.com" value="<?php echo $this->session->flashdata('email'); ?>" class="form-control input-md" required="">
                              <!--  <span class="help-block">Digite um email valido</span>  -->
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-xs-6">
                            <label class="col-md-3 control-label" for="telefone">Telefone</label>  
                            <div class="col-md-9">
                                <input id="telefone" name="telefone" type="text" placeholder="(21) 1234-5678" value="<?php echo $this->session->flashdata('telefone'); ?>" class="form-control input-md">

                            </div>
                        </div>
                        <div class="form-group col-md-3 col-xs-6">
                            <label class="col-md-3 control-label" for="celular">Celular</label>  
                            <div class="col-md-9">
                                <input id="celular" name="celular" type="text" placeholder="(21) 91234-5678" value="<?php echo $this->session->flashdata('celular'); ?>" class="form-control input-md" required="">

                            </div>
                        </div>
                    </div>
</div>


            <!-- Multiple Checkboxes (inline) -->


            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="enviar"></label>
                <div class="col-md-4">
                    <button id="enviar" name="enviar" class="btn btn-default">Cadastrar</button>
                    <a href='' class='voltarPagina btn btn-default  pull-right'><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
                </div>
            </div>
            <br>
            <!--</fieldset>-->
        </form>
    </div>
</div>
</div>