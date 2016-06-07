<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
if ($_GET['Edit'] != "Yes")
{
$ID=$_GET[ID];
header("Location: category_delete.php?ID=$ID");
}
else
{
include ("../carter.inc");
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$query = "select * from calendar_category where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);
}
$ID=$_GET['ID'];
require_once('header.php');

$michelle="select sum(sort_order) as sort_value from calendar_category";
$michelle_query=mysqli_query($cxn, $michelle)
or die("Michelle is not happy.");
$michelle_row=mysqli_fetch_assoc($michelle_query);
extract($michelle_row);
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> 
<script type="text/javascript"> 
$(document).ready(function() {
	//Tooltips
	$(".tip_trigger").hover(function(){
		tip = $(this).find('.tip');
		tip.show(); //Show tooltip
	}, function() {
		tip.hide(); //Hide tooltip		  
	}).mousemove(function(e) {
		var mousex = e.pageX + 20; //Get X coodrinates
		var mousey = e.pageY + 20; //Get Y coordinates
		var tipWidth = tip.width(); //Find width of tooltip
		var tipHeight = tip.height(); //Find height of tooltip
		
		//Distance of element from the right edge of viewport
		var tipVisX = $(window).width() - (mousex + tipWidth);
		//Distance of element from the bottom of viewport
		var tipVisY = $(window).height() - (mousey + tipHeight);
		  
		if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport
			mousex = e.pageX - tipWidth - 20;
		} if ( tipVisY < 20 ) { //If tooltip exceeds the Y coordinate of viewport
			mousey = e.pageY - tipHeight - 20;
		} 
		tip.css({  top: mousey, left: mousex });
	});
});
</script>
	
		<table border="0" cellspacing="0" cellpadding="0" width=100%>
		<tr>
		<td>
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width=100%>
			<tr>
			<td class="TitleText">
			<b>Calendar Category Display Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			To edit a calendar category, make your changes in the fields below and click on "Submit." To return to the event list, click <A HREF="category_list.php">here</a>.
			<P>
			<?php include ("help.php"); ?>
			</td>
			</tr>
			<tr>
			<td>
			&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td>
			<HR>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td align="center">
					<table align="center" border="0"><form action="category_edit.php" method="post">
					<tr>
					<td class="MainText" background="images/spacer.gif" width="100" height="10">
					<?php
					if($michelle_row['sort_value']>0)
					{
					?>
					<A HREF="" class="tip_trigger">Sort Order<span class="tip"><?php include('tooltip_content.php'); ?></span></a>
					<?php
					}
					else
					{
					?>
					Sort Order
					<?php
					}
					?>
					</td>
					<td>
					<input type="text" size="87" name="sort_order" value="<?php echo $row['sort_order']; ?>">
					</td>
					</tr>
					<tr>
					<td class="MainText" background="images/spacer.gif" width="100" height="10">
					Category Name
					</td>
					<td>
					<input type="text" size="87" name="event_name" value="<?php echo stripslashes($row['name']); ?>">
					</td>
					</tr>
					<tr>
					<td colspan="2">&nbsp;<BR>
					<textarea name="event_description"><?php echo stripslashes($row['description']); ?></textarea>
					</td>
					</tr>
					<tr>
					<td colspan="2" align="center"><input type="hidden" name="id" value="<?php echo $ID; ?>">
					<input type="Submit" value="Submit">
					</td>
					</tr>
					</table>
		
				</td>
				<td>
				<IMG SRC="../images/spacer.gif" width="10" height="10">
				</td>
				</tr>
				</table>
			</td>
			</tr>
			</table>
		</td>
		
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		</tr>
		</table>
 <?php require_once('footer.php'); ?>	