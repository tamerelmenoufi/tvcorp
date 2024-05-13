<?php
    include("../includes/includes.php");
    
    if($_GET[del]){
        mysql_query("delete from produto where codigo = '".$_GET[del]."'");
        mysql_query("delete from exibicoes where tipo = 'produto' and cod in(".$_GET[del].")");
        mysql_query("delete from horaios where tipo = 'produto' and cod in(".$_GET[del].")");
    }
    
    if($_POST[acao] == 'novo'){

        //Incluir como padrão todas as estações
        $query = "select * from estacoes";
        $result = mysql_query($query);
        if(mysql_num_rows($result)){
            while($d = mysql_fetch_object($result)){
                $estacoes[] = $d->codigo;   
            }
            $estacoes = '|'.implode('||',$estacoes).'|';
        }
        
        
        //Incluir como padrão todos os dias da semana e 24 horas por dia
        $dias_semana = '|seg||ter||qua||qui||sex||sab||dom|';        
        
        
        mysql_query("insert into produto set 
                                            posicao = '1',
                                            nivel = '1',
                                            situacao = 'bloqueado',
                                            titulo = '".utf8_decode($_POST[titulo])."',
                                            data_inicial = '".date("Y-m-d 00:00:00")."',
                                            data_final = '".date("Y-m-d 23:59:59")."',
                                            estacoes = '".$estacoes."',
                                            dias_semana = '".$dias_semana."',
                                            tempo = '10'
                    ");
                    

        $cod = mysql_insert_id();

        //difinições de horários
        $dias_semana = array('seg','ter','qua','qui','sex','sab','dom');
        for($i=0;$i<count($dias_semana);$i++){
            //codigo	tipo	cod	dia	inicio	fim
            mysql_query("insert into horarios set tipo = 'produto', cod='".$cod."', dia = '".$dias_semana[$i]."', inicio = '00:00', fim = '23:59'");
        }


        //definindo as exibições
        list($a1,$m1,$d1) = explode("-",date("Y-m-d 00:00:00"));
        list($a2,$m2,$d2) = explode("-",date("Y-m-d 23:59:59"));
        
        //$ini = mktime(0,0,0,$m1,$d1,$a1);
        $ini = mktime(0,0,0,date("m"),date("d"),date("Y"));
        $fim = mktime(23,59,59,$m2,$d2,$a2);

        $e = explode("|",$estacoes);
        $d = explode("|",$dias);
        for($k=$ini;$k<$fim;$k=$k+86400){
            $data = date("Y-m-d",$k);
            for($i=0;$i<count($e);$i++){
                if($e[$i]){
                    for($j=0;$j<count($d);$j++){
                        if($d[$j]){
                            $q = "select * from horarios where tipo = 'produto' and cod = '".$cod."' and dia = '".$d[$j]."' order by inicio";
                            $r = mysql_query($q);
                            while($t = mysql_fetch_object($r)){
                                //	tipo 	cod 	estacao 	dia 	data_inicial 	data_final 	situacao
                                $com = "insert into exibicoes set tipo = 'produto', cod = '".$cod."', dia = '".$d[$j]."', estacao = '".$e[$i]."', data_inicial = '".$data." ".$t->inicio."', data_final = '".$data." ".$t->fim."'";
                                mysql_query($com);
                            }
                        }
                    }
                }
            }
        }
        // Fim da alimentação das exibições /////////////////////////                    
                    
                    
                    
                    
                    
                    
    }
    
    
    if($_GET[excluir]){
        if($_GET[codigos] and $_GET[fatura]){
            $q = "SELECT * FROM `produto`";
            $n = mysql_num_rows(mysql_query($q));
        }
        if($n){
            echo "erro";
            exit();
        }
        mysql_query("delete from servico_outros where codigo = '".$_GET[excluir]."'");
    }
    
    $query = "SELECT * FROM `produto` where posicao != '5' order by codigo desc";
    $result = mysql_query($query);
?>


<div class='col-md-12 mg' style="text-align:right; margin-bottom:30px;">
    <div class="input-group">
      <div class="input-group-addon">Criar uma nova Publicação</div>
      <input type="text" class="form-control" id="NomeNovaPublicacao" placeholder="Digite o Título da publicação">
      <div id="novo" class="input-group-addon btn btn-primary">Cadastrar</div>
    </div>

    
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Código</th>
            <th>Título</th>
            <th>Data Inicial</th>
            <th>Data Final</th>
            <th>Situação</th>
            <th width="70"></th>
        </tr>
    </thead>
    <tbody>
<?php
    while($d = mysql_fetch_object($result)){

?>
        <tr linha_voo<?=$d->codigo?>>
            <td><?=$d->codigo?></td>
            <td><?=utf8_encode($d->titulo)?></td>
            <td><?=dataBr($d->data_inicial)?></td>
            <td><?=dataBr($d->data_final)?></td>
            <td><?=$d->situacao?></td>
            <td>
                <i servico_editar cod="<?=$d->codigo?>" class="fa fa-edit" style="color:green; cursor:pointer; margin-right:10px;"></i>
                <i servico_excluir cod="<?=$d->codigo?>" class="fa fa-close" style="color:red; cursor:pointer;"></i>
            </td>
        </tr> 
 
<?php

    }
?>



    </tbody>
</table> 

<script>
    
    $(function(){
        $("i[servico_editar]").click(function(){
            $(".Cpg").css("display","block");
            cod = $(this).attr("cod");
            $.ajax({
                url:"publicacoes/form.php",
                type:"GET",
                data:{
                    cod:cod
                },
                success:function(dados){
                    popup = $.dialog({
                        content:dados,
                        title:false,
                        columnClass:'col-md-12',
                        closeIcon:false,
                    });
                    $(".Cpg").css("display","none");
                }
            });
            
        });
        
        $("i[servico_excluir]").click(function(){
            cod = $(this).attr("cod");
            $.confirm({
                content:"Deseja realmente excluir a publicação?",
                title:false,
                buttons:{
                    SIM:function(){
                        $(".Cpg").css("display","block");
                        $.ajax({
                            url:"publicacoes/index.php",
                            type:"GET",
                            data:{
                                del:cod
                            },
                            success:function(dados){
                                $("div[corpo]").html(dados);
                                $(".Cpg").css("display","none");
                            }
                        });
                    },
                    NÃO:function(){
                        
                    }
                }
            });
            
        });
        
        $("#novo").click(function(){
            titulo = $("#NomeNovaPublicacao").val();
            if(titulo.trim()){
                $(".Cpg").css("display","block");
                $.ajax({
                    url:"publicacoes/index.php",
                    type:"POST",
                    data:{
                        titulo:titulo,
                        acao:'novo'
                    },
                    success:function(dados){
                        $("div[corpo]").html(dados);
                        $(".Cpg").css("display","none");
                    }
                })
            }else{
                $.alert({
                    content:"Favor preencha o nome da publicação.",
                    title:false
                });
            }
        });
        

    })
    
</script>