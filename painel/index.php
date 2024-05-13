<?php
    $home = true;
    include("includes/includes.php");
    if($_GET[s]){
        $_SESSION = array();
        echo "<script>window.location.href='./'</script>";
        exit();
    }
?><!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
    <title>TV CORPORATIVO</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
        $query = "select * from mohatron_painel.lib where versao = 'v1'";
        $result = mysql_query($query);
        $d_lib = mysql_fetch_object($result);
        echo $d_lib->lib;
    ?>
    <style>
        .Cpg{
            position:fixed;
            width:100%;
            height:100%;
            left:0px;
            top:0px;
            background:#333;
            opacity:0.5;
            display:none;
            z-index:99999999;
        }
    </style>
</head>
<body>
<div class="Cpg"></div>
<?php

    if($_SESSION['painel_usuario_logado']){
        include("includes/menu.php");
        
        include("includes/home.php");
    }else{
        include("includes/login.php");
    }


    echo $d_lib->lib_rodape;

?>
    
    <script>
        
        $(function(){

        })
        
    </script>
    
</body>
</html>