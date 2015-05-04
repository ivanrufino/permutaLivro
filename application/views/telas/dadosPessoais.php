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
            $('#cadDados').ajaxSubmit(options);
        });
    })
</script>
<div class="">


<form id="cadDados" method="post" action="<?= base_url() ?>usuario/cadastroDadosPessoais" enctype="multipart/form-data">
    <div class="col-xs-4"> 
        <img src="<?= base_url(); ?>assets/imagens/foto/<?=$info['FOTO']?>" class="img-responsive" style="min-width: 100px">        
        <input type="file" id="foto" class="form-control"  name="foto">
    </div>

    
    <div class="col-xs-8"> 
        <label for="" style="float: left">Nome</label>
        <input type="text" class="form-control "  name="NOME" value="<?= isset($info['NOME'])?$info['NOME']:""; ?>">
    </div>
<!--

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
-->
    <div class="col-md-6 clearfix"></div>
 
    <div class="col-md-12"><br>
        <button type="button" class="btn btn-primary salvar" id="salvarEndereco">Salvar Modificações</button>
 </div>
        <p class="clearfix">
            <br>
     <div class="msgEndereco alert clearfix"></div>
     
    

    
</form>

</div>