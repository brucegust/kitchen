<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
include ("../carter.inc");
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
require_once('header.php');
?>
	
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
			<b>Category List</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Below is the list of all the categories that have been entered into the database. To either edit or delete an entry, simply click on one of the two links located to the right of each category.
			<ul>
				<li>you can edit any of the Macro Categories by clicking on the name</li>
				<li>to insert or delete a Macro Category, click <a href="macro_list.php">here</a> to access the Macro Category List</li>
			</ul>
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
			<td class="admin_body">
				<table width=100% border="0">
				<tr>
				<td>
				<IMG SRC="../images/spacer.gif" width="10" height="10">
				</td>
				<td class="admin_body">
				
					<table style="width:auto; margin:auto; padding:10px;" border="1">
					<tr>
					<td style="background-color:#000000; color:#ffffff; padding:10px;">
					Macro Category | Category
					</td>
					<td style="background-color:#000000; color:#ffffff; text-align:center; padding:10px;">
					Edit / Delete
					</td>
					</tr>
					<?php
					$current_macro_id="";	
					$current_category="";
					$querystate = "select * from categories order by macro_category_id, category, sub_category DESC";
					$resultstate = mysqli_query($cxn, $querystate)
					or die ("Couldn't execute query.");
				
					while ($row=mysqli_fetch_assoc($resultstate))
					{
					extract($row);
					?>
						<?php
						if($current_macro_id<>$row['macro_category_id'])
						{
						?>
							<tr>
								<td style="background-color:#0861c5; color:#ffffff; padding:5px;" colspan="3"><a href="macro_display.php?id=<?php echo $row['macro_category_id'];?>" style="color:#ffffff; text-decoration:underline;"><?php echo stripslashes($row['macro_category']);?></a></td>
							</tr>
						<?php
						}
						?>
						<?php
						if($current_category<>$row['category'])
						{
							$check_category="select id from categories where category='$row[category]'";
							$check_category_query=mysqli_query($cxn, $check_category);
							$count_category=mysqli_num_rows($check_category_query);
							if($count_category>1)
							{
							?>
								<tr>
									<td style="background-color:#cccccc; color:#000000; padding:5px;" colspan="2"><?php echo stripslashes($row['category']);?></a></td>
								</tr>
							<?php
							}
							else
							{
							?>
								<tr>
									<td style="background-color:#cccccc; color:#000000; padding:5px;"><?php echo stripslashes($row['category']);?></a></td>
									<td style="background-color:#cccccc; color:#000000; padding:5px;"><A HREF="category_display.php?ID=<?php echo $row['id']; ?>&Edit=Yes" >Edit</a>&nbsp;&nbsp;
									<A HREF="category_display.php?ID=<?php echo $row['id']; ?>&Delete=Yes">Delete</a></td>
								</tr>
							<?php
							}
						}
						?>
					<?php
						if($count_category>1)
						{
						?>
						<tr>
							<td style="width:600px; vertical-align:middle; padding:5px;"><?php echo stripslashes($row['sub_category']);?></td>
							<td style="text-align:center; background-color:#cccccc; color:#000000; vertical-align:middle; padding:5px;">
							<A HREF="category_display.php?ID=<?php echo $row['id']; ?>&Edit=Yes" >Edit</a>&nbsp;&nbsp;
							<A HREF="category_display.php?ID=<?php echo $row['id']; ?>&Delete=Yes">Delete</a>
							</td>
						</tr>
						<?php
						}
						else
						{
							continue;
						}
					$current_category=$row['category'];
					$current_macro_id=$row['macro_category_id'];
					}
					?>
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