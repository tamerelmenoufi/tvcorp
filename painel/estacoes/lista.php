<?php
    include("../includes/includes.php");
    
    if($_GET[del]){
        mysql_query("delete from estacoes where codigo = '".$_GET[del]."'");
    }

?>
<style>
    a[acoes]{
        cursor:pointer;
    }
    .w3-text-red{
        color:red;
        font-weight:bold;
        padding-left:10px;
    }
    .w3-text-green{
        color:green;
        font-weight:bold;
        padding-left:10px;
    }
</style>
<div class="panel panel-default" style="padding-bottom:130px">
  <div class="panel-heading">
      Lista das Estações
      <button nova_estacao class="btn btn-success btn-xs" style="position:absolute; right:80px">Cadastrar Estação</button>
      <button Fechar_estacoes class="btn btn-danger btn-xs" style="position:absolute; right:20px">Fechar</button> 
  </div>
  <div class="panel-body">
    <h4><?=utf8_encode($empresa)?></h4>
  </div>
    <table class="table table-hover">
      <thead>
          <tr>
              <th>Nome</th>
              <th>Chave</th>
              <th>S.C.W.</th>
              <th>Situação</th>
              <th width="70"></th>
          </tr>
      </thead>
      <tbody>

<?php
    $query = "select * from estacoes order by nome";
    $result = mysql_query($query);
    while($d = mysql_fetch_object($result)){
        
        list($TemPrd) = mysql_fetch_row(mysql_query("select count(*) from produto where estacoes like '%|".$d->codigo."|%'"));
        list($TemAvi) = mysql_fetch_row(mysql_query("select count(*) from aviso where estacoes like '%|".$d->codigo."|%'"));
        list($TemAud) = mysql_fetch_row(mysql_query("select count(*) from audios where estacoes like '%|".$d->codigo."|%'"));
        $TemEst = ($TemPrd + $TemAvi + $TemAud);
?>

          <tr>
              <td><?=utf8_encode($d->nome)?></td>
              <td><?=$d->chave?></td>
              <td><i class="fa fa-power-off <?=(($d->bloqueio_scw)?"w3-text-red":"w3-text-green")?>" aria-hidden="true"></i></td>
              <td><?=(($d->situacao == 'bloqueado')?'Em uso':'Liberada')?></td>
              <td>
                <i estacao_editar cod="<?=$d->codigo?>" class="fa fa-edit" style="color:green; cursor:pointer; margin-right:10px;"></i>
                <?php
                if(!$TemEst){
                ?>
                <i estacao_excluir cod="<?=$d->codigo?>" class="fa fa-close" style="color:red; cursor:pointer;"></i>
                <?php
                }
                ?>
              </td>
          </tr>
<?php
    }
?>

      </tbody>
    </table> 
</div>


<script>
    $(function(){
        $("button[nova_estacao]").click(function(){
            $(".Cpg").css("display","block");
            $.ajax({
                url:"estacoes/form.php",
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

        $("i[estacao_editar]").click(function(){
            $(".Cpg").css("display","block");
            cod = $(this).attr("cod");
            $.ajax({
                url:"estacoes/form.php",
                type:"GET",
                data:{
                    cod:cod,
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

        $("i[estacao_excluir]").click(function(){
            cod = $(this).attr("cod");
            $.confirm({
                content:"Deseja realmente excluir a estção?",
                title:false,
                buttons:{
                    SIM:function(){
                        $(".Cpg").css("display","block");
                        $.ajax({
                            url:"estacoes/lista.php",
                            type:"GET",
                            data:{
                                del:cod,
                                produto:'<?=$_GET[produto]?>',
                                audio:'<?=$_GET[audio]?>',
                                aviso:'<?=$_GET[aviso]?>',
                            },
                            success:function(dados){
                                popupEstacoes.setContent(dados);
                                
                                $.ajax({
                            	    url:"estacoes/index.php?produto=<?=$_GET[produto]?>&audio=<?=$_GET[audio]?>",
                                	success: function(dados){
                                		$("div[TelaEstacoes]").html(dados);
                                		$(".Cpg").css("display","none");
                                	}
                                });    
                                
                            }
                        });                        
                    },
                    NÃO:function(){
                        
                    }
                }
            });

            
        });

       $("button[Fechar_estacoes]").click(function(){
            popupEstacoes.close();
       })
        
    })
</script>
