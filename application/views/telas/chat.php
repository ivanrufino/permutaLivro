<script>
    $(document).ready(function () {
        $("#chat").html('Carregando...');
        inicializaChat();
    })
    function setFocus() {
        var obj = $('#chat');
        if (obj.length) {
            obj.scrollTop(obj.height());
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
                                        $("#chat").append(data);
                                        setFocus();
                                    }
                                });
                            }
                            function enviaMensagem() {

//                                if ($("#txtNome").val() == "") {
//                                    $("#chat").append("<div><span class='error'>Favor inserir um [NICKNAME]</span></div>");
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
.de{color: red}
.para{color:blue}
</style>
<input type="text" name="txtMensagem" id="txtMensagem" value="" class="input-msg" onkeypress="if (event.keyCode == 13)
            enviaMensagem();" />
&nbsp;<input name="btEnvia" type="button" value="Enviar" class="input-button" onclick="enviaMensagem()" />
<div id="chat">
    aqui começa tudo
</div>
