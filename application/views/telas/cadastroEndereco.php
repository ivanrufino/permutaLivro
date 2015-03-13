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
<h1 class="titulo_legenda" style="margin: 0 5px">Cadastre o seu endereço e ganhe 10 pontos</h1>

<form id="cadEndereco" method="post" action="<?= base_url() ?>usuario/cadastroEndereco">


    <div class="col-md-3"> 
        <label for="">Cep</label>
        <input type="text" class="form-control"  name="CEP" value="<?= isset($endereco['CEP'])?$endereco['CEP']:""; ?>">
    </div>


    <div class="col-md-8">
        <label for="">Logradouro</label>
        <input type="text" class="form-control "  name="ENDERECO">
    </div>


    <div class="col-md-3">
        <label for="">Número</label>
        <input type="text" class="form-control"  name="NUMERO">
    </div>


    <div class="col-md-2">
        <label for="">Estado</label>
        <input type="text" class="form-control"  name="ESTADO">
    </div>

    <div class="col-md-6">             
        <label for="">Cidade</label>
        <input type="text" class="form-control"  name="CIDADE">
    </div>


    <div class="col-md-6">
        <label for="">Bairro</label>
        <input type="text" class="form-control"  name="BAIRRO">
    </div>

     <div class="col-md-6">
         &nbsp;
        </div>
 
        <button type="button" class="btn btn-primary salvar" id="salvarEndereco">Salvar Modificações</button>
        <p class="clearfix">
            <br>
     <div class="msgEndereco alert clearfix">asd</div>
     
    

    
</form>

</div>