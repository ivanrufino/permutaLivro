<script>
    $(document).ready(function () {
        $("#chat").html('Carregando...');
        inicializaChat();
    })
    function setFocus() {
        var obj = $('#chat');
        if (obj.length) {
            obj.scrollTop(obj.get(0).scrollHeight);
           
        }
    }
    function inicializaChat() {
        $("#chat").html("<center>Carregando Mensagens...</center>");
        $.ajax({
            url: "<?= base_url() ?>pedido/ajaxAtualizaChat/<?= $codPedido ?>",
                        data: {
                            ac: ""
                        },
                        type: 'post',
                        success: function (data) {
                            $("#chat").html(data);
                            setFocus();
                        }
                    });

                    window.setInterval(function () {
                        atualizaChat();
                    }, 2000);
                }

                function atualizaChat() {
                    $.ajax({
                        url: "<?= base_url() ?>pedido/ajaxAtualizaChat/<?= $codPedido ?>",
                                    data: {
                                        ac: "update"
                                    },
                                    type: 'post',
                                    success: function (data) {
                                        if(data!="    0"){
                                            console.log('dados'+data)
                                            $("#chat").append(data);
                                            setFocus();
                                        }
                                    }
                                });
                            }
                            function enviaMensagem() {

//                                if ($("#txtNome").val() == "") {
//                                    $("#chat").append("<div><div class='error'>Favor inserir um [NICKNAME]</div></div>");
//                                    $("#txtNome").focus();
//                                }
//                                else {
                                    $.ajax({
                                        url: "<?= base_url() ?>pedido/ajaxEnviaMensagem/<?= $codPedido ?>",//'ajaxEnviaMensagem.php',
                                        data: {
                                            msg: $("#txtMensagem").val(),
                                            //usu: nomeUsuario
                                        },
                                        type: 'post',
                                        success: function (data) {
                                            $("#txtMensagem").val("");
                                            atualizaChat();
                                        }
                                    });
//                                }
                            }

</script>
<style>
    #chat{
        
        height: 300px;
        border: 1px solid blue;
        padding: 6px;
        overflow-y: auto;
        width: 100%
    }
.de, .para{width: 50.5%; border-bottom: 1px dashed grey;font-size: 150% }
.de{color: red; float: left}
.para{color:blue;float: right;text-align: right };

.clearfix{clear: both}
</style>
<input type="text" name="txtMensagem" id="txtMensagem" value="" class="input-msg" onkeypress="if (event.keyCode == 13)
            enviaMensagem();" />
&nbsp;<input name="btEnvia" type="button" value="Enviar" class="input-button" onclick="enviaMensagem()" />
<!--<div id="chat">
    
</div>-->
<div id="chat" >    
    <div class="de"> To precisando </div><br class="clearfix">
    <div class="de"> beleza </div><br class="clearfix">
    <div class="para"> sim </div><br class="clearfix">
    <div class="de"> algo a dizer </div><br class="clearfix">
    <div class="para"> nao </div><br class="clearfix">
    <div class="para"> e voce </div><br class="clearfix">
    <div class="de"> sei la </div><br class="clearfix">
    <div class="para"> pode mandar este livro pra mim </div><br class="clearfix">
    <div class="de"> nao </div><br class="clearfix">
    <div class="de"> correria mano </div><br class="clearfix">
    <div class="para"> demais, o que fazer nestas horas </div><br class="clearfix">
    <div class="para"> :) </div><br class="clearfix">
</div>