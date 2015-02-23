<style>
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
    .row{margin-bottom: 15px !important;}
</style>
<script>
    $(document).ready(function(){
        
    })
      
</script>
<div class="container-alternate">
    <div class="container">
        {view_lateral}
        <div class="col-md-9" style="background: transparent">
            <div class="col-md-12  blocos">
                <span class="alert alert-danger  col-md-12"> Preencha corretamente as informações solicitadas.<br>
                    <strong>Isso é importante para que as buscas sejam feitas com exatidão.</strong><br>
                    <ul><strong>Dicas importantes:</strong>
                        <li>Preste sempre atenção na ortografia</li>
                        <li>Verifique corretamente o nome do autor e editora</li>
                        <li>Busque pela capa dos livros nos buscadores (google, bing, etc)</li>
                    </ul>
                    
                </span>
                <br>
                <?php echo $this->session->flashdata('msg') ?>
                
                <form action="{base_url}livro/doLivro" method="POST">
                    <div class="col-md-3">
                        <img src="<?=  base_url()?>assets/imagens/capa/semcapa.jpg" class="capa img-responsive" style="margin:0 auto"><br>
                        <input type="file" name="foto" class="form-control" placeholder="Insira uma foto"><br>
                    </div>
                    <div class="col-md-9">
                        <span class="col-md-6 row"> 
                            <label for="titulo">Título</label>
                            <input type="text" name="" id="titulo"class="form-control" value="<?php echo set_value('titulo'); ?>" placeholder="Digite o titulo">
                        </span>   
                        
                        <span class="col-md-6 row col-md-offset-0">
                            <label for="autor">Autor</label>
                            <input type="text" name="autor" class="form-control" value="<?php echo set_value('autor'); ?>" placeholder="Digite o autor">
                        </span>
                        <span class="col-md-4 row">
                        <label for="ano">Ano</label>
                        <input type="number" name="ano" class="form-control" value="<?php echo set_value('ano'); ?>" placeholder="Digite o ano">
                        </span>
                         <span class="col-md-4 col-md-offset-0 row">
                        <label for="edicao">Edicao</label>
                        <input type="text" name="edicao" class="form-control" value="<?php echo set_value('edicao'); ?>" placeholder="Digite o edição">
                         </span>
                         <span class="col-md-4 col-md-offset-0 row">
                        <label for="pagina">Páginas</label>
                        <input type="number" name="pagina" class="form-control" value="<?php echo set_value('pagina'); ?>" placeholder="Digite o número de paginas">
                         </span>
                         <span class="col-md-6 row">
                        <label for="editora">Editora</label>
                        <input type="text" name="editora" class="form-control" value="<?php echo set_value('editora'); ?>" placeholder="Digite o Editora">
                         </span>
                         <span class="col-md-6 col-md-offset-0 row">
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" class="form-control" value="<?php echo set_value('isbn'); ?>" placeholder="Digite o ISBN">
                         </span>
                        <input type="submit" class="btn btn-success btn-md" value="Cadastrar Novo">
                        <br><br>
                    </div>
                    
                </form>
                <?php if (validation_errors()!= false){ ?>
                <span class="alert alert-danger col-md-12">
                    <strong>Corrija os erros encontrados:</strong>
                    <?php echo validation_errors(); ?> 
                </span>
                <?php }?>
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
