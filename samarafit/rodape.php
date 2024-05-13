<style>
    .nivel{
        text-align:center;
        padding-top:15px;
        color:#fff;
        font-weight:bold;
    }
</style>
<div class="clearfix col-md-12" style="margin-top:auto;">
<div class="col-md-3">
 <div id="clock" style="color: #ccc; font-size:25px;text-align:center;text-shadow: 2px 2px 2px #000"></div>
</div>
<div class="col-md-4 nivel" style=" color:#333">
    
</div>
<div class="col-md-1">
  
</div>
<div class="col-md-4">
    <img src="img/logopainel.png" style="height:55px; float:right;margin-top: -7px" />
 
</div>
</div>

<script>

$(function(){


    $('#clock').load("data.php");
    setInterval(function(){
        $('#clock').load("data.php");
    }, 10000);

    $("i[informacoes]").click(function(){
        
        Estacoes = $.dialog({
            content:"url:informacoes.php",
            title:"Identificação da Estação",
        }); 
        
    });  
})


</script>