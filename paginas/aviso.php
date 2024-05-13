<?php   
    include('../includes/includes.php');

        $pergunta = "select * from aviso where  situacao='liberado' and NOW() between data_inicial and data_final order by data_inicial desc ";
        $resposta = mysql_query($pergunta);
        $quantidade = mysql_num_rows($resposta);
        
        list($alteracao) = mysql_fetch_row(mysql_query("select sum(alteracao) as alteracao from aviso where  situacao='liberado'"));

        if($_GET[quantidade] and $quantidade == $_GET[quantidade] and !$alteracao){
            exit();
        }

        mysql_query("update aviso set alteracao = '0' where situacao = 'liberado'");

        
?>
<div class="clearfix col-md-12" style="background:#fff; padding: 5px;margin-top:auto; margin-bottom:auto; ">
    <marquee>
        <?php while($d = mysql_fetch_object($resposta)){ ?>
            <span style="color: #b61616;font-size:22px;text-shadow: 2px 2px 5px #b9a6a6; margin-right:50px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="padding-right:5px; color:#ff7a00; "></i><?=utf8_encode($d->aviso)?></span>
        <?php } ?>
    </marquee>
    <input type="hidden" id="quantidade2" value="<?=$quantidade?>" style="color:#333">
</div>


