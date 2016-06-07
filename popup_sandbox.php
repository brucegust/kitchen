<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(function(){
	var pop = function(){
		$('#screen').css({'display': 'block', opacity: 0.7, 'width':$(document).width(),'height':$(document).height()});
		$('body').css({'overflow':'hidden'});
		$('#box').css({'display': 'block'});
	}
	var closePop = function() {
	$('#screen').css('display', 'none');	
	}
	
$('#button').click(pop);
$('#closeBut').click(closePop);
});
</script>
<style>
#box
{
    width: 500px;
    height: 350px;
    background: #FFF;
    position: absolute;
    margin-left: -225px;
    margin-top: -225px;
    left: 50%;
    top: 50%;
    z-index: 20;
    display: none;
}
 
#screen
{
    position: absolute;
    left: 0;
    top: 0;
    background: #000;
	display: none;
}
</style>
</head>

<body>

<input type='button' value='grey out me!' id='button'/>

<div id='screen'>
  <div id='box'>what's this look like...?<br><br>
     <button id="closeBut" >Close This</button>
  </div>
</div>
</div>
</body>
</html>

                                          