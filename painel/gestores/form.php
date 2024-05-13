<?php
    include("../includes/includes.php");
    
    if($_POST){
                    
        $permissoes = @implode(",",$_POST[permissoes]);
        
        if($_POST[acao] == 'novo'){
            
            $query = "insert into login set nome='".utf8_decode($_POST['nome'])."',
                    login = '".utf8_decode($_POST['login'])."',
                    senha = '".md5($_POST['senha'])."',
                    perfil = '".$_POST[perfil]."',
                    permissoes = '".$permissoes."',
                    situacao='".$_POST['situacao']."'"; //situacao='".$_POST['situacao']."'
                    
        }elseif($_POST[acao] == 'alterar'){
            
            $query = "update login set 
                    nome='".utf8_decode($_POST['nome'])."',
                    login = '".utf8_decode($_POST['login'])."',
                    ".(($_POST['senha'])?"senha = '".md5($_POST['senha'])."',":false)."
                    perfil = '".$_POST['perfil']."',
                    permissoes = '".$permissoes."',
                    situacao='".$_POST['situacao']."' where codigo = '".$_POST[cod]."'";
                    
        }
        
        
        mysql_query($query);
        
        if($_POST[acao] == 'novo'){
            $cod = mysql_insert_id();
        }else{
            $cod = $_POST[cod];
        }
        
        exit();
    }
    
    
    
    $query = "select * from login where codigo = '".$_GET[cod]."'";
    $result = mysql_query($query);
    $d = mysql_fetch_object($result);
    
    $permissoes = explode(',',$d->permissoes);
    

?>

<div class="panel panel-default">
  <div class="panel-heading">
      Cadastro / Edição do Gestor
  </div>
  <div class="panel-body">
            

            <label for="basic-url">Nome</label>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon2"><i class="fa fa-university fa-fw " aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Nome" id="nome" value="<?=utf8_encode($d->nome)?>">
            </div>
            

            <label for="basic-url">Login</label>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon2"><i class="fa fa-university fa-fw " aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Login" id="login" value="<?=utf8_encode($d->login)?>">
            </div>
            

            <label for="basic-url">Senha</label>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon2"><i class="fa fa-university fa-fw " aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Deigite a nova senha" id="senha" value="">
            </div>
            
            
            
            <label for="basic-url">Perfil</label>
            <div class="radio">
                <label>
                  <input type="radio" name="perfil" id="usuario" <?=(($d->perfil == 'usuario' or !$d->perfil)?'checked':false)?> > Usuário
                </label>
            </div>
            <div class="radio">
                <label>
                  <input type="radio" name="perfil" id="gestor" <?=(($d->perfil == 'gestor')?'checked':false)?> > Gestor
                </label>
            </div>
            

            <label for="basic-url">Permissões</label>
            <!--<div class="checkbox">
                <label>
                  <input type="checkbox" permissoes acao="gestao_gestores" <?=((in_array('gestao_gestores',$permissoes))?'checked':false)?> > Manutenção de Gestores
                </label>
            </div>-->
            <div class="checkbox">
                <label>
                  <input type="checkbox" permissoes acao="liberar_publicacoes" <?=((in_array('liberar_publicacoes',$permissoes))?'checked':false)?> > Liberar Publicações
                </label>
            </div>
            <div class="checkbox">
                <label>
                  <input type="checkbox" permissoes acao="liberar_audios" <?=((in_array('liberar_audios',$permissoes))?'checked':false)?> > Liberar Áudios
                </label>
            </div>
            <div class="checkbox">
                <label>
                  <input type="checkbox" permissoes acao="liberar_avisos" <?=((in_array('liberar_avisos',$permissoes))?'checked':false)?> > Liberar Avisos
                </label>
            </div>

            
            
            <label for="basic-url">Situação</label>
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
                url:"gestores/lista.php",
                type:"GET",
                success:function(dados){
                    popupLogin.setContent(dados);
                    $(".Cpg").css("display","none");
                }
            });
        });
        
        $("#salvar").click(function(){
            $(".Cpg").css("display","block");
            nome = $("#nome").val();
            login = $("#login").val();
            senha = $("#senha").val();
            situacao = (($("#liberado").prop("checked") == true)?'liberado':'bloqueado');
            perfil = (($("#usuario").prop("checked") == true)?'usuario':'gestor');
            acao = $(this).attr("acao");
            permissoes = [];
            p=0;
            $("input[permissoes]").each(function(){
                if($(this).prop("checked") == true){
                    permissoes[p] = $(this).attr("acao");
                    p++;
                }
            });
            
            $.ajax({
                url:"gestores/form.php",
                type:"POST",
                data:{
                    nome:nome,
                    login:login,
                    senha:senha,
                    situacao:situacao,
                    perfil:perfil,
                    acao:acao,
                    permissoes:permissoes,
                    cod:'<?=$_GET[cod]?>',
                },
                success:function(dados){
                    //popupLogin.setContent(dados);
                    $.ajax({
                        url:"gestores/lista.php",
                        success:function(dados){
                            popupLogin.setContent(dados);
                            $(".Cpg").css("display","none");
                        }
                    });

                }
            });            
            
        });
        
        
        
        
    })
</script>
