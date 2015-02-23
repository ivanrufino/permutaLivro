<form id="form" method="post" enctype="multipart/form-data" action="{base_url}{ref}updateSenha">


    <div class="col-md-9">
        <input type="hidden" name="codigo" value="{codigo}" readonly="">
        <input type="hidden" name="codigo_pessoa" value="{codigo_pessoa}" readonly="">
        <div class="row">
            <div class="form-group col-md-4 ">
                <label for="senha_atual">Senha Atual:</label>                    
                <input id="senha_atual" name="senha_atual" type="password" placeholder="" class="form-control input-md disabled" required=""  value="">                            
            </div>
<!--             <div class="form-group col-md-8">
                <?php echo form_error('senha_atual', '<div class="alert alert-danger">', '</div>'); ?>
               
            </div>-->
            
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="senha">Senha Nova:</label>                    
                <input id="senha" name="senha" type="password" placeholder="" class="form-control input-md disabled" required="" >                            
            </div>
            <div class="form-group col-md-4">
                <label for="confirma_senha">Repita a Senha:</label>                    
                <input id="confirma_senha" name="confirma_senha" type="password" placeholder="" class="form-control input-md disabled" required="" >                            
            </div>
<!--            <div class="form-group col-md-8">
                <?php echo form_error('senha', '<div class="alert alert-danger">', '</div>'); ?>
               
            </div>-->
        </div>
<!--        <div class="row">
            <div class="form-group col-md-4">
                <label for="confirma_senha">Repita a Senha:</label>                    
                <input id="confirma_senha" name="confirma_senha" type="password" placeholder="" class="form-control input-md disabled" required="" >                            
            </div>
            
        </div>-->

        <div class="clearfix"></div>
        <div class="form-group col-md-6">
            <input id="submit" name="submit" type="submit" placeholder="cep" class="btn btn-success" value="Alterar Senha">                            
        </div>
        <div class="clearfix"></div>
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        
        <div class="col-md-12">
            <div class="presubmit"></div>

        </div>


    </div>
</form>