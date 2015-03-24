<style>
    .blocos{
        border:1px dashed grey;
        margin:15px 5px ;
    }
    .blocos:first-child{margin-top: 0px}
    /*.livrosBuscados .mnblocos{background: rgba(5, 212, 249, 0.16);border: 1px solid green; height: 200px;text-align: center}*/
    .ultimosInseridos .mnblocos{border: 1px solid #fff; min-height: 200px;text-align: center;margin-bottom: 10px}
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
    .c_pendente{ border: 1px solid blue !important;  }
    .c_recusado{border: 1px solid red !important;}
    .c_aguardando{border: 1px solid yellow !important;}
    .c_aceito{border: 1px solid green !important;}
</style>
<script>
    $(document).ready(function(){
        $(".livrosBuscados .mnblocos").on('click',function(){
            alert($(this).attr('codigo'))
        })
         $(".ultimosInseridos .mnblocos").hover(function(){
            $(".option",this).slideDown();
        },function(){
             $(".option",this).slideUp();
        })
        
    })
      
</script>
<div class="container-alternate">
    <div class="container">
        {view_lateral}
        <div class="col-md-9" style="background: transparent">
           
            <div class="col-md-12 livrosBuscados blocos alert alert-info">
                <fieldset class="alert">
                    <legend>Encontre mais livros</legend>
                    Use a tela de busca para encontrar mais livros <br>
                    <a href="{base_url}meus_livros/buscar" class="btn btn-info btn-md">ir para "Buscar Livro"</a>
                    
                  
                    <!--mostrar capa, titulo e autor dos livros que colocaram a disposição-->
                </fieldset>
                </div>
            <?php 
            if ($livrosDesejados){
                $btn_link=array( /*mostrar apenas para recusados e sem usuario | mostrar=L , L de limitado, t de todos */
                    array('link'=>'pedido/remover/','class'=>'btn-info','mostrar'=>'L','titulo'=>"Remover"),
                    array('link'=>'pedido/detalhes/','class'=>'btn-info','mostrar'=>'T','titulo'=>"Detalhes"),
                    //array('link'=>'pedido/selecionarUsuarioPedido/','class'=>'btn-info','mostrar'=>'T','titulo'=>"Editar"),
                  
                );
               $titulo_legenda="Meus Pedidos";
                montarGrid($livrosDesejados, "" , $titulo_legenda, $btn_link);
            }else{
                echo "<div class='col-md-12 alert alert-warning '><strong>Atenção</br></strong>Não há livros em sua lista de pedidos.</div>";
            }
                ?>
     <?php /*      <div class="col-md-12 ultimosInseridos blocos">
                <fieldset>
                    <legend>Meus Pedidos</legend>
                     <?php 
                     if ($livrosDesejados){
                   foreach ($livrosDesejados as $key => $value) { ?>
                    <div class="col-md-4 mnblocos"   >
                        <div class="<?= $value['class']; ?>">
                        <img src="{local}imagens/capa/<?= $value['FOTO']; ?>" class="capa img-responsive">
                        <?=  character_limiter($value['TITULO'], 40); ; ?><br>
                        <strong> <?= $value['AUTOR']; ?></strong><br>
                        
                        <span class="option">
                           <?php $slug = url_title($value['TITULO'], '_', TRUE)."_".$value['CODIGO'].".html";?>
                            <a href="<?=  base_url('pedido/detalhes/').'/'.$slug?>" class="detalhe">Detalhe</a>
                            <!--<a href="" class="tenho">Tenho</a>-->
                        </span>
                        </div>
                    </div>
                        <!--echo $value['id'];-->
                     <?php } }else{
                        echo "<div class='col-md-12 alert alert-warning '><strong>Atenção</br></strong>Não há livros em sua lista de pedidos.</div>";
                     }
                    ?>
                    
                </fieldset>
            </div> */ ?>
            <br>
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
function montarGrid($livros,$classe,$legenda,$botoes){ 
     
   
    echo "<div class='table-responsive clearfix'>";
    echo "<h1 class='titulo_legenda'>$legenda</h1>";
echo "<table class='table table-bordered table-striped table-hover table-condensed table-responsive'>";

    foreach ($livros as $key => $value) {
       
      $codlivro = isset($value['COD_LIVRO'])?$value['COD_LIVRO']:$value['CODIGO'];
        echo"<tr>";
        $codPedido=isset($value['CODIGO'])?"_".$value['CODIGO']:"";
        $slug = url_title($value['TITULO'], '_', TRUE) .$codPedido. ".html"; 
        echo "<td style='width:100px;text-align:center'><img src='{local}imagens/capa/".$value['FOTO']." ' class=' img-responsive' style='width:60px'> </td>";
        echo "<td style='vertical-align: middle;'>".$value['TITULO']."<br>". $value['AUTOR'];
        if (isset($value['QUANTIDADE'])){echo "<br><strong class=' alert-info'>".$value['QUANTIDADE']." usuários leram ou estão lendo este livro</strong>";}
        echo "</td>";
        echo "<td  nowrap style='text-align:center;vertical-align: middle;'>";
        $linkEdita="";
        $mostrarRecusado=false;
        switch ($value['STATUS']) {
            case '0':
               echo "{$value['NOME_USUARIO_DE']} <br><span class='alert-danger'>recusou seu pedido</span>";
                $mostrarRecusado=TRUE;
                break;
            case '1':
                 if(is_null($value['COD_USUARIO_DE'])){
                      echo "<span class='alert alert-danger'>Sem usuário</span>";
                        $mostrarRecusado=TRUE;
                 }else{
                    echo "{$value['NOME_USUARIO_DE']} <br><span class='alert-info'>ainda não respondeu </span>";
                 }
                
                break;
            case '2':
               echo "<span class='alert-info'>Pedido em andamento de</span><br>{$value['NOME_USUARIO_DE']}";
                
                break;
            default:
                break;
        }
        
//            if(is_null($value['COD_USUARIO_DE'])){
//             echo "<span class='alert alert-danger'>Sem usuário</span>";
//                 $mostrarRecusado=TRUE;
//            }
        
        
      
        echo "</td>";
        echo "<td style='text-align:center;vertical-align: middle;'>";
//        echo $linkEdita;
      // echo '<button type="button"  data-toggle="modal" data-target="#edit_livro_modal" data-codLivro="'.$codlivro.'" data-tituloLivro="'.$value['TITULO'].'" class="btn btn-success btn-lg navbar-btn  "><i class="fa fa-edit"></i> &nbsp;Editar</button>'; 
        
            foreach ($botoes as $btn) {
                 if($mostrarRecusado && $btn['mostrar']=="L"){
                    echo "<a href='".base_url($btn['link']) . '/' . $slug ."' class='detalhe btn ".$btn['class']."'>".$btn['titulo']." </a>";
                   
                 }else if ($btn['mostrar']=="T"){
                     echo "<a href='".base_url($btn['link']) . '/' . $slug ."' class='detalhe btn ".$btn['class']."'>".$btn['titulo']." </a>";
                 }
               
            }
        echo "</td>";
        
        echo"</tr>";
        
    }
echo "</table></div>";
 }
 ?>