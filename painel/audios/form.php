<?php
    include("../includes/includes.php");
    
    if($_POST[tempo]){
        
        $q = "update audios set tempo = '".$_POST[tempo]."' where codigo = '".$_POST[cod]."'";
        //mysql_query($q);

        //exit();
        
    }
    
    
    
    if($_POST[acao]){
        if($_POST[acao] == 'novo'){
            
            if($_POST[imagem]){
                $ext = explode('.',$_POST[nome]);
                $ext = $ext[count($ext)-1];
                
                $img = str_replace("data:".$_POST[tipo].";base64,",false,$_POST[imagem]);
                $img = base64_decode($img);
                $url = md5($_POST[nome]).".".$ext;
                
                if(is_file("audios/".$_POST[atu])){
                    unlink("audios/".$_POST[atu]);
                }
                file_put_contents("audios/".$url,$img);
                
            }
            
    
            $query = "insert into audios set ".(($url)?"url = '".($url)."',":false)."
                                             titulo = '".utf8_decode($_POST[titulo])."',
                                             data_inicial = '".dataMysql($_POST[data_inicial])."',
                                             data_final = '".dataMysql($_POST[data_final])."',
                                             situacao = '".strtolower($_POST[situacao])."',
                                             tempo = '".$_POST[tempo]."',
                                             alteracao = '1'
                                            ";
                                            
            //file_put_contents('xxx.txt',$query);
                                            
        }elseif($_POST[acao] == 'alterar'){
    
            if($_POST[imagem]){
                $ext = explode('.',$_POST[nome]);
                $ext = $ext[count($ext)-1];
                
                $img = str_replace("data:".$_POST[tipo].";base64,",false,$_POST[imagem]);
                $img = base64_decode($img);
                $url = md5($_POST[nome]).".".$ext;
                
                if(is_file("audios/".$_POST[atu])){
                    unlink("audios/".$_POST[atu]);
                }
                file_put_contents("audios/".$url,$img);
                
            }
    
            $query = "update audios set ".(($url)?"url = '".($url)."',":false)."
                                             titulo = '".utf8_decode($_POST[titulo])."',
                                             data_inicial = '".dataMysql($_POST[data_inicial])." 00:00:00',
                                             data_final = '".dataMysql($_POST[data_final])." 23:59:59',
                                             situacao = '".strtolower($_POST[situacao])."',
                                             tempo = '".$_POST[tempo]."',
                                             alteracao = '1'
                        where codigo = '".$_POST[cod]."'";
        
            //file_put_contents('xxx.txt',$query);
        }
        if(mysql_query($query)){
            
            if($_POST[acao] == 'alterar'){
                $cod = $_POST[cod];
            }else{
                $cod = mysql_insert_id();
            }


            // Alimentação das exibições /////////////////////////
            ////////////////////////////////////////NOVA VERSÃO /////////////////////////////////////////////////
            $gnd = "select dias_semana, estacoes, data_inicial, data_final from audios where codigo = '".$cod."' and NOW() between data_inicial and data_final";
            $gndr = mysql_query($gnd);
            
            if(mysql_num_rows($gndr)){
                list($dias, $estacoes, $data_inicial, $data_final) = mysql_fetch_row($gndr);
        
        
                mysql_query("DELETE FROM `exibicoes` where tipo = 'audio' and cod = '".$cod."'");
                
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
            
            /*
            list($dias, $estacoes, $data_inicial, $data_final) = mysql_fetch_row(mysql_query("select dias_semana, estacoes, data_inicial, data_final from audios where codigo = '".$cod."'"));
    
            mysql_query("DELETE FROM `exibicoes` where tipo = 'audio' and cod = '".$cod."'");
            
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
            // Fim da alimentação das exibições /////////////////////////
            //*/
            
            echo "ok";
    
        }
    }
    
    $query = "select * from audios where codigo = '".$_GET[cod]."'";
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
      Cadastro / Edição do áudio
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
                <label for="basic-url">Situação</label>
                  <input situacao
                   <?=(($Conf->perfil == 'usuario' and !in_array('liberar_audios',$ConfPermissoes))?'disabled':false)?>
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



            <div class="col-md-8 mg">
    
                <input type="file" id="file"> 
                <input type="hidden" id="imagem" url="<?=$d->url?>" imagem="" nome="" tipo="" value="" atu="<?=$d->url?>" >
    
            </div>            
            <div class="col-md-4 mg">
                <?php
                if(is_file("audios/".$d->url)){
                ?>
                <audio id="audio" autoplay="autoplay" controls="controls">
                    <source src="audios/audios/<?=$d->url?>" type="audio/mp3" />
                    seu navegador não suporta HTML5
                </audio>
                <?php
                }else{
                ?>
                <audio id="audio" autoplay="autoplay" controls="controls"></audio>
                <?php
                }
                ?>
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
                <div class="input-group" style="margin-top:10px; text-align:right; width:100%">
                  <button class="btn btn-success" acao="<?=(($_GET[cod])?'alterar':'novo')?>" salvar style="margin-right:5px">Salvar</button>
                  <button class="btn btn-danger" cancelar>Cancelar</button>
                </div>
            </div>

  </div>
</div><br>


<script>
    $(function(){

    //*



    $('.selectpicker').selectpicker();
    
        $("#file").fileinput({
                                showPreview: false,
                                showRemove: false,
                                showUpload: false,
                                browseLabel: 'áudio',
                                browseIcon: "<i class=\"fa fa-volume-up\"></i> ",
                                
                            });


        //Upload do arquivo croqui
        if (window.File && window.FileList && window.FileReader) {
            
            $('input[type="file"]').change(function () {
                
                var files = $(this).prop("files");
                for (var i = 0; i < files.length; i++) {
                    (function (file) {
                            var fileReader = new FileReader();
                            fileReader.onload = function (f) {
        						var Base64 = f.target.result;
        						var type = file.type;
        						var name = file.name;
        						$("#imagem").attr("imagem",Base64);
        						$("#imagem").attr("nome",name);
        						$("#imagem").attr("tipo",type);

                            };
                            fileReader.readAsDataURL(file);
                    })(files[i]);
                }
                //$(this).fileinput('clear');

            });
        }
        else {
            alert('Não suporta HTML5');
        }
        //fim do Upload do arquivo croqui



        $('input[situacao]').bootstrapToggle();
        
        $('input[aplicativos]').change(function() {
            if($(this).prop('checked') == true){
                $(this).val('liberado');
            }else{
                $(this).val('bloqueado');
            }
        });
        


        TempoDoAudio = setInterval(function(){
            audio = document.getElementById('audio');
            Duracao = Math.floor(audio.duration)*1000;
            
            
            /*
            if(Duracao != '<?=$d->tempo?>'){
                $.ajax({
                    url:"audios/form.php",
                    type:"POST",
                    data:{
                        tempo:Duracao,
                        cod:'<?=$_GET[cod]?>',
                    },
                    success:function(dados){
                        //alert(dados);
                    }
                });
            }
            */
            
            
        }, 3000);


        $("#horarios").html('<center><br><br><br><h3>CARREGANDO ...</h3><br><br><br></center>');
        $.ajax({
    	    url:"horarios/horarios.php?audio=<?=$d->codigo?>&dia=seg",
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
        	    url:"horarios/horarios.php?audio=<?=$d->codigo?>&dia="+opc,
            	success: function(dados){
            		$("#horarios").html(dados);
            	}
            });        


        });



        
        $.ajax({
    	    url:"estacoes/index.php?audio=<?=$d->codigo?>",
        	success: function(dados){
        		$("div[TelaEstacoes]").html(dados);
        	}
        });        

        
        $("#data_inicial").mask("99/99/9999"); //99:99
        $("#data_final").mask("99/99/9999"); // 99:99
        
        $("button[cancelar]").click(function(){
            clearInterval(TempoDoAudio);
            popup.close();
        });
        
        $("button[salvar]").click(function(){
            clearInterval(TempoDoAudio);
            $(".Cpg").css("display","block");
            titulo = $("#titulo").val();
            data_inicial = $("#data_inicial").val();
            data_final = $("#data_final").val();
            situacao = (($("#situacao").prop("checked"))?'liberado':'bloqueado');
            tempo = $("#tempo").val();
            acao = $(this).attr("acao");

        var imagem = (($("#imagem").attr("imagem"))?$("#imagem").attr("imagem"):'');
        var url = ((imagem)?$("#imagem").attr("url"):'');
        var atu = ((imagem)?$("#imagem").attr("atu"):'');
        var nome = ((imagem)?$("#imagem").attr("nome"):'');
        var tipo = ((imagem)?$("#imagem").attr("tipo"):'');

        

            $.ajax({
                url:"audios/form.php",
                type:"POST",
                data:{
                    titulo:titulo,
                    data_inicial:data_inicial,
                    data_final:data_final,
                    situacao:situacao,
                    tempo:Duracao,
                    acao:acao,
                    cod:'<?=$_GET[cod]?>',
                    imagem:imagem,
                    url:url,
                    atu:atu,
                    nome:nome,
                    tipo:tipo
                    
                },
                success:function(dados){

                    $.ajax({
                        url:"audios/index.php",
                        success:function(dados){
                            $("div[corpo]").html(dados);
                            popup.close();
                            $(".Cpg").css("display","none");
                        }
                    });
                    
                }
            });            
            

        });
        
        //*
        
    })
</script>
