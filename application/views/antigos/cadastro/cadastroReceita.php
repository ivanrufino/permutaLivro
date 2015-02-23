<link href="{local}css/select2.css" rel="stylesheet"/>
<script src="{local}js/select2.min.js"></script>
<script>
$(document).ready(function(){
 $("#buscaPaciente").modal('show');
 $("#txt-medicamento").change(function(){
     var url="{base_url}receita/buscaFormaFarma/"+$(this).val();
     //alert(url);
     $("#txt-medicamentoForma").load(url);
     //alert($(this).val())
 })
 $("#txt-medicamento").select2({
    placeholder: "Selecione um medicamento"
});
});
</script>

<style>
 
</style>
<div class="container">
    <!--<div class="col-md-1 hidden-xs">lateral esquerda</div>-->
    <div class="col-md-8">
        <div class="receita" >
            Receita gerada em: <?= date("d/ m/ Y H:i")?>
            <div class="rec_logo col-md-2  col-xs-12 text-center"><img src=""></div>
             <form id="formReceita" action="{base_url}receita/cadastro" method="post">
            <div class="rec_head col-md-10 col-xs-12 text-center">
                <h1>{empresa}{NOME}</h1>
                    <input type="hidden" id="codEmpresa" name="codEmpresa" value="{CODIGO}" readonly="">
                    {/empresa}
                <h2><b>Dr(a).</b> {nome} </h2>
                <input type="hidden" id="codMedico" name="codMedico" value="{codigo}" readonly="">
                <input type="hidden" id="codPaciente" name="codPaciente" value="" readonly="">
                <input type="hidden" id="codHash" name="codHash" value="<?= date("Ym")?>" readonly="">
                
                <h3><b>Paciente: </b><label id="labelPaciente"></label></h3>
            </div>
            <div class="clearfix"></div>
            <hr>
            <label for="permissao"><input type="checkbox"  name="permissao" id="permissao" checked="" >&nbsp;Permitir visualização ao farmaceutico</label>
            
                
                <div id="listaReceita"></div>
           </form>
           <!-- <div class="medicamentos col-md-11 col-xs-10"><label class="close">Excluir</label>
                <label class="medicamento col-md-10 col-xs-12"><i class="glyphicon glyphicon-ok-circle"></i> Xarope AcetilCisteina</label>
                <label class="prescricao col-md-10 col-xs-12">Tomar de 8 em 8 horas, durante um mês</label>
                <div class="clearfix"></div>
            </div>
            <div class="medicamentos col-md-11 col-xs-10"><label class="close">Excluir</label>
                <label class="medicamento col-md-10 col-xs-12"><i class="glyphicon glyphicon-ok-circle"></i> Xarope AcetilCisteina</label>
                <label class="prescricao col-md-10 col-xs-12">Tomar de 8 em 8 horas, durante um mês</label>
                <div class="clearfix"></div>
            </div>-->
           <div class='clearfix '></div>
           <div class="text-center botao"></div>
            <div class="col-md-11 rec_footer text-center">
                
                  <p class="ident"><b>Dr(a).</b> {nome} (carimbo)</p>
            </div>
           <div class='clearfix'id="base"></div>
        </div>
        
    </div>
    <div id="menu" class="col-md-4">
        <div class="menuReceita col-md-3">
            <label for="txt-medicamento">Medicamento:</label>
            <select id="txt-medicamento"class="form-control">
                <option value="0">Selecione o medicamento na lista</option>
                {medicamentos}
                <option value="{CODIGO}">{MEDICAMENTO}</option>
                {/medicamentos}
            </select>
            <br>
            <label for="txt-medicamentoForma">Forma Farmaceutica:</label>
             <select id="txt-medicamentoForma" class="form-control">
                
                <option value="0">Selecione um medicamento</option>
               
            </select>
            <br>
            <label for="txt-prescricao">Prescrição:</label>
            <textarea id="txt-prescricao" class="form-control"></textarea>
            <br>
            <label for="txt-prescricao2">Posologia:</label>
		<textarea id="txt-prescricao2" class="form-control" placeholder="Digite a posologia"></textarea>
            <!--<select id="txt-prescricao2"class="form-control">
                <option value="0">Selecione</option>
                <option value="1">Tomar de 2 em 2 horas</option>
                <option value="1">Tomar de 3 em 3 horas</option>
                <option value="1">Tomar de 4 em 4 horas</option>
                <option value="1">Tomar de 8 em 8 horas</option>
                
            </select>-->
            
            
            <br>
            <button class="btn btn-lg btn-default" id="inserirMedicamento"><i class="glyphicon glyphicon-save"></i> Inserir</button>
            
        </div>
        <div class="clearfix"></div>
        
    </div>
         
</div>

<div class="modal fade" id="buscaPaciente" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Busca de Paciente por CPF</h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-success"><span class="glyphicon glyphicon-warning-sign"></span> Digite o CPF abaixo</div>
                <label for="buscacpf">CPF:<input type="text" class="form-control" id="buscacpf" name="cpf"></label>
                <div id="resultadoPesquisa"></div>
                
            </div>
            <div class="modal-footer ">
                <button type="button" id="buscar" class="btn btn-warning" ><span class="glyphicon glyphicon-ok-sign"></span> Buscar</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Sair</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>
