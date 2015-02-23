<br>
<div class="container"> 
    <div class="col-lg-8 col-lg-offset-2">
        <!--<div class="well text-center">
            <div class="input-group input-group-lg">
                 <span class="input-group-addon">@</span>
                 <input type="text" class="form-control" placeholder="Username">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
            
        </div>-->
        
        <form class="form-horizontal" method="POST" action="{base_url}login/efetuarLoginAdmin">
            <fieldset class="well text-center">                

                <!-- Form Name -->
                <legend></legend>
                <!-- Mensagens de Erro-->
                {mensagem_erro}
                
               
                <!-- Text input-->
                <div class="form-group ">
                    <label class="col-md-4 control-label  visible-lg" for="usuario">Administrador</label>  
                    <div class="col-md-6 input-group">
                        <input id="usuario" name="usuario" type="text" placeholder="Digite seu login" class="form-control input-md" required="">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label  visible-lg" for="senha">Senha</label>
                    <div class="col-md-6 input-group">
                        <input id="senha" name="senha" type="password" placeholder="Senha" class="form-control input-md" required="">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                    </div>
                </div>

                <!-- Multiple Radios 
                <div class="form-group">
                    <label class="col-md-4 control-label" for="categoria">Categoria</label>
                    <div class="col-md-4">
                        {categoria}
                        <div class="radio">
                            <label for="cat_{CODIGO}">
                                <input type="radio" name="categoria" value="{TABELA}" id="cat_{CODIGO}"  >
                                {DESCRICAO} 
                            </label>
                        </div>
                     {/categoria}
                    </div>
                </div>-->

                <!-- Button (Double) -->
                <div class="form-group">
                    
                    <div class="col-md-8 col-lg-offset-2">
                        <input type="submit" id="entrar" name="entrar" class="btn btn-success" value="Entrar">
                        <a href="cadastro" class="btn btn-primary">Cadastrar empresa</a>
                        <!--<input type="button" id="cadastrar_empresa" name="cadastre_se" class="btn btn-primary" value="Cadastrar empresa">-->
                    </div>
                </div>
                <div class="form-group">
                    
                    <div class="col-md-8 col-lg-offset-2">
                        <a href="">Esqueci minha senha</a>
                        <!--<input type="button" id="lembreteSenha" name="lembreteSenha" class="btn btn-primary" value="Esqueci Minha Senha">-->
                    </div>
                </div>

            </fieldset>
        </form>

        
 <?php /*
     <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <a id="btn-login" href="#" class="btn btn-success">Login  </a>
                                      <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                  
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" placeholder="Email Address">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="firstname" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="passwd" placeholder="Password">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="icode" class="col-md-3 control-label">Invitation Code</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="icode" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                                        <span style="margin-left:8px;">or</span>  
                                    </div>
                                </div>
                                
                                <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
                                    
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-fbsignup" type="button" class="btn btn-primary"><i class="icon-facebook"></i> � Sign Up with Facebook</button>
                                    </div>                                           
                                        
                                </div>
                                
                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 
    </div>
    <!--fim--> */ ?>
    </div>
</div>

