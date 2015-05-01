<style>
     .mnblocos{border: 1px solid grey; text-align: center}
    .resultadoLivro { min-height: 250px}
    .resultadoLivro img{margin: 0 auto}
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
  $(document).ready(function(){
         $(".resultadoLivro ").hover(function(){
            $(".option",this).slideDown();
        },function(){
             $(".option",this).slideUp();
        })
        
    })
</script>

<!-- <fieldset>
    <legend>Livros desejados </legend>
    <?php /*foreach ($livros as $key => $value) { ?>
        <div class="col-md-4 resultadoLivro mnblocos" >
            <img src="<?=  base_url()?>assets/imagens/capa/<?= $value['FOTO']; ?>" class="capa img-responsive">
            <?=  character_limiter($value['TITULO'], 40); ; ?><br>
            <span style="font-weight: bold"><?= $value['AUTOR']; ?></span><br>
            <span class="option">
                <?php $slug = url_title($value['TITULO'], '_', TRUE)."_".$value['CODIGO'].".html";?>
                <a href="<?=  base_url('livro/detalhes/').'/'.$slug?>" class="detalhe">Detalhe</a>
                <!--<a href="" class="tenho">Tenho</a>-->
            </span>
        </div>
        <!--echo $value['id'];-->
    <?php }*/
    ?>

</fieldset>-->
<?php 
$legenda = 'Livros Encontrados';
$classe="";
$botoes=null;
montarGrid($livros, $classe, $legenda, $botoes) ?>
<?php
function montarGrid($livros,$classe,$legenda,$botoes){ 
     
   
    echo "<div class='table-responsive clearfix'>";
    echo "<h1 class='titulo_legenda'>$legenda</h1>";
echo "<table class='table table-bordered table-striped table-hover table-condensed table-responsive'>";

    foreach ($livros as $key => $value) {
       
      $codlivro = isset($value['COD_LIVRO'])?$value['COD_LIVRO']:$value['CODIGO'];
        echo"<tr>";
        $codPedido=isset($value['CODIGO'])?"_".$value['CODIGO']:"";
        $slug = url_title($value['TITULO'], '_', TRUE) .$codPedido. ".html"; 
        echo "<td style='width:100px;text-align:center'><img src='".  base_url() ."assets/imagens/capa/".$value['FOTO']." ' class=' img-responsive' style='width:60px'> </td>";
        echo "<td style='vertical-align: middle;'>".$value['TITULO']."<br>". $value['AUTOR'];
        if (isset($value['QUANTIDADE'])){echo "<br><strong class=' alert-info'>".$value['QUANTIDADE']." usuários leram ou estão lendo este livro</strong>";}
        echo "</td>";
//        echo "<td  nowrap style='text-align:center;vertical-align: middle;'>";
//        $linkEdita="";
//        $mostrarRecusado=false;
//        switch ($value['STATUS']) {
//            case '0':
//               echo "{$value['NOME_USUARIO_DE']} <br><span class='alert-danger'>recusou seu pedido</span>";
//                $mostrarRecusado=TRUE;
//                break;
//            case '1':
//                 if(is_null($value['COD_USUARIO_DE'])){
//                      echo "<span class='alert alert-danger'>Sem usuário</span>";
//                        $mostrarRecusado=TRUE;
//                 }else{
//                    echo "{$value['NOME_USUARIO_DE']} <br><span class='alert-info'>ainda não respondeu </span>";
//                 }
//                
//                break;
//            case '2':
//               echo "<span class='alert-info'>Pedido em andamento de</span><br>{$value['NOME_USUARIO_DE']}";
//                
//                break;
//            default:
//                break;
//        }
//        
////            if(is_null($value['COD_USUARIO_DE'])){
////             echo "<span class='alert alert-danger'>Sem usuário</span>";
////                 $mostrarRecusado=TRUE;
////            }
//        
//        
//      
//        echo "</td>";
        echo "<td style='text-align:center;vertical-align: middle;'>";
//        echo $linkEdita;
      // echo '<button type="button"  data-toggle="modal" data-target="#edit_livro_modal" data-codLivro="'.$codlivro.'" data-tituloLivro="'.$value['TITULO'].'" class="btn btn-success btn-lg navbar-btn  "><i class="fa fa-edit"></i> &nbsp;Editar</button>'; 
        $slug = url_title($value['TITULO'], '_', TRUE)."_".$value['CODIGO'].".html";
        echo "<a href='".base_url('livro/detalhes/')."/".$slug. "' class='detalhe'>Detalhe</a>"; 
    //<a href='".base_url($btn['link']) . '/' . $slug ."' class='detalhe btn ".$btn['class']."'>".$btn['titulo']." </a>";
//            foreach ($botoes as $btn) {
//                 if($mostrarRecusado && $btn['mostrar']=="L"){
//                    echo "<a href='".base_url($btn['link']) . '/' . $slug ."' class='detalhe btn ".$btn['class']."'>".$btn['titulo']." </a>";
//                   
//                 }else if ($btn['mostrar']=="T"){
//                     echo "<a href='".base_url($btn['link']) . '/' . $slug ."' class='detalhe btn ".$btn['class']."'>".$btn['titulo']." </a>";
//                 }
//               
//            }
        echo "</td>";
        
        echo"</tr>";
        
    }
echo "</table></div>";
 }
 ?>

