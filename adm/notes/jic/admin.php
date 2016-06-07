<?php 
session_start();
if (@$_SESSION['auth'] != "yes")                 
{
header("Location:default.php");
exit();
}
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
	<b>Admin Page</b>			
	</td>			
	</tr>			
	<tr>			
	<td>&nbsp;<BR>			
	</td>			
	</tr>			
	<tr>		
	<td class="MainText">			
	<P>		
	Welcome to the "KitchenCabinetCo" Admin page! Choose from the pulldown menus listed below the task that you're looking to accomplish. 			
	<P>
To login to the phpMyAdmin interface, click <A HREF="https://p3nlmysqladm001.secureserver.net/nl41/15/index.php" target="_blank">here</a>.	
	<P>
	To logout, click <A HREF="logout.php">here</a>.
	</td>			
	</tr>			
	<tr>			
	<td>			
	&nbsp;<BR>	&nbsp;<BR>		
	</td>			
	</tr>			
	<tr>			
	<td class="admin_cell">				
		<table width=100% border="0" cellspacing="3" cellpadding="3" class="center">				
		<tr>
		<td class="admin_body" style="vertical-align:top;">
			<table class="center">
			<tr>
			<td>
			<select name="select54" size="1" onchange="MM_jumpMenu('top',this,1)">						
			<option value="#" selected>Pages</option>						
			<option value="pageInsert.php">Insert Page</option>								
			<option value="pageList.php">Edit / Page Page</option>								
			<option value="pageList.php">List All Pages</option>						
			<option value="">_______________________	</option>	
			</select>
			</td>
			</tr>
			<tr>
			<td>
			<select name="select579" size="1" onchange="MM_jumpMenu('top',this,1)">						
			<option value="#" selected>Photos</option>						
			<option value="picture_insert.php">Insert Photo</option>								
			<option value="pictureList.php">Edit / Page Photos</option>								
			<option value="pictureList.php">List All Photos</option>						
			<option value="">_______________________	</option>	
			</select>
			</td>
			</tr>
			</table>
		</td>
		<td class="admin_cell">	
			<table class="center">
			<tr>
			<td>
			<select name="select45" size="1" onchange="MM_jumpMenu('top',this,1)">						
			<option value="#" selected>Gallery</option>						
			<option value="galleryInsert.php">Insert Gallery Photo</option>								
			<option value="galleryList.php">Edit / Delete</option>								
			<option value="galleryList.php">List All Gallery Photos</option>				
			<option value="">_____________________</option>
			</select>
			</td>
			</tr>
			</table>
		</td>
		<td class="admin_cell">				
			<table class="center">
			<tr>
			<td>
			<select name="select93" size="1" onchange="MM_jumpMenu('top',this,1)">						
			<option value="#" selected>Doors</option>						
			<option value="door_insert.php">Insert Door</option>								
			<option value="door_list.php">Edit / Page Door</option>								
			<option value="door_list.php">List All Doors</option>						
			<option value="">_____________________</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>
			<select name="select99" size="1" onchange="MM_jumpMenu('top',this,1)">						
			<option value="#" selected>Products</option>						
			<option value="product_insert.php">Insert Product</option>								
			<option value="product_list.php">Edit / Page Product</option>								
			<option value="product_list.php">List All Products</option>						
			<option value="">_____________________</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>
			<select name="select193" size="1" onchange="MM_jumpMenu('top',this,1)">						
			<option value="#" selected>Product Categories</option>						
			<option value="category_insert.php">Insert Category</option>								
			<option value="category_list.php">Edit / Delete Category</option>								
			<option value="category_list.php">List All Categories</option>						
			<option value="">_____________________</option>
			<option value="macro_insert.php">Insert Macro Category</option>								
			<option value="macro_list.php">Edit / Delete Macro</option>								
			<option value="macro_list.php">List All Macro Categories</option>					
			</select>
			</td>
			</tr>
			<tr>
			<td>
			<select name="select99" size="1" onchange="MM_jumpMenu('top',this,1)">						
			<option value="#" selected>Multipliers</option>						
			<option value="door_list.php">Insert Multiplier</option>												
			<option value="">_____________________</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>
			<select name="select199" size="1" onchange="MM_jumpMenu('top',this,1)">						
			<option value="#" selected>Main Page Ad</option>						
			<option value="ad_page.php">Edit Ad</option>												
			<option value="">_____________________</option>
			</select>
			</td>
			</tr>
			</table>
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>	
<?php require_once('footer.php'); ?>		