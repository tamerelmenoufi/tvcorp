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
<div class="col-md-2 nivel">
    <i class="fas fa-square" style="color:green;"></i> ATENDIDO
</div>
<div class="col-md-2 nivel">
    <i class="fas fa-square" style="color:orange;"></i> EM ANDAMENTO
</div>
<div class="col-md-2 nivel">
    <i class="fas fa-square" style="color:red;"></i> NOVO
</div>
<div class="col-md-3">
    <center><img src="img/logomssss.png" style="height:50px;" /></center>    
</div>
</div>

    <script>
   
 

dayName = new Array ("domingo", "segunda", "terça", "quarta", "quinta", "sexta", "sábado")
monName = new Array ("janeiro", "fevereiro", "março", "abril", "maio", "junho", "agosto", "outubro", "novembro", "dezembro")
now = new Date
$("#clock2").html("<h1> Hoje é " + dayName[now.getDay() ] + ", " + now.getDate () + " de " + monName [now.getMonth() ]   +  " de "  +     now.getFullYear () + ". </h1>");
    
(function( $ ){
   $.fn.getDate = function(format) {

	var gDate		= new Date();
	var mDate		= {
	'S': gDate.getSeconds(),
	'M': gDate.getMinutes(),
	'H': gDate.getHours(),
	'd': gDate.getDate(),
	'm': gDate.getMonth() + 1,
	'y': gDate.getFullYear(),
	}

	// Apply format and add leading zeroes
	return format.replace(/([SMHdmy])/g, function(key){return (mDate[key] < 10 ? '0' : '') + mDate[key];});

	return getDate(str);
   }; 
})( jQuery );


// Usage: example #1. Write to '#date' div
$('#date').html($().getDate("d-m-y H:M:S"));

// Usage: ex2. Simple clock. Write to '#clock' div
function clock(){
	//$('#clock').html($().getDate("<b>d/m/y H:M:S</b>"))
	$('#clock').load("paginas/clock.php");
}
clock();
setInterval(clock, 10000); // One second

</script>