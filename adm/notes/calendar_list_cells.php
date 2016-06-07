<?php
//finding out if there's a sort order first
error_reporting(E_ALL);
$derek = "select sum(sort_order) as sort_value from calendar_category";
$derek_query=mysqli_query($cxn, $derek)
or die("Couldn't make derek work.");
$derek_row=mysqli_fetch_assoc($derek_query);
extract($derek_row);
if($derek_row['sort_value']>0)
{
$maddie="select * from calendar_category order by sort_order";
}
else
{
$maddie="select * from calendar_category order by name";
}
$maddie_query=mysqli_query($cxn, $maddie)
or die("Couldn't execute query.");
$maddie_count =mysqli_num_rows($maddie_query);
if($maddie_count>0)
{
	while($maddie_row=mysqli_fetch_assoc($maddie_query))
	{
	extract($maddie_row);
	?>
	<td class="calendar_list_cell">
	<?php
	$early = $this_year.'-'.$this_month_number.'-'.$the_date_number;
	$early.=" 00:00:00";
	$early_day = date('Y-m-d H:i:s', strtotime($early));

	$late = $this_year.'-'.$this_month_number.'-'.$the_date_number;
	$late.=" 23:59:00";
	$late_day = date('Y-m-d H:i:s', strtotime($late));
	$carter_day=$this_year.'-'.$this_month_number.'-'.$the_date_number;
	?>
	<A HREF="calendar_insert_select.php?event_category=<?php echo stripslashes($maddie_row['name']); ?>&today=<?php echo $carter_day; ?>&back_page=<?php echo $back_page; ?>&month=<?php echo $back_month; ?>&right_now=<?php echo $right_now; ?>"><IMG SRC="images/add_tab.png" border="0"></a>
	<?php
		//first thing we're going to do is flip through any "church wide" category stuff
	$jim="select * from calendar where event_category='Church Wide' AND (event_start>'$early_day' AND event_start<= '$late_day') order by event_start";
		$jim_query=mysqli_query($cxn, $jim);
		if(!$jim_query)
		{
		$rats=mysqli_errno($cxn).': '.mysqli_error($cxn);
		die($rats);
		}
		$jim_count=mysqli_num_rows($jim_query);
		if($jim_count>0)
		{
			while($jim_row=mysqli_fetch_assoc($jim_query))
			{
			extract($jim_row);
				if(!empty($jim_row['repeating_event_id']))
				{
				$cassidy_alert=1;
				$jerry ="select repeating_event_id, event_start from calendar where repeating_event_id='$jim_row[repeating_event_id]' order by event_start DESC LIMIT 1";
				$jerry_query=mysqli_query($cxn, $jerry);
				if(!$jerry_query)
				{
				$doodle=mysqli_errno($cxn).': '.mysqli_error($cxn);
				die($doodle);
				}
				$jerry_row=mysqli_fetch_assoc($jerry_query);
				extract($jerry_row);
				}
			?><a href="calendar_display.php?id=<?php echo $jim_row['id'];?>&Edit=Yes&back_page=<?php echo $back_page; ?>&month=<?php echo $back_month; ?>&right_now=<?php echo $right_now; ?>" class="tip_trigger" style="text-decoration:none";><?php 
			if($jim_row['all_day']=="Y")
			{
			?>
			<b><?php 
			if(strlen($jim_row['event_name'])<=25)
			{
			echo substr(stripslashes($jim_row['event_name']), 0, 25);  
			}
			else
			{
			echo substr(stripslashes($jim_row['event_name']), 0, 25).'...';
			}
			?></b>
			<?php
			}
			else
			{
				if(strlen($jim_row['event_name'])<=25)
				{
				echo substr(stripslashes($jim_row['event_name']), 0, 25);  
				}
				else
				{
				echo substr(stripslashes($jim_row['event_name']), 0, 25).'...';
				}
			}
			?><span class="tip"><?php include('tooltip_content_calendar_church.php'); ?></span></a>&nbsp;<A HREF="calendar_display.php?id=<?php echo $jim_row['id']; ?>&Edit=Yes&back_page=<?php echo $back_page; ?>&month=<?php echo $back_month; ?>&right_now=<?php echo $right_now; ?>"><IMG SRC="images/pencil.png" width="15" border="0"></a>&nbsp;
			<?php
			if($jim_row['repeating_event_id']<>"" OR !$jim_row['repeating_event_id']<>" " OR !empty($jim_row['repeating_event']))
			{
			?>
			<A HREF="calendar_display.php?id=<?php echo $jim_row['id']; ?>&Delete=Yes&repeating=Yes&back_page=<?php echo $back_page; ?>&right_now=<?php echo $right_now; ?>&month=<?php echo $back_month; ?>"><IMG SRC="images/trash_can.png" width="15" border="0"></a>
			<?php
			}
			else
			{
			?>
			<A HREF="calendar_display.php?id=<?php echo $jim_row['id']; ?>&Delete=Yes&back_page=<?php echo $back_page; ?>&right_now=<?php echo $right_now; ?>&month=<?php echo $back_month; ?>"><IMG SRC="images/trash_can.png" width="15" border="0"></a>
			<?php
			}
			?>&nbsp;&nbsp;<BR>
			<?php
			}
		}
		else
		{
		echo "";
		}
	//now you're checking every other category
	$jeff="select * from calendar where event_category='$maddie_row[name]' AND (event_start>'$early_day' AND event_start<= '$late_day') order by event_start";
	$jeff_query=mysqli_query($cxn, $jeff);
		if(!$jeff_query)
		{
		$rats=mysqli_errno($cxn).': '.mysqli_error($cxn);
		die($rats);
		}
	$jeff_count=mysqli_num_rows($jeff_query);
		if($jeff_count>0)
		{
			while($jeff_row=mysqli_fetch_assoc($jeff_query))
			{
			extract($jeff_row);
			?><a href="calendar_display.php?id=<?php echo $jeff_row['id'];?>&Edit=Yes&back_page=<?php echo $back_page; ?>&month=<?php echo $back_month; ?>&right_now=<?php echo $right_now; ?>" class="tip_trigger" style="text-decoration:none";><?php 
			if($jeff_row['all_day']=="Y")
			{
			?>
			<b><?php 
				if(strlen($jeff_row['event_name'])<=25)
				{
				echo substr(stripslashes($jeff_row['event_name']), 0, 25);  
				}
				else
				{
				echo substr(stripslashes($jeff_row['event_name']), 0, 25).'...';
				}
				?></b>
			<?php
			}
			else
			{
				if(strlen($jeff_row['event_name'])<=25)
				{
				echo substr(stripslashes($jeff_row['event_name']), 0,25);  
				}
				else
				{
				echo substr(stripslashes($jeff_row['event_name']), 0, 25).'...';
				}
			}
			?><span class="tip"><?php include('tooltip_content_calendar.php'); ?></span></a>&nbsp;<A HREF="calendar_display.php?id=<?php echo $jeff_row['id']; ?>&Edit=Yes&back_page=<?php echo $back_page; ?>&month=<?php echo $back_month; ?>&right_now=<?php echo $right_now; ?>"><IMG SRC="images/pencil.png" width="15" border="0"></a>&nbsp;
			<?php
			if($jeff_row['repeating_event_id']<>"" OR !$jeff_row['repeating_event_id']<>" " OR !empty($jeff_row['repeating_event']))
			{
			?>
			<A HREF="calendar_display.php?id=<?php echo $jeff_row['id']; ?>&Delete=Yes&repeating=Yes&back_page=<?php echo $back_page; ?>&right_now=<?php echo $right_now; ?>&month=<?php echo $back_month; ?>"><IMG SRC="images/trash_can.png" width="15" border="0"></a>
			<?php
			}
			else
			{
			?>
			<A HREF="calendar_display.php?id=<?php echo $jeff_row['id']; ?>&Delete=Yes&back_page=<?php echo $back_page; ?>&right_now=<?php echo $right_now; ?>&month=<?php echo $back_month; ?>"><IMG SRC="images/trash_can.png" width="15" border="0"></a>
			<?php
			}
			?>&nbsp;&nbsp;<BR>
			<?php
			}
		}
		else
		{
		echo "";
		}
	?></div></div>
	</td>
	<?php
	$this_month_number = date('m', strtotime($today)); 
	}
	?>
<?php
}
else
{
?>
<td>
&nbsp;<BR>
</td>
<?php
}
?>
