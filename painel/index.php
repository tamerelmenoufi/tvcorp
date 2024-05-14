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

		<!-- lib -->

        <link href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" rel="stylesheet" type="text/css" >

<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css">
        <link href="<?=$urlPainel?>lib/v1/fonts_grafic/fonte.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/jquery/jquery.js"></script>

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/bootstrap/bootstrap.js"></script>

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/search/jquery.quicksearch.js"></script>

<link href="<?=$urlPainel?>lib/v1/css/bootstrap.css" rel="stylesheet" type="text/css">

<link href="<?=$urlPainel?>lib/v1/css/popup.css" rel="stylesheet prefetch" type="text/css">

<link href="<?=$urlPainel?>lib/v1/css/jquery-confirm.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/jquery/jquery-confirm.js"></script>

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/mask/mask.js"></script>

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/validate/jquery.validate.js"></script>

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/mask/jquery.maskMoney.js"></script>

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/jquery/jquery-ui.js"></script>

<link href="<?=$urlPainel?>lib/v1/css/jquery-ui.css" rel="stylesheet" type="text/css">

<link href="<?=$urlPainel?>lib/v1/css/easy-responsive-tabs.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/jquery/easy-responsive-tabs.js"></script>

<link href="<?=$urlPainel?>lib/v1/css/templatemo-misc.css" rel="stylesheet" type="text/css">

       <!-- <link href="<?=$urlPainel?>lib/v1/fonts/fonte.css" rel="stylesheet" type="text/css"> -->

<link href="<?=$urlPainel?>lib/v1/datapicker/css.css" rel="stylesheet">

<script src="<?=$urlPainel?>lib/v1/datapicker/locales.js"></script>

<script src="<?=$urlPainel?>lib/v1/datapicker/js.js"></script>

<script src="<?=$urlPainel?>lib/v1/datapicker/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="<?=$urlPainel?>lib/v1/datapicker/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="<?=$urlPainel?>lib/v1/paginacao/jqpagination.css">

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/paginacao/jquery.jqpagination.js"></script>

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/bootstrap/bootstrap-filestyle.js"></script>

   <link href="<?=$urlPainel?>lib/v1/css/select.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/bootstrap/select.js"></script>

<link href="<?=$urlPainel?>lib/v1/bootstrap-toggle/bootstrap-toggle.css" rel="stylesheet">

<script src="<?=$urlPainel?>lib/v1/bootstrap-toggle/bootstrap-toggle.js"></script>

   <link href="<?=$urlPainel?>lib/v1/maxlength/css.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/maxlength/js.js"></script>

<link href="<?=$urlPainel?>lib/v1/fileinput/css.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/fileinput/js.js"></script>

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/fileinput/jq.js"></script>

<script src="<?=$urlPainel?>lib/v1/graficos/highstock.js"></script>

<script src="<?=$urlPainel?>lib/v1/graficos/exporting.js"></script>

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/ckeditor/ckeditor.js"></script>




<script src="<?=$urlPainel?>lib/v1/sms/chart/dist/Chart.bundle.js"></script>

<script src="<?=$urlPainel?>lib/v1/sms/chart/samples/utils.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/js/bootstrap-dialog.min.js"></script>	

<!--<script type="text/javascript" src="<?=$urlPainel?>lib/v1/jquery/dropdowns.js"></script>

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/jquery/price-range.js"></script>

<link href="<?=$urlPainel?>lib/v1/css/price-range.css" rel="stylesheet" type="text/css">

<link href="<?=$urlPainel?>lib/v1/css/dropdowns-skin-discrete.css" rel="stylesheet" type="text/css">

<link href="<?=$urlPainel?>lib/v1/css/dropdowns-skin-default.css" rel="stylesheet" type="text/css">

<link href="<?=$urlPainel?>lib/v1/css/dropdowns.css" rel="stylesheet" type="text/css">-->


<link href="<?=$urlPainel?>lib/v1/crop/croppic.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/crop/croppic.min.js"></script>


<link href="<?=$urlPainel?>lib/v1/slick/slick.css" rel="stylesheet" type="text/css">

<link href="<?=$urlPainel?>lib/v1/slick/slick-theme.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/slick/slick.min.js"></script>


<script type="text/javascript" src="<?=$urlPainel?>lib/v1/fullscreen/jquery.fullscreen.min.js"></script>



<link href="<?=$urlPainel?>lib/v1/scrollbar/scrollbar.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/scrollbar/scrollbar.js"></script>

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/contador/waypoints.min.js"></script>

<script type="text/javascript" src="<?=$urlPainel?>lib/v1/contador/jquery.counterup.min.js"></script>



<!-- fim lib -->		
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

?>
    

    		<!-- lib -->
		
		<script type="text/javascript" src="<?=$urlPainel?>lib/v1/jquery/jquery.easing-1.3.js"></script>
		
		<!--<script type="text/javascript" src="<?=$urlPainel?>lib/v1/jquery/plugins.js"></script>-->
		
		<!--<script type="text/javascript" src="<?=$urlPainel?>lib/v1/jquery/main.js"></script>-->
		
		<!--<script type="text/javascript" src="<?=$urlPainel?>lib/v1/jquery/acoes.js"></script>-->
		
		<!--<script type="text/javascript" src="<?=$urlPainel?>lib/v1/jquery/popup.js"></script>-->
		
		<!--<script type="text/javascript" src="<?=$urlPainel?>lib/v1/jquery/popup-responsive.js"></script>-->
		
		<!-- fim lib -->


    <script>
        
        $(function(){

        })
        
    </script>
    
</body>
</html>