<script>
    $(document).ready(function(){
    $("#salvar").on("click", function() {
        
        var options = {
            target: '.msg', // target element(s) to be updated with server response 
           // resetForm: true,
             beforeSubmit:  function(){$(".msg").removeClass('alert-success')},  // pre-submit callback 
            success: function(){$(".msg").addClass('alert-success')}, // post-submit callback 

        };
        $('#formPermissao').ajaxSubmit(options);
    });

    });
</script>
    
<?php $checked=$status==1? "checked=''":"";
      $permissao=$status==1? "Permitido":"Não Permitido";
      
      $unico=$status_medico==1? "checked=''":"";
      $todos=$status_medico==0? "checked=''":"";
        ?>
<form id="formPermissao" action="<?=  base_url()?>receita/AlterarPermissao" method="POST">
    <label for="">Permitir visualização para farmaceutico</label><br>
    <input type="hidden" name="cod_hash" id=""  value="<?=$cod_hash ?>" readonly="">
    <input type="checkbox" name="status" id="permiteFarma" <?=$checked?> value="1"><label for="permiteFarma" class="text"><?=$permissao?></label><br>
    <hr>
    <label>Permitir visualização para Médicos</label><br>
    <input type="radio" name="status_medico" id="permiteMedicoProprio" <?=$todos?> value="0"><label for="permiteMedicoProprio">Apenas para quem receitou</label><br>
    <input type="radio" name="status_medico" id="permiteMedicoTodos" <?=$unico?> value="1"><label for="permiteMedicoTodos">Para todos os Médicos</label>
    
    <br><br>
<!--    <input class="btn btn-success" type="button" name="salvar" id="salvar" value="Salvar">-->
    <div class="msg alert"></div>
</form>

