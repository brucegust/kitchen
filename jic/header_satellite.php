<?php
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
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script>
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
	
	$("menu_toggle").click(function(e) {
	e.preventDefault();
	$("page_content_wrapper").toggleClass("menuDisplayed");
	alert("hello");
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
		<div class="store_link"></div>
	</div>
	<div class="no_cam_sign"></div>
	<!-- this is your navbar -->
	<?php include("navbar.php"); ?>
</div>
<div style="width:1000px; margin:auto;">
	<div style="background-image:url(images/satellite_text_header.jpg); background-repeat:no-repeat; width:857px; height:81px; margin:auto;">
	<a href="index.php"><div style="width:328px; height:45px; position:relative; display:inline-block;"></div></a>
	<a href="all_doors.php"><div style="width:82px; height:22px; position:relative; display:inline-block; margin-left:10px;"></div></a>
	<a href="cabinets_home.php"><div style="width:52px; height:22px; position:relative; display:inline-block; margin-left:-3px;"></div></a>
	<a href="cabinets_home.php"><div style="width:98px; height:22px; position:relative; display:inline-block; margin-left:-1px;"></div></a>
	<a href="posts_home.php"><div style="width:138px; height:22px; position:relative; display:inline-block; margin-left:2px;"></div></a>
	<a href="posts_home.php"><div style="width:113px; height:22px; position:relative; display:inline-block; margin-left:2px;"></div></a>
	</div>
	
	<div style="background-image:url(images/satellite_filler.jpg); background-repeat:y-repeat; width:857px; height:auto; margin:auto;">	
		<div style="width:790px; min-height:750px; margin-left:50px;"><br><!--main content-->