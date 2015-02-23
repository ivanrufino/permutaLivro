<style>
    /*Para a lista navegavel*/
    .listNav { margin:0 0 10px; }
.ln-letters { overflow:hidden; }
.ln-letters a { font-size:0.9em; display:block; float:left; padding:2px 6px; border:1px solid silver; border-right:none; text-decoration:none; }
.ln-letters a.ln-last { border-right:1px solid silver; }
.ln-letters a:hover,
.ln-letters a.ln-selected { background-color:#eaeaea; }
.ln-letters a.ln-disabled { color:#ccc; }
.ln-letter-count { text-align:center; font-size:0.8em; line-height:1; margin-bottom:3px; color:#336699; }
/*fim da lista navegavel*/
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
    $(document).ready(function(){
        $(".livrosBuscados .mnblocos").on('click',function(){
            alert($(this).attr('codigo'))
        })
         $(".ultimosInseridos .mnblocos").hover(function(){
            $(".option",this).slideDown();
        },function(){
             $(".option",this).slideUp();
        });
        $('#myList').listnav();
        
    })
      
</script>
<div class="container-alternate">
    <div class="container">
        {view_lateral}
        <div class="col-md-9" style="background: transparent">
           
            <div class="col-md-12 editora blocos">
                <fieldset>
                    <legend>Editoras</legend>
                    <div id="myList-nav"></div>
                    <ul id="myList">
                    <?php foreach ($editoras as  $editora) {
                        echo "<li><a href='{base_url}livro/buscar/editora/$editora[EDITORA]'>".url_title($editora['EDITORA'], ' ')."</a></li>";
                    }?>
                    </ul>
                    <!--mostrar capa, titulo e autor dos livros que colocaram a disposição-->
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
