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
        <?php
            list($lib_moh,$lib_rodape) = mysql_fetch_row(mysql_query("select lib,lib_rodape from lib where versao = 'v1'"));
            echo $lib_moh;
        ?>
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
                            if(dados == 's'){
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