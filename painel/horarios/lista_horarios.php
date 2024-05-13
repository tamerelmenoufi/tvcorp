<?php
    include("../includes/includes.php");
    
    if($_POST[del]){
        $query = "delete from horarios where codigo = '".$_POST[del]."'";
        mysql_query($query);
    }
    if($_POST[acao]){
        if($_POST[produto]){
            $query = "insert into horarios set tipo='produto', cod = '".$_POST[produto]."', dia = '".$_POST[dia]."', inicio = '".$_POST[inicio]."', fim = '".$_POST[fim]."'";
        }
        
        if($_POST[audio]){
            $query = "insert into horarios set tipo='audio', cod = '".$_POST[audio]."', dia = '".$_POST[dia]."', inicio = '".$_POST[inicio]."', fim = '".$_POST[fim]."'";
        }
        
        if($_POST[aviso]){
            $query = "insert into horarios set tipo='aviso', cod = '".$_POST[aviso]."', dia = '".$_POST[dia]."', inicio = '".$_POST[inicio]."', fim = '".$_POST[fim]."'";
        }
        
        mysql_query($query);
    }
?>

<style>
    td[acao]{
        width:50px;
        text-align:center;
    }
</style>


    <table class="table table-hover">
        <thead>
            <tr>
                <th>Inicio</th>
                <?php
                if($_POST[produto] or $_POST[aviso]){
                ?>
                <th>Fim</th>
                <?php
                }
                ?>
                <th style="width:70px;">Ação</th>
            </tr>
        </thead>
        <tbody>
<?php
    if($_POST[produto]){
        $query = "select * from horarios where tipo = 'produto' and cod = '".$_POST[produto]."' and dia = '".$_POST[dia]."' order by inicio asc";
    }

    if($_POST[audio]){
        $query = "select * from horarios where tipo = 'audio' and cod = '".$_POST[audio]."' and dia = '".$_POST[dia]."' order by inicio asc";
    }

    if($_POST[aviso]){
        $query = "select * from horarios where tipo = 'aviso' and cod = '".$_POST[aviso]."' and dia = '".$_POST[dia]."' order by inicio asc";
    }

    $result = mysql_query($query);
    while($d = mysql_fetch_object($result)){
?>
            <tr>
                <td><?=$d->inicio?></td>
                <?php
                if($_POST[produto] or $_POST[aviso]){
                ?>                
                <td><?=$d->fim?></td>
                <?php
                }
                ?>
                <td acao>
                    <i horas_excluir cod="<?=$d->codigo?>" class="fa fa-close" title="excluir" style="color:red; cursor:pointer;"></i>
                </td>
            </tr>
<?php
    }
?>
        </tbody>
    </table>

    <script type="text/javascript">

    $(function(){
        
        $("i[horas_excluir]").click(function(){
            del = $(this).attr("cod");
            $.confirm({
                content:"Deseja realmente excluir o horário?",
                title:false,
                buttons:{
                    SIM:function(){
                        $(".Cpg").css("display","block");
                        $.ajax({
                            url:"horarios/lista_horarios.php",
                            type:"POST",
                            data:{
                                del:del,
                                produto:'<?=$_POST[produto]?>',
                                audio:'<?=$_POST[audio]?>',
                                aviso:'<?=$_POST[aviso]?>',
                                dia:'<?=$_POST[dia]?>',
                            },
                            success:function(dados){
                                $("div[lista_horarios]").html(dados);
                                $(".Cpg").css("display","none");
                            }
                        });
                    },
                    NÃO:function(){
                        
                    }
                }
            });
        });

        
    })

              
    </script>