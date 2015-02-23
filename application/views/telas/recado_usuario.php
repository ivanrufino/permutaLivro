<style>
    .blocos{
        border:1px dashed grey;
        margin:5px 5px 1px;
    }
    .blocos:first-child{margin-top: 0px}

</style>
<script>
$(document).ready(function(){
    //    $(".openRecado").on('click',function(){
//        alert($(this).attr('lido'));
//    });
$('.messages.active').on('shown.bs.collapse', function () {
    var id = $(this).attr('id').split("_");
     
        $.ajax({
            type: "POST",
            url: "<?=  base_url()?>usuario/marcarComoLido/"+id['1'],
            //data: { codigo: "John", location: "Boston" }
          })
            .done(function( msg ) {
             // alert( "Data Saved: " + msg );
            });
    });
    $('.messages.active').on('hidden.bs.collapse', function () {
    $(this).removeClass('active');
    $("p.msgCorpo",this).removeClass('alert-info').addClass('alert-success');
    });
});


</script>
<div class="container-alternate">
    <div class="container">
        {view_lateral}
        <div class="col-md-9" style="background: transparent">
            <div class="col-md-12 recados blocos">
                <fieldset>
                    <legend>Recados</legend>
                    <?php foreach ($minhasmensagens as $mensagem) { ?>
                        <!--<span clasa="title"><?= $mensagem['TITULO'] ?></span>-->
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#div_<?=$mensagem['CODIGO']?>" >
                                    <h4 class="panel-title"><span class="glyphicon ">
                                    </span><?= $mensagem['TITULO'] ?>
                            </h4></a>
                        </div>
                        <div id="div_<?=$mensagem['CODIGO']?>" class="panel-collapse collapse messages <?= $mensagem['LIDO']==0? "active":"" ?>">
                            <div class="list-group">
                                <!--<a href="#" class="list-group-item openRecado <?= $mensagem['LIDO']==0? "active":"" ?>" >-->
                                    <!--<h4 class="list-group-item-heading">List group item heading</h4>-->
                                    <p class="list-group-item-text alert msgCorpo <?= $mensagem['LIDO']==0? "alert-info":"alert-success" ?>"><?=$mensagem['MENSAGEM']?></p>
                                <!--</a>-->
                            </div>
<!--                            <div class="list-group">
                                <a href="#" class="list-group-item active">
                                    <h4 class="list-group-item-heading">List group item heading</h4>
                                    <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                </a>
                            </div>
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <h4 class="list-group-item-heading">List group item heading</h4>
                                    <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                </a>
                            </div>-->
                        </div>
                    </div>
                <?php } ?>
                </fieldset>
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
