<style>
    .blocos{
        border:1px dashed grey;
        margin:5px 5px 1px;
    }
    .blocos:first-child{margin-top: 0px}

</style>
<script>
    $(document).ready(function(){
        var options = {
                target: '.resultado_busca', // target element(s) to be updated with server response 
                resetForm: false,
                 beforeSubmit:  showRequest,  // pre-submit callback 
                success: refreshPage, // post-submit callback 

            };
        $('form').on("submit",function(){
            $(this).ajaxSubmit(options);
            return false;
        });
        $(".btn_busca").on('click',function(){
            var form = $(this).parents("form");
            
            form.ajaxSubmit(options);
            //alert(form.attr('action'));
        });
        if ($("#autor").val() != ""){
            var form = $("#autor").parents('form');  
            $(form).ajaxSubmit(options);
        }
        if ($("#editora").val() != ""){
            var form = $("#editora").parents('form');  
            $(form).ajaxSubmit(options);
        }
        $("#btnUpdateFoto").on("click", function() {

            var options = {
                target: '#conteudo_upFoto', // target element(s) to be updated with server response 
                resetForm: true,
                 beforeSubmit:  showRequest,  // pre-submit callback 
                success: refreshPage // post-submit callback 

            };
            $('#formUpload').ajaxSubmit(options);

        });
    })
</script>
    
<div class="container-alternate">
    <div class="container">
        {view_lateral}
        <div class="col-md-9" style="background: transparent">
            <div class="col-md-12 blocos">
                <div class="col-lg-6 ">
                    <form action="{base_url}livro/getlivro/titulo" method="post">
                    <div class="input-group">
                        <input type="text" name="titulo" class="form-control" placeholder="buscar por Titulo">
                        <span class="input-group-btn">
                            <button class="btn btn-default btn_busca " type="button"><i class="glyphicon glyphicon-search"></i></button>
                        </span>
                    </div><!-- /input-group -->
                    </form>
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6 ">
                    <form action="{base_url}livro/getlivro/autor" method="post">
                    <div class="input-group">
                        <input type="text" name="autor" id="autor" class="form-control" placeholder="buscar por Autor" value="<?= isset($campo_autor)? $campo_autor:"" ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default  btn_busca" type="button"><i class="glyphicon glyphicon-search"></i></button>
                        </span>
                    </div><!-- /input-group -->
                    </form>
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6 ">
                    <form action="{base_url}livro/getlivro/editora" method="post">
                    <div class="input-group">
                        <input type="text" name="editora" id="editora" class="form-control" placeholder="buscar por Editora" value="<?= isset($campo_editora)? $campo_editora:"" ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default  btn_busca" type="button"><i class="glyphicon glyphicon-search"></i></button>
                        </span>
                    </div><!-- /input-group -->
                    </form>
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6 ">
                    <form action="{base_url}livro/getlivro/isbn" method="post">
                    <div class="input-group">
                        <input type="text" name="isbn" class="form-control" placeholder="buscar por ISBN">
                        <span class="input-group-btn">
                            <button class="btn btn-default btn_busca " type="button"><i class="glyphicon glyphicon-search"></i></button>
                        </span>
                    </div><!-- /input-group -->
                    </form>
                </div><!-- /.col-lg-6 -->
                 
            </div>
            <div class="col-md-12 resultado_busca blocos">

            </div>

        </div>
    </div>
    <br>
</div>

<div class="col-md-12">
    <footer>
        Direitos reservados
    </footer>
</div>
