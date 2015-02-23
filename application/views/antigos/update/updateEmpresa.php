<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCqBOGX7rdQw4OtZRZSpki-vbutol0HhNM&amp;sensor=false"></script>
<form id="form" method="post" enctype="multipart/form-data" action="{base_url}admin/updateEmpresa">
    
    <div class="col-md-3 hide">
        <img src="{base_url}assets/fotos/{pasta}{foto}" class="fotoExibicao"> <br/>
        <input type="file" class="foto" name="foto" id="foto">
    </div>
    <div class="col-md-12">
        <input type="hidden" name="codigo" value=" <?=$empresa['codigo']?>    " readonly="">
        <input type="hidden" name="nomeFoto" value="{foto}" readonly="">
                 
                             
                    <div class="form-group  col-md-6">                        
                        <label class="control-label " for="nome">Nome Empresa</label>
                        <input id="nome" name="nome" type="text" placeholder="" class="form-control input-md" required="" value=" <?php echo $empresa['nome']?> ">                        
                    </div>                                        
        
                    <div class="form-group  col-md-6">                       
                        <label class="control-label" for="razao_social">Razão Social</label>                         
                            <input id="razao_social" name="razao_social" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $empresa['razao_social']; ?>">                        
                    </div>      
    
                    <div class="form-group col-md-8">                        
                        <label class="control-label" style="" for="descricao">Descrição</label>                         
                        <input id="descricao" name="descricao" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $empresa['descricao']; ?>">                        
                    </div>                   
        
                    <div class="form-group col-md-4">                      
                        <label class="control-label" style="" for="cnpj">CNPJ</label>                          
                        <input id="cnpj" name="cnpj" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $empresa['cnpj']; ?>">                        
                    </div>                    
        
                    <div class="form-group col-md-4">                        
                        <label class="control-label"  for="segmento">Segmento</label>                         
                                                 
                            <select name= "segmento" class="form-control input-md" required="">                                
                                <option value="1"> Clinica Médica / Hospital </option>                                
                                <option value="2"> Farmacias </option>                                
                                <option value="3"> Clinica médica com farmacia </option>                           
                            </select>                        
                                  
                    </div>                   
                    <div class="form-group  col-md-4 "> 
                        <label class="control-label" style="" for="email_empresa">Email</label>                          
                        <input id="email_empresa" name="email_empresa" type="email" placeholder="nome@exemplo.com" class="form-control input-md" required="" value="<?php echo $empresa['email']; ?>">                        
                    </div>                   
        
                    <div class="form-group col-md-4 ">                        
                        <label class="control-label" for="telefone">Telefone</label>                          
                        <input id="telefone" name="telefone" type="text" placeholder="(21) 1234-5678" class="form-control input-md" value="<?php echo $empresa['telefone']; ?>">                        
                    </div> 
                    
                    <div class="form-group col-md-4 ">                        
                        <label class="control-label" style="" for="cep" >Cep</label>                          
                        <input id="cep" name="cep" type="text" placeholder="xx.xxx-xxx" class="form-control input-md" required="" value="<?php echo $empresa['cep']; ?>">                        
                    </div>   
                    
                     <div class="form-group col-md-5" style="">                        
                        <label class="control-label" style="" for="endereco">Endereço</label>                          
                        <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo $empresa['endereco']; ?>">                        
                    </div>
        
                    <div class="form-group col-md-3">                        
                        <label class="control-label " for="numero">N&#186;.</label>                          
                        <input id="numero" name="numero" type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo $empresa['numero']; ?>">                        
                    </div>         
        
                    <div class="form-group col-md-4 " >                       
                        <label class="control-label " for="bairro">Bairro</label>                         
                        <input id="bairro" name="bairro" type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo $empresa['bairro']; ?>">                       
                    </div> 
                    
                    
                                      
                    <div class="form-group col-md-5" style="">                         
                        <label class="control-label" style="" for="cidade">Cidade</label>                          
                        <input id="cidade" name="cidade"  type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo $empresa['cidade']; ?>" >                       
                    </div>
                    <div class="form-group col-md-3 ">                       
                        <label class="control-label" for="estado" >Estado</label>                         
                        <input id="estado" name="estado"  type="text" placeholder="" class="form-control input-md endereco" required="" value="<?php echo $empresa['estado']; ?>">                        
                    </div> 
                  
                    <input id="latitude" name="latitude" type="hidden" placeholder="" class="form-control input-md" readonly="" value="<?php echo $empresa['latitude']; ?>">                    
                    <input id="longitude" name="longitude" type="hidden" placeholder="" class="form-control input-md" readonly=""value="<?php echo $empresa['longitude']; ?>">                    
                    <!-- Button -->     
                    
                                 
                                      
                                 
                    
              
        <div class="clearfix"></div>
        <div class="form-group col-md-6">

            <input id="submit" name="submit" type="submit" placeholder="cep" class="btn btn-success">                            
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="presubmit"></div>
            
        </div>
        

    </div>
</form>
<div class="container">    <div id="mapa" class="col-md-12 " style="height: 300px;  background: transparent; display: none">mapa</div>    <hr></div><script>    changeClassBody('marginTop125');</script>