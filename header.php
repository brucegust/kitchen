<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
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
<link href="css/stylesheet_index.css" rel="stylesheet" type="text/css" />
<link href="css/carousel_stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<!--<map name="pulls">
<area shape="rect" coords="44,19,217,96" href="all_doors.php">
<area shape="rect" coords="260,19,434,96" href="cabinets_home.php">
<area shape="rect" coords="469,19, 635,96" href="details.php">
<area shape="rect" coords="669,19,855,96" href="posts.php">
<area shape="rect" coords="889,19,1063,96" href="accessories.php">
</map>-->

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

});
 </script>
 
</head>

<body>
<div class="logo"></div>
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