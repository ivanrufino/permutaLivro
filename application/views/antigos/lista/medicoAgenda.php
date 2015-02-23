<script>
  $(document).ready(function(){
      $(".mostrarAgenda").click(function(){
        var codigo=$(this).attr('data-codigo');
        //alert(codigo);return false;
        var url=$("#base_url").val()+"medico/buscaAgenda/"+codigo;
        $(".medAgenda").load(url);
//        $(".medAgenda").html('<h1>'+codigo+'</h1>')
      });
      
  })  ;
</script>
<div class="container-alternate">
    <div class="container">
    <h4 class='alert alert-info'>Lista de Médicos</h4>	
    
    <?php echo $this->session->flashdata('mensagem'); ?>
    </div>
</div>    
<div class="container">     
    <div class="col-md-12">
        <input type="hidden" id="msgmedicos" value="Médico">
        <input type="hidden" id="base_url" value="{base_url}">
        <div class="table-responsive">
            <table id="mytable" class="table table-bordred table-striped">
                <!--<div class="col-md-8  "><a href="#" href3='{base_url}admin/cadastroMedico' class='btn btn-success  pull-right ' data-title="Vincular Médico" data-toggle="modal" data-target="#vincular" data-placement="top" rel="tooltip"> <span class="glyphicon glyphicon-plus">    </span> Vincular Médico</a>   </div>-->
                <thead>

                <th><input type="checkbox" id="checkall" /></th>
                <th>Nome</th>
                <th>CRM</th>
                <th>Email</th>
                <th>Especialidade</th>
                <!--<th>Editar</th>-->
                <th>Agenda</th>
                </thead>
                <tbody>
                    <?php if ($medicos) { ?>
                        {medicos}
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>{NOME}</td>
                            <td>{LOGIN}</td>
                            <td>{EMAIL}</td>
                            <td>{ESPECIALIDADE}</td>
                            <!--<td><p><button class="btn btn-primary btn-xs" data-title="Editar Médico" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>-->
                            <td><p><button class="btn btn-success btn-md mostrarAgenda" data-codigo="{CODIGO}" data-title="Verificar agenda de {NOME}" data-toggle="modal" data-target="#verificarAgenda" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-search"></span></button></p></td>
                        </tr>
                        {/medicos}
                    <?php } ?>
                </tbody>

            </table>

            <div class="clearfix"></div>


        </div>
        <div class="row col-md-8">
            <a href='' class='voltarPagina btn btn-default  '><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>

        </div>            
    </div>    
</div>

<div class="modal fade" id="vincular" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Digite o CRM do Médico</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="base_url" name="base_url" type="hidden" placeholder="" value="{base_url}" class="form-control input-md" required="">
                    <label class="col-md-3 control-label" for="estado" >Estado</label> 
                    <div class="col-md-9">
                        <select  id="uf" name="uf" class="form-control " >
                            {estado}
                            <option  codigo={CODIGO} value="{UF}">{NOME}</option>
                            {/estado}
                            <!--                            <option value="RJ">Rio de Janeiro</option>
                                                        <option value="SP">São Paulo</option>-->
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

                <!--                <div class="form-group">
                                    <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
                
                
                                </div>-->
            </div>
            <div class="modal-footer ">
                <button id="btnBuscar" type="button" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Confirmar</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog -->  
</div>
<div class="modal fade " id="vincularMedicoAjax" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <img src="{local}imagens/loading.gif">
            <!--<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">carregar via ajax</h4>
            </div>
            <div class="modal-body">
                 
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
                
                     >
            </div>
            <div class="modal-footer ">
                <button id="vincularMedico" type="button" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Confirmar</button>
            </div>-->
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control " type="text" placeholder="Mohsin">
                </div>
                <div class="form-group">

                    <input class="form-control " type="text" placeholder="Irshad">
                </div>
                <div class="form-group">
                    <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>


                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>



<div class="modal fade" id="verificarAgenda" tabindex="-1" role="dialog" aria-labelledby="Agenda" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content "style='min-width: 700px'>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Agenda</h4>
            </div>
            <div class="modal-body medAgenda">
                

                <!--<div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>-->

            </div>
            <div class="modal-footer ">
                <!--<button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>-->
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Fechar</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>

<!--<a href='' class='voltarPagina btn btn-default  pull-right'><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>-->