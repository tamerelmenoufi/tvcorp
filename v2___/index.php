<?php
    include("../includes/includes.php");
    
    if($_GET[e] == 'del'){
        mysql_query("update estacoes set situacao = 'liberado' where codigo = '".$_SESSION[musashi_tv_estacao]."'");
        $_SESSION[musashi_tv_estacao] = false;
    }
    
?><!doctype html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- lib -->

        <link href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" rel="stylesheet" type="text/css" >

<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css">
        <link href="http://mohatron.com.br/lib/v1/fonts_grafic/fonte.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/jquery/jquery.js"></script>

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/bootstrap/bootstrap.js"></script>

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/search/jquery.quicksearch.js"></script>

<link href="https://www.mohatron.com.br/lib/v1/css/bootstrap.css" rel="stylesheet" type="text/css">

<link href="https://www.mohatron.com.br/lib/v1/css/popup.css" rel="stylesheet prefetch" type="text/css">

<link href="https://www.mohatron.com.br/lib/v1/css/jquery-confirm.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/jquery/jquery-confirm.js"></script>

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/mask/mask.js"></script>

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/validate/jquery.validate.js"></script>

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/mask/jquery.maskMoney.js"></script>

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/jquery/jquery-ui.js"></script>

<link href="https://www.mohatron.com.br/lib/v1/css/jquery-ui.css" rel="stylesheet" type="text/css">

<link href="https://www.mohatron.com.br/lib/v1/css/easy-responsive-tabs.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/jquery/easy-responsive-tabs.js"></script>

<link href="https://www.mohatron.com.br/lib/v1/css/templatemo-misc.css" rel="stylesheet" type="text/css">

       <!-- <link href="https://www.mohatron.com.br/lib/v1/fonts/fonte.css" rel="stylesheet" type="text/css"> -->

<link href="https://www.mohatron.com.br/lib/v1/datapicker/css.css" rel="stylesheet">

<script src="https://www.mohatron.com.br/lib/v1/datapicker/locales.js"></script>

<script src="https://www.mohatron.com.br/lib/v1/datapicker/js.js"></script>

<script src="https://www.mohatron.com.br/lib/v1/datapicker/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="https://www.mohatron.com.br/lib/v1/datapicker/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="https://www.mohatron.com.br/lib/v1/paginacao/jqpagination.css">

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/paginacao/jquery.jqpagination.js"></script>

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/bootstrap/bootstrap-filestyle.js"></script>

   <link href="https://www.mohatron.com.br/lib/v1/css/select.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/bootstrap/select.js"></script>

<link href="https://www.mohatron.com.br/lib/v1/bootstrap-toggle/bootstrap-toggle.css" rel="stylesheet">

<script src="https://www.mohatron.com.br/lib/v1/bootstrap-toggle/bootstrap-toggle.js"></script>

   <link href="https://www.mohatron.com.br/lib/v1/maxlength/css.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/maxlength/js.js"></script>

<link href="https://www.mohatron.com.br/lib/v1/fileinput/css.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/fileinput/js.js"></script>

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/fileinput/jq.js"></script>

<script src="https://www.mohatron.com.br/lib/v1/graficos/highstock.js"></script>

<script src="https://www.mohatron.com.br/lib/v1/graficos/exporting.js"></script>

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/ckeditor/ckeditor.js"></script>




<script src="https://www.mohatron.com.br/lib/v1/sms/chart/dist/Chart.bundle.js"></script>

<script src="https://www.mohatron.com.br/lib/v1/sms/chart/samples/utils.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/js/bootstrap-dialog.min.js"></script>	

<!--<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/jquery/dropdowns.js"></script>

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/jquery/price-range.js"></script>

<link href="https://www.mohatron.com.br/lib/v1/css/price-range.css" rel="stylesheet" type="text/css">

<link href="https://www.mohatron.com.br/lib/v1/css/dropdowns-skin-discrete.css" rel="stylesheet" type="text/css">

<link href="https://www.mohatron.com.br/lib/v1/css/dropdowns-skin-default.css" rel="stylesheet" type="text/css">

<link href="https://www.mohatron.com.br/lib/v1/css/dropdowns.css" rel="stylesheet" type="text/css">-->


<link href="https://www.mohatron.com.br/lib/v1/crop/croppic.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/crop/croppic.min.js"></script>


<link href="https://www.mohatron.com.br/lib/v1/slick/slick.css" rel="stylesheet" type="text/css">

<link href="https://www.mohatron.com.br/lib/v1/slick/slick-theme.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/slick/slick.min.js"></script>


<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/fullscreen/jquery.fullscreen.min.js"></script>



<link href="https://www.mohatron.com.br/lib/v1/scrollbar/scrollbar.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/scrollbar/scrollbar.js"></script>

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/contador/waypoints.min.js"></script>

<script type="text/javascript" src="https://www.mohatron.com.br/lib/v1/contador/jquery.counterup.min.js"></script>



<!-- fim lib -->	
        <title>TV CORP</title>
        <style>
            body{
                background-color:#68000c;
            }
            .palco_apresentacao{
                width:100%;
                padding-top:0px;
                position:fixed;
                left:0px;
                top:0px;
                bottom:110px;
            }
            .palco_avisos{
                width:100%;
                height:50px;
                background-color:#fff;
                padding-top:0px;
                position:fixed;
                left:0px;
                bottom:60px;
                color:#333;
                font-size:30px;
                font-weight:bold;
                padding:5px;
            }
            .palco_rodape{
                width:100%;
                height:50px;
                padding-top:0px;
                position:fixed;
                left:0px;
                bottom:0px;
            }
        </style>
    </head>
<body>
    <div class="palco_apresentacao"></div>
    <div class="palco_avisos"></div>
    <div class="palco_rodape"></div>
    <div class="palco_audio"></div>
    


<script>
    $(function(){
        
        
        //window.localStorage.removeItem('musashi_tv_estacao'); // remover
        //window.localStorage.setItem('musashi_tv_estacao', 'valor'); //Gravar
        musashi_tv_estacao = window.localStorage.getItem('musashi_tv_estacao'); //Ler
        
        if(!musashi_tv_estacao){
            
            Estacoes = $.dialog({
                content:"url:estacao.php",
                title:"Identificação da Estação",
            });
            
        }else{


                $.ajax({
                    url:"publicacoes.php?vez=0",
                    type:"GET",
                    data:{
                      vez:'0',
                      musashi_tv_estacao:musashi_tv_estacao,
                    },
                    success:function(dados){
                        $(".palco_apresentacao").html(dados);
                    }
                });
                $.ajax({
                    url:"avisos.php",
                    type:"GET",
                    data:{
                      musashi_tv_estacao:musashi_tv_estacao,
                    },
                    success:function(dados){
                        $(".palco_avisos").html(dados);
                    }
                });
                $.ajax({
                    url:"rodape.php",
                    type:"GET",
                    data:{
                      musashi_tv_estacao:musashi_tv_estacao,
                    },
                    success:function(dados){
                        $(".palco_rodape").html(dados);
                    }
                });
                
                $.ajax({
                    url:"audio.php",
                    type:"GET",
                    data:{
                      musashi_tv_estacao:musashi_tv_estacao,
                    },
                    success:function(dados){
                        $(".palco_audio").html(dados);
                    }
                });
                
                
                 setInterval(function(){ 
                    n = $("marquee").attr('n');
                    $.ajax({
                        url:"avisos.php",
                        type:"GET",
                        data:{
                          n:n,
                          musashi_tv_estacao:musashi_tv_estacao,
                        },
                        success:function(dados){
                        console.log(dados)
                            if(dados == 's' || dados == '0'){
                                $.ajax({
                                    url:"avisos.php",
                                    success:function(dados){
                                        $(".palco_avisos").html(dados);
                                    }
                                });
                            }
                            
                        }
                    });
                }, 2000);

        }
        
        function mensagem(){ 
                        $.dialog({
                            content:"<div class='row'><center><h5>Esta estação perdeu conexão com o servidor.</h5></center><a href='./' class='btn btn-primary btn-lg btn-block'>Clique aqui para atualizar</a></div>",
                            title:false,
                            closeIcon: false
                        });
                    }
        
        SistemaOnLine = setInterval(function(){
            $.ajax({
                url:"online.php",
                success:function(dados){
                    if(dados != 'ok'){
                        mensagem();
                        clearInterval(SistemaOnLine);
                    }
                },
                error:function(){
                    mensagem();
                    clearInterval(SistemaOnLine);
                }
            });
        }, 10000);

        

    })



</script>

</body>
</html>