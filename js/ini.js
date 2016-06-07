$(function(){
var pop = function(){
	$('#screen').css({	"display": "block", opacity: 0.7, "width":$(document).width(),"height":$(document).height()});
	$('body').css({"overflow":"hidden"});
	$('#box').css({"display": "block"}).click(function(){$(this).css("display", "none");$('#screen').css("display", "none")});
}
$('#button').click(pop);
});
