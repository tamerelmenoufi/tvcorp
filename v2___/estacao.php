<?php
    include("../includes/includes.php");
    
    if($_POST[chave]){
        $query = "select * from estacoes where chave = '".$_POST[chave]."'";
        $result = mysql_query($query);
        if(mysql_num_rows($result)){
            $d = mysql_fetch_object($result);
            mysql_query("update estacoes set situacao = 'bloqueado' where codigo = '".$d->codigo."'");
            echo $_SESSION[musashi_tv_estacao] = $d->codigo;
        }else{
            echo 'erro';
        }
        exit();
    }
    
?>
<div class="row">
    <div class="col-md-12">
        <center>
            <input cod_estacao type="text" placeholder="Digite o código da estação" class="form-control">
            <br><br>
            <button ativar_estacao type="button" class="btn btn-primary btn-lg btn-block">Ativar</button>
        </center>
    </div>
</div>
<script>
    
    $(function(){
        $("button[ativar_estacao]").click(function(){
            
            chave = $("input[cod_estacao]").val();
            
            if(chave){
                $(".Cpg").css("display","block");
                $.ajax({
                    url:"estacao.php",
                    type:"POST",
                    data:{
                        chave:chave,
                    },
                    success:function(dados){
                        if(dados){
                            if(dados == 'erro'){
                                $.alert({
                                    content:"<center><b>Chave informada não existe ou em uso!</b><br><br>Favor entrar em contato com o suporte do sistema.</center>",
                                    title:false
                                });                                
                            }else{
                                window.localStorage.setItem('musashi_tv_estacao', dados);
                                window.location.href="./";                               
                            }
                            $(".Cpg").css("display","none");
                        }
                    }
                });
            }else{
                $.alert({
                    content:"Favor informe a sua chave da estação.",
                    title:false
                });
            }
            
        });
    })
    
    
</script>