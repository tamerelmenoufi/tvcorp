<?php
/*
    $query = "select * from login where codigo = '".$_SESSION['painel_usuario_logado']."'";
    $result = mysql_query($query);
    $d = mysql_fetch_object($result);
*/
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Sistema Gestão de TV-Corporativo</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Bem-Vindo(a): <?=utf8_decode($Conf->nome)?></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ações <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <!--<li><a href="#">Editar Cadastro</a></li>
            <li><a href="#">Alterar Senha</a></li>-->
            <?php
            if($Conf->perfil == 'gestor'){
            ?>
            <li><a gestores href="#">Gestores</a></li>
            <li role="separator" class="divider"></li>
            <?php
            }
            ?>
            <li><a href="?s=1">Sair</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<script>
    
    $(function(){
        $("a[gestores]").click(function(){
            popupLogin = $.dialog({
                content:"url:gestores/lista.php",
                title:false,
                columnClass:"col-md-8 col-md-offset-2"
            });
        });
    })
    
</script>
