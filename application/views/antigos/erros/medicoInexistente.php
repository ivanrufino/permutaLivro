<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Médico Inexistente</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <bold>Atenção: </bold>Não foi encontrado nenhum médico com CRM <?= $CRM ?> para o estado <?=$estado?>.
                </div>
                <!-- 
                <div class="form-group">
                     <input class="base_url" name="base_url" type="hidden" placeholder="" value="{base_url}" class="form-control input-md" required="">
                    <label class="col-md-3 control-label" for="estado" >Estado</label> 
                    <div class="col-md-9">
                        <select  id="uf" name="uf" class="form-control endereco" >
                            {estado}
                            <option  codigo={CODIGO} value="{UF}">{NOME}</option>
                            {/estado}

                        </select>
                    </div>
                </div>
                <br>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="crm">CRM</label>  
                    <div class="col-md-9">
                        <input id="crm" name="crm" type="text" placeholder="" class="form-control input-md" required="">

                    </div>
                </div>
                <div class="clearfix"><br></div>
                
                <div class="clearfix msn alert alert-info ">Preencha o CRM.</div>
                
                     >-->
            </div>
            <div class="modal-footer ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Fechar</button>
                <!--<button id="vincularMedico" type="button" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Confirmar</button>-->
            </div>

