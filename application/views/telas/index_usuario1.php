<style>
    .blocos{
        border:1px dashed grey;
        margin:5px 5px 1px;
    }
    .blocos:first-child{margin-top: 0px}
    
</style>
<div class="container-alternate">
    <div class="container">
        {view_lateral}
        <div class="col-md-9" style="background: transparent">
            <div class="col-md-12 recados blocos">
                <fieldset>
                    <legend>Recados</legend>
                    <?=$meusrecados; ?>
                    <?php /*if ($meusrecados>0) {?>
                        <div class="alert alert-info"> Você tem <strong><?='0' ?></strong> novos recados. <br>
                            <br>
                            <a href="meus_recados" >Clique para vê-los</a>
                        </div>
                    <?php    
                    }*/ ?>
                </fieldset>
                </div>
            <div class="col-md-12 livrosBuscados blocos">
                <fieldset>
                    <legend>Livros que você deseja estao a disposição</legend>
                    mostrar capa, titulo e autor dos livros que colocaram a disposição
                    <br>//quando eu faço um pedido de livro que ninguem tem, este livro vai para pedidos
                    <br>//com o usuario_de vazio, e quando um usuario disse que tem aquele livro (buscar na estantevirtual de todos)
                    indico para o usurio atual
                </fieldset>
            </div>
            <div class="col-md-12 ultimosInseridos blocos">
                <fieldset>
                    <legend>Livros inseridos no sistema</legend>
                    mostrar capa, titulo e autos dos livros cadastrados no sistema
                    
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
