<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCqBOGX7rdQw4OtZRZSpki-vbutol0HhNM&amp;sensor=false"></script>
<?php echo validation_errors(); ?>
<div class="col-md-8 col-xs-12">

    <form class="form-horizontal" method="POST" action="{base_url}empresa/efetuarCadastro">
        <fieldset class="col-md-12 col-xs-12">

            <legend>Adminstrador</legend>
            <div class="row ">
                <div class="form-group col-md-6 col-xs-12 ">
                    <label class="col-md-3 control-label" for="nome">Nome</label>  
                    <div class="col-md-9">
                        <input id="nome" name="nome" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('nome'); ?>" >

                    </div>
                </div>
            
                <div class="form-group col-md-6 col-xs-12 ">
                    <label class="col-md-3 control-label" for="email">Email</label>  
                    <div class="col-md-9">
                        <input id="email" name="email" type="email" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('email'); ?>">

                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="form-group col-md-6 col-xs-12 ">
                    <label class="col-md-3 control-label" for="login">Login</label>  
                    <div class="col-md-9">
                        <input id="login" name="login" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('login'); ?>">

                    </div>
                </div>
            
                <div class="form-group col-md-6 col-xs-12 ">
                    <label class="col-md-3 control-label" for="senha">Senha</label>  
                    <div class="col-md-9">
                        <input id="senha" name="senha" type="password" placeholder="" class="form-control input-md" required="">

                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="col-md-12 col-xs-12">

            <!-- Form Name -->
            <legend>Empresa</legend>


            <div class="row ">
                <div class="form-group col-md-10 col-xs-12 ">
                    <label class="col-md-3 control-label" for="nome_empresa">Nome Empresa</label>  
                    <div class="col-md-9">
                        <input id="nome_empresa" name="nome_empresa" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('nome_empresa'); ?>">

                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="form-group col-md-10 col-xs-12 ">
                    <label class="col-md-3 control-label" for="razao_social">Razão Social</label>  
                    <div class="col-md-9">
                        <input id="razao_social" name="razao_social" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('razao_social'); ?>">

                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="form-group col-md-10 col-xs-12 ">
                    <label class="col-md-3 control-label" for="descricao">Descrição</label>  
                    <div class="col-md-9">
                        <input id="descricao" name="descricao" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('descricao'); ?>">

                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="form-group col-md-10 col-xs-12 ">
                    <label class="col-md-3 control-label" for="cnpj">CNPJ</label>  
                    <div class="col-md-9">
                        <input id="cnpj" name="cnpj" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('cnpj'); ?>">

                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group  col-md-6 col-xs-12">
                    <label class="col-md-2 control-label" for="email_empresa">Email</label>   
                    <div class="col-md-10">
                        <input id="email_empresa" name="email_empresa" type="email" placeholder="nome@exemplo.com" class="form-control input-md" required="" value="<?php echo set_value('email_empresa'); ?>">
                      <!--  <span class="help-block">Digite um email valido</span>  -->
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-6">
                    <label class="col-md-3 control-label" for="telefone">Telefone</label>  
                    <div class="col-md-9">
                        <input id="telefone" name="telefone" type="text" placeholder="(21) 1234-5678" class="form-control input-md" value="<?php echo set_value('telefone'); ?>">

                    </div>
                </div>
                <!--                <div class="form-group col-md-3 col-xs-6">
                                    <label class="col-md-3 control-label" for="celular">Celular</label>  
                                    <div class="col-md-9">
                                        <input id="celular" name="celular" type="text" placeholder="(21) 91234-5678" class="form-control input-md" required="">
                
                                    </div>
                                </div>-->
            </div>



            <!-- Text input-->
            <div class="row">
                <div class="form-group col-md-6"> 
                    <label class="col-md-2 control-label" for="cep" >Cep</label>  
                    <div class="col-md-10">
                        <input id="cep" name="cep" type="text" placeholder="xx.xxx-xxx" class="form-control input-md" required="" value="<?php echo set_value('cep'); ?>">

                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="col-md-3 control-label" for="estado" >Estado</label> 
                    <div class="col-md-9">
                        <select id="estado" name="estado" class="form-control endereco" >
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="SP">São Paulo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row"> 

                <div class="form-group col-md-12 "> 
                    <label class="col-lg-2 control-label" for="endereco">Endereço</label>  
                    <div class="col-md-9">
                        <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo set_value('endereco'); ?>">

                    </div>
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-md-12 col-xs-12" >
                    <label class="col-md-2 control-label" for="bairro">Bairro</label>  
                    <div class="col-md-9 ">
                        <input id="bairro" name="bairro" type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo set_value('bairro'); ?>">

                    </div>
                </div>
            </div>
            <div class="row"> 
                <!-- Text input-->


                <div class="form-group col-md-12">
                    <label class="col-md-2 control-label" for="cidade">Cidade</label>  
                    <div class="col-md-9">
                        <input id="cidade" name="cidade"  type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo set_value('cidade'); ?>">

                    </div>
                </div>



            </div>
                <input id="latitude" name="latitude" type="text" placeholder="" class="form-control input-md"  value="<?php echo set_value('latitude'); ?>">
            <input id="longitude" name="longitude" type="hidden" placeholder="" class="form-control input-md" value="<?php echo set_value('longitude'); ?>">





            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="enviar"></label>
                <div class="col-md-4">
                    <button id="enviar" name="enviar" class="btn btn-default">Cadastrar</button>
                </div>
            </div>

        </fieldset>
    </form>

</div>
<div id="mapa" class="col-md-4 col-xs-12 hidden-xs" style="height: 700px; background: transparent;">mapa</div>