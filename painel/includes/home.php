<style>
    li[abas] a{
        cursor:pointer;
    }
</style>

<div class="container" style="margin-top:50px">
    <div class="row">
        <div class="col-md-12">
            
            
                <ul class="nav nav-tabs">
                  <!--<li abas opc="navegacao/principal.php" b role="presentation"><a>Principal</a></li>-->
                  <li abas opc="publicacoes/index.php" b role="presentation" class="active"><a>Publicações</a></li>
                  <li abas opc="audios/index.php" n role="presentation"><a>Áudios</a></li>
                  <li abas opc="avisos/index.php" c role="presentation"><a>Avisos</a></li>
                </ul>
                <div corpo class="panel-body nav-tabs" style="border-left:#ddd solid 1px; border-right:#ddd solid 1px; min-height:300px;">

                </div>

        </div>
    </div>
</div>


<script>
    
    $(function(){
        $(".Cpg").css("display","block");
        $.ajax({
            url:'publicacoes/index.php',
            success:function(dados){
                $("div[corpo]").html(dados);
                $(".Cpg").css("display","none");
            }
        });
        
        $("li[abas]").click(function(){
            $(".Cpg").css("display","block");
            $("li[abas]").removeClass("active"); 
            $(this).addClass("active");
            local = $(this).attr("opc");
            $.ajax({
                url:local,
                title:false,
                success:function(dados){
                    $("div[corpo]").html(dados);
                    $(".Cpg").css("display","none");
                }
            });
            
        });
        
    });   

</script>