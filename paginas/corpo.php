<?php   
    include('../includes/includes.php');
    
    
    

        $pergunta = "select * from produto where  situacao='liberado' and NOW() between data_inicial and data_final order by nivel desc,  data_inicial desc";
        $resposta = mysql_query($pergunta);
        $quantidade = mysql_num_rows($resposta);
        
        list($alteracao) = mysql_fetch_row(mysql_query("select sum(alteracao) as alteracao from produto where  situacao='liberado'"));
        
        if( $_GET[quantidade] and $quantidade == $_GET[quantidade] and !$alteracao){
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
	}
	.dados span{
		font-size: 14px;

	}
	.dados p{
		font-size: 30px;
		font-weight: bold;
	}

	.campo_id{
		border-radius: 100%;
		width: 200px;
		height: 200px;
		color: #fff;
		background-color: #8f3838;
		font-size: 20px;
		font-weight: bold;
		text-align: center;
		padding-top: 50px;
	}
	.campo_id span{
		font-size: 14px;

	}
	.campo_id p{
		font-size: 50px;
		font-weight: bold;
	}
 
</style>
<div class="slider-for<?=$md5?>" style="display:none; margin-bottom:auto; ">
    
    <?php while($d2 =  mysql_fetch_object($resposta)){ ?>
        
        <div class="item ">
        <?php if($d2->posicao == 1){?>

                <div class="col-md-12 borda-verde">
                <div class="col-md-6 " style="padding-left:0px">
                    <img src="<?=($d2->imagem)?>" class="img-responsive" style="width:100%;height:500px">  
                </div>
                <div class="col-md-5 pull-left">
                    <div style="color:#fff !important;font-size:55px;font-weight:bold;margin-top:80px;text-align:center"><?=utf8_encode($d2->texto)?></div>
                </div>
                <div class="col-md-1"></div>
                </div>

        <?php }else if($d2->posicao == 2){ ?>

                <div class="col-md-12 borda-verde">
                <div class="col-md-5 pull-left">
                    <div style="color:#fff !important;font-size:55px;font-weight:bold;margin-top:80px;text-align:center"><?=utf8_encode($d2->texto)?></div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6 " style="padding-left:0px">
                    <img src="<?=($d2->imagem)?>" class="img-responsive" style="width:100%;height:500px">  
                </div>
                </div>

        <?php }else if($d2->posicao == 3){ ?>

                <div class="col-md-12 borda-verde">
                <div class="col-md-12 pull-left" style="height: 500px; display: flex;">
                    <div style="color:#fff;font-size:55px;font-weight:bold;margin-top:80px;text-align:center; margin: auto;"><?=utf8_encode($d2->texto)?></div>
                </div>
                </div>

        <?php }else if($d2->posicao == 4){ ?>

                <div class="col-md-12 borda-verde">
                <div class="col-md-12" style="padding-left:0px; text-align:center">
                    <img src="<?=($d2->imagem)?>" class="img-responsive" style="height:500px; display:inline; ">  
                </div>
                </div>

        <?php }else if($d2->posicao == 5){ ?>

                <div class="col-md-12 borda-verde">
                <div class="col-md-12" style="padding-left:0px;">
                    <?=utf8_encode($d2->texto)?>
                </div>
                </div>

        <?php } ?>
        
            <p style="color:#fff;font-weight:bold;font-size:22px; text-align:center; ">
                <?=niveis($d2->nivel)?>
                <input type="hidden" id="quantidade" value="<?=$quantidade?>" style="color:#333">
            </p>

        </div>

    <?php     
    }
    ?>
  
</div>

<script>
$(document).ready(function () {
    $(".slider-for<?=$md5?>").css("display", "block");
});
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