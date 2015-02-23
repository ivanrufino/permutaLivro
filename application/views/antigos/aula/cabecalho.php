<script>
    $(document).ready(function(){
        $(this).attr("title","Aulas do Ivan");
    })
</script>
<!-- Cabe�alho com menu-->       
<div class="navbar-header ">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand logo-nav" href="{base_url}"><img class="" src="{local}imagens/logo.png"  height="35">Siscorem</a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav navbar-right">
        <!--<li ><a href="" class="btn btn-default voltar" ><i class=" glyphicon glyphicon-arrow-left"></i> Voltar </a></li>-->
        <!--<li ><a href="{base_url}" class="btn btn-default" ><i class="glyphicon glyphicon-home"></i> Home </a></li>-->
        <?php if (isset($labelLogin)){ ?>
            <!--<li><a href="{lnklogin}" class="btn btn-info" ><i class="glyphicon glyphicon-user"> </i> {labelLogin} </a></li>-->
        <?php }?>
    </ul>
</div><!-- /.navbar-collapse -->