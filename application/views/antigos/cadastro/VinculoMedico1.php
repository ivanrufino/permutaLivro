<script>
$("#vincularMedico").click(function(){
    $(this).vincularMedico();
})
</script>
<form id="formVinculo" class="form-horizontal" method="POST" action="<?=  base_url()?>medico/cadastro">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title custom_align" id="Heading"><?= $medico['NOME'] ?></h4>
    </div>
    <div class="modal-body">
        <?php //print_r($medico) ?>
        <div class="form-group">
            <label class="col-md-3 control-label" for="crm">CRM</label>  
            <div class="col-md-9">
                <input id="crm" name="crm" type="text" value="<?=$medico['CRM']?>" class="form-control input-md" readonly="">
                <input id="codigo" name="codigo" type="hidden" value="<?=$medico['CODIGO']?>" class="form-control input-md" readonly="">
            </div>
        </div>
        <br>
        <div class="clearfix"></div>
       <div class="form-group">
                    <label class="col-md-3 control-label" for="estado" >Especialidade</label> 
                    <div class="col-md-9">
                        <select  id="especialidade" name="especialidade[]" class="form-control" multiple="" >
                            <?php foreach ($especialidades as $especialidade) {?>
                                <option  value=<?=$especialidade['CODIGO'] ?>><?=$especialidade['ESPECIALIDADE'] ?></option>
                            <?php }?>
                            
                            

                        </select>
                    </div>
                </div>
        <div id="msgAgenda" class=" alert alert-success">Favor checar agenda do médico ao incluir os horários!. </div>
        <div class="agenda">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#domingo" data-toggle="tab">Dom</a></li>
                <li><a href="#segunda" data-toggle="tab">Seg</a></li>
                <li><a href="#terca" data-toggle="tab">Ter</a></li>
                <li><a href="#quarta" data-toggle="tab">Qua</a></li>
                <li><a href="#quinta" data-toggle="tab">Qui</a></li>
                <li><a href="#sexta" data-toggle="tab">Sex</a></li>
                <li><a href="#sabado" data-toggle="tab">Sab</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content"> 
                <!--DOMINGO -->
                <div class="tab-pane active alert alert-warning form-group" id="domingo">
                    <label for="de_dom" class="col-sm-2 control-label"><strong> de </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="de_dom" id="de_dom" min="0" max="23"  class="form-control ">
                    </div>
                    <br class="clearfix">
                    <label for="ate_dom" class="col-sm-2 control-label"><strong> até </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="ate_dom" id="ate_dom" min="0" max="23"  class="form-control ">
                    </div>
                </div>
                
                <!-- SEGUNDA -->
                <div class="tab-pane alert alert-warning form-group" id="segunda">
                    <label for="de_seg" class="col-sm-2 control-label"><strong> de </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="de_seg" id="de_dom" min="0" max="23"  class="form-control ">
                    </div>
                    <br class="clearfix">
                    <label for="ate_seg" class="col-sm-2 control-label"><strong> até </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="ate_seg" id="ate_dom" min="0" max="23"  class="form-control ">
                    </div>
                </div>
                
                <!-- TERÇCA -->
                <div class="tab-pane alert alert-warning form-group" id="terca">
                    <label for="de_ter" class="col-sm-2 control-label"><strong> de </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="de_ter" id="de_dom" min="0" max="23"  class="form-control ">
                    </div>
                    <br class="clearfix">
                    <label for="ate_ter" class="col-sm-2 control-label"><strong> até </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="ate_ter" id="ate_dom" min="0" max="23"  class="form-control ">
                    </div>
                </div>
                
                <!-- QUARTA -->
                <div class="tab-pane alert alert-warning form-group" id="quarta">
                    <label for="de_qua" class="col-sm-2 control-label"><strong> de </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="de_qua" id="de_dom" min="0" max="23"  class="form-control ">
                    </div>
                    <br class="clearfix">
                    <label for="ate_qua" class="col-sm-2 control-label"><strong> até </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="ate_qua" id="ate_dom" min="0" max="23"  class="form-control "> 
                    </div>
                </div>
                
                <!-- QUINTA -->
                <div class="tab-pane alert alert-warning form-group" id="quinta">
                    <label for="de_qui" class="col-sm-2 control-label"><strong> de </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="de_qui" id="de_dom" min="0" max="23"  class="form-control ">
                    </div>
                    <br class="clearfix">
                    <label for="ate_qui" class="col-sm-2 control-label"><strong> até </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="ate_qui" id="ate_dom" min="0" max="23"  class="form-control ">
                    </div>
                </div>
                
                <!-- SEXTA -->
                <div class="tab-pane alert alert-warning form-group" id="sexta">
                    <label for="de_sex" class="col-sm-2 control-label"><strong> de </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="de_sex" id="de_dom" min="0" max="23"  class="form-control ">
                    </div>
                    <br class="clearfix">
                    <label for="ate_sex" class="col-sm-2 control-label"><strong> até </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="ate_sex" id="ate_dom" min="0" max="23"  class="form-control ">
                    </div>
                </div>
                
                <!-- SABADO -->
                <div class="tab-pane alert alert-warning form-group" id="sabado">
                    <label for="de_sab" class="col-sm-2 control-label"><strong> de </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="de_sab" id="de_dom" min="0" max="23"  class="form-control ">
                    </div>
                    <br class="clearfix">
                    <label for="ate_sab" class="col-sm-2 control-label"><strong> até </strong></label>
                    <div class="col-sm-9">
                        <input type="number" name="ate_sab" id="ate_dom" min="0" max="23"  class="form-control ">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer ">
        <!--<input type="submit" class="btn btn-success btn-lg glyphicon glyphicon-ok-sign" style="width: 50%;" value="Confirmar Vinculo">-->
        <button id="vincularMedico"  type="button" class="btn btn-success btn-lg" ><span class="glyphicon glyphicon-ok-sign"></span> Vincular Médico</button>
        <button id="Fechar" data-dismiss="modal" type="button" class="btn btn-danger btn-lg" ><span class="glyphicon glyphicon-off"></span> Fechar</button>
    </div>
</form>

