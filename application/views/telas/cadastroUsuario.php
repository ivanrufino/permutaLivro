<!--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCqBOGX7rdQw4OtZRZSpki-vbutol0HhNM&amp;sensor=false"></script>-->
<?php if (validation_errors() != false) { ?>    
<div class="container">        
    <div class="alert alert-danger">            
        <?php echo validation_errors(); ?>        
    </div>    
</div>
    <?php } ?>
<div class="col-md-12 col-xs-12">    
    <input type="hidden" class="base_url" value="{base_url}">   
    <form class="form-horizontal" method="POST" action="{base_url}usuario/efetuarCadastro">        
        <div class="container-alternate">            
            <div class="container ">                
                <fieldset class="col-md-12 col-xs-12">                    
                    <br>                    
                    <legend>Usuário</legend>                    
                    <div class="row ">                        
                        <div class="form-group col-md-6 col-xs-12 ">                            
                            <label class="col-md-3 control-label" for="nome">Nome</label>                              
                            <div class="col-md-9">                                
                                <input id="nome" name="nome" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('nome'); ?>" >                            
                            </div>                        
                        </div>
                          </div>  
                        <div class="row ">  
                        <div class="form-group col-md-6 col-xs-12 ">                            
                            <label class="col-md-3 control-label" for="email">Email</label>                              
                            <div class="col-md-9">                                
                                <input id="email" name="email" type="email" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('email'); ?>">                            
                            </div>                        
                        </div>                   
                    </div>  
                          
                    <div class="row ">                        
<!--                        <div class="form-group col-md-6 col-xs-12 ">                            
                            <label class="col-md-3 control-label" for="login">Login</label>                             
                            <div class="col-md-7">                               
                                <input id="login" name="login" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('login'); ?>">                                
                                <span class="alert-danger">* Mínimo de 6 caracteres</span>                           
                            </div>                        
                        </div>                        -->
                        <div class="form-group col-md-6 col-xs-12 ">                            
                            <label class="col-md-3 control-label" for="senha">Senha</label>                              
                            <div class="col-md-9">                                
                                <input id="senha" name="senha" type="password" placeholder="" class="form-control input-md" required="">                                
                                <span class="alert-danger">* Mínimo de 6 caracteres</span>                            
                            </div>                       
                        </div>                   
                    </div>   
                     <div class="cleafix col-md-12 text-center" >   
                                           
                            <button id="enviar" name="enviar" class="btn btn-success">Cadastrar</button>   
                      </div>
                </fieldset>           
            </div>        
        </div>        
        <br>        
<!--        <div class="container-alternate hide">            
            <div class="container alert alert-info">                
                <fieldset class="col-md-12 col-xs-12 ">                    
                    <br>                    
                    <legend>Empresa</legend>                                        
                    <div class="form-group  col-md-6  col-sm-6  col-xs-8 ">                        
                        <label class="col-md-4 control-label " for="nome_empresa">Nome Empresa</label>                          
                        <div class="col-md-8">                            
                            <input id="nome_empresa" name="nome_empresa" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('nome_empresa'); ?>">                        
                        </div>                    
                    </div>                                        
                    <div class="form-group  col-md-6 col-sm-6  col-xs-8 ">                       
                        <label class="col-md-3  control-label labelRazao" for="razao_social">Razão Social</label>                          
                        <div class="col-md-9 ">                            
                            <input id="razao_social" name="razao_social" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('razao_social'); ?>">                        
                        </div>                   
                    </div>                   
                    <div class="form-group  col-md-12 col-sm-12 col-xs-8">                        
                        <label class="col-md-2  control-label labelDescricao" style="" for="descricao">Descrição</label>                         
                        <div class="col-md-10 divDescricao"  style="">                            
                            <input id="descricao" name="descricao" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('descricao'); ?>">                        
                        </div>                   
                    </div>                   
                    <div class="form-group col-md-5 col-sm-6  col-xs-8">                      
                        <label class="col-md-5 control-label labelCnpjEmail" style="" for="cnpj">CNPJ</label>                          
                        <div class="col-md-7">                           
                            <input id="cnpj" name="cnpj" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo set_value('cnpj'); ?>">                        
                        </div>                   
                    </div>                    
                    <div class="form-group col-md-5 col-sm-6  col-xs-8">                        
                        <label class="col-md-4 control-label "  for="segmento">Segmento</label>                         
                        <div class="col-md-8">                            
                            <select name= "segmento" class="form-control input-md" required="">                                
                                <option value="1"> Clinica Médica / Hospital </option>    
                                <option value="3"> Clinica médica com farmacia </option>  
                                <option value="2"> Farmacias </option>                                
                                                         
                            </select>                        
                        </div>                   
                    </div>                   
                    <div class="form-group  col-md-5  col-sm-6  col-xs-8">                       
                        <label class="col-md-5 control-label labelCnpjEmail" style="" for="email_empresa">Email</label>                          
                        <div class="col-md-7">                           
                            <input id="email_empresa" name="email_empresa" type="email" placeholder="nome@exemplo.com" class="form-control input-md" required="" value="<?php echo set_value('email_empresa'); ?>">                        
                        </div>                    
                    </div>                   
                    <div class="form-group col-md-5  col-sm-6  col-xs-8">                        
                        <label class="col-md-4 control-label " for="telefone">Telefone</label>                          
                        <div class="col-md-8">                            
                            <input id="telefone" name="telefone" type="text" placeholder="(21) 1234-5678" class="form-control input-md" value="<?php echo set_value('telefone'); ?>">                        
                        </div>                   
                    </div> 
                    
                    <div class="form-group col-md-4  col-sm-6  col-xs-8">                        
                        <label class="col-md-6 control-label labelCep" style="" for="cep" >Cep</label>                          
                        <div class="col-md-6 divCep" style="">                            
                            <input id="cep" name="cep" type="text" placeholder="xx.xxx-xxx" class="form-control input-md" required="" value="<?php echo set_value('cep'); ?>">                        
                        </div>                    
                    </div>   
                    
                     <div class="form-group col-md-5  col-sm-6  col-xs-8 divEnderecoPai" style="">                        
                        <label class=" col-md-2 control-labellabelEndereco " style="" for="endereco">Endereço</label>                          
                        <div class="col-md-10" >                            
                            <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo set_value('endereco'); ?>">                        
                        </div>                   
                    </div>
                    <div class="form-group col-md-3  col-sm-6  col-xs-8 ">                        
                        <label class=" col-md-3 control-label " for="numero">N&#186;</label>                          
                        <div class="col-md-9">                            
                            <input id="numero" name="numero" type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo set_value('numero'); ?>">                        
                        </div>                   
                    </div>         
                    <div class="form-group col-md-4  col-sm-6  col-xs-8" >                       
                        <label class="col-md-6 control-label " for="bairro">Bairro</label>                         
                        <div class="col-md-6">                           
                            <input id="bairro" name="bairro" type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo set_value('bairro'); ?>">                       
                        </div>                    
                    </div> 
                    
                    
                                      
                    <div class="form-group col-md-5  col-sm-6  col-xs-8 divCidadePai" style="">                         
                        <label class="col-md-2 control-label labelCidade" style="" for="cidade">Cidade</label>                          
                        <div class="col-md-9">                           
                            <input id="cidade" name="cidade"  type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo set_value('cidade'); ?>" >                       
                        </div>                   
                    </div>
                    <div class="form-group col-md-3  col-sm-6  col-xs-8">                       
                        <label class="col-md-3 control-label " for="estado" >Estado</label>                         
                        <div class="col-md-9">                            
                            <input id="estado" name="estado"  type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo set_value('estado'); ?>">                        
                        </div>                   
                    </div> 
                  
                    <input id="latitude" name="latitude" type="hidden" placeholder="" class="form-control input-md" readonly="" value="<?php echo set_value('latitude'); ?>">                    
                    <input id="longitude" name="longitude" type="hidden" placeholder="" class="form-control input-md" readonly=""value="<?php echo set_value('longitude'); ?>">                    
                     Button      
                    
                                      
                                      
                                 
                    
                </fieldset>    
                    <div class="cleafix col-md-12 text-center" >    
                                           
                            <button id="enviar" name="enviar" class="btn btn-success">Cadastrar</button>   
                      </div>
                    
            </div>        
        </div>   -->
    </form>
</div>
<div class="container">    <div id="mapa" class="col-md-12 " style="height: 300px;  background: transparent; display: none">mapa</div>    <hr></div><script>    changeClassBody('marginTop125');</script>