<?php
    include("../includes/includes.php");
    
    if($_SESSION[musashi_tv_estacao]){
        $query = "select * from estacoes where codigo = '".$_SESSION[musashi_tv_estacao]."'";
        $result = mysql_query($query);
        if(mysql_num_rows($result)){
            $d = mysql_fetch_object($result);
        }
    }

?>
<div class="row">
    <div class="col-md-12">
        <label>Estação:</label>
        <center><h2><?=utf8_encode($d->nome)?></h2></center>
    </div>
    <div class="col-md-12">
        <label>Chave:</label>
        <center><h2><?=$d->chave?></h2></center>
    </div>
    <div class="col-md-12">
        <label>Descrição:</label>
        <center><h4><?=utf8_encode($d->descricao)?></h4></center>
    </div>
    <div class="col-md-12" style="margin-top:30px;">
        <button alterar_estacao type="button" class="btn btn-primary btn-lg btn-block">Alterar Estação</button>
    </div>
</div>
<script>
    
    $(function(){
        $("button[alterar_estacao]").click(function(){
            $.confirm({
                content:"Deseja realmente trocar a configuração desta estação?",
                title:false,
                buttons:{
                    SIM:function(){
                        window.localStorage.removeItem('musashi_tv_estacao');
                        window.location.href='./?e=del';
                    },
                    NÃO:function(){
                        
                    }
                }
            });

        });
    })
    
    
</script>