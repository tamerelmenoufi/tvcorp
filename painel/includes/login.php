<style>
	div[carregando_tela_login]{
		background-color:#eee;
		position:absolute;
		top:0px;
		left:0px;
		height:100%;
		width:100%;
		z-index:9;
		opacity:0.5;
		display:none;
	}
	.ErroAlert{
		color:red;
	}
	.ErroAlert1{
		color:yellow;
	}
	.ErroAlert2{
		color:red;
	}
	.espaco{
		margin-bottom: 5px;
		margin-top: 5px;
	}
	.Lico{
		width: 20px;
	}
	
	
</style>


    <div carregando_tela_login>
        <div style="position:relative; top:50%; text-align:center;" >
            <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw carregando"></i>
            <span class="sr-only">Carregando...</span>
        </div>
    </div>



	<div class="session">
		<div id="paginas" class="container">

         	
            <!--<div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
                <img src="lib/img/logo_spf.png" class="img-responsive">
            </div>-->

            <div class="col-md-4 col-md-offset-4" style="margin-top:15%;">
                <div class="panel panel-success">
                  <div class="panel-heading" style="text-align: center;">ACESSO AO PAINEL DE CONTROLE</div>
                  <div class="panel-body">
                    <p>
                        <!--FORM DE CADASTRO E ORDENAÇÃO DE GRUPOS -->
                        <div class="col-md-12">

	                        <div class="input-group espaco">
	                          <input login type="text" class="form-control" placeholder="Login de acesso" value="">
	                          <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user Lico" aria-hidden="true"></i></span>
	                        </div>
	                        
	                        <div class="input-group espaco">
	                          <input senha type="password" class="form-control" placeholder="Senha de acesso" value="">
	                          <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-key Lico" aria-hidden="true"></i></span>
	                        </div>
	                        <!--<P>
	                        <div class="input-group">
	                          <input captcha type="text" class="form-control" placeholder="Digite o Texto ao lado">
	                          <span class="input-group-addon" id="sizing-addon1"><?=$_SESSION["captcha"]?></span>
	                        </div>
	                        </P>-->
	                        
	                        <P id="esqueci_senha" style="cursor:pointer" class="espaco">
	                        Esqueci a senha
	                        </P>                        
	                        
	                        <div class="input-group espaco">
	                          <button class="btn btn-success" type="button" style="height:auto; margin-right:5px;" id="entrar">Entrar</button>
	                        </div>
                        
                        </div>
                        <!-- FIM FORM DE CADASTRO E ORDENAÇÃO DE GRUPOS -->
                    </p>
                  </div>
                  
                </div>                
            </div>
            <div class="col-md-4 col-md-offset-4">
	            <p style="text-align:center">
				MOHATRON <?=date(Y)?>, todos os direitos reservados.
				</p> 
            </div>              
    		<!--FIM LISTA E MANUTENÇÃO DAS CATEGORIAS E GRUPOS -->
   
		</div>
	</div>

<script>
	$(function(){
	
		
		$("#entrar").click(function(){
			$(".Cpg").css("display","block");
			login = $("input[login]").val();
			senha = $("input[senha]").val();
			//captcha = $("input[captcha]").val();
			$("div[carregando_tela_login]").css("display","block");
			$.ajax({
				url:"includes/login_script.php",
				type:"POST",
				data:{login:login,senha:senha},
				success: function(dados){
					$(".Cpg").css("display","none");
					if(dados == 'ok'){
						window.location.href = './';	
					}else{
						$.alert({
							content:'Dados Incorretos!<br>Por favor digite seus dados corretamente.',
							title: false,
						});		
						$("div[carregando_tela_login]").css("display","none");
					}
				}
			})
		});
		
		
		$("#esqueci_senha").click(function(){
			janela_recuperar_senha = $.dialog({
				content:'url:includes/recuperar_senha.php',
				closeIcon: true,
				confirmButton:false,
				title: false,
				confirm:function(){
					$("input[login]").val('');
					$("input[senha]").val('');
					$("div[carregando_tela_login]").css("display","none");
				}	
			});
		});
		
	})
</script>