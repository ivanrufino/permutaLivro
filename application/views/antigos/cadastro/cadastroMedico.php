
<form class="form-horizontal" method="POST" action="{base_url}medico/cadastro">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title custom_align" id="Heading"><?= $medico['NOME'] ?></h4>
    </div>
    <div class="modal-body">
        <?php print_r($medico) ?>
        <div class="form-group">
            <label class="col-md-3 control-label" for="crm">CRM</label>  
            <div class="col-md-9">
                <input id="crm" name="crm" type="text" value="<?=$medico['CRM']?>" class="form-control input-md" readonly="">
            </div>
        </div>
        <br>
        <div class="clearfix"></div>
       <div class="form-group">
                    <label class="col-md-3 control-label" for="estado" >Especialidade</label> 
                    <div class="col-md-9">
                        <select  id="especialidade" name="especialidade" class="form-control" multiple="" >
                            <?php foreach ($especialidades as $especialidade) {?>
                                <option  value=<?=$especialidade['CODIGO'] ?>><?=$especialidade['ESPECIALIDADE'] ?></option>
                            <?php }?>
                            
                            

                        </select>
                    </div>
                </div>
    </div>
    <div class="modal-footer ">
        <input type="submit" class="btn btn-success btn-lg glyphicon glyphicon-ok-sign" style="width: 100%;" value="Confirmar Vinculo">
        <!--<button id="vincularMedico" type="button" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Confirmar</button>-->
    </div>
</form>

