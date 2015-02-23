<script>
    
    
//$(document).ready(function(){
//    $(".table-responsive").delegate('.visualizarReceita','click',function(){
//       
//        var numero=$(this).attr('data-codigo');
//        $.ajax({
//                type: 'post',
//                url:"{base_url}receita/buscaReceita/" + numero+"/0",
//                dataType: 'html',
//                beforeSend: function() {
//                    $('#resultadoPesquisa').html('<h4 style="padding:10px"><img src="http://tcc.bl.ee/assets/imagens/loading.gif" /> Aguarde, carregando...</h4>');
//
//                },
//                success: function(data) {
//                    $("#visualizar .modal-body").html(data)
//                    
//
//
//                }
//            });
//        
//    })
//
//})
</script>
<input type="hidden" value="{base_url}" class="base_url">
<div class="container-alternate">
    <div class="container">
        <!--<h4 class='alert alert-info'>Lista de Receituários</h4>-->	
        <?php echo $this->session->flashdata('mensagem'); ?>
    </div>
</div>    
<div class="container">     
    <div class="col-md-12">
        <input type="hidden" id="msgreceita" value="receita">
        <input type="hidden" value="{cat}" name="cat" id="cat" readonly="" disabled="">
        
        <div class="table-responsive">
            <?php if($cat != 4){ ?>
            <div class="row">
                <div class="col-sm-6 col-xs-8">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-success" id="buscaReceitaCPF" type="button">Buscar por CPF</button>
                        </span>
                        <input type="text" class="form-control" id="cpf" name="cpf">
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-4 -->
                <div class="col-sm-6 col-xs-8">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-success" id="buscaReceitaNumero" type="button">Buscar por Número</button>
                        </span>
                        <input type="number" class="form-control" id="numero" name="numero" min="1">
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-4 -->
                <br class="clearfix">     
            </div>
            <?php } ?>
          <!--            <label for="buscacpf" class="col-md-3">CPF:<input type="text" class="form-control" id="cpf" name="cpf"></label>
                           
                      <label for="num" class="col-md-3">Número Receita:<input type="text" class="form-control" id="numero" name="numero"></label>
                      
                          <br class="clearfix">
                          <label for="" class="col-md-6">
                              <input type="button" class="btn btn-success btn-md  " value="Buscar" id="buscar">
                              </label>-->
            <br class="clearfix">
            <table id="mytable" class="table table-bordred table-striped " style="width: 100% !important">

                <thead>


                <th style="width: 15% !important;">Número</th>
                <?php if($cat == 4){ ?>
                <th style="width: 60% !important;">Médico</th>
                <?php }else {?>
                    <th style="width: 60% !important;">Paciente</th>
                <?php }?>
                
                <th style="width: 25% !important;">Data</th>

                <th style="width: 10% !important;">Visualizar</th>
                <?php if($cat == 4){ ?>
                <th style="width: 10% !important;">Permissões</th>
                <?php }?>
                <?php if($cat == 4){ ?>
                <th style="width: 10% !important;">Aprovado</th>
                <?php }?>
                </thead>
                <tbody>
                    <?php
                    if ($receitas) {
                        //  print_r($receitas);die();
                        foreach ($receitas as $receita) {
                            echo " <tr>";
                            echo " <td style='text-align:center'>$receita[COD_HASH]</td>";
                              if($cat == 4){
                                    echo " <td>$receita[MEDICO]</td>";
                                }else {
                                    echo " <td>$receita[PACIENTE]</td>";
                               }
                            
                            echo " <td>$receita[DATA]</td>";
                            ?>


         <!--<td><p><button class="btn btn-primary btn-xs" data-title="Editar Médico" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>-->
                        
                        <td><button class="btn btn-success btn-md visualizarReceita" data-title="Visualizar Receita" data-toggle="modal" data-codigo="<?=$receita['COD_HASH']?>" data-target="#visualizar" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-search"></span></button></td>
                    <?php if($cat == 4){ ?>
                                <td><button class="btn btn-success btn-md alterarPermissao" data-title="Alterar Permissões" data-toggle="modal" data-codigo="<?=$receita['COD_HASH']?>" data-target="#permissoes" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                    <?php }?>
                    <?php if($cat == 4){ ?>
                                <td><button class="btn btn-info btn-md aprovarReceita" data-title="Aprovar Receita" data-toggle="modal" data-codigo="<?=$receita['COD_HASH']?>" data-aprovado="<?=$receita['APROVACAO_PACIENTE']?>" data-target="#aprovacao" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-ok-circle"></span></button></td>
                    <?php }?>
                        </tr>
                    <?php }
                } ?>
                </tbody>

            </table>

            <div class="clearfix"></div>


        </div>
        <div class="row col-md-8">
            <a href='' class='voltarPagina btn btn-default  '><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>

        </div>            
    </div>    
</div>
<br><br><br><br>


<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Visualização de Receita</h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-success"><span class="glyphicon glyphicon-warning-sign"></span></div>

            </div>
            <div class="modal-footer ">
                   <?php if($cat == 1){ ?>
                <a href="" local="<?=  current_url()?>" class="btn btn-success printReceita"><span class="glyphicon glyphicon-print"></span> Imprmir</a>
                <?php }?>
                <!--<button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-print"></span> Imprimir</button>-->
                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Sair</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>
<div class="modal fade" id="permissoes" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Visualização de Receita</h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-success"><span class="glyphicon glyphicon-warning-sign"></span></div>

            </div>
            <div class="modal-footer ">
                  
                <!--<button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-print"></span> Imprimir</button>-->
                <button type="button" class="btn btn-success" id="salvar" ><span class="glyphicon glyphicon-edit"></span> Salvar</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Sair</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>
<div class="modal fade" id="aprovacao" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <script>
    $(document).ready(function(){
    $("#salvarAprovacao").on("click", function() {
        
        var options = {
            target: '.msgAprovado', // target element(s) to be updated with server response 
           // resetForm: true,
             beforeSubmit:  function(){$(".msgAprovado").removeClass('alert-success')},  // pre-submit callback 
            success: function(){$(".msgAprovado").addClass('alert-success')}, // post-submit callback 

        };
        $('#formAprovacao').ajaxSubmit(options);
    });
        $("#obs_erro").on("click", function() {
            $(".msgAprovado").removeClass('alert-success')    
            $(".obs_erro").show();

        });
    });
</script>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Aprovar Receita</h4>
            </div>
            
            <div class="modal-body">  
                <h5>Esta receita foi gerada em seu nome, por favor confirme se está tudo correto.<br></h5>
                <strong>Caso não tenha ido a este médico na data da criação da receita entre em contato e informe o fato ocorrido.</strong>
                <div class="stand"></div>
                <hr>
                <div class="retornoAjax">
                    <form id="formAprovacao" action="<?=  base_url()?>receita/aprovacao" method="POST">
                        <input type="hidden" name="cod_hash" id="cod_hash" value="" readonly="">
                        <input type="checkbox" name="status" id="aprovado"  value="1">
                        <label for="aprovado" class="text_aprovado">Aprovar Receita</label><br>
                        <span class="obs_erro" style="display: none">
                            
                        <label for="obs" class="">Esta receita não foi gerada com sua autorização?, informe aqui.</label>
                        <textarea name="obs" id="obs" class="form-control" placeholder="Ex. Esta receita foi gerada sem minha autorização."></textarea>
                        </span>
                    </form>
                </div>
                <div class="alert  msgAprovado" ></div>

            </div>
            <div class="modal-footer ">
                  
                <!--<button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-print"></span> Imprimir</button>-->
                <button type="button" class="btn btn-success" id="salvarAprovacao" ><span class="glyphicon glyphicon-edit"></span> Salvar</button>
                <button type="button" class="btn btn-danger" id="obs_erro" ><span class="glyphicon glyphicon-remove"></span> Informar Erro</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Sair</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>

<!--<a href='' class='voltarPagina btn btn-default  pull-right'><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>-->