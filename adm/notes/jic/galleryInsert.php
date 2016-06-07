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
				<IMG SRC="../images/spacer.gif" width="10" height="10">
				</td>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" width=100%>
					<tr>
						<td class="TitleText">
						<b>Gallery Photo Insert Page</b>
						</td>
					</tr>
					<tr>
						<td>&nbsp;<BR>
						</td>
					</tr>
					<tr>
						<td class="MainText">
						<P>
						To insert a gallery photo into the database, fill in all of the fields, then click on "Submit."
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
							<table width=100% border="0">
								<tr>
									<td>
									<IMG SRC="../images/spacer.gif" width="10" height="10">
									</td>
									<td align="center">	
										<table width="700" align="center" border="0"><form enctype="multipart/form-data" action="gallery_insert_execute.php" method="POST">
											<tr>
												<td class="MainText" background="../images/spacer.gif" width="200" height="10">
												Name
												</td>
												<td background="../images/spacer.gif" width="500" height="10">
												<input type="text" size="80" name="name">
												</td>
											</tr>
											<tr>
												<td class="MainText" background="../images/spacer.gif" width="200" height="10">
												Caption
												</td>
												<td background="../images/spacer.gif" width="500" height="10">
												<input type="text" size="80" name="caption">
												</td>
											</tr>
											<tr>
												<td class="MainText" background="../images/spacer.gif" width="200" height="10">
												Photo Category
												</td>
												<td background="../images/spacer.gif" width="500" height="10">
												<select name="category" style="width:495px;">
												<option></option>
												<?php
												$querystate = "select * from doors order by name ASC";
												$resultstate = mysqli_query($cxn, $querystate)
												or die ("Couldn't execute query.");
											
												while ($row=mysqli_fetch_assoc($resultstate))
												{
												extract($row);
												?>
												<option value="<?php echo $row['id']; ?>"><?php echo stripslashes($row['name']); ?></option>
												<?php
												}
												?>
												</td>
											</tr>
											<tr>
												<td class="MainText" background="../images/spacer.gif" width="200" height="10">
												Photo
												</td>
												<td>
												<input name="photo" type="file" size="66">
												</td>
											</tr>
											<tr>
												<td colspan="2">&nbsp;<BR>
												<textarea name="description" class="photo">Description</textarea>
												</td>
											</tr>
											<tr>
												<td colspan="2" style="text-align:center;">&nbsp;<BR>
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
