<style>
    .nivel{
        text-align:center;
        padding-top:15px;
        color:#fff;
        font-weight:bold;
    }
</style>
<div class="clearfix col-md-12" style="margin-top:auto; ">
<div class="col-md-3">
 <div id="clock" style="color: #fff; font-size:25px;text-align:center;text-shadow: 2px 2px 5px #000"></div>
</div>
<div class="col-md-5 nivel">
    <!--<i class="fas fa-square" style="color:green;"></i> ATENDIDO

    <i class="fas fa-square" style="color:orange;"></i> EM ANDAMENTO

    <i class="fas fa-square" style="color:red;"></i> NOVO-->
</div>
<div class="col-md-2">
    <center><i informacoes class="fa fa-info-circle fa-3x" style="color:#fff; cursor:pointer"></i></center>    
</div>
<div class="col-md-2">
    <center><img src="img/logom.png" style="height:35px;" /></center>    
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