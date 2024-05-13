<?php
    include("sessoes.php");
    include("connect.php");

	if($_POST){

		//tem login, senha
		$query = "select * from login where login = '".$_POST[login]."' and senha = '".md5($_POST[senha])."'";

		$result = mysql_query($query) or die(mysql_error());

		if(mysql_num_rows($result)){
			$d = mysql_fetch_object($result);

			$_SESSION['painel_usuario_logado'] = $d->codigo;

            if($_SESSION['painel_usuario_logado']){
				echo "ok";
				exit();
			}

			
		}else{

			echo "dados_incorretos";
			exit();
		}
	}
	
?>