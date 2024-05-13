<?php   
        $pergunta = "select * from aviso where  situacao='liberado'  ";
        $resposta = mysql_query($pergunta);
        //$d = mysql_fetch_object($resposta);
?>
<style>
.marquee {
    width: 100%;
    height: auto;
    overflow: hidden;
    white-space: nowrap;
    border: 1px solid transparent;
    padding: 2px;
}

.marquee span {
    display: inline-block;
    padding-left: 20%;
    animation: marquee 10s linear infinite;
}

@keyframes marquee {
    0%   { transform: translate(0, 0); }
    100% { transform: translate(-100%, 0); }
}
</style>
<div class="clearfix col-md-12" style="background:#fff; padding: 5px;margin-top:auto; margin-bottom:auto; ">
    <div class="marquee">
        <?php while($d = mysql_fetch_object($resposta)){ ?>
            <span style="color: #b61616;font-size:22px;text-shadow: 2px 2px 5px #b9a6a6;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="padding-right:5px; color:#ff7a00; "></i><?=utf8_encode($d->aviso)?></span>
        <?php } ?>
    </div>
</div>


