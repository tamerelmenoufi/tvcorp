<?php
    include("../includes/includes.php");
    $vez = (($_GET[vez])?$_GET[vez]:'0');
    //Alimentação do vetor principal

    $diaH = DiasSemana(date("w"));
    
    if($_GET[musashi_tv_estacao]) $_SESSION[musashi_tv_estacao] = $_GET[musashi_tv_estacao];
    
    
    $ConfEstacao = mysql_fetch_object(mysql_query("select * from estacoes where codigo = '".$_SESSION[musashi_tv_estacao]."'"));
    
    
    
    $q1 = "select * from exibicoes where estacao = '".$_SESSION[musashi_tv_estacao]."' and tipo = 'produto' and dia = '".$diaH."' and (NOW() between data_inicial and data_final) group by cod";
    $r1 = mysql_query($q1);
    while($d1 = mysql_fetch_object($r1)){
        $Exb[] = $d1->cod;
        $alerta_exibicao = $d1->alerta;
    }

    if($ConfEstacao->bloqueio_scw){
    $query = "select * from produto where situacao = 'liberado' and (NOW() between data_inicial and data_final) ".(($Exb)?" and codigo in(".implode(",",$Exb).") ":false)." order by nivel desc, codigo asc";    
    }else{
    $query = "select * from produto where situacao = 'liberado' and (NOW() between data_inicial and data_final) and ( posicao = '5' ".(($Exb)?" or codigo in(".implode(",",$Exb).") ":false).") order by nivel desc, codigo asc";
    }
    //$query = "select * from produto where situacao = 'liberado' and (NOW() between data_inicial and data_final) and ( posicao = '5' ".(($Exb)?" or codigo in(".implode(",",$Exb).") ":false).") order by nivel desc, codigo asc";
    file_put_contents('AlertExib_esta.txt',$query);
    $result = mysql_query($query);
    while($d = mysql_fetch_object($result)){
        $r[] = $d->codigo;  
    }
    if($r) $rs = implode(",",$r);
    //Fim da alimentação do vetor principal
    
    $query = "select * from produto where codigo = '".$r[$vez]."'";
    $result = mysql_query($query);
    $d2 = mysql_fetch_object($result);
    
    $Dsem = array('dom','seg','ter','qua','qui','sex','sab');
    
    list($AlertaNovo) = mysql_fetch_row(mysql_query("select count(*) from exibicoes where dia = '".$Dsem[date("w")]."' and tipo = 'produto' and cod = '".$d2->codigo."' and estacao = '".$_SESSION[musashi_tv_estacao]."'	and alerta != '1' and (NOW() between data_inicial and data_final)"));
    if($AlertaNovo and @in_array($d2->codigo,$Exb)){
        //*
?>        
        <audio id="NovaPublicacao" autoplay="autoplay" controls="controls" preload="auto" style="opacity:0; position:absolute; left:-1000px; top:-1000px;">
            <source src="../painel/includes/alertas/novo.mp3" type="audio/mp3" />
        </audio>   
<?php 
        mysql_query("update exibicoes set alerta = '1' where dia = '".$Dsem[date("w")]."' and tipo = 'produto' and cod = '".$d2->codigo."' and estacao = '".$_SESSION[musashi_tv_estacao]."'	and alerta != '1' and (NOW() between data_inicial and data_final)");

        //*/
    }
?>
<style>
    .slick-arrow{
        display:none !important;
    }
    .borda-verde{
        border:10px solid green;
        border-color:transparent;
    }

    .titulo_chamada{
        color: #fff;
        margin-bottom: 20px;
    }

	.painel_chamadas{
		position:relative !important;
		top: 0;
		bottom:0;
		min-height: 500px;
	}
	.dados{
		color:#fff;
		background: transparent !important;
		margin-bottom:10px;
	}
	.dados span{
		font-size: 14px;

	}
	.dados p{
		font-size: 25px;
		font-weight: bold;
	}

	.dados_comentario{
		color:#fff;
		background: transparent !important; 
	}
	.dados_comentario span{
		font-size: 14px;

	}
	.dados_comentario p{
		font-size: 30px;
		font-weight: bold;
        overflow: hidden;
        text-overflow: ellipsis;
        height:385px;
        border:solid 0px yellow;
	}
	
	.campo_id{
		border-radius: 15px;
		width: 100%;
		height: auto;
		color: #fff;
		background-color: #8f3838;
		font-size: 20px;
		font-weight: bold;
		text-align: center;
		padding-top: 30px;
	}
	.campo_id span{
		font-size: 14px;
		padding:0;
		margin:0;

	}
	.campo_id p{
		font-size: 40px;
		font-weight: bold;
		padding:0;
		margin:0;
		margin-bottom:10px;
	}
 </style>


<div id="conteudo_publicacoes">
        <div style="position:absolute; width:100%; height:100%;">
        <?php if($d2->posicao == 1){?>

                <div style="position:relative; width:50%; height:100%; float:left; background-image:url(<?=$d2->imagem?>); background-size:cover;">
                </div>
                <div style="position:relative; width:50%; height:100%; float:left; color:#fff !important;font-size:55px; font-weight:bold; text-align:center; vertical-align: middle;">
                    <?=utf8_encode($d2->texto)?>
                </div>

        <?php }else if($d2->posicao == 2){ ?>


                <div style="position:relative; width:50%; height:100%; float:left; color:#fff !important;font-size:55px; font-weight:bold; text-align:center; vertical-align: middle;">
                    <?=utf8_encode($d2->texto)?>
                </div>
                <div style="position:relative; width:50%; height:100%; float:left; background-image:url(<?=$d2->imagem?>); background-size:cover;">
                </div>

        <?php }else if($d2->posicao == 3){ ?>
        
                <div style="position:relative; width:100%; height:100%; float:left; color:#fff !important;font-size:55px; font-weight:bold; text-align:center; vertical-align: middle;">
                    <?=utf8_encode($d2->texto)?>
                </div>

        <?php }else if($d2->posicao == 4){ ?>
                <div style="position:relative; width:100%; height:100%; background-image:url(<?=$d2->imagem?>); background-size:100% 100%;"></div>
        <?php }else if($d2->posicao == 5){ ?>
                    <?=utf8_encode($d2->texto)?>
        <?php } ?>


        </div>
</div>


<script>
    $(function(){
        
        <?php
        
            if($ConfEstacao->chave == '6C8349'){
                file_put_contents('ExibeQt.txt',"Vez:".$_GET[vez]."\nExibicoes:".$rs."\nComparacao: ".$_GET[tot].' = '.count($r));
            }

        
        
        if($AlertaNovo and @in_array($d2->codigo,$Exb)){
        ?>
        //NovaPublicacao = document.getElementById('NovaPublicacao');
        //NovaPublicacao.play();
        <?php
        }
        ?>
        
        
        //$("#conteudo_publicacoes").append(exibicoes[vez]);
        setTimeout(function(){ 


            exibicoes = [<?=$rs?>];
            n = exibicoes.length;
            tot = '<?=$_GET[tot]?>';
            if(n == tot){
                vez = <?=(($_GET[vez])?$_GET[vez]:0)?>;
                if(n-1 == '<?=$_GET[vez]?>'){
                    prx = 0;
                }else{
                    prx = vez*1 + 1;
                }
            }else{
                vez = 0;
                prx = 0;
            }


            $.ajax({
                url:"publicacoes.php",
                type:"GET",
                data:{
                  vez:prx,
                  tot:n,
                  musashi_tv_estacao:'<?=$_SESSION[musashi_tv_estacao]?>', 
                },
                success:function(dados){
                    $(".palco_apresentacao").html(dados);
                }
            });            
        }, <?=number_format($d2->tempo*1000,false,false,false)?>);
    })
</script>