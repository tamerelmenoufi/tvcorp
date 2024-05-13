<?php
    include("../includes/includes.php");
    
    if($_GET[acao]){
        
        if($_GET[produto]){
            list($ativas) = mysql_fetch_row(mysql_query("select estacoes from produto where codigo = '".$_GET[produto]."'"));
            if($_GET[acao] == 'ativo'){
                $ativar = str_replace("|".$_GET[cod]."|",false,$ativas);
                $ativar = $ativar."|".$_GET[cod]."|";
            }else{
                $ativar = str_replace("|".$_GET[cod]."|",false,$ativas);
            }
            mysql_query("update produto set estacoes = '".$ativar."' where codigo = '".$_GET[produto]."'");
            exit();
        }
        
        if($_GET[audio]){
            list($ativas) = mysql_fetch_row(mysql_query("select estacoes from audios where codigo = '".$_GET[audio]."'"));
            if($_GET[acao] == 'ativo'){
                $ativar = str_replace("|".$_GET[cod]."|",false,$ativas);
                $ativar = $ativar."|".$_GET[cod]."|";
            }else{
                $ativar = str_replace("|".$_GET[cod]."|",false,$ativas);
            }
            mysql_query("update audios set estacoes = '".$ativar."' where codigo = '".$_GET[audio]."'");
            exit();
        }
        
        if($_GET[aviso]){
            list($ativas) = mysql_fetch_row(mysql_query("select estacoes from aviso where codigo = '".$_GET[aviso]."'"));
            if($_GET[acao] == 'ativo'){
                $ativar = str_replace("|".$_GET[cod]."|",false,$ativas);
                $ativar = $ativar."|".$_GET[cod]."|";
            }else{
                $ativar = str_replace("|".$_GET[cod]."|",false,$ativas);
            }
            mysql_query("update aviso set estacoes = '".$ativar."' where codigo = '".$_GET[aviso]."'");
            exit();
        }
    }
    
    
?>
<style>

</style>

<div class="col-md-12" style="margin-bottom:30px; text-align:right">
    <button class="btn btn-primary" Estacoes>Adicionar Estação</button>    
</div>


<?php
    if($_GET[produto]){
        list($EstatcoesAtivas) = mysql_fetch_row(mysql_query("select estacoes from produto where codigo = '".$_GET[produto]."'"));
    }
    
    if($_GET[audio]){
        list($EstatcoesAtivas) = mysql_fetch_row(mysql_query("select estacoes from audios where codigo = '".$_GET[audio]."'"));
    }
    
    if($_GET[aviso]){
        list($EstatcoesAtivas) = mysql_fetch_row(mysql_query("select estacoes from aviso where codigo = '".$_GET[aviso]."'"));
    }
    
    
    $EstatcoesAtivas = explode("|",$EstatcoesAtivas);

    $query = "select * from estacoes order by codigo";
    $result = mysql_query($query);
    while($d = mysql_fetch_object($result)){
        
        //mysql_query("update estacoes set chave = '".strtoupper(substr(md5($d->codigo),0,6))."' where codigo = '".$d->codigo."'");
        
?>
<div class="col-md-3" style="margin-bottom:10px">
    <input AtivaEstacoes
            <?=((in_array($d->codigo,$EstatcoesAtivas))?'checked':false)?>
            data-on="<?=utf8_encode($d->nome)?>"
            data-off="<?=utf8_encode($d->nome)?>"
            data-toggle="toggle"
            type="checkbox"
            value="<?=$d->codigo?>"
            data-width="100%"
            XXdata-size="mini"
            name="estacao"
            id="estacao"
            data-onstyle="success"
            data-offstyle="danger"
    >
</div>
<?php
    }
?>


<script>
    $(function(){
        
        $('input[AtivaEstacoes]').bootstrapToggle();
        
        $('input[AtivaEstacoes]').change(function() {
            
            cod = $(this).val();
            
            if($(this).prop('checked') == true){
                acao = 'ativo';
            }else{
                acao = 'desativo';
            }
            
            $.ajax({
                url:"estacoes/index.php",
                type:"GET",
                data:{
                    acao:acao,
                    produto:'<?=$_GET[produto]?>',
                    audio:'<?=$_GET[audio]?>',
                    aviso:'<?=$_GET[aviso]?>',
                    cod:cod,
                },
                success:function(dados){

                }
            });
            
            
        });
        
        

        $("button[Estacoes]").click(function(){
            popupEstacoes = $.dialog({
                content:"url:estacoes/lista.php?produto=<?=$_GET[produto]?>&audio=<?=$_GET[audio]?>&aviso=<?=$_GET[aviso]?>",
                title:false,
                columnClass:'col-md-8 col-md-offset-2',
                closeIcon:false,
            });
        })

    })
</script>
