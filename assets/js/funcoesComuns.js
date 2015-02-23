$(function() {
    
    $(".voltar").on('click', function() {
        window.history.back();
        return false;
    });
//    $(".form-control").on('focus',function(){
//        $(this).next('span').slideDown();
//    })
//    $(".form-control").on('blur',function(){
//        $(this).next('span').slideUp();
//    })
// mascaras 
//Alteração para telefones com 9 digitos

 var celphoneMask = function(phone, e, currentField, options){
  return phone.match(/^(\(?11\)? ?9(5[0-9]|6[0-9]|7[01234569]|8[0-9]|9[0-9])[0-9]{1})/g) ?  '(00) 00000-0000' : '(00) 0000-00009';
};


    
    $("#telefone").mask("(99) 9999-9999");
    $("#cep").mask("99.999-999");
    
   // $("#celular").mask("(99) ?9999-9999");
//    $('.celular').mask(maskBehavior, options);
    $("#celular").mask(celphoneMask);
    $("#cpf").mask("999.999.999-99");
    $("#buscacpf").mask("999.999.999-99");
    
    $("#cnpj").mask("99.999.999/9999-99");
});
$(function() {
    $('#myTab a:last').tab('show');
});
$(function() {
//buscar endereço peloCEP
$("#cep").on('blur',function(){
    var qtd=$(this).val().length;
    if(qtd==10){
        var cep=$(this).val().replace('.','').replace('-','');
        //$("#numero").focus();
        carregarEnderecoPorCep(cep);
        
    }
});
    $("#buscar").click(function() {
        var cpf = $("#buscacpf").val();
        if(cpf == ""){
            $('#resultadoPesquisa').html("<div  class='alert alert-danger'>Preencha o CPF.</div>");
            return false;
        }
        var base_url = $(".base_url").val();
        $.ajax({
            type: 'post',
            url: base_url + 'paciente/buscarcpf/' + cpf,
            dataType: 'html',
            beforeSend: function() {
                $('#resultadoPesquisa').html('<h4 style="padding:10px"><img src="http://tcc.bl.ee/assets/imagens/loading.gif" /> Aguarde, carregando...</h4>');
                
            },
            success: function(data) {
                var newcpf = cpf.substring(0, 3);
                if (data==0){
                    $('#resultadoPesquisa').html("<div  class='alert alert-danger'>Não existe paciente cadastro com CPF.</div>");
                    $("#buscacpf").val(" ");
                }else{
                    
                    data =jQuery.parseJSON(data)
                $('#resultadoPesquisa').html("<div  class='alert alert-success'>Paciente encontrado<br>Clique em sair e inicie o receiturario</div>");
                  //   $('#resultadoPesquisa').html(data);
                    $("#labelPaciente").html(data['nome']);
                    $("#codPaciente").val(data['codigo']);
                    $("#codHash").val($("#codHash").val()+newcpf)
                  $(".msgRetorno").html("<div  class='alert alert-success'>Paciente encontrado");
                    $(".dados").show();
                    $("#nome").html(data['nome']);
                    $("#cpf").html(data['cpf']);
                    $("#celular").html(data['celular']);
                    $("#email").html(data['email']);
                    $("#cep").html(data['cep']);
                   // $("#buscaPaciente").modal('hide');
                }
                //$('#resultadoPesquisa').html(data);
            }
        });

    });
    
    $('#buscaPaciente').on('hidden.bs.modal', function (e) {
        $("#buscacpf").val(" ");
        $("#nome").html(" ");
        $("#cpf").html(" ");
        $("#celular").html(" ");
        $("#email").html(" ");
        $("#cep").html(" ");
    })

    var campo = $(".endereco");
    campo.click(function() {
        carregarEndereco();
    })

    campo.blur(function() {
        carregarEndereco();
    })




});
function carregarEndereco() {
    var campo = $(".endereco");
    var endereco_completo = "";
    campo.each(function() {
        // alert($(this).val());
        if ($(this).val() != "")
            endereco_completo = endereco_completo + $(this).val() + "-";
        //carregarNoMapa(endereco_completo);
    });

    carregarNoMapa(endereco_completo);
}
function carregarNoMapa(endereco) {

    geocoder.geocode({'address': endereco + ', Brasil', 'region': 'BR'}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();

                $('#txtEndereco').val(results[0].formatted_address);
                $('#latitude').val(latitude);
                $('#longitude').val(longitude);

                var location = new google.maps.LatLng(latitude, longitude);
                marker.setPosition(location);
                map.setCenter(location);
                map.setZoom(16);
            }
        }
    });
}
$(document).ready(function() {
    var mensagem=$("#msgmedicos").val();
    var vazio='N&atilde;o existe nenhum '+mensagem+' cadastrado !';
    if ($("#msgreceita").val()=="receita"){
        vazio="Faça um busca para listar as receitas";
    }
//    $(".table #checkall").click(function() {
//        if ($(".table #checkall").is(':checked')) {
//            $(".table input[type=checkbox]").each(function() {
//                $(this).prop("checked", true);
//            });
//
//        } else {
//            $(".table input[type=checkbox]").each(function() {
//                $(this).prop("checked", false);
//            });
//        }
//    });
    $(".tables").dataTable({
        "sDom": '<"col-md-4 col-xs-5"f>rt<"col-md-4 col-sm-8 col-xs-12 "i><"col-md-4 col-sm-4 hidden-xs"l><"col-md-4 text-right"p> <"clear">',
        "iDisplayLength": 15,
        "bDeferRender": true ,
        "bPaginate": true,
        "bFilter": true,
        "aaSorting": [[ 3, "desc" ]],
        "oLanguage": {
            "sLengthMenu": 'Mostrar <select>' +
                    '<option value="10">15</option>' +
                    '<option value="20">30</option>' +
                    '<option value="30">45</option>' +
                    '<option value="40">60</option>' +
                    //'<option value="50">50</option>'+
                    '<option value="-1">All</option>' +
                    '</select> Registros',
            "sZeroRecords": "Nenhum registro para a pesquisa realizada!",
            "sEmptyTable": vazio,
            "sInfoEmpty": '',
            "sInfo": "_TOTAL_ registros, mostrando de _START_ at&eacute; _END_",
            "sInfoFiltered": " - Quantidade Total _MAX_ registros",
            "sSearch": "Filtrar Registros:",
            "oPaginate": {"sFirst": "Início", "sPrevious": "Anterior", "sNext": "Pr&oacute;ximo", "sLast": "Último"}
        },
    });
});

$(function() {
    $("[rel='tooltip']").tooltip();

});
$(function() {
    var base_url = $(".base_url").val();
    //Carregar as cidades quando carregar a pagina
    var id = $("#estado").find('option:selected').attr('codigo');
    loadCidades(id, base_url);

    //Carregar as cidades quando mudar o estado
    $("#estado").change(function() {
        //var id= $(this).val();
        var id = $(this).find('option:selected').attr('codigo');
        loadCidades(id, base_url);
    });

    $(".voltarPagina").click(function() {
        window.history.back();
        return false
    });

});
$(function() {
    $(".editarMedico").click(function(){
        var crmCompleto = $(this).attr('crm').split("-");
        var crm = crmCompleto[1];
        var uf =  crmCompleto[0];
        var url = $(".base_url").val();
        $("#vincular").modal('hide');
        $("#vincularMedicoAjax").modal('show');
        $("#vincularMedicoAjax .modal-content").load(url + "medico/buscarMedico/" + crm + "/" + uf);
    })
    $("#btnBuscar").click(function() {
        if ($("#crm").val() == "") {
            $(".msn").addClass("alert-danger");
            // alert("Preencha o crm");
        } else {
            var url = $(".base_url").val();
            var crm = $("#crm").val();
            var uf = $("#uf").val();
            $("#vincular").modal('hide');
            $("#vincularMedicoAjax").modal('show');
            $("#vincularMedicoAjax .modal-content").load(url + "medico/buscarMedico/" + crm + "/" + uf);
            //window.location.href = url + "admin/vincularMedico/" + crm + "/" + uf;
        }
    });
    $("#vincularMedicoAjax").on('hidden.bs.modal', function(e) {
        $("#vincularMedicoAjax .modal-content").html(" ");
    });
    $("#vincular").on('hidden.bs.modal', function(e) {
        $(".msn").removeClass("alert-danger");
    });

    $.fn.vincularMedico = function() {
        var options = {
            target: '#msgAgenda', // target element(s) to be updated with server response 
        };
        $('#formVinculo').ajaxSubmit(options);
    };


    $(".alterarImagem").on('click', function() {
        var controler = $(this).attr("data-ctrl");
        $('#updateImage').on('show.bs.modal', function() {
            $("#formUpload").attr('action', controler)
        });
    });
    $("#btnUpdateFoto").on("click", function() {

        var options = {
            target: '#conteudo_upFoto', // target element(s) to be updated with server response 
            resetForm: true,
             beforeSubmit:  showRequest,  // pre-submit callback 
            success: refreshPage, // post-submit callback 

        };
        $('#formUpload').ajaxSubmit(options);

    });
    
 

});
function showRequest(formData, jqForm, options) { 
    $("#conteudo_upFoto").html('Enviando...')
    return true; 
} 
function refreshPage() {
    var img = $(".imgPerfil").attr('src');
    $(".imgPerfil").attr('src', img);
}
function loadCidades(codEstado, base_url) {
    $("#cidade").load(base_url + "admin/getCidade/" + codEstado); //val($(this).val())
}
function changeClassBody(classe) {
    $("body").attr('class', '');
    $('body').addClass(classe);
}
$("document").ready(function(){
    $("#inserirMedicamento").click(function(){
        // $('html, body').animate({ scrollTop: $("#base").offset().top+100 }, 1000);
         var medicamento =$("#txt-medicamento option:selected").text();
	if (medicamento=="Selecione o medicamento na lista"){
		alert('Selecione o medicamento na lista');
		return false;	
	}

         var forma =$("#txt-medicamentoForma option:selected").text();
         var cod_medicamento =$("#txt-medicamento").val();
         var cod_forma =$("#txt-medicamentoForma").val();
         var prescricao =$("#txt-prescricao").val();
	 var prescricao2 =$("#txt-prescricao2").val();
	if (prescricao==""){
		alert("Digite a prescrição");
		return false;
	}
    	if (prescricao2==""){
		alert("Digite a Posologia");
		return false;
	}
        /* if ($("#txt-prescricao2").val()!=0){
            prescricao+="<br>"+$("#txt-prescricao2 option:selected").text();
        }*/
         
        var html="<div class='medicamentos col-md-11 col-xs-10'><label class='close fecharMedicamento'>Excluir</label>";
        html+= "<input type='hidden' name='medicamento[]' value='"+cod_medicamento+"'> "
        html+= "<input type='hidden' name='forma[]' value='"+cod_forma+"'> "
        html+= "<input type='hidden' name='prescricao[]' value='"+prescricao+"'> "
         html+="<label class='medicamento col-md-10 col-xs-12'><i class='glyphicon glyphicon-ok-circle'></i>   "+medicamento+"</label>";
         html+="<label class='medicamento col-md-10 col-xs-12'>  "+forma+"</label>";
         html+="<label class='prescricao col-md-10 col-xs-12'>"+prescricao+"</label>";
         html+="<br class='clearfix '></div>";
         
        $("#listaReceita").append(html);
	$("#txt-prescricao2, #txt-prescricao").val("")
        criarBotao();
         $('html, body').stop().animate({ scrollTop: $("#base").offset().top }, 2000);
    })
    $('body').on('click', '.fecharMedicamento', function(){
       $(this).parent().slideUp(500,function(){
           $(this).remove();
           removerBotao();
       }) ;
       //alert($('.medicamentos').length)
       
    });
    
    function criarBotao(){
        if ($('.medicamentos').length==1){
          var html="<input type='button' class='btn btn-default btnReceita' value='Gravar Receita'> ";
             $(".botao").append(html);
     }
    }
    function removerBotao(){
        if ($('.medicamentos').length==0){          
             $(".botao").html(" ");
        }
    }
    $('body').on('click', '.btnReceita', function(){
       $("#formReceita").submit();
       
    });
   $(".efetLogin").on('click',function(){
       var options = {
            target: '#conteudo_upFoto', // target element(s) to be updated with server response 
            resetForm: true,
            // beforeSubmit:  showRequest,  // pre-submit callback 
            //success: refreshPage, // post-submit callback 

        };
        $('#formlogin').submit();
        
   });


//enviando formulario de esqueci minha senha
$(".enviarEmail").on('click',function(){
   $("#msgEsqueciSenha").html(" ");
       var options = {
            target: '#msgEsqueciSenha', // target element(s) to be updated with server response 
           // resetForm: true,
            // beforeSubmit:  showRequest,  // pre-submit callback 
           // success: refreshPage, // post-submit callback 

        };
        $('#formEsqueciSenha').ajaxSubmit(options);
        
   });
})
   function carregarEnderecoPorCep(cep){
       var url=$(".base_url").val()+"admin/getCep/"+cep;
       $.ajax({
                url : url, /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: '', /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#endereco').val(data.rua);//.attr("readonly","readonly").addClass('disabled');
                        $('#bairro').val(data.bairro);//.attr("readonly","readonly").addClass('disabled');
                        $('#cidade').val(data.cidade);//.attr("readonly","readonly").addClass('disabled');
                        $('#estado').val(data.estado);//.attr("readonly","readonly").addClass('disabled');
                        carregarEndereco();
                        $('#numero').focus();
                    }else{
                        alert('endereço nao encontrado');
                        $('#endereco').val(" ");
                        $('#bairro').val(" ");
                        $('#cidade').val(" ");
                        $('#estado').val(" ");
                        $('#latitude').val(" ");
                        $('#longitude').val(" ");
                        $("#cep").focus().val(" ")
                    }
                }
           });
       

   }
   //ajustar altura da jubotron de acordo com tamanho da tela
   $(document).ready(function(){ 
       var message = $(".tootipMessage").html();
       $('.pa').tooltip({title: message,html:true}).click(function(){return false;})
   })
   
    $(document).ready(function() {
        var base_url = $(".base_url").val();
         
    
        $("#buscaReceitaCPF").click(function() {
            var cpf = $('#cpf').val();
            var cat = $('#cat').val();
            $.ajax({
                type: 'post',
                url: base_url+"receita/getReceitaByCpf/" + cpf+"/"+cat,
                dataType: 'html',
                beforeSend: function() {
                    $('#resultadoPesquisa').html('<h4 style="padding:10px"><img src="http://tcc.bl.ee/assets/imagens/loading.gif" /> Aguarde, carregando...</h4>');

                },
                success: function(data) {
                    createDataTable(data)

                }
            });
        })
        $("#buscaReceitaNumero").click(function() {
            var numero = $('#numero').val();
            if (numero==""){numero=0}
            var cat = $('#cat').val();

            $.ajax({
                type: 'post',
                url: base_url+"receita/getReceitaByNumero/" + numero+"/"+cat,
                dataType: 'html',
                beforeSend: function() {
                    $('#resultadoPesquisa').html('<h4 style="padding:10px"><img src="http://tcc.bl.ee/assets/imagens/loading.gif" /> Aguarde, carregando...</h4>');

                },
                success: function(data) {
//                    $('.table').dataTable().fnDestroy();
//                    $(".table tbody").html(data);
                  
                    createDataTable(data);
                    
                    


                }
            });

        })
        
        $(".table-responsive").delegate('.visualizarReceita','click',function(){
       
        var numero=$(this).attr('data-codigo');
        var retorno=$("#cat").val();
        
        $.ajax({
                type: 'post',
                url:base_url+"receita/buscaReceita/" + numero+"/0",
                dataType: 'html',
                beforeSend: function() {
                    $('#resultadoPesquisa').html('<h4 style="padding:10px"><img src="'+base_url +'assets/imagens/loading.gif" /> Aguarde, carregando...</h4>');

                },
                success: function(dados) {
                    $(".printReceita").attr('href',base_url+"receita/buscaReceita/"+numero+"/1/"+retorno);
                    $("#visualizar .modal-body").html(dados);
                    


                }
            });
        
    })
    $(".table-responsive").delegate('.alterarPermissao','click',function(){
       
        var numero=$(this).attr('data-codigo');
        var retorno=$("#cat").val();
        
        $.ajax({
                type: 'post',
                url:base_url+"receita/buscaPermissao/" + numero,
                dataType: 'html',
                beforeSend: function() {
                    $('#resultadoPesquisa').html('<h4 style="padding:10px"><img src="'+base_url +'assets/imagens/loading.gif" /> Aguarde, carregando...</h4>');
                    

                },
                success: function(dados) {
                   // $(".printReceita").attr('href',base_url+"receita/buscaReceita/"+numero+"/1/"+retorno);
                    $("#permissoes .modal-body").html(dados);
                    


                }
            });
        
    })
    $(".table-responsive").delegate('.aprovarReceita','click',function(){
       
        var numero=$(this).attr('data-codigo');
        var aprovado=$(this).attr('data-aprovado');
        
        
         $("#aprovacao .modal-body .retornoAjax #cod_hash").val(numero);
           $("#aprovacao .modal-body .retornoAjax #aprovado").removeAttr('checked'); 
            $("#aprovacao .modal-body .retornoAjax .text_aprovado").html('Aprovar receita');  
         if (aprovado==1){
             $("#aprovacao .modal-body .retornoAjax #aprovado").attr('checked','checked'); 
             $("#aprovacao .modal-body .retornoAjax .text_aprovado").html('Aprovação já confirmada'); 
         }
         
    })
        function createDataTable(data){
         $('.table').dataTable().fnDestroy(); //destrui a tabela para depois reconstruir
       
          $(".table tbody").html(data);
                    
            $(".table").dataTable({
                        "sDom": '<"col-md-4 col-xs-5"f>rt<"col-md-4 col-sm-8 col-xs-12 "i><"col-md-4 col-sm-4 hidden-xs"l><"col-md-4 text-right"p> <"clear">',
                        "iDisplayLength": 15,
                        "bDeferRender": true,
                        "bPaginate": true,
                        "bFilter": true,
                        "oLanguage": {
                            "sLengthMenu": 'Mostrar <select>' +
                                    '<option value="10">15</option>' +
                                    '<option value="20">30</option>' +
                                    '<option value="30">45</option>' +
                                    '<option value="40">60</option>' +
                                    //'<option value="50">50</option>'+
                                    '<option value="-1">All</option>' +
                                    '</select> Registros',
                            "sZeroRecords": "Nenhum registro para a pesquisa realizada!",
                            "sEmptyTable": 'N&atilde;o foi encontrada nenhuma receita para a busca realizada !',
                            "sInfoEmpty": '',
                            "sInfo": "_TOTAL_ registros, mostrando de _START_ at&eacute; _END_",
                            "sInfoFiltered": " - Quantidade Total _MAX_ registros",
                            "sSearch": "Filtrar Registros:",
                            "oPaginate": {"sFirst": "Início", "sPrevious": "Anterior", "sNext": "Pr&oacute;ximo", "sLast": "Último"}
                        },
                    });
        }
    })
