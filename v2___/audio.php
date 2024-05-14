<?php   
    include('../includes/includes.php');

    $diaH = DiasSemana(date("w"));
    
    if($_GET[musashi_tv_estacao]) $_SESSION[musashi_tv_estacao] = $_GET[musashi_tv_estacao];
    
    
    $q1 = "select * from exibicoes where estacao = '".$_SESSION[musashi_tv_estacao]."' and tipo = 'audio' and dia = '".$diaH."' and NOW() >= data_inicial and situacao != '1' group by cod order by data_inicial limit 1";
    $r1 = mysql_query($q1);
    while($d1 = mysql_fetch_object($r1)){
        $Exb[] = $d1->cod;
        $CExb[] = $d1->codigo;
    }
    
    if($Exb){
        
    mysql_query("update exibicoes set situacao = '1' where codigo in (".implode(",",$CExb).") or data_inicial < now()");
        
    $query = "select * from audios where codigo in (".implode(",",$Exb).")";
    $result = mysql_query($query);
    $d = mysql_fetch_object($result);
    
    
?>

<audio autoplay="autoplay" controls="controls" >
    <source src="../painel/audios/audios/<?=$d->url?>" type="audio/mp3" />
</audio>
<div msg_audio style="position:absolute; padding:20px; border-radius:10px; background-color:#eee; color:#333; text-align:center; left:20px; top:10px; width:auto; font-size:20px; z-index:100;"><b><i class="fa fa-volume-up" aria-hidden="true"></i> <?=utf8_encode($d->titulo)?></b></div>

<script>
    $(function(){

        //clearInterval(AcaoAudios);
        // TempoAudio = document.getElementById('TempoAudio');
        // TempoAudio.play();
        
        setTimeout(function(){
                $.ajax({
                    url:"audio.php",
                    type:"GET",
                    data:{
                      musashi_tv_estacao:'<?=$_SESSION[musashi_tv_estacao]?>', 
                    },
                    success:function(dados){
                        $(".palco_audio").html(dados);
                    }
                }); 
        },<?=number_format($d->tempo*1+3000,false,false,false)?>);
        
    })
</script>

<?php

        }else{
?>
<span></span>

<script>
    $(function(){
        
        setTimeout(function(){
                $.ajax({
                    url:"audio.php",
                    type:"GET",
                    data:{
                      musashi_tv_estacao:'<?=$_SESSION[musashi_tv_estacao]?>', 
                    },
                    success:function(dados){
                        $(".palco_audio").html(dados);
                    }
                }); 
        },5000);
    })
</script>
<?php
        }
?>