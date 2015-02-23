<script>
    $(document).ready(function() {
        $(".Preferencias").tooltip({
            template: '<div class="meu_tooltip tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner "></div></div>',
            title: '<p>Preferencias</p>',
            html: true
        });
     
    	$("#input-quali").rating({
    	starCaptions: {0.1: "Péssimo", 25: "Ruim", 50: "Regular", 75: "Bom", 100: "Ótimo"},
    	clearCaption:"Não avaliado"
    
});
    	/*$("#input-27").on("rating.change", function(event, value, caption) {
    		
    	$("#input-27").rating("refresh", {disabled: true, showClear: false});
    	alert("You rated: " + value + " = " + $(caption).text());
	});
    });*/
    });
</script>
<style>
   #accordion .glyphicon { margin-right:10px; }
      .panel-collapse>.list-group .list-group-item:first-child {border-top-right-radius: 0;border-top-left-radius: 0;}
      .panel-collapse>.list-group .list-group-item {border-width: 1px 0;}
      .panel-collapse>.list-group {margin-bottom: 0;}
      .panel-collapse .list-group-item {border-radius:0;}

      .panel-collapse .list-group .list-group {margin: 0;margin-top: 10px;}
      .panel-collapse .list-group-item li.list-group-item {margin: 0 -15px;border-top: 1px solid #ddd;border-bottom: 0;padding-left: 30px;}
      .panel-collapse .list-group-item li.list-group-item:last-child {padding-bottom: 0;}

      .panel-collapse div.list-group div.list-group{margin: 0;}
      .panel-collapse div.list-group .list-group a.list-group-item {border-top: 1px solid #ddd;border-bottom: 0;padding-left: 30px;}
      
</style>
 

        <div class="col-sm-3 col-md-3" style="background: transparent;border: 1px dashed #0099ff">
          <div class="panel-group" id="accordion">
              <div id="box-img" style="text-align:center">
                  <?php if ($usuario['LOGIN_FACEBOOK']){ ?>
                  <a href="<?=$usuario['LINK_FACEBOOK']?>">
                      <img class="img-thumbnail" data-src="holder.js/140x140" alt="" src="https://graph.facebook.com/<?=$usuario['ID_FACEBOOK']?>/picture?type=large" style="width: 140px; height: 140px;"><br>
                    <label><?=$usuario['NOME']?></label>
                    </a>
                  <?php }else{ ?>
                      <a href="#">
                        <img class="img-thumbnail" data-src="holder.js/140x140" alt="" src="{local}imagens/foto/<?=$usuario['FOTO']?>" style="width: 140px; height: 140px;"><br>
                        <label><?=$usuario['NOME']?></label>
                        </a>
                   <?php } ?>
              </div>
                <!--<img src="{local}imagens/foto/<?= $usuario['FOTO'] ?>" class="img-responsive img-rounded img-circle" style="width: 60%; margin: 0 auto;margin-top: -80px;background-color: #fff;">-->
                <?php $ret= calculaPontuacao($usuario['TITULO_QUALIFICACAO']) ?>
                <input id="input-quali"  type="number" step="1" data-min="0" data-max="5" data-size="xs" data-show-clear="false"  data-readonly="true" data-default-caption="<?php echo round($ret,1) ?> %" value=<?php echo round($ret/20) ?>>
                Saldo: <?= $usuario['SALDO'] ?><br>
                <a href="login/efetuarLogout">Sair</a>
                <!--$quali=  json_decode($data['usuario']['TITULO_QUALIFICACAO'],true);-->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title"> 
                   
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                    </span>Dados Pessoais</a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse ">
                <ul class="list-group">
                     
<!--                  <li class="list-group-item"> <span class="glyphicon glyphicon-comment text-success"></span><a href="http://fb.com/moinakbarali">Alterar Foto de Exibição</a></li>
                    <li class="list-group-item"><span class="glyphicon glyphicon-flash text-success"></span><a href="http://fb.com/moinakbarali">Alterar dados Pessoais</a></li>-->
                    <?php if (is_null($usuario['ENDERECO']) ){
                        echo ' <li class="list-group-item"><span class="glyphicon glyphicon-pencil text-primary"></span>'
                        .'<button type="button" class="btn btn-link" data-toggle="modal" data-target="#meuendereco">Inserir Endereço</button>'
                        . '</li>'; 
                        
                     }else{?>
                     <?php //if ($usuario['ENDERECO']!=0 ){
                    echo ' <li class="list-group-item"><span class="glyphicon glyphicon-pencil text-primary"></span>'
                     .'<button type="button" class="btn btn-link" data-toggle="modal" data-target="#meuendereco">Alterar Endereço</button>'
                            . '</li>'; 
                     }?>
                  

                  <!--<li class="list-group-item"> <span class="glyphicon glyphicon-comment text-success"></span><a href="http://fb.com/moinakbarali">Alterar Senha</a></li>-->

                </ul>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-file">
                    </span>Livros</a>
                </h4>
              </div>
              <div id="collapseFour" class="panel-collapse collapse <?= isset($livro_in)? $livro_in:"" ?>">
               <ul class="list-group">
                     
                  <li class="list-group-item"><span class="glyphicon glyphicon-book text-primary"></span><a href="{base_url}meus_livros">Tenho</a><span class="badge">{numQuantTenho}</span>
                    <ul class="list-group">
                        <li class="list-group-item"><span class="glyphicon glyphicon-bookmark text-primary"></span><a href="{base_url}meus_livros/nao_lidos">Não Li</a><span class="badge">{numQuantNaoLi}</span></li>
                      <li class="list-group-item"><span class="glyphicon glyphicon-bookmark text-primary"></span><a href="{base_url}meus_livros/estou_lendo">Estou lendo</a><span class="badge">{numQuantLendo}</span></li>

                      <li class="list-group-item"><span class="glyphicon glyphicon-ok text-success"></span><a href="{base_url}meus_livros/lidos">Já Li</a><span class="badge">{numQuantLi}</span></li>


                    </ul>
                  </li>

                  <!--<li class="list-group-item"><span class="glyphicon glyphicon-plus text-success"></span><a href="{base_url}meus_livros/desejo_ter">Desejo ter</a></li>-->
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus text-success"></span><a href="{base_url}meus_livros/buscar">Buscar Mais</a></li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus text-success"></span><a href="{base_url}livro/novo">Inserir novo</a></li>

                  <li class="list-group-item"><span class="glyphicon glyphicon-user text-sucess"></span><a href="{base_url}lista/autores">Autores</a></li>

                  <li class="list-group-item"> <span class="glyphicon glyphicon-list text-success"></span><a href="{base_url}lista/editoras">Editoras</a></li>

                </ul>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#pedidos"><span class="glyphicon glyphicon-file">
                    </span>Pedidos</a>
                </h4>
              </div>
              <div id="pedidos" class="panel-collapse collapse <?= isset($pedidos_in)? $pedidos_in:"" ?>">
               <ul class="list-group">
                    <li class="list-group-item"><span class="glyphicon glyphicon-plus text-success"></span><a href="{base_url}meusPedidos/recebidos">Pedidos Recebidos</a></li>
                    <li class="list-group-item"><span class="glyphicon glyphicon-user text-sucess"></span><a href="{base_url}meusPedidos">Pedidos Enviados</a>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="glyphicon glyphicon-userr text-sucess"></span><a href="{base_url}meusPedidos/pendentes">Pendentes</a>
                            <li class="list-group-item"><span class="glyphicon glyphicon-userr text-sucess"></span><a href="{base_url}meusPedidos/aguardando">Aguardando</a>
                                <li class="list-group-item"><span class="glyphicon glyphicon-userr text-sucess"></span><a href="{base_url}meusPedidos/em_andamento">Em Andamento</a>
                                    <li class="list-group-item"><span class="glyphicon glyphicon-userr text-sucess"></span><a href="{base_url}meusPedidos/recusado">Recusado</a>
                        </ul>
                    </li>

                </ul>
              </div>
            </div>
<!--            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"><span class="glyphicon glyphicon-heart">
                    </span>Reports</a>
                </h4>
              </div>
              <div id="collapseFive" class="panel-collapse collapse">
                <div class="list-group">
                  <a href="#" class="list-group-item">
                    <h4 class="list-group-item-heading">List group item heading</h4>
                    <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                  </a>
                </div>
                <div class="list-group">
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
                </div>
              </div>
            </div>-->
          </div>
            <!--<div id="cb_div" align="center"><iframe id="cb_iframe" width="180" height="200" frameborder="0" allowtransparency="allowtransparency" scrolling="no" src="http://www.calendario.com.br/calendario_peq/calendario_peq.php"></iframe>  <br /><div id="cb_urllink"></div></div>-->
        </div>
       
<?php

function calculaPontuacao($json) {
    $Votantes=0;$porcentagem=0;$pontuacaoVoto=0;
//$json='{"1":0,"2":0,"3":0,"4":0,"5":0} ';
   
 $quali =  json_decode($json,true);
 
foreach($quali as $key=>$q){
	$pontuacaoVoto += $key*$q;
	if ($q>0){
		$Votantes += $q;
	}
	
}
if($Votantes!=0){
    $porcentagem = ((100*$pontuacaoVoto)/($Votantes*5));
    
}
//$porcentagem=6;
//$porcentagem = $porcentagem/20;
//echo $pontuacaoVoto. " de " .$Votantes*5 ."<br>";


return $porcentagem;
}

?>   