<?php
    include("../includes/includes.php");
    
    if($_GET[del]){
        $query = "select * from audios where codigo in(".$_GET[del].")";	
        $result = mysql_query($query);
        while($d = mysql_fetch_object($result)){
            if(is_file("audios/".$d->url)){
                unlink("audios/".$d->url);
            }
        }
        mysql_query("delete from exibicoes where tipo = 'audio' and cod in(".$_GET[del].")");
        mysql_query("delete from horaios where tipo = 'audio' and cod in(".$_GET[del].")");
    	$query = "delete from audios where codigo in(".$_GET[del].")";	
    	mysql_query($query);
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

        
        mysql_query("insert into audios set 
                                            situacao = 'bloqueado',
                                            titulo = '".utf8_decode($_POST[titulo])."',
                                            data_inicial = '".date("Y-m-d 00:00:00")."',
                                            data_final = '".date("Y-m-d 23:59:59")."',
                                            estacoes = '".$estacoes."',
                                            dias_semana = '".$dias_semana."'
                    ");



    }



    $query = "SELECT * FROM `audios` order by codigo desc";
    $result = mysql_query($query);
?>


<div class='col-md-12 mg' style="text-align:right; margin-bottom:30px;">
    <div class="input-group">
      <div class="input-group-addon">Criar novo Áudio</div>
      <input type="text" class="form-control" id="NomeNovoAudio" placeholder="Digite o Título do áudio">
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
                url:"audios/form.php",
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
                            url:"audios/index.php",
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
            titulo = $("#NomeNovoAudio").val();
            if(titulo.trim()){
                $(".Cpg").css("display","block");
                $.ajax({
                    url:"audios/index.php",
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