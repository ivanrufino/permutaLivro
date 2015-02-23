<script>
$(document).ready(function(){
    
    $(".openPage").click(function(){
        $(".openPage").parent().removeClass('active');
        
        $(this).parent().addClass('active');
        var page=$(this).attr('href');
        $(".corpo").hide().removeClass('active');
        $("#"+page).delay().fadeIn().addClass('active');
        return false;
    })
    $(".foto").filestyle({
        //input: false,
        buttonText: "Foto",
        buttonName: "btn-info",
        size: "sm",
        iconName: "glyphicon-upload",
        buttonBefore: true,
        
    });
    $("#form").submit(function(){
        $(".presubmit").addClass('alert alert-info').html("<h3>Enviando...</h3>")
        //return false;
    })
    ativar('{page}');
})
function ativar(classe){
    $("."+classe).addClass('active');
}
</script>
<!--data-buttonText="Foto" data-buttonName="btn-info" data-buttonBefore="true" data-iconName="glyphicon-inbox" data-size="sm"-->
<style>
    .corpo{display: none}
    .active{display: block}
    .fotoExibicao{width: 100%;max-height: 283px;max-width: 174px}
</style>
<div class="container">
    <div class="row well">
        <div class="col-md-3 ">
            <ul class="nav nav-pills nav-stacked well">
                <li  class="hide"><a href="#"  class="openPage"><i class="fa fa-envelope"></i> Compose</a></li>
                <li class="home"><a href="f_home" class="openPage"><i class="fa fa-home " ></i> Home</a></li>
                <li class="dados"><a href="f_dados" class="openPage"><i class="fa fa-user "></i> Meus Dados</a></li>
                <?php if($ref=="medico/"){  ?>
                <li class="agenda"><a href="f_agenda" class="openPage"><i class="fa fa-calendar "></i> Minha Agenda</a></li>
                <?php }?>
                <?php if($ref=="admin/"){  ?>
                <li class="dadosEmpresa"><a href="f_empresa" class="openPage"><i class="fa fa-group "></i> Empresa</a></li>
                <?php }?>
                <li class="seguranca"><a href="f_senha" class="openPage"><i class="fa fa-key "></i> Segurança</a></li>
                
                <li class=""><a href="{base_url}login/efetuarLogout"><i class="fa fa-sign-out openPage"></i> Logout</a></li>
            </ul>
        </div>
        <div class="col-md-9">

            <h3 style="border-bottom: 1px dashed">{nome}</h3>
            <div class="panel hide">
                <img class="pic img-circle" src="http://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/twDq00QDud4/s120-c/photo.jpg" alt="...">
                <div class="name"><small>{nome}</small></div>
                <a href="#" class="btn btn-xs btn-primary pull-right" style="margin:10px;"><span class="glyphicon glyphicon-picture"></span> Change cover</a>
            </div>

            <div class="compose hide">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#inbox" data-toggle="tab"><i class="fa fa-envelope-o"></i> Inbox</a></li>
                    <li class=""><a href="#sent" data-toggle="tab"><i class="fa fa-reply-all"></i> Sent</a></li>
                    <li class=""><a href="#assignment" data-toggle="tab"><i class="fa fa-file-text-o"></i> Assignment</a></li>
                    <li class=""><a href="#event" data-toggle="tab"><i class="fa fa-clock-o"></i> Event</a></li>
                </ul>

                <div class="tab-content ">
                    <div class="tab-pane active" id="inbox">
                        <a type="button" data-toggle="collapse" data-target="#a1">
                            <div class="btn-toolbar well well-sm" role="toolbar"  style="margin:0px;">
                                <div class="btn-group"><input type="checkbox"></div>
                                <div class="btn-group col-md-3">Admin Kumar</div>
                                <div class="btn-group col-md-8"><b>Hi Check this new Bootstrap plugin</b> <div class="pull-right"><i class="glyphicon glyphicon-time"></i> 12:10 PM <button class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-share-square-o"> Reply</i></button></div> </div>
                            </div>
                        </a>
                        <div id="a1" class="collapse out well">This is the message body1</div>
                        <br>
                        <button class="btn btn-primary btn-xs"><i class="fa fa-check-square-o"></i> Delete Checked Item's</button>
                    </div>


                    <div class="tab-pane" id="sent">
                        <a type="button" data-toggle="collapse" data-target="#s1">
                            <div class="btn-toolbar well well-sm" role="toolbar"  style="margin:0px;">
                                <div class="btn-group"><input type="checkbox"></div>
                                <div class="btn-group col-md-3">Kumar</div>
                                <div class="btn-group col-md-8"><b>This is reply from Bootstrap plugin</b> <div class="pull-right"><i class="glyphicon glyphicon-time"></i> 12:30 AM</div> </div>
                            </div>
                        </a>
                        <div id="s1" class="collapse out well">This is the message body1</div>
                        <br>
                        <button class="btn btn-primary btn-xs"><i class="fa fa-check-square-o"></i> Delete Checked Item's</button>
                    </div>


                    <div class="tab-pane" id="assignment">
                        <a href=""><div class="well well-sm" style="margin:0px;">Open GL Assignments <span class="pull-right"><i class="glyphicon glyphicon-time"></i> 12:20 AM 20 Dec 2014 </span></div></a>        
                    </div>

                    <div class="tab-pane" id="event">
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object img-thumbnail" width="100" src="http://cfi-sinergia.epfl.ch/files/content/sites/cfi-sinergia/files/WORKSHOPS/Workshop1.jpg" alt="...">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Animation Workshop</h4>
                                2Days animation workshop to be conducted
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <div class="corpo home" id="f_home">
                <p>No menu ao lado você pode alterar seus dados cadastrais, como também a sua senha.<br>
                    É recomendado manter sempre seus dados atualizados e alterar sua senha pelo menos a cada 3 meses.<br></p>
                
                <small>informações adcionais sempre apareceram nesta tela.</small>
                <?php if ( $this->session->flashdata('msg')) { ?>
                <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Aviso!</strong><br> <?php echo  $this->session->flashdata('msg'); ?>.
                </div>
                <?php }?>
                <br><br>
                <a href="{base_url}{ref}" class="btn btn-primary btn-md"><i class="fa fa-backward"></i> Voltar à página principal</a>
               
            </div>
            <div class="corpo dados" id="f_dados">
                {view_dadosUpdate}
            </div>
            <div class="corpo seguranca" id="f_senha">
                {view_updateSenha}
            </div>
            <div class="corpo dadosEmpresa" id="f_empresa">
               {view_dadosEmpresa}
            </div>
            <div class="corpo agenda" id="f_agenda">
               {view_agenda}
            </div>

        </div>
    </div>


</div>



<!--MODAL DO ENVIO DE MENSAGEM-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"><br/><br/>
            <form class="form-horizontal">
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="body">Body :</label>  
                        <div class="col-md-8">
                            <input id="body" name="body" type="text" placeholder="Message Body" class="form-control input-md">

                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="message">Message :</label>
                        <div class="col-md-8">                     
                            <textarea class="form-control" id="message" name="message"></textarea>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="send"></label>
                        <div class="col-md-8">
                            <button id="send" name="send" class="btn btn-primary">Send</button>
                        </div>
                    </div>

                </fieldset>
            </form>

        </div>
    </div>
</div>



