<?php
session_start();
$session_id = session_id();
 $_SESSION['door'] = "1";
//echo $session_id;
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include 'Mobile_Detect.php';
$detect = new Mobile_Detect();
if ($detect->isMobile()) {
// Any mobile device.
header("Location:mobile/index.php");
exit();
}

include("carter.inc");
$cxn = new mysqli($host,$user,$password,$database);
if($cxn->connect_errno)
{
	$err="CONNECT FAIL: "
	.$cxn->connect_errno
	. ' '
	.$cxn->connect_error
	;
	trigger_error($err, E_USER_ERROR);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>KitchenCabinetCo.com by Online Cabinets Direct</title>
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="css/carousel_stylesheet.css" rel="stylesheet" type="text/css" />
<link href="css/sidebar.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script language="Javascript">
	function MM_jumpMenu(targ,selObj,restore){ //v3.0
	eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	if (restore) selObj.selectedIndex=0;
}

</script>

<script>
$.ajaxSetup({ cache: false });

$(document).ready(function(){
	
	
//this is your starting point where all your slidingNavTerms are hidden and your display_hide links are displayed

		$(".slidingNavTerms").hide();
		$(".display_hide").show();
 
//here's your actual function, as far as a user clicking on a link in order to see the "hidden" link beneath it 
 
		$('.display_hide').click(function(){
			$(this).next().slideToggle();
			//$(this).html("System Performance &#9650;");
		});
	
//this is the command that corresponds to all of the links on your main nav bar in that anytime the user hovers over a "primary" link, it sets all of the previously exposed links to "hidden." This way
//any expanded menus don't linger. Since I've got graphic to correspond with every link, I gave each link a function. It may not be the most elegant approach, but it got the job done.	

	$('.restore').hover(function(){
		$(".slidingNavTerms").hide();
		$(".display_hide").show();
	});
	
	$('.button').click(function() {
		//$('.screen'+$(this).val()).text('Button clicked: ' + $(this).val());
		$('#screen').show();
		$(this).next().show("slow");
	});
	
	$('.close_window').click(function() {
		//$('.screen'+$(this).val()).text('Button clicked: ' + $(this).val());
		$('#screen').hide();
		//$(this).prev().hide("slow");
		//$(this).hide("slow");
		$(".box").hide("slow");
	});
	
	/*$(".menu_toggle").click(function(e){
	e.preventDefault();
	$('#screen').hide();
	$(".box").hide("slow");
	$("#wrapper").toggleClass("menuDisplayed");
	$(window).scrollTop(0);
	});*/
	
	$("#show_cart").click(function(e){
	e.preventDefault();
	$('#sidebar_content').load('ajax.php?session_id=<?php echo $session_id;?>');
	//$('#sidebar_content').load(url +' #sidebar_content');
	$("#wrapper").toggleClass("menuDisplayed");
	$(window).scrollTop(0);
	$('#show_cart_button').hide();
	$("#select_option").hide();
	$(".button").hide();
	$('#screen').show();
	});
	
	$("#myForm").submit(function(e) {// use the correct ID
		e.preventDefault();// we don\'t want to submit anything until we\'ve first determined that the user\'s not get ready to duplicate something that\'s already in the database.
		
		var devTest = $( "#myForm" ).serialize(); //packaging all of our submitted variables into one, neat little var
		//alert("Develop test, URL prams = "+devTest);// publish a little alert box that lets you see your posted variables
		$.post( "ajax.php", devTest) // posting all of our variables to ajax.php 
			.done(function(Drumstick) { //the "done"function is what you\'re doing when the AJAX call (in this case the ajax.php page) is "done" running and we\'re now hearing back from the server
				if (Drumstick.charAt(0) == "E") //"Drumstick.charAT(0) is just fancy code for the first letter of what you\'re getting back from the server
				{
					alert("ERROR - The submarket has been entered before");
				}
				else 
				{	
					//alert(Drumstick);
					$('#sidebar_content').html(Drumstick);
					$(".box").hide("slow");
					$("#wrapper").toggleClass("menuDisplayed");
					$(window).scrollTop(0);
					$("#select_option").hide();
					$(".add_to_cart_button").hide();
					$("#show_cart_button").hide();
					$('#screen').show();
				}
			});
		});	
		
		$("#doorForm").submit(function(e) {// use the correct ID
		e.preventDefault();// we don\'t want to submit anything until we\'ve first determined that the user\'s not get ready to duplicate something that\'s already in the database.
		
		var devTest = $( "#doorForm" ).serialize(); //packaging all of our submitted variables into one, neat little var
		//alert("Develop test, URL prams = "+devTest);// publish a little alert box that lets you see your posted variables
		$.post( "ajax.php", devTest) // posting all of our variables to ajax.php 
			.done(function(Drumstick) { //the "done"function is what you\'re doing when the AJAX call (in this case the ajax.php page) is "done" running and we\'re now hearing back from the server
				if (Drumstick.charAt(0) == "E") //"Drumstick.charAT(0) is just fancy code for the first letter of what you\'re getting back from the server
				{
					alert("ERROR - The submarket has been entered before");
				}
				else 
				{	
					//alert(Drumstick);
					$('#sidebar_content').html(Drumstick);
					$(".box").hide("slow");
					$("#wrapper").toggleClass("menuDisplayed");
					$(window).scrollTop(0);
					$("#select_option").hide();
					$(".add_to_cart_button").hide();
					$("#show_cart_button").hide();
					$('#screen').show();
				}
			});
		});	
	
		$("#menu_toggle_option").click(function(e){
		e.preventDefault();
		//alert("ajax_2.php");
		$('#sidebar_content').load('ajax.php?session_id=<?php echo $session_id;?>');
		$("#wrapper").toggleClass("menuDisplayed");
		$('#show_cart_button').show();
		$("#select_option").show();
		$(".button").show();
		$('#screen').hide();
		return false;
		 //alert("The paragraph was clicked.");
	});
	
	
	
});

</script>
</head>
<?php 
include("carter.inc"); 
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
?>
<body><!-- this is your browser container-->
<div id="screen"></div>
<div class="navbar_background">
<div style="background-color:#000000; height:49px; width:100%; position:absolute; z-index:-2"></div>
	<div class="bbb_logo"></div>
	<div class="social_icons">
		<a href="http://facebook.com" target="_blank"><div class="facebook_link"></div></a>
		<div class="blog_link"></div>
		<?php
		if(isset($session_id)&&$session_id<>"")
		{
		?>
			<a href="checkout.php?session_id=<?php echo $session_id;?>"><div class="store_link"></div></a>
		<?php
		}
		else
		{
		?>
			<a href="no_shopping_cart.php"><div class="store_link"></div></a>
		<?php
		}
		?>
		<a href="#"><div class="avatar_link"></div></a>
	</div>
	<div class="no_cam_sign"></div>
	<!-- this is your navbar -->
	<?php include("navbar.php"); ?>
</div>
<div id="wrapper">
	<div id="page_content_wrapper">
		<div id="sidebar_wrapper">
			<div style="background-color:#b20606; height:35px; width:50%; text-align:center; color:#ffffff; padding-top:5px; font-variant:small-caps; display:inline-block;"><a href="#" id="menu_toggle_option" style="color:#ffffff;">Continue Shopping</a></div><div style="background-color:#0687b2; height:35px; width:50%; text-align:center; color:#ffffff; padding-top:5px; font-variant:small-caps; display:inline-block;"><a href="checkout.php?session_id=<?php echo $session_id;?>" style="color:#ffffff;">Checkout</a></div>
			<br><br>
				<div id="sidebar_content"></div>
			</div>
			<!-- end of cart sidebar-->
		<div style="margin:auto; width:1000px; height:auto; margin-bottom:50px;"><!-- this centers your content-->
			<br><br>
			<div style="background-image:url(images/satellite_text_header.jpg); background-repeat:no-repeat; width:857px; height:81px; margin:auto;"><!-- filler-->
			<a href="index.php"><div style="width:328px; height:45px; position:relative; display:inline-block;"></div></a>
			<a href="all_doors.php"><div style="width:82px; height:22px; position:relative; display:inline-block; margin-left:10px;"></div></a>
			<a href="cabinets_home.php"><div style="width:52px; height:22px; position:relative; display:inline-block; margin-left:-3px;"></div></a>
			<a href="trim_home.php"><div style="width:98px; height:22px; position:relative; display:inline-block; margin-left:-1px;"></div></a>
			<a href="posts_home.php"><div style="width:138px; height:22px; position:relative; display:inline-block; margin-left:2px;"></div></a>
			<a href="accessories_home.php"><div style="width:113px; height:22px; position:relative; display:inline-block; margin-left:2px;"></div></a>
			</div>
			<div style="background-image:url(images/satellite_filler.jpg); background-repeat:y-repeat; width:857px; height:auto; margin:auto;">	
				<div style="width:790px; min-height:750px; margin-left:50px;"><br><!--main content-->	