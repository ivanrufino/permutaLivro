<div class="container-alternate">
    <div class="container">
    <h4 class='alert alert-info'>Lista de Atendentes</h4>	
    <?php echo $this->session->flashdata('mensagem'); ?>
    </div>
</div>    
<div class="container">  
    <div class="col-md-12">
 <input type="hidden" id="msgmedicos" value="atendente">
        <div class="table-responsive">
            <table id="mytable" class="table table-bordred table-striped">
                <div class="col-md-8  "><a href='{base_url}admin/cadastroAtendenteF' class='btn btn-success  pull-right '> <span class="glyphicon glyphicon-plus">    </span> Adicionar</a>   </div>


                <thead>
                <th class="hide">Código</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Email</th>
                <th>Ativo</th>
                <!--<th>Editar</th>-->
                <th>Deletar</th>
                </thead>
                <tbody>
                    <?php if ($atendentes) { ?>
                        {atendentes}
                        <tr>
                            <td class="hide">{CODIGO}</td>
                            <td>{NOME}</td>
                             <td class="hidden-xs hidden-sm">{LOGIN}</td>
                            <td class="hidden-xs">{EMAIL}</td>
                            <td>{STATUS_N}</td>
                            <!--<td><p><button class="btn btn-primary btn-xs" data-title="Editar" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>-->
                            <td><p><button class="btn btn-danger btn-xs" data-title="Desativar" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
                        </tr>
                        {/atendentes}
                    <?php } //else { ?>
                    <!--<tr class='alert alert-success'><td colspan="7">Nenhum Atendente cadastrado até o momento</td></tr>-->
                    <?php //} ?>
                </tbody>

            </table>

            <div class="clearfix"></div>
            <!--                    <ul class="pagination pull-right">
                                <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                                 
                                <li class="active"><a href="#">1</a></li>                   
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                            </ul>-->

        </div>
        <div class="row col-md-8">
            <a href='' class='voltarPagina btn btn-default  '><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
<!--            <a href='{base_url}admin/cadastroAtendente' class='btn btn-success pull-right '> <span class="glyphicon glyphicon-plus">    </span> Adicionar</a>   -->

        </div>
    </div>

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
                <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"> <span class="glyphicon glyphicon-ok-sign"></span> Update</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>



<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                <button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-remove"></span> No</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>

