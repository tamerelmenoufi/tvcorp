<?php   
    include('../includes/includes.php');
    //exit();
$acentuacao = array(
					array('á','u00e1'),
					array('à','u00e0'),
					array('â','u00e2'),
					array('ã','u00e3'),
					array('ä','u00e4'),
					array('Á','u00c1'),
					array('À','u00c0'),
					array('Â','u00c2'),
					array('Ã','u00c3'),
					array('Ä','u00c4'),
					array('é','u00e9'),
					array('è','u00e8'),
					array('ê','u00ea'),
					array('ê','u00ea'),
					array('É','u00c9'),
					array('È','u00c8'),
					array('Ê','u00ca'),
					array('Ë','u00cb'),
					array('í','u00ed'),
					array('ì','u00ec'),
					array('î','u00ee'),
					array('ï','u00ef'),
					array('Í','u00cd'),
					array('Ì','u00cc'),
					array('Î','u00ce'),
					array('Ï','u00cf'),
					array('ó','u00f3'),
					array('ò','u00f2'),
					array('ô','u00f4'),
					array('õ','u00f5'),
					array('ö','u00f6'),
					array('Ó','u00d3'),
					array('Ò','u00d2'),
					array('Ô','u00d4'),
					array('Õ','u00d5'),
					array('Ö','u00d6'),
					array('ú','u00fa'),
					array('ù','u00f9'),
					array('û','u00fb'),
					array('ü','u00fc'),
					array('Ú','u00da'),
					array('Ù','u00d9'),
					array('Û','u00db'),
					array('ç','u00e7'),
					array('Ç','u00c7'),
					array('ñ','u00f1'),
					array('Ñ','u00d1'),
					array('&','u0026'),
					array('\'','u0027'),
					);
    
    function acentuacao($a){
        global $acentuacao;
        foreach($acentuacao as $i => $v ){
            $a = str_replace($v[1],$v[0],$a);
        }
        return utf8_decode($a);
    }
    
    
    mysql_query("delete from produto where posicao = '5'");
    
    echo $query = "select * from issues where (closed = '0' and closed_at = '0000-00-00 00:00:00' and created > '2020-02-29 23:59:59') or modified like '%".date("Y-m-d")."%' order by id desc limit 62"; /*id='2502' closed != '1' order by id desc*/
    //$query = "select * from issues order by id desc limit 3"; /*id='2502' closed != '1' order by id desc*/

    //exit();
    
    $result = mysql_query($query);
    
    $cont=1;
    
    while($d = mysql_fetch_object($result)){
        
        if($d->approved == '0' and $d->closed == '0'){
            $cor = 'red';
        }elseif($d->approved == '1' and $d->closed == '0'){
            $cor = 'orange';
        }else{
            $cor = 'green';
        }
        $coment = false;
        $approved_at = $d->approved_at;
        $approved_by = $d->approved_by;        
        
        if($d->comment){
            
            $jde = array("\n","\r","\r\n","\n\r");
            
            $json_str = json_decode(trim(str_replace($jde," ",($d->comment))), true);
            if(is_array($json_str)){
                foreach ( $json_str as $e ){ 
                        
                    $DT = explode('.',$e[Date]);
                    
                    if($e[Action] == 'Accepted'){
                        $approved_at = dataBr($DT[0]);
                        $approved_by = $e[User];
                    }else{
                        $coment = ("$e[Action] - ".dataBr($DT[0])."<br>$e[User]<br>".((trim($e[Comment]))?'('.acentuacao($e[Comment]).')':false)); 
                    }
                    
                    
                } 
            }
        }

    echo "<h1>".$cont."</h1>";
    $cont++;

	$var = ' <div class="row painel_chamadas">
		<center><h1 class="titulo_chamada">'.utf8_decode('CHAMADA SCW (STOP CALL WAIT)').'</h1></center>
		<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
			<div class="col-md-7 col-sm-7 col-xs-7">
			
				<div class="col-md-12 col-sm-12 col-xs-12 dados">
					<span>'.$d->id.' - Aberto por:</span><p><i class="fa fa-user" aria-hidden="true"></i> '.((trim($d->employee))?utf8_encode($d->employee):utf8_encode('NAO IDENTIFICADO')).'</p>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-6 dados">
					<span>Data da Abertura:</span><p><i class="fa fa-arrow-up" aria-hidden="true"></i> '.dataBr($d->created).'</p>
				</div>'.(($approved_at)?'<div class="col-md-6 col-sm-6 col-xs-6 dados">
					<span>Data Recebimento:</span><p><i class="fa fa-arrow-down" aria-hidden="true"></i> '.($approved_at).'</p>
				</div>':false).'
                <!--
				<div class="col-md-6 col-sm-6 col-xs-6 dados">
					<span>Recebido por:</span><p><i class="fa fa-user" aria-hidden="true"></i> '.($approved_by).'</p>
				</div>
                
				<div class="col-md-6 col-sm-6 col-xs-6 dados">
					<span>Local/Origem/Setor:</span><p><i class="fa fa-map-marker" aria-hidden="true"></i> '.utf8_encode($d->cost_center).'</p>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-6 dados">
					<span>'.utf8_decode('Razão').':</span><p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.utf8_encode($d->issue_category).'</p>
				</div>
				-->
				'.(($coment)?'<div class="col-md-12 col-sm-12 col-xs-12 dados_comentario">
					<span>'.utf8_decode('Comentário').':</span><p><i class="fa fa-commenting-o" aria-hidden="true"></i> '.$coment.'</p>
				</div>':false).'
			</div>
			<div class="col-md-5 col-sm-5 col-xs-5">
				<div  class="campo_id" style="background-color:'.$cor.'">
				    <span><i class="fa fa-map-marker fa-2x" aria-hidden="true"></i> Local / Origem / Setor</span><p>'.($d->cost_center).'</p>
				    <span><i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i> '.utf8_decode('Razão').'</span><p>'.($d->issue_category).'</p>
				    <span><i class="fa fa-cogs fa-2x" aria-hidden="true"></i> '.utf8_decode('Máquina').'</span><p>'.($d->machine).'</p>
				    '.(($approved_by)?'<span><i class="fa fa-user fa-2x" aria-hidden="true"></i> Recebido por:</span><p>'.($approved_by).'</p>':false).'
				</div>
			</div>
		</div>
	</div>';
	
	echo $q = "insert into produto set data_inicial = '".date("Y-m-d 00:00:00")."', data_final = '".date("Y-m-d 23:59:59")."', posicao = '5', situacao = 'liberado', alteracao = '1', nivel='3', titulo = 'Integracao', texto = '".($var)."', tempo = '7'";
	mysql_query($q);
	

    }
?>
    