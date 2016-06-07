<?php
$mike="select * from calendar where id='$jeff_row[id]'";
$mike_query=mysqli_query($cxn, $mike)
or die("Couldn't execute query.");
$mike_row=mysqli_fetch_assoc($mike_query);
extract($mike_row);
?>
<table class="tooltip" border="0">
<tr>
<td>
<b>Event Category</b>
</td>
<td class="right">
<?php echo stripslashes($mike_row['event_category']); ?>
</td>
</tr>
<tr>
<td>
<b>Event Name</b>
</td>
<td class="right">
<?php echo stripslashes($mike_row['event_name']); ?>
</td>
</tr>
<tr>
<td>
<b>Start Date / Time</b>
</td>
<td class="right">
<?php echo date('l, F j, Y g:i a',strtotime($mike_row['event_start'])); ?>
</td>
</tr>
<tr>
<td background="../images/spacer.gif" width="150" height="10">
<b>End Date / Time</b>
</td>
<td class="right">
<?php 
if($mike_row['all_day']=="Y")
{
echo "all day";
}
else
{
echo date('l, F j, Y g:i a',strtotime($mike_row['event_end'])); 
}
?>
</td>
</tr>
<?php
if(!empty($mike_row['repeating_event_id']))
{
$perry ="select repeating_event_id, event_start from calendar where repeating_event_id='$mike_row[repeating_event_id]' order by event_start DESC LIMIT 1";
$perry_query=mysqli_query($cxn, $perry);
if(!$perry_query)
{
$doodle=mysqli_errno($cxn).': '.mysqli_error($cxn);
die($doodle);
}
$perry_row=mysqli_fetch_assoc($perry_query);
extract($perry_row);
?>
<tr>
<td colspan="2">
<i>This is a repeating event and ends <?php echo date("m/d/Y", strtotime($perry_row['event_start'])); ?></i>
</td>
</tr>
<?php
}
?>
</table>
<div id="tooltip_description">
<b><u>Event Description</u></b>
<P>
<?php 
$position = 200;					
$message = $mike_row['event_desc'];					
$post = substr($message,$position,1); 										
if($post !=" ") {					
$length = strlen( $message );					
while($post !=" " && $position < $length){					
$i =1;					
$position = $position+$i;					
$message = $mike_row['event_desc'];					
$post = substr($message,$position,1); 							
}					
}					
$post = substr($message,0,$position); 	
if($length>200)
{	
echo stripslashes($post).'...'; 
}
else
{
echo stripslashes($post);
}
?>
</div>