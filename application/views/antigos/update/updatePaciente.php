<form id="form" method="post" enctype="multipart/form-data" action="{base_url}{ref}update">

    <div class="col-md-3">
        <img src="{base_url}assets/fotos/{ref}{foto}" class="fotoExibicao"> <br/>
        <input type="file" class="foto" name="foto" id="foto">
    </div>
    <div class="col-md-9">
        <input type="hidden" name="codigo" value="{codigo}" readonly="">
        <input type="hidden" name="nomeFoto" value="{foto}" readonly="">

        <div class="form-group col-md-6">
            <label for="login">Login:</label>                    
            <input id="login" name="login" type="text" placeholder="Login" class="form-control input-md disabled" required="" readonly="" value="{login}">                            
        </div>
        <div class="form-group col-md-6">
            <label for="cpf">CPF:</label>                    
            <input id="cpf" name="cpf" type="text" placeholder="cpf" class="form-control input-md disabled" required=""readonly="" value="{cpf}">                            
        </div>

        <div class="form-group col-md-6">
            <label for="nome">Nome:</label>                    
            <input id="nome" name="nome" type="text" placeholder="Nome" class="form-control input-md " required="" value="{nome}">                            
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email:</label>                    
            <input id="email" name="email" type="email" placeholder="email" class="form-control input-md " required="" value="{email}">                            
        </div>

        <div class="form-group col-md-4">
            <label for="telefone">Telefone:</label>                    
            <input id="telefone" name="telefone" type="text" placeholder="telefone" class="form-control input-md " required="" value="{telefone}">                            
        </div>
        <div class="form-group col-md-4">
            <label for="celular">Celular:</label>                    
            <input id="celular" name="celular" type="tel" placeholder="celular" class="form-control input-md " required="" value="{celular}">                            
        </div>
        <div class="form-group col-md-4">
            <label for="data_nascimento">Data de Nascimento:</label>                    
            <input id="data_nascimento" name="data_nascimento" type="date" placeholder="" class="form-control input-md " required="" value="{data_nascimento}">                            
        </div>
        <hr class="col-md-12" style="border-bottom:  1px dashed; border-top: 1px solid #cecece">



        <div class="form-group col-md-3"> 
            <label for="cep">Cep</label>  
            <input id="cep" name="cep" type="text" placeholder="xx.xxx-xxx" value="{cep}"  class="form-control input-md" required="">
        </div>

        <div class="form-group col-md-6 "> 
            <label  for="endereco">Endereço</label>                    
            <input id="endereco" name="endereco" type="text" placeholder="" value="{endereco}"  class="form-control input-md endereco" required="">
        </div>

        <div class="form-group col-md-3 " >
            <label  for="numero" >Número</label>  
            <input id="numero" name="numero" type="number" placeholder="" value="{numero}" class="form-control input-md endereco" required="">
        </div>


        <div class="form-group col-md-4 " >
            <label  for="bairro" >Bairro</label>  
            <input id="bairro" name="bairro" type="text" placeholder="" value="{bairro}" class="form-control input-md endereco" required="">
        </div>

        <div class="form-group col-md-5">
            <label  for="cidade">Cidade</label>  
            <input id="cidade" name="cidade"  type="text" placeholder="" class="form-control input-md endereco" required="" value="{cidade}" >                       
        </div>
        
        <div class="form-group col-md-3">
            <label  for="estado" >Estado</label> 
            <input id="estado" name="estado"  type="text" placeholder="" class="form-control input-md endereco" required="" value="{estado}">                        
        </div>



        <div class="form-group col-md-6">

            <input id="submit" name="submit" type="submit" placeholder="cep" class="btn btn-success">                            
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="presubmit"></div>

        </div>


    </div>
</form>