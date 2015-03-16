<script>
    $(document).ready(function () {
        $("#salvarEndereco").on("click", function () {

            var options = {
                target: '.msgEndereco', // target element(s) to be updated with server response 
                // resetForm: true,
                beforeSubmit: function () {
                    $(".msgEndereco").removeClass('alert-success')
                }, // pre-submit callback 
                success: function () {
                    $(".msgEndereco").addClass('alert-success')
                }, // post-submit callback 

            };
            $('#cadEndereco').ajaxSubmit(options);
        });
    })
</script>
<div class="">

<?php $acao ='cadastroEndereco';
    if($endereco['CODIGO']){
        $acao="updateEndereco/{$endereco['CODIGO']}";
    }else{?>
        <h1 class="titulo_legenda" style="margin: 0 5px">Cadastre o seu endereço e ganhe 10 pontos</h1>
    <?php }
        ?>
<form id="cadEndereco" method="post" action="<?= base_url() ?>usuario/<?=$acao; ?>">

    
    <div class="col-md-3"> 
        <label for="" style="float: left">Cep</label>
        <input type="text" class="form-control"  name="CEP" value="<?= isset($endereco['CEP'])?$endereco['CEP']:""; ?>">
    </div>


    <div class="col-md-8">
        <label for="">Logradouro</label>        
        <input type="text" class="form-control "  name="ENDERECO" value="<?= isset($endereco['ENDERECO'])?$endereco['ENDERECO']:""; ?>">
    </div>


    <div class="col-md-3">
        <label for="">Número</label>
        <input type="text" class="form-control"  name="NUMERO" value="<?= isset($endereco['NUMERO'])?$endereco['NUMERO']:""; ?>">
    </div>


    <div class="col-md-2">
        <label for="">Estado</label>
        <input type="text" class="form-control"  name="ESTADO" value="<?= isset($endereco['ESTADO'])?$endereco['ESTADO']:""; ?>">
    </div>

    <div class="col-md-6">             
        <label for="">Cidade</label>
        <input type="text" class="form-control"  name="CIDADE" value="<?= isset($endereco['CIDADE'])?$endereco['CIDADE']:""; ?>">
    </div>


    <div class="col-md-6">
        <label for="">Bairro</label>
        <input type="text" class="form-control"  name="BAIRRO" value="<?= isset($endereco['BAIRRO'])?$endereco['BAIRRO']:""; ?>">
    </div>

    <div class="col-md-6 clearfix"></div>
 
    <div class="col-md-12"><br>
        <button type="button" class="btn btn-primary salvar" id="salvarEndereco">Salvar Modificações</button>
 </div>
        <p class="clearfix">
            <br>
     <div class="msgEndereco alert clearfix"></div>
     
    

    
</form>

</div>