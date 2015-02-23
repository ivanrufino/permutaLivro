<!--<div class="row">
    <div class="col-md-12 ">-->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"></h3>
                <a href="#" class="panel-title btn btn-sm btn-default" data-toggle="modal" data-target="#pesquisa"><span class="glyphicon glyphicon-search"></span> Pesquisar Paciente</a>




            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        {view_cadastroPaciente}
                    </div>
                    <!-- <div class="tab-pane" id="tab2"> 
                         Nome
     
                          {view_buscaNomePaciente} 
                     </div>
                     <div class="tab-pane" id="tab3">
                         CPF
                          {view_buscaCpfPaciente}
                     </div>-->

                </div>
            </div>
        </div>
<!--    </div>
</div>-->
<input type="hidden" class="base_url" value="{base_url}">
{view_modalPesquisaPaciente}