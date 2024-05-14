<?php
    include("../includes/includes.php");


    $diaH = DiasSemana(date("w"));
    
    if($_GET[musashi_tv_estacao]) $_SESSION[musashi_tv_estacao] = $_GET[musashi_tv_estacao];
    $Exb[] = 0;
    $q1 = "select * from exibicoes where estacao = '".$_SESSION[musashi_tv_estacao]."' and tipo = 'aviso' and dia = '".$diaH."' and (NOW() between data_inicial and data_final) group by cod";
    $r1 = mysql_query($q1);
    while($d1 = mysql_fetch_object($r1)){
        $Exb[] = $d1->cod;
    }

    
    $query = "select * from aviso where  situacao='liberado' and (NOW() between data_inicial and data_final) and codigo in(".implode(",",$Exb).") order by data_inicial desc";
    $result = mysql_query($query);
    $n = mysql_num_rows($result);
    
    // if($_GET[n]){
        if($n != $_GET[n]){
            echo 's';
            
        }
        // exit();
    // }
    
    while($d = mysql_fetch_object($result)){
        $avs[] = utf8_encode($d->aviso);
    }
    if($avs) $avisos = implode("  -  ",$avs);

?>

<marquee n='<?=$n?>'><?=$avisos?></marquee>
<script>
    $(function(){


    })
</script>
