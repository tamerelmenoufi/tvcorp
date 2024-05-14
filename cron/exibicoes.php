<?php

        include("../painel/includes/connect.php");

            mysql_query("DELETE FROM `exibicoes`");

            // Alimentação das exibições /////////////////////////
            $gnd = "select codigo, dias_semana, estacoes, data_inicial, data_final from aviso where (NOW() between data_inicial and data_final) and situacao = 'liberado'";
            $gndr = mysql_query($gnd);
            
            if(mysql_num_rows($gndr)){
            
                while($x = mysql_fetch_row($gndr)){
                    list($cod, $dias, $estacoes, $data_inicial, $data_final) = $x;
            
                    // mysql_query("DELETE FROM `exibicoes` where tipo = 'aviso'");
                    
                    //list($a1,$m1,$d1) = explode("-",date("Y-m-d"));
                    list($a2,$m2,$d2) = explode("-",date("Y-m-d"));
                    
                    //$ini = mktime(0,0,0,$m1,$d1,$a1);
                    $ini = mktime(0,0,0,date("m"),date("d"),date("Y"));
                    $fim = mktime(23,59,59,$m2,$d2,$a2);
            
                    $e = explode("|",$estacoes);
                    $d = explode("|",$dias);
                    for($k=$ini;$k<$fim;$k=$k+86400){
                        $data = date("Y-m-d",$k);
                        for($i=0;$i<count($e);$i++){
                            if($e[$i]){
                                for($j=0;$j<count($d);$j++){
                                    if($d[$j]){
                                        $q = "select * from horarios where tipo = 'aviso' and cod = '".$cod."' and dia = '".$d[$j]."' order by inicio";
                                        $r = mysql_query($q);
                                        while($t = mysql_fetch_object($r)){
                                            //	tipo 	cod 	estacao 	dia 	data_inicial 	data_final 	situacao
                                            $com = "insert into exibicoes set tipo = 'aviso', cod = '".$cod."', dia = '".$d[$j]."', estacao = '".$e[$i]."', data_inicial = '".$data." ".$t->inicio."', data_final = '".$data." ".$t->fim."'";
                                            mysql_query($com);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            // Fim da alimentação das exibições /////////////////////////







            // Alimentação das exibições /////////////////////////
            ////////////////////////////////////////NOVA VERSÃO /////////////////////////////////////////////////
            $gnd = "select codigo, dias_semana, estacoes, data_inicial, data_final from audios where (NOW() between data_inicial and data_final) and situacao = 'liberado'";
            $gndr = mysql_query($gnd);
            
            if(mysql_num_rows($gndr)){

                while($x = mysql_fetch_row($gndr)){
                    list($cod, $dias, $estacoes, $data_inicial, $data_final) = $x;
            
                    // mysql_query("DELETE FROM `exibicoes` where tipo = 'audio' and cod = '".$cod."'");
                    
                    //list($a1,$m1,$d1) = explode("-",date("Y-m-d"));
                    list($a2,$m2,$d2) = explode("-",date("Y-m-d"));
                    
                    //$ini = mktime(0,0,0,$m1,$d1,$a1);
                    $ini = mktime(0,0,0,date("m"),date("d"),date("Y"));
                    $fim = mktime(23,59,59,$m2,$d2,$a2);
            
                    $e = explode("|",$estacoes);
                    $d = explode("|",$dias);
                    for($k=$ini;$k<$fim;$k=$k+86400){
                        $data = date("Y-m-d",$k);
                        for($i=0;$i<count($e);$i++){
                            if($e[$i]){
                                for($j=0;$j<count($d);$j++){
                                    if($d[$j]){
                                        $q = "select * from horarios where tipo = 'audio' and cod = '".$cod."' and dia = '".$d[$j]."' order by inicio";
                                        $r = mysql_query($q);
                                        while($t = mysql_fetch_object($r)){
                                            //	tipo 	cod 	estacao 	dia 	data_inicial 	data_final 	situacao
                                            $com = "insert into exibicoes set tipo = 'audio', cod = '".$cod."', dia = '".$d[$j]."', estacao = '".$e[$i]."', data_inicial = '".$data." ".$t->inicio."', data_final = '".$data." ".$t->fim."', situacao = '1'";
                                            mysql_query($com);
                                        }
                                        
                                        mysql_query("update exibicoes set situacao = '0' where data_inicial >= NOW() and tipo = 'audio' and cod = '".$cod."' and dia = '".$d[$j]."' and estacao = '".$e[$i]."'");
                                        
                                    }
                                }
                            }
                        }
                    }
                }
            }
            // Alimentação das exibições /////////////////////////
            





            // Alimentação das exibições /////////////////////////


            $gnd = "select codigo, dias_semana, estacoes, data_inicial, data_final from produto where (NOW() between data_inicial and data_final) and situacao = 'liberado'";
            $gndr = mysql_query($gnd);
            
            if(mysql_num_rows($gndr)){

                while($x = mysql_fetch_row($gndr)){

                    list($cod, $dias, $estacoes, $data_inicial, $data_final) = $x;
            
                    // mysql_query("DELETE FROM `exibicoes` where tipo = 'produto' and cod = '".$cod."'");
                    
                    //list($a1,$m1,$d1) = explode("-",date("Y-m-d"));
                    list($a2,$m2,$d2) = explode("-",date("Y-m-d"));
                    
                    //$ini = mktime(0,0,0,$m1,$d1,$a1);
                    $ini = mktime(0,0,0,date("m"),date("d"),date("Y"));
                    $fim = mktime(23,59,59,$m2,$d2,$a2);
            
                    $e = explode("|",$estacoes);
                    $d = explode("|",$dias);
                    for($k=$ini;$k<$fim;$k=$k+86400){
                        $data = date("Y-m-d",$k);
                        for($i=0;$i<count($e);$i++){
                            if($e[$i]){
                                for($j=0;$j<count($d);$j++){
                                    if($d[$j]){
                                        echo $q = "select * from horarios where tipo = 'produto' and cod = '".$cod."' and dia = '".$d[$j]."' order by inicio";
                                        $r = mysql_query($q);
                                        while($t = mysql_fetch_object($r)){
                                            //	tipo 	cod 	estacao 	dia 	data_inicial 	data_final 	situacao
                                            $com = "insert into exibicoes set tipo = 'produto', cod = '".$cod."', dia = '".$d[$j]."', estacao = '".$e[$i]."', data_inicial = '".$data." ".$t->inicio."', data_final = '".$data." ".$t->fim."'";
                                            mysql_query($com);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            // Fim da alimentação das exibições /////////////////////////

