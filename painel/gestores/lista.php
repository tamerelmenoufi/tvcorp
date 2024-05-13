<?php
    include("../includes/includes.php");
    
    if($_GET[del]){
        mysql_query("delete from login where codigo = '".$_GET[del]."'");
    }

?>
<style>
    a[acoes]{
        cursor:pointer;
    }
</style>
<div class="panel panel-default" style="padding-bottom:130px">
  <div class="panel-heading">
      Lista dos Gestores
      <button novo_login class="btn btn-success btn-xs" style="position:absolute; right:80px">Cadastrar Gestor</button>
      <button Fechar_login class="btn btn-danger btn-xs" style="position:absolute; right:20px">Fechar</button> 
  </div>
  <div class="panel-body">
    <h4><?=utf8_encode($empresa)?></h4>
  </div>
    <table class="table table-hover">
      <thead>
          <tr>
              <th>Nome</th>
              <th>Login</th>
              <th>Perfil</th>
              <th>Situação</th>
              <th width="70"></th>
          </tr>
      </thead>
      <tbody>

<?php
    $query = "select * from login order by nome";
    $result = mysql_query($query);
    while($d = mysql_fetch_object($result)){
?>

          <tr>
              <td><?=utf8_encode($d->nome)?></td>
              <td><?=$d->login?></td>
              <td><?=$d->perfil?></td>
              <td><?=$d->situacao?></td>
              <td>
                <i login_editar cod="<?=$d->codigo?>" class="fa fa-edit" style="color:green; cursor:pointer; margin-right:10px;"></i>
                <i login_excluir cod="<?=$d->codigo?>" class="fa fa-close" style="color:red; cursor:pointer;"></i>
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
        $("button[novo_login]").click(function(){
            $(".Cpg").css("display","block");
            $.ajax({
                url:"gestores/form.php",
                success:function(dados){
                    popupLogin.setContent(dados);
                    $(".Cpg").css("display","none");
                }
            });
            
        });

        $("i[login_editar]").click(function(){
            $(".Cpg").css("display","block");
            cod = $(this).attr("cod");
            $.ajax({
                url:"gestores/form.php",
                type:"GET",
                data:{
                    cod:cod,
                },
                success:function(dados){
                popupLogin.setContent(dados);
                $(".Cpg").css("display","none");
                }
            });
            
        });

        $("i[login_excluir]").click(function(){
            cod = $(this).attr("cod");
            $.confirm({
                content:"Deseja realmente excluir o Gestor?",
                title:false,
                buttons:{
                    SIM:function(){
                        $(".Cpg").css("display","block");
                        $.ajax({
                            url:"gestores/lista.php",
                            type:"GET",
                            data:{
                                del:cod,
                            },
                            success:function(dados){
                                popupLogin.setContent(dados);
                                $(".Cpg").css("display","none");
                            }
                        });                        
                    },
                    NÃO:function(){
                        
                    }
                }
            });

            
        });

       $("button[Fechar_login]").click(function(){
            popupLogin.close();
       })
        
    })
</script>
