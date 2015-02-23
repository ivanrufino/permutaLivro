<div class="row">
    <div class="col-lg-3 ">
        <!-- INICIO MENU -->
        <div class="accordion" id="leftMenu" >
            
            <?php 
            foreach ($menu as $categoria) {                
                //echo $categoria['descricao'];?>
            <div class="accordion-group">
                <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#cat_<?=$categoria['idCategoria']?>">
                    
                    
                        <i class="<?=$categoria['icone']?>"></i> <?=$categoria['descricao']?>
                    
                </a>
                    </div>
                <div id="cat_<?=$categoria['idCategoria']?>" class="accordion-body collapse" style="height: 0px; ">
                    <div class="accordion-inner">
                        <ul>
            <?php
                
            foreach ($categoria['subcat'] as $subcategoria) {
              // echo $subcategoria['descricao'];
                echo "<li><a class='prod' produto='".$subcategoria['idSubcategoria']."' href='{base_url}produtos/lista_produtos/".$subcategoria['idSubcategoria'].".html'>".$subcategoria['descricao']."</a></li>";
                }?>
                </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php for($x=0;$x<0;$x++){?>
                <div class="accordion-group">
                    <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#id_<?=$x?>">
                    
                    
                        <i class="glyphicon glyphicon-th"></i> Layout <?=$x?>
                    
                </a>
                        </div>
                <div id="id_<?=$x?>" class="accordion-body collapse" style="height: 0px; ">
                    <div class="accordion-inner">
                        <ul>
                            <li><a href="lista_produtos.html">Produto 1</a></li>
                            <li>This is two</li>
                            <li>This is Three</li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php }?>
            <!--
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#">
                        <i class="glyphicon glyphicon-home"></i> Dashboard
                    </a>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseTwo">
                        <i class="glyphicon glyphicon-th"></i> Layout
                    </a>
                </div>
                <div id="collapseTwo" class="accordion-body collapse" style="height: 0px; ">
                    <div class="accordion-inner">
                        <ul>
                            <li><a href="lista_produtos.html">Produto 1</a></li>
                            <li>This is two</li>
                            <li>This is Three</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseThree">
                        <i class="glyphicon glyphicon-list"></i> UI Components
                    </a>
                </div>
                <div id="collapseThree" class="accordion-body collapse" style="height: 0px; ">
                    <div class="accordion-inner">
                        <ul>
                            <li>This is one</li>
                            <li>This is two</li>
                            <li>This is Three</li>
                        </ul>                 
                    </div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseFour">
                        <i class="glyphicon glyphicon-list-alt"></i> Forms
                    </a>
                </div>
                <div id="collapseFour" class="accordion-body collapse" style="height: 0px; ">
                    <div class="accordion-inner">
                        <ul>
                            <li>This is one</li>
                            <li>This is two</li>
                            <li>This is Three</li>
                        </ul>                 
                    </div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseFive">
                        <i class="glyphicon glyphicon-cog"></i> Plugins
                    </a>
                </div>
                <div id="collapseFive" class="accordion-body collapse" style="height: 0px; ">
                    <div class="accordion-inner">
                        <ul>
                            <li>This is one</li>
                            <li>This is two</li>
                            <li>This is Three</li>
                        </ul>                 
                    </div>
                </div>
            </div>
            <div class="accordion-group">                
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseSix">
                        <div class="accordion-heading">
                        <i class="glyphicon glyphicon-file"></i> Templates
                        </div>
                    </a>                
                <div id="collapseSix" class="accordion-body collapse" style="height: 0px; ">
                    <div class="accordion-inner">
                        <ul>
                            <li>This is one</li>
                            <li>This is two</li>
                            <li>This is Three</li>
                        </ul>                 
                    </div>
                </div>
            </div>
        --></div>
        <!-- FIM MENU -->
        <h2>Heading 1</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sollicitudin auctor quam ac tempor. Cras a ante sed libero mollis sodales. Praesent fringilla, neque ut ultrices faucibus, dolor eros ultrices neque, nec bibendum arcu ipsum eget justo.</p>
        <a class="btn btn-default" href="#">More Info</a>
    </div>
    <div class="col-lg-8">
        <div class="row text-center " id="listaProdutos">
        Selecione uma subcategoria
            </div><!-- /.row -->
    </div>
    <div class="col-lg-1">
        <h2>Heading 3</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sollicitudin auctor quam ac tempor. Cras a ante sed libero mollis sodales. Praesent fringilla, neque ut ultrices faucibus, dolor eros ultrices neque, nec bibendum arcu ipsum eget justo.</p>
        <a class="btn btn-default" href="#">More Info</a>
    </div>
</div>
<script>
$(document).ready(function(){
    $(".prod").click(function(){
        var carregar=($(this).attr('href'))
        var top=$("#listaProdutos").offset().top-150;
        
        $( "#listaProdutos" ).load(carregar);
        $('html,body').stop().animate({scrollTop: top}, 2000);
        //$('html,body').animate({scrollTop: 100},'slow');
        return false;
    })
    
})
</script>