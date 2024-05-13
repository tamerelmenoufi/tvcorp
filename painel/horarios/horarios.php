<?php
    include("../includes/includes.php");
    
    if($_POST[acao]){
        
        if($_POST[produto]){
            list($dias) = mysql_fetch_row(mysql_query("select dias_semana from produto where codigo = '".$_POST[produto]."'"));
            if($_POST[acao] == 'inc'){
                $dias_atualiza = str_replace("|".$_POST[dia]."|",false,$dias);
                $dias_atualiza = $dias_atualiza."|".$_POST[dia]."|";
            }else{
                $dias_atualiza = str_replace("|".$_POST[dia]."|",false,$dias);
            }
            mysql_query("update produto set dias_semana = '".$dias_atualiza."' where codigo = '".$_POST[produto]."'");
        }
        
        if($_POST[audio]){
            list($dias) = mysql_fetch_row(mysql_query("select dias_semana from audios where codigo = '".$_POST[audio]."'"));
            if($_POST[acao] == 'inc'){
                $dias_atualiza = str_replace("|".$_POST[dia]."|",false,$dias);
                $dias_atualiza = $dias_atualiza."|".$_POST[dia]."|";
            }else{
                $dias_atualiza = str_replace("|".$_POST[dia]."|",false,$dias);
            }
            mysql_query("update audios set dias_semana = '".$dias_atualiza."' where codigo = '".$_POST[audio]."'");
        }
        
        if($_POST[aviso]){
            list($dias) = mysql_fetch_row(mysql_query("select dias_semana from aviso where codigo = '".$_POST[aviso]."'"));
            if($_POST[acao] == 'inc'){
                $dias_atualiza = str_replace("|".$_POST[dia]."|",false,$dias);
                $dias_atualiza = $dias_atualiza."|".$_POST[dia]."|";
            }else{
                $dias_atualiza = str_replace("|".$_POST[dia]."|",false,$dias);
            }
            mysql_query("update aviso set dias_semana = '".$dias_atualiza."' where codigo = '".$_POST[aviso]."'");
        }
        
        exit();
        
    }
    
    if($_GET[produto]){
        list($dias) = mysql_fetch_row(mysql_query("select dias_semana from produto where codigo = '".$_GET[produto]."'"));
    }
    
    if($_GET[audio]){
        list($dias) = mysql_fetch_row(mysql_query("select dias_semana from audios where codigo = '".$_GET[audio]."'"));
    }
    
    if($_GET[aviso]){
        list($dias) = mysql_fetch_row(mysql_query("select dias_semana from aviso where codigo = '".$_GET[aviso]."'"));
    }
    
    $vetor_dias = explode("|",$dias);
    

?>
            <div class='col-md-12 mg'>
                <div class="checkbox">
                    <label>
                      <input ativar_dia value="<?=$_GET[dia]?>" type="checkbox" <?=((in_array($_GET[dia], $vetor_dias))?'checked':false)?>> Ativar <?=$_GET[dia]?> para exibição
                    </label>
                </div>
            </div>
            <div class='col-md-3 mg'>
                <label for="basic-url"></label>
                <div class="input-group">
                    Adicionar <?=(($_GET[produto] or $_GET[aviso])?'Intervalo de':false)?> Horário
                </div>
            </div>
            <div class='col-md-3 mg'>
                <label for="basic-url">Inicial</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon3"><i class="fas fa-angle-double-up fa-fw"></i></span>
                  <input type="text" class="form-control" placeholder="Hora Inicial" id="hora_inicial" value="">
                </div>
            </div>
            <?php
            if($_GET[produto] or $_GET[aviso]){
            ?>
            <div class='col-md-3 mg'>
                <label for="basic-url">Final</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon3"><i class="fas fa-angle-double-down fa-fw"></i></span>
                  <input type="text" class="form-control" placeholder="Hora Final" id="hora_final" value="">
                </div>
            </div>
            <?php
            }
            ?>
            <div class='col-md-3 mg'>
                <label for="basic-url"></label>
                <div class="input-group">
                  <input type="button" class="btn btn-default" id="hora_add" value="Adicionar Horário">
                </div>
            </div>


            <div lista_horarios class='col-md-12 mg'>
                
            </div>

    <script type="text/javascript">

    $(function(){
        //$(".Cpg").css("display","block");
        $.ajax({
            url:"horarios/lista_horarios.php",
            type:"POST",
            data:{
                codigo:'<?=$_GET[codigo]?>',
                dia:'<?=$_GET[dia]?>',
                produto:'<?=$_GET[produto]?>',
                audio:'<?=$_GET[audio]?>',
                aviso:'<?=$_GET[aviso]?>',
            },
            success:function(dados){
               $("div[lista_horarios]").html(dados);
              // $(".Cpg").css("display","none");
            }
        });        

        $("#hora_inicial<?=(($_GET[produto] or $_GET[aviso])?', #hora_final':false)?>").mask("99:99");

        $("input[ativar_dia]").click(function(){
            //$(".Cpg").css("display","block");
            if($(this).prop("checked") == true){
                acao = 'inc';
            }else{
                acao = 'del';
            }
            $.ajax({
                url:"horarios/horarios.php",
                type:"POST",
                data:{
                    codigo:'<?=$_GET[codigo]?>',
                    dia:'<?=$_GET[dia]?>',
                    produto:'<?=$_GET[produto]?>',
                    audio:'<?=$_GET[audio]?>',
                    aviso:'<?=$_GET[aviso]?>',
                    acao:acao
                },
                success:function(dados){
                   // alert(dados);
                   //$(".Cpg").css("display","none");
                }
            });
        });
        
        
        $("#hora_add").click(function(){
            inicio = $("#hora_inicial").val();
            <?=(($_GET[produto] or $_GET[aviso])?'fim = $("#hora_final").val();':false)?>
            
            $("#hora_inicial").val('');
            <?=(($_GET[produto] or $_GET[aviso])?'$("#hora_final").val(\'\');':false)?>
            
            if(inicio<?=(($_GET[produto] or $_GET[aviso])?' && fim':false)?>){
                $(".Cpg").css("display","block");
                $.ajax({
                    url:"horarios/lista_horarios.php",
                    type:"POST",
                    data:{
                        codigo:'<?=$_GET[codigo]?>',
                        dia:'<?=$_GET[dia]?>',
                        produto:'<?=$_GET[produto]?>',
                        audio:'<?=$_GET[audio]?>',
                        aviso:'<?=$_GET[aviso]?>',
                        inicio:inicio,
                        <?=(($_GET[produto] or $_GET[aviso])?'fim:fim,':false)?>
                        acao:'hs'
                    },
                    success:function(dados){
                       $("div[lista_horarios]").html(dados);
                       $(".Cpg").css("display","none");
                    }
                });                
            }else{
                $.alert({
                    content:"Favor informe a hora inicial<?=(($_GET[produto] or $_GET[aviso])?' e final':false)?>.",
                    title:false,
                });
            }
        });
        
        
        
    })

              
    </script>