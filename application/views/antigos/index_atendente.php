<div class="container">
   
    <div class=" col-sm-4 col-xs-12 text-center ">
        <a href="{base_url}atendente/cadastroPaciente.html">
             <figure class="imglink">
                <legend>Cadastrar Paciente </legend>
                <img src="{base_url}assets/imagens/paciente.png" class="img-responsive img-thumbnail"></figure>
        </a>
    </div>
    <div class="col-sm-4 col-xs-12 text-center">
        <a href="#" data-toggle="modal" data-target="#buscaPaciente"> <figure class="imglink">
                <legend>Buscar Paciente </legend>
                <img src="{base_url}assets/imagens/paciente_busca.png" class="img-responsive img-thumbnail"></figure>
        </a>
    </div>
    <div class="col-sm-4 col-xs-12 text-center">
        <a href="{base_url}agenda/medico/2.html"> <figure class="imglink">
                <legend>Médico </legend>
                <img src="{base_url}assets/imagens/medico2.png" class="img-responsive img-thumbnail"></figure>
        </a>
    </div>
   
</div>
<div class="modal fade" id="buscaPaciente" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Busca de Paciente</h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-info"><span class="glyphicon glyphicon-warning-sign"></span> Digite o CPF do paciente</div>
                <div class="row"><label class="col-md-2">CPF</label><input type="text" id="buscacpf" class="cpf"></div> <br class='clearfix'>
                <div class="msgRetorno" id="resultadoPesquisa"></div>
                <div class="dados" id="">
                    <div class="row"><label class="col-md-2">Nome:</label> <span id="nome" class="col-md-5 " ></span></div>
                    <div class="row"><label class="col-md-2">CPF:</label> <span id="cpf" class="col-md-5" ></span></div>
                    <div class="row"><label class="col-md-2">Email:</label> <span id="email" class="col-md-5" ></span></div>
                    <div class="row"><label class="col-md-2">Celular:</label> <span id="celular" class="col-md-5" ></span></div>
                    <div class="row"><label class="col-md-2">CEP:</label> <span id="cep" class="col-md-5" ></span></div>
                </div>
                
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success" id="buscar"><span class="glyphicon glyphicon-ok-sign"></span> Buscar</button>
                <button type="button" class="btn btn-warning "data-dismiss="modal" aria-hidden="true" ><span class="glyphicon glyphicon-remove" class="close" ></span> Sair</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>