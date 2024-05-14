<?php
    include("sessoes.php");
    include("connect.php");
    $md5 = md5(date("YmdHis"));
    if((!$_SESSION['painel_usuario_logado']) and !$home){
        echo "<script>window.location.href='./?s=1'</script>";
        exit();
    }
    
    $query = "select * from login where codigo = '".$_SESSION['painel_usuario_logado']."'";
    $result = mysql_query($query);
    $Conf = mysql_fetch_object($result);
    
    $ConfPermissoes = explode(",",$Conf->permissoes);

    $urlPainel = "http://tvcorp.mohatron.com.br/";
    
    
    
?>