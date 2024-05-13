<?php   
    include('../includes/includes.php');

        $pergunta = "select * from produto where  situacao='liberado' and NOW() between data_inicial and data_final order by nivel desc,  data_inicial desc";
        $resposta = mysql_query($pergunta);
        $quantidade = mysql_num_rows($resposta);
        
        list($alteracao) = mysql_fetch_row(mysql_query("select sum(alteracao) as alteracao from produto where  situacao='liberado'"));
        
        if( $_GET[quantidade] and $quantidade == $_GET[quantidade] and !$alteracao){
            //file_put_contents('atu.txt',date("d/m/Y H:i:s"));
            exit();
        }
        
        mysql_query("update produto set alteracao = '0' where situacao = 'liberado'");

    function niveis($n){
        switch($n){
            case '1':{
                return '<i class="fas fa-square" style="color:#1ba932;"></i> Nivel de urgência: NORMAL';
                break;
            }
            case '2':{
                return '<i class="fas fa-square" style="color:#c4b200;"></i> Nivel de urgência: MÉDIO';
                break;
            }
            case '3':{
                return '<i class="fas fa-square" style="color:#c46500;"></i> Nivel de urgência: ALTO';
                break;
            }
        }
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
<div class="slider-for<?=$md5?>" style="position:relative; width:100%; height:100%;">
    
    <?php while($d2 =  mysql_fetch_object($resposta)){ ?>
        
        <div style="position:relative; width:100%; height:100%;">
        <?php if($d2->posicao == 1){?>

                <div style="position:relative; width:50%; height:<?=$_GET[h]?>px; float:left; background-image:url(<?=$d2->imagem?>); background-size:cover;">
                    <!--<img src="<?=($d2->imagem)?>" style="width:auto; height:<?=$_GET[h]?>px; position:relative;">-->
                </div>
                <div style="position:relative; width:50%; height:<?=$_GET[h]?>px; float:left; color:#fff !important;font-size:55px; font-weight:bold; text-align:center; vertical-align: middle;">
                    <?=utf8_encode($d2->texto)?>
                </div>

        <?php }else if($d2->posicao == 2){ ?>


                <div style="position:relative; width:50%; height:<?=$_GET[h]?>px; float:left; color:#fff !important;font-size:55px; font-weight:bold; text-align:center; vertical-align: middle;">
                    <?=utf8_encode($d2->texto)?>
                </div>
                <div style="position:relative; width:50%; height:<?=$_GET[h]?>px; float:left; background-image:url(<?=$d2->imagem?>); background-size:cover;">
                    <!--<img src="<?=($d2->imagem)?>" style="width:auto; height:<?=$_GET[h]?>px; position:relative;">-->
                </div>

        <?php }else if($d2->posicao == 3){ ?>
                <?=utf8_encode($d2->texto)?>
        <?php }else if($d2->posicao == 4){ ?>
                <img src="<?=($d2->imagem)?>" style="width:<?=$_GET[w]?>px; height:<?=$_GET[h]?>px; position:relative;">
        <?php }else if($d2->posicao == 5){ ?>
                    <?=utf8_encode($d2->texto)?>
        <?php } ?>
            <!--
            <p style="color:#fff;font-weight:bold;font-size:22px; text-align:center; ">
                <?=niveis($d2->nivel)?>
            </p>
            -->
            <input type="hidden" id="quantidade" value="<?=$quantidade?>">
        </div>

    <?php     
    }
    ?>
  
</div>

<script>
    $('.slider-for<?=$md5?>').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 7000,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear'
    });
</script>