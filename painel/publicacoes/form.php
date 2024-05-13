<?php
    include("../includes/includes.php");
    
    if($_POST){
         if($_POST[acao] == 'novo'){

            $query = "insert into produto set 
                                            titulo = '".utf8_decode($_POST[titulo])."',
                                            data_inicial = '".dataMysql($_POST[data_inicial])."',
                                            data_final = '".dataMysql($_POST[data_final])."',
                                            situacao = '".$_POST[situacao]."',
                                            tempo = '".$_POST[tempo]."',
                                            texto = '".utf8_decode($_POST[texto])."',
                                            imagem = '".$_POST[imagem]."',
                                            posicao = '".$_POST[posicao]."',
                                            estacoes = '".$estacoes."',
                                            dias_semana = '".$dias_semana."',
                                            nivel = '".$_POST[nivel]."'
            ";

            mysql_query($query);


            
         }else if($_POST[acao] == 'alterar'){
            $query = "update produto set 
                                        titulo = '".utf8_decode($_POST[titulo])."',
                                        data_inicial = '".dataMysql($_POST[data_inicial])." 00:00:00',
                                        data_final = '".dataMysql($_POST[data_final])." 23:59:59',
                                        situacao = '".$_POST[situacao]."',
                                        tempo = '".$_POST[tempo]."',
                                        texto = '".utf8_decode($_POST[texto])."',
                                        imagem = '".$_POST[imagem]."',
                                        posicao = '".$_POST[posicao]."',
                                        nivel = '".$_POST[nivel]."' where codigo = '".$_POST[cod]."'
            ";
            mysql_query($query);


            $cod = $_POST[cod];
            
            // Alimentação das exibições /////////////////////////

            
            $gnd = "select dias_semana, estacoes, data_inicial, data_final from produto where codigo = '".$cod."'";
            $gndr = mysql_query($gnd);
            
            if(mysql_num_rows($gndr)){


                list($dias, $estacoes, $data_inicial, $data_final) = mysql_fetch_row($gndr);
        
                mysql_query("DELETE FROM `exibicoes` where tipo = 'produto' and cod = '".$cod."'");
                
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
                                    $q = "select * from horarios where tipo = 'produto' and cod = '".$cod."' and dia = '".$d[$j]."' order by inicio";
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
            // Fim da alimentação das exibições /////////////////////////

            /*
            // Alimentação das exibições /////////////////////////
            list($dias, $estacoes, $data_inicial, $data_final) = mysql_fetch_row(mysql_query("select dias_semana, estacoes, data_inicial, data_final from produto where codigo = '".$cod."'"));
    
            mysql_query("DELETE FROM `exibicoes` where tipo = 'produto' and cod = '".$cod."'");
            
            list($a1,$m1,$d1) = explode("-",$data_inicial);
            list($a2,$m2,$d2) = explode("-",$data_final);
            
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
                                $q = "select * from horarios where tipo = 'produto' and cod = '".$cod."' and dia = '".$d[$j]."' order by inicio";
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
            // Fim da alimentação das exibições /////////////////////////
            //*/


         }

        
        

        
        
        
        exit();
    }
    
    $query = "select * from produto where codigo = '".$_GET[cod]."'";
    $result = mysql_query($query);
    $d = mysql_fetch_object($result);


?>
<style>
    li[modelo]{
        cursor:pointer;
    }
    .mg{
        margin-bottom:20px;
    }
    .custom-range{
        width:100%;
        margin:20px;
    }
</style>

<div class="panel panel-default" style="margin-top:10px;">
  <div class="panel-heading">
      Cadastro / Edição das Publicações
  </div>
  <div class="panel-body">
            <div class='col-md-12 mg'>
                <label for="basic-url">Título</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon3"><i class="fas fa-concierge-bell fa-fw"></i></span>
                  <input type="text" class="form-control" placeholder="Título" id="titulo" value="<?=utf8_encode($d->titulo)?>">
                </div>
            </div>

            <div class='col-md-3 mg'>
                <label for="basic-url">Data Inicial</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon3"><i class="fas fa-angle-double-up fa-fw"></i></span>
                  <input type="text" class="form-control" placeholder="Data Inicial" id="data_inicial" value="<?=dataBr($d->data_inicial)?>">
                </div>
            </div>
            
            <div class='col-md-3 mg'>
                <label for="basic-url">Data Final</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon3"><i class="fas fa-angle-double-down fa-fw"></i></span>
                  <input type="text" class="form-control" placeholder="Data Final" id="data_final" value="<?=dataBr($d->data_final)?>">
                </div>
            </div>
            
            <div class='col-md-3 mg'>
                <label for="basic-url">Nível</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon3"><i class="fas fa-angle-double-down fa-fw"></i></span>
                  <select class="form-control" id="nivel">
                      <option value="1" <?=(($d->nivel == '1')?'selected':false)?>>Normal</option>
                      <option value="2" <?=(($d->nivel == '2')?'selected':false)?>>Médio</option>
                      <option value="3" <?=(($d->nivel == '3')?'selected':false)?>>Alto</option>
                  </select>
                </div>
            </div>
            
            <div class='col-md-3 mg'>
                <label for="basic-url">Situação</label>
                  <input situacao
                   <?=(($Conf->perfil == 'usuario' and !in_array('liberar_publicacoes',$ConfPermissoes))?'disabled':false)?>
                   <?=(($d->situacao == 'liberado')?'checked':'bloqueado')?>
                   data-on="Liberado"
                   data-off="Bloqueado"
                   data-toggle="toggle"
                   type="checkbox"
                   value="<?=$d->situacao?>"
                   data-width="100%"
                   XXdata-size="mini"
                   name="situacao"
                   id="situacao"
                   data-onstyle="primary"
                   data-offstyle="danger"
                   >
            </div>
            
            <div class='col-md-12 mg' >
                <label for="basic-url">Tempo Exibição: <span tempo><?=$d->tempo*1?> segundo(s)</span></label>
                <div class="input-group" style="width:100%">
                  <input type="range" class="custom-range" min="0" max="60" step="1" id="tempo" value="<?=$d->tempo?>">
                </div>            
            </div>

            <div class='col-md-12 mg' >
                <div class="input-group" style="margin-top:10px; text-align:right; width:100%">
                  <button class="btn btn-success" acao="<?=(($_GET[cod])?'alterar':'novo')?>" salvar style="margin-right:5px">Salvar</button>
                  <button class="btn btn-danger" cancelar>Cancelar</button>
                </div>
            </div>

            <div class='col-md-12 mg' >
                <div class="panel panel-primary" style="margin-top:10px;">
                  <div class="panel-heading">
                      Estações
                  </div>
                  <div TelaEstacoes class="panel-body">
                      
                  </div>
                </div>
            </div>
            
            <div class='col-md-12 mg' >
                <div class="paibel">
                    <ul class="nav nav-tabs">
                      <li semana opc="seg" role="presentation" class="active"><a>Seg</a></li>
                      <li semana opc="ter" role="presentation"><a>Ter</a></li>
                      <li semana opc="qua" role="presentation"><a>Qua</a></li>
                      <li semana opc="qui" role="presentation"><a>Qui</a></li>
                      <li semana opc="sex" role="presentation"><a>Sex</a></li>
                      <li semana opc="sab" role="presentation"><a>Sab</a></li>
                      <li semana opc="dom" role="presentation"><a>Dom</a></li>
                    </ul>
                    <div id="horarios" class="panel-body nav-tabs" style="border-left:#ddd solid 1px; border-right:#ddd solid 1px; min-height:300px;">
    
                    </div>
                </div>
            </div>






            <div class='col-md-12 mg' >
                
                <div class="paibel">
                    <ul class="nav nav-tabs">
                      <li modelo opc="4" i role="presentation" <?=(($d->posicao == '4' or !$d->posicao)?'class="active"':false)?>><a>Somente Imagem</a></li>
                      <li modelo opc="3" t role="presentation" <?=(($d->posicao == '3')?'class="active"':false)?>><a>Somente Texto</a></li>
                      <li modelo opc="1" it role="presentation" <?=(($d->posicao == '1')?'class="active"':false)?>><a>Imagem / Texto</a></li>
                      <li modelo opc="2" ti role="presentation" <?=(($d->posicao == '2')?'class="active"':false)?>><a>Texto / Imagem</a></li>
                      <input type="hidden" id="posicao" value="<?=$d->posicao?>" />
                    </ul>
                    <div id="visualizar" class="panel-body nav-tabs" style="border-left:#ddd solid 1px; border-right:#ddd solid 1px; min-height:300px;">
    
                    </div>
                </div>
            </div>


            <div class='col-md-12 mg' >
                <div class="input-group" style="margin-top:10px; text-align:right; width:100%">
                  <button class="btn btn-success" acao="<?=(($_GET[cod])?'alterar':'novo')?>" salvar style="margin-right:5px">Salvar</button>
                  <button class="btn btn-danger" cancelar>Cancelar</button>
                </div>
            </div>




  </div>
</div><br>


<script>
    $(function(){

        $('input[situacao]').bootstrapToggle();
        
        $('input[aplicativos]').change(function() {
            if($(this).prop('checked') == true){
                $(this).val('liberado');
            }else{
                $(this).val('bloqueado');
            }
        });
        

        $("#tempo").on( "mousemove mousedown mouseup" ,function(e){
            tempo = e.target.value;
            $("span[tempo]").html(tempo + ' segundo(s)');
        });


        <?php
        $posicao = (($d->posicao)?$d->posicao:'4');
        if($posicao){
        ?>
        $("#visualizar").html('<center><br><br><br><h3>CARREGANDO ...</h3><br><br><br></center>');
        $.ajax({
        	    url:"publicacoes/visualizar.php?posicao=<?=$d->posicao?>&codigo=<?=$d->codigo?>",
            	success: function(dados){
            		$("#visualizar").html(dados);
            	}
            });        
        <?php
        }
        ?>
        
        
        $("li[modelo]").click(function(){
            
            $("li[modelo]").removeClass("active"); 
            $(this).addClass("active");
            
            opc = $(this).attr("opc");
            
            $("#posicao").val(opc);
            
            $("#visualizar").html('<center><br><br><br><h3>CARREGANDO ...</h3><br><br><br></center>');
            $.ajax({
        	    url:"publicacoes/visualizar.php?codigo=<?=$d->codigo?>&posicao="+opc,
            	success: function(dados){
            		$("#visualizar").html(dados);
            	}
            });        


        });



        $("#horarios").html('<center><br><br><br><h3>CARREGANDO ...</h3><br><br><br></center>');
        $.ajax({
    	    url:"horarios/horarios.php?produto=<?=$d->codigo?>&dia=seg",
        	success: function(dados){
        		$("#horarios").html(dados);
        	}
        });        



        $("li[semana]").click(function(){
            
            $("li[semana]").removeClass("active"); 
            $(this).addClass("active");
            
            opc = $(this).attr("opc");
            $("#horarios").html('<center><br><br><br><h3>CARREGANDO ...</h3><br><br><br></center>');
            $.ajax({
        	    url:"horarios/horarios.php?produto=<?=$d->codigo?>&dia="+opc,
            	success: function(dados){
            		$("#horarios").html(dados);
            	}
            });        


        });



        
        $.ajax({
    	    url:"estacoes/index.php?produto=<?=$d->codigo?>",
        	success: function(dados){
        		$("div[TelaEstacoes]").html(dados);
        	}
        });        





        
        $("#data_inicial").mask("99/99/9999");
        $("#data_final").mask("99/99/9999");
        
        $("button[cancelar]").click(function(){
            popup.close();
        });
        
        $("button[salvar]").click(function(){
            $(".Cpg").css("display","block");
            titulo = $("#titulo").val();
            data_inicial = $("#data_inicial").val();
            data_final = $("#data_final").val();
            situacao = (($("#situacao").prop("checked"))?'liberado':'bloqueado');
            tempo = $("#tempo").val();
            texto = $("#column1").html();
            imagem = $("#imagem").attr("src");
            posicao = $("#posicao").val();
            nivel = $("#nivel").val();
            acao = $(this).attr("acao");
            //alert(tempo);
            $.ajax({
                url:"publicacoes/form.php",
                type:"POST",
                data:{
                    titulo:titulo,
                    data_inicial:data_inicial,
                    data_final:data_final,
                    situacao:situacao,
                    tempo:tempo,
                    texto:texto,
                    imagem:imagem,
                    posicao:posicao,
                    nivel:nivel,
                    acao:acao,
                    cod:'<?=$_GET[cod]?>'
                },
                success:function(dados){

                    $.ajax({
                        url:"publicacoes/index.php",
                        success:function(dados){
                            $("div[corpo]").html(dados);
                            popup.close();
                            $(".Cpg").css("display","none");
                        }
                    });
                    
                }
            });            
            

        });
        
        
        
        
    })
</script>
