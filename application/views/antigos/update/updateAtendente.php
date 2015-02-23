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
            <label for="nome">Nome:</label>                    
            <input id="nome" name="nome" type="text" placeholder="Nome" class="form-control input-md disabled" required="" value="{nome}">                            
        </div>
        <div class="form-group col-md-6">
            <label for="telefone">Telefone:</label>                    
            <input id="telefone" name="telefone" type="text" placeholder="telefone" class="form-control input-md disabled" required="" value="{telefone}">                            
        </div>
        <div class="form-group col-md-6">
            <label for="celular">Celular:</label>                    
            <input id="celular" name="celular" type="tel" placeholder="celular" class="form-control input-md disabled" required="" value="{celular}">                            
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email:</label>                    
            <input id="email" name="email" type="email" placeholder="" class="form-control input-md disabled" required="" value="{email}">                            
        </div>
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