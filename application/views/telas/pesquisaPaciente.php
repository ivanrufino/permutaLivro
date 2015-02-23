<script>
    jQuery(function($) {
        $("#buscacpf").mask("999.999.999-99", {placeholder: " "});
    });

</script>
<!-- Modal -->
<div class="modal fade" id="pesquisa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Pesquisa de Paciente</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="input-group">
                        <input type="text" name="buscacpf" id="buscacpf" class="form-control">
                        <span class="input-group-btn">
                            <button id="buscar" class="btn btn-default" type="button">Buscar</button>
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <br>    

            <div class="row">
                <div id="resultadoPesquisa"></div>
                
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <!--        <button type="button" class="btn btn-primary">Save changes</button>-->
        </div>
    </div>
</div>
</div>