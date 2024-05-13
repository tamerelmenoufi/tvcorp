<?php
    include("../includes/includes.php");


    if($_POST){
                    
        if($_POST[acao] == 'novo'){
            
            $query = "insert into estacoes set nome='".utf8_decode($_POST['nome'])."',
                    descricao='".utf8_decode($_POST['descricao'])."',
                    situacao='liberado'"; //situacao='".$_POST['situacao']."'
                    
        }elseif($_POST[acao] == 'alterar'){
            
            $query = "update estacoes set 
                    nome='".utf8_decode($_POST['nome'])."',
                    descricao='".utf8_decode($_POST['descricao'])."',
                    bloqueio_scw='".(($_POST['bloqueio_scw'])?'1':'0')."'
                    /*,
                    situacao='".$_POST['situacao']."'*/ where codigo = '".$_POST[cod]."'";
                    
        }
        
        
        mysql_query($query);
        
        if($_POST[acao] == 'novo'){
            $cod = mysql_insert_id();
        }else{
            $cod = $_POST[cod];
        }
        
        mysql_query("update estacoes set chave = '".strtoupper(substr(md5($cod),0,6))."' where codigo = '".$cod."'");
    
        exit();
    }
    
    
    
    $query = "select * from estacoes where codigo = '".$_GET[cod]."'";
    $result = mysql_query($query);
    $d = mysql_fetch_object($result);

?>

<div class="panel panel-default">
  <div class="panel-heading">
      Cadastro / Edição da Estação
  </div>
  <div class="panel-body">
            

            <label for="basic-url">Nome</label>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon2"><i class="fa fa-university fa-fw " aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Nome" id="nome" value="<?=utf8_encode($d->nome)?>">
            </div>
            

            <label for="basic-url">Descrição</label>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon2"><i class="fa fa-university fa-fw " aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Descrição" id="descricao" value="<?=utf8_encode($d->descricao)?>">
            </div>
            

            <div class="checkbox">
                <label>
                <input id="bloqueio_scw" type="checkbox" <?=(($d->bloqueio_scw)?'checked':false)?>> Bloquear Exibição do S.C.W. neta estação
                </label>
            </div>

            
            <!--
            <div class="radio">
                <label>
                  <input type="radio" name="situacao" id="liberado" <?=(($d->situacao == 'liberado' or !$d->situacao)?'checked':false)?> > Liberado
                </label>
            </div>

            <div class="radio">
                <label>
                  <input type="radio" name="situacao" id="bloqueado" <?=(($d->situacao == 'bloqueado')?'checked':false)?> > Bloqueado
                </label>
            </div>
            -->

            <div class="input-group" style="margin-top:10px;">
              <button class="btn btn-success" acao="<?=(($_GET[cod])?'alterar':'novo')?>" id="salvar" style="margin-right:5px">Salvar</button>
              <button class="btn btn-danger" id="cancelar">Cancelar</button>
            </div>


  </div>
</div>


<script>
    $(function(){

        $("#cancelar").click(function(){
            $(".Cpg").css("display","block");
            $.ajax({
                url:"estacoes/lista.php",
                type:"GET",
                data:{
                    produto:'<?=$_GET[produto]?>',
                    audio:'<?=$_GET[audio]?>',
                    aviso:'<?=$_GET[aviso]?>',
                },
                success:function(dados){
                    popupEstacoes.setContent(dados);
                    $(".Cpg").css("display","none");
                }
            });
        });
        
        $("#salvar").click(function(){
            $(".Cpg").css("display","block");
            nome = $("#nome").val();
            descricao = $("#descricao").val();
            situacao = (($("#liberado").prop("checked") == true)?'liberado':'bloqueado');
            acao = $(this).attr("acao");
            bloqueio_scw = (($("#bloqueio_scw").prop("checked") == true)?'1':'');
            
            $.ajax({
                url:"estacoes/form.php",
                type:"POST",
                data:{
                    nome:nome,
                    descricao:descricao,
                    situacao:situacao,
                    acao:acao,
                    cod:'<?=$_GET[cod]?>',
                    bloqueio_scw:bloqueio_scw,
                },
                success:function(dados){
                    $.ajax({
                        url:"estacoes/lista.php",
                        type:"GET",
                        data:{
                            produto:'<?=$_GET[produto]?>',
                            audio:'<?=$_GET[audio]?>',
                            aviso:'<?=$_GET[aviso]?>',
                        },
                        success:function(dados){
                            popupEstacoes.setContent(dados);
                            
                            $.ajax({
                        	    url:"estacoes/index.php?produto=<?=$_GET[produto]?>&audio=<?=$_GET[audio]?>&aviso=<?=$_GET[aviso]?>",
                            	success: function(dados){
                            		$("div[TelaEstacoes]").html(dados);
                            		$(".Cpg").css("display","none");
                            	}
                            }); 
                            
                            
                        }
                    });

                }
            });            
            
        });
        
        
        
        
    })
</script>
