<?php   
    include('../includes/includes.php');

        $min5 = mktime(date("H"),date("i")-3,date("s"),date("m"),date("d"),date("Y"));
        $min5 = date("Y-m-d H:i:s", $min5);

        $pergunta = "select a.*, b.url, b.titulo from audios_horas a left join audios b on a.audio = b.codigo where  a.situacao='0' and (a.data between '".$min5."' and NOW()) and b.situacao = 'liberado' order by a.data desc limit 1 ";
        $resposta = mysql_query($pergunta);
        $quantidade = mysql_num_rows($resposta);
        if($quantidade){
        $d = mysql_fetch_object($resposta);

        //mysql_query("update audios_horas set situacao = '1' where data <= NOW() and audio = '".$d->audio."'");
        
?>
<audio id="TempoAudio" autoplay="autoplay" controls="controls" preload="auto" style="opacity:0">
    <source src="https://www.moh1.com.br/painel_musashi/audios/<?=$d->url?>" type="audio/mp3" />
</audio>
<div msg_audio style="position:absolute; padding:20px; border-radius:10px; background-color:#eee; color:#333; text-align:center; left:20px; top:10px; width:auto; font-size:20px; z-index:100;"><b><i class="fa fa-volume-up" aria-hidden="true"></i> <?=utf8_encode($d->titulo)?></b></div>

<script>
    clearInterval(AcaoAudios);
    TempoAudio = document.getElementById('TempoAudio');
    TempoAudio.play();
    setTimeout(function(){
        Duracao = Math.floor(TempoAudio.duration)*1000;
        setTimeout(function(){Audios();}, Duracao);
        //alert(Duracao);
    }, 3000);
</script>

<?php
        }else{
?>
<span></span>
<?php
        }
?>