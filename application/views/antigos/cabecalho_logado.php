<link href='http://fonts.googleapis.com/css?family=Meddon' rel='stylesheet' type='text/css'>
<link href='//cdn.datatables.net/1.10.3/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

<script>
    $(document).ready(function() {
//    $('.table').dataTable( {
//        "order": [[ 3, "desc" ]]
//    } );
} );
    changeClassBody('marginTop125');
</script>
<input type='hidden' class='base_url' value='{base_url}' readonly="">
<div class="row hide" >

    <div class="navbar-right pull-right hidden-xs">
        <img class="pic img-circle imgPerfil " src="{base_url}assets/fotos/{pasta}{foto}" alt="Foto de Perfil">
    </div>
    <div class="panel_img " style="background-image: url('{local}imagens/background-default.jpg'); height: 115px">



        <div class="navbar-nav navbar-right pull-right" style="width: 140px; ">

            <ul class="nav  navbar-right config">
                <li class="dropdown">
                    <a href="#" class=" btn btn-info"  data-toggle="dropdown">Config <b class="caret"></b></a>
                    <!--<a href="#" class=" btn btn-info  " style="position: relative; right: -158px;" data-toggle="dropdown">Config <b class="caret"></b></a>-->
                    <ul class="dropdown-menu">
                        <li   class="well">

                            <div class='text-center '>
                                <img class="img-responsive visible-xs imgPerfil" style="padding:8%;" src="{base_url}assets/fotos/{pasta}{foto}" alt="Foto de Perfil"/>

                                <a class="config btn btn-sm btn-default alterarImagem " data-ctrl="{base_url}{pasta}uploadImagem/{codigo}/{foto}" style="width: 120px" data-toggle="modal" href="#updateImage">
                                    <i class="glyphicon glyphicon-user"></i> Mudar Imagem </a>

                            </div>
 <a href="{base_url}{ref}"  class="config btn btn-sm btn-default"><i class="glyphicon glyphicon-cog"></i> Home</a> 
                            <a href="{base_url}{ref}configuracao"  class="config btn btn-sm btn-default config"><i class="glyphicon glyphicon-cog"></i> Configura&ccedil;&otilde;es</a>                            
                            <a href="{base_url}login/efetuarLogout" class=" config btn btn-sm btn-default logout"><i class="glyphicon glyphicon-log-out"></i> Sair</a>

                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--NOVO MENU-->
<div class="col-sm-4 col-xs-6" >
    <a class="navbar-brand logo-nav text-center" href="{base_url}" style="font-family: 'Meddon', cursive;font-size: 2em;"><img class="" src="{local}imagens/logo.png"  style="height: 80px">Siscorem</a>
</div>
<div class="col-sm-5 col-xs-6"style="background: rgba(0,200,200,0.5)">

</div>
<div class="col-xs-3 col-xs-offset-9 col-sm-offset-0">
    <div class="navbar-right pull-right ">
        <img class="pic img-circle imgPerfil pull-right hidden-xs" src="{base_url}assets/fotos/{pasta}{foto}" alt="Foto de Perfil">
        <a href="#" class="btn btn-default pull-right"  data-toggle="dropdown">{nome} <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li   class="well">
                <div class='text-center '>
                    <img class="img-responsive visible-xs imgPerfil" style="padding:8%;" src="{base_url}assets/fotos/{pasta}{foto}" alt="Foto de Perfil"/>
<!--                    <a class="config btn btn-sm btn-default alterarImagem" data-ctrl="{base_url}{pasta}uploadImagem/{codigo}/{foto}"  data-toggle="modal" href="#updateImage">
                        <i class="glyphicon glyphicon-user"></i> Mudar Imagem </a>-->

                </div>
 <a href="{base_url}{ref}"  class="config btn btn-sm btn-default"><i class="glyphicon glyphicon-home"></i> Home</a> 
                 <a class="config btn btn-sm btn-default alterarImagem" data-ctrl="{base_url}{pasta}uploadImagem/{codigo}/{foto}"  data-toggle="modal" href="#updateImage">
                        <i class="glyphicon glyphicon-user"></i> Mudar Imagem </a>
                <a href="{base_url}{ref}configuracao"  class="config btn btn-sm btn-default config"><i class="glyphicon glyphicon-cog"></i> Configura&ccedil;&otilde;es</a>                            
                <a href="{base_url}login/efetuarLogout" class=" config btn btn-sm btn-default logout"><i class="glyphicon glyphicon-log-out"></i> Sair</a>

            </li>
        </ul>
    </div>
</div>
