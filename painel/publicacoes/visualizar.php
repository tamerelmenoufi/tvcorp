<?php
    include("../includes/includes.php");


    if($_GET[codigo]){
        
        $query = "select * from produto where codigo = '".$_GET[codigo]."'";
        $result = mysql_query($query);
        $d = mysql_fetch_object($result);
        
    }


            if($_GET[posicao] == '1'){
            ?>

            <table style="width:100%; height:350px; border:solid 1px green">
                <tr>
                    <td style="width:50%; position:relative;">
                        <input type="file" style="width:100%; height:100%; left:0; top:0; position:absolute; opacity:0;" />
                        <img src="<?=$d->imagem?>" id="imagem" alterado='' class="img-responsive" /> 
                    </td>
                    <td style="width:50%; border-right:solid 1px green">
                        <div id='column1' style='color:#CCC; width:100%; height:100%; font-size:55px; z-index:0'><?=utf8_encode($d->texto)?></div>
                    </td>
                </tr>
            </table>


            <?php
            }
            if($_GET[posicao] == '2'){
            ?>


            <table style="width:100%; height:350px; border:solid 1px green">
                <tr>
                    <td style="width:50%; border-right:solid 1px green">
                        <div id='column1' style='color:#CCC; width:100%; height:100%; font-size:55px; z-index:0'><?=utf8_encode($d->texto)?></div>
                    </td>
                    <td style="width:50%; position:relative;">
                        <input type="file" style="width:100%; height:100%; left:0; top:0; position:absolute; opacity:0;" />
                        <img src="<?=$d->imagem?>" id="imagem" alterado='' class="img-responsive" /> 
                    </td>
                </tr>
            </table>

            <?php
            }
            if($_GET[posicao] == '3'){
            ?>



            <table style="width:100%; height:350px; border:solid 1px green">
                <tr>
                    <td style="width:100%;">
                        <div id='column1' style='color:#CCC; width:100%; height:100%; font-size:55px; z-index:0'><?=utf8_encode($d->texto)?></div>
                    </td>
                </tr>
            </table>

            <?php
            }
            if($_GET[posicao] == '4'){
            ?>


            <table style="width:100%; height:350px; border:solid 1px green">
                <tr>
                    <td style="width:100%; position:relative;">
                        <input type="file" style="width:100%; height:100%; left:0; top:0; position:absolute; opacity:0;" />
                        <center><img src="<?=$d->imagem?>" id="imagem" alterado='' class="img-responsive" /></center>
                    </td>
                </tr>
            </table>

            <?php
            }
            ?>



    <script type="text/javascript">

    $(function(){
        
        <?php
        if($_GET[posicao] != '4'){
        ?>
        
      	//function editor_inline() {
      	    // The inline editor should be enabled on an element with "contenteditable" attribute set to "true".
        // Otherwise CKEditor will start in read-only mode.
        var introduction = document.getElementById('column1');
        introduction.setAttribute('contenteditable', true);
    
        CKEDITOR.inline('column1', {
            // Allow some non-standard markup that we used in the introduction.
            //extraAllowedContent: '<?=$d->titulo?>',
            //removePlugins: 'stylescombo',
            //extraPlugins: 'sourcedialog',
            // Show toolbar on startup (optional).
            //startupFocus: false,
            toolbar: [
                [ 'Bold', 'Italic'/*,"TextColor"*/, "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock" ]
            ]
        });
      	//}
        <?php
        }
        ?>

        if (window.File && window.FileList && window.FileReader) {
            
            $('input[type="file"]').change(function () {
                

                if($(this).val()){
                    //$(".Cpg").css("display","block");
                    var files = $(this).prop("files");
                    for (var i = 0; i < files.length; i++) {
                        (function (file) {
                                var fileReader = new FileReader();
                                fileReader.onload = function (f) {
            						var Base64 = f.target.result;
            						var type = file.type;
            						var name = file.name;
            						
            						$("#imagem").attr('src',Base64);
            						$("#imagem").attr('alterado','1');
                                    //$(".Cpg").css("display","none");
    
                                };
                                fileReader.readAsDataURL(file);
                        })(files[i]);
                    }

                }
                
            });
        }
        else {
            alert('Nao suporta HTML5');
        }


    })

              
    </script>