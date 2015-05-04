<style>
    a.detalhe:not(:first-child){margin-left: 10px}
    img.capa{width: 100px}
    .blocos{
        border:1px dashed grey;
        margin:15px 5px ;
    }
    .blocos:first-child{margin-top: 0px}
    .livrosBuscados .mnblocos{background: rgba(5, 212, 249, 0.16);border: 1px solid green; height: 200px;text-align: center}
    .ultimosInseridos .mnblocos{background: rgba(96, 249, 71, 0.27);border: 1px solid grey; height: 200px;text-align: center}
    .mnblocos img{width: 75px; height: 120px;margin: 0 auto;padding-top: 5px}

    .livrosBuscados .mnblocos:hover{background: #99ff99;font-weight: bold}
    .autor{font-weight: normal}
    .option{position: absolute;top: 150px;left: 0;background: white;width: 100%;display: none;height: 40px;line-height: 40px}
    .option a{
        color: black;
        margin: 0px 17px;
        font-size: 20px;
        text-decoration: none;

    }
    .option a:hover{color: blue}
    .option a.quero{
        float: left;
    }
    .option a.tenho{
        float: right;
    }
</style>
<script>
    $(document).ready(function () {
        $(".livrosBuscados .mnblocos").on('click', function () {
            alert($(this).attr('codigo'))
        })
        $(".ultimosInseridos .mnblocos").hover(function () {
            $(".option", this).slideDown();
        }, function () {
            $(".option", this).slideUp();
        })
        $('.close.me').click(function(){
            $(this).parent().parent().slideUp();
            
        });
        
    })

</script>
<div class="container-alternate">
    <div class="container">
        {view_lateral}
        <div class="col-sm-9 col-md-9 col-xs-8" style="background: transparent">
            
            <?php if(!is_null($meusrecados)){?>
            <div class="col-md-12 recados blocos">
                <fieldset>
                    <legend>Recados</legend>
                    <?= $meusrecados; ?>
                </fieldset>
            </div>
            <div class="clearfix"></div>
            <?php }?>
            
            <?php if ($queroLivros) { 
                $legenda="Livros de sua lista de desejos estão a disposição";
                $btn_link=array(
                    array('link'=>'pedido/selecionarUsuarioPedido/','class'=>'btn-success','titulo'=>"Listar Usuários"),
                  
                );
                montarGrid($queroLivros, 'livrosBuscados', $legenda,$btn_link); } ?>
            
             <?php if ($livroRecomendados) { 
                $legenda="Livros recomendados para você.";
                $btn_link=array(
                    array('link'=>'pedido/selecionarUsuarioPedido/','class'=>'btn-success','titulo'=>"Listar Usuários"),
                  
                );
                montarGrid($livroRecomendados, 'livrosBuscados', $legenda,$btn_link); } ?>
            
              <?php if ($usuarioLinkados) { 
                switch ($usuarioLinkados) {
                    case 1:
                       $legenda="Usuario que você gostaria de conhecer";
                         break;
                    default:
                         $legenda="Usuarios que você gostaria de conhecer";
                        break;
                }
                //$legenda="Este(s) usuário(s) fora(m) selecionado por terem o mesmos livros que você e mais";
                $btn_link=array(
                    array('link'=>'pedido/selecionarUsuarioPedido/','class'=>'btn-success','titulo'=>"Ver Livros"),
                    array('link'=>'usuario/seguir/','class'=>'btn-success','titulo'=>"Seguir Usuário"),
                  
                );
                montarGridUsuario($usuarioLinkados, 'livrosBuscados', $legenda,$btn_link); } ?>
            
            <?php if ($ultimosLivros) { 
                $legenda="Últimos livros inseridos no sistema";
               
                $btn_link=array(
                    array('link'=>'pedido/selecionarUsuarioPedido/','class'=>'btn-info','titulo'=>"Solicitar de um usuário"),
                     array('link'=>'estantevirtual/adcionarLivro/','class'=>'btn-success','titulo'=>"Adcionar na Biblioteca virtual")
                );
                montarGrid($ultimosLivros, 'ultimosInseridos', $legenda,$btn_link); 
               
                 } ?>
            
            <?php if ($maisLidos) { 
                $legenda="Livros mais lidos pelos usuários";
               
                $btn_link=array(
                    array('link'=>'pedido/selecionarUsuarioPedido/','class'=>'btn-info','titulo'=>"Solicitar de um usuário"),
//                    array('link'=>'estantevirtual/adcionarLivro/','class'=>'btn-info','titulo'=>"Detalhes2"),
                     array('link'=>'estantevirtual/adcionarLivro/','class'=>'btn-success','titulo'=>"Adcionar na Biblioteca virtual")
                    
                );
                montarGrid($maisLidos, 'ultimosInseridos', $legenda,$btn_link); 
               
                 } ?>

        </div>
    </div>
    <br>
</div>

<div class="col-md-12">
    <footer>
        Direitos reservados
    </footer>
</div>
<?php 
 function montarGridUsuario($usuario,$classe,$legenda,$botoes){
     //print_r($usuario);
    echo "<div class=''>";
    echo "<h1 class='titulo_legenda'>$legenda <span class='fa fa-times floatRight close me' style='floatRight'></span></h1>";
    
echo "<table class='table table-bordered table-striped table-hover table-condensed '>";

    foreach ($usuario as $key => $value) {
        echo"<tr>";
        $value['LOGIN_FACEBOOK']=false;
        //$slug = url_title($value['TITULO'], '_', TRUE) .$codPedido. "_" . $value['CODIGO'] . ".html"; 
        echo "<td style='width:100px;text-align:center'>";
        if ($value['LOGIN_FACEBOOK']){
            echo "<img src='https://graph.facebook.com/".$value['ID_FACEBOOK']."/picture?type=large' class=' img-responsive'>";
        }else{
            echo "<img src='{local}imagens/foto/".$value['FOTO_USUARIO']." ' class=' img-responsive' style='width:60px'>";
        }
        echo "</td>";
        echo "<td style='vertical-align: middle;'>";
         if ($value['LOGIN_FACEBOOK']!=""){
              echo "<a href='".$value['LINK_FACEBOOK']."'> ".$value['NOME']."</a>";
         }else{
              echo $value['NOME'];
         }
         echo "<br>";
         if(!is_null($value['CIDADE'])){
            echo $value['CIDADE']."/". $value['ESTADO']."</td>";
         }else{
             echo "Usuário não informou endereço";
         }
        echo "<td style='text-align:center;vertical-align: middle;'>";
            foreach ($botoes as $btn) {
            echo "<a href='".base_url($btn['link']) . '/' . $value['CODIGO']."' class='detalhe btn bt-xs".$btn['class']."'>".$btn['titulo']." </a>";
            }
        echo "</td>";
        echo"</tr>";
        
    }
echo "</table></div>";
}
function montarGrid($livros,$classe,$legenda,$botoes){ 
     
    echo "<div class=''>";
    echo "<h1 class='titulo_legenda'>$legenda <span class='fa fa-times floatRight close me' style='floatRight'></span></h1>";
echo "<table class='table table-bordered table-striped table-hover table-condensed'>";

    foreach ($livros as $key => $value) {
      $codlivro = isset($value['COD_LIVRO'])?$value['COD_LIVRO']:$value['CODIGO'];
        echo"<tr>";
        $codPedido=isset($value['COD_PEDIDO'])?"_".$value['COD_PEDIDO']:"";
        $slug = url_title($value['TITULO'], '_', TRUE) .$codPedido. "_" . $codlivro . ".html"; 
        echo "<td style='width:100px;text-align:center'><img src='{local}imagens/capa/".$value['FOTO']." ' class=' img-responsive' style='width:60px'> </td>";
        echo "<td style='vertical-align: middle;'>".$value['TITULO']."<br>". $value['AUTOR'];
        if (isset($value['QUANTIDADE'])){echo "<br><strong class=' alert-info'>".$value['QUANTIDADE']." usuários leram ou estão lendo este livro</strong>";}
        echo "</td>";
        echo "<td style='text-align:center;vertical-align: middle;'>";
            foreach ($botoes as $btn) {
            echo "<a href='".base_url($btn['link']) . '/' . $slug ."' class='detalhe btn btn-xs ".$btn['class']."'>".$btn['titulo']." </a>";
            }
        echo "</td>";
        echo"</tr>";
        
    }
echo "</table></div>";
 }
?>











































