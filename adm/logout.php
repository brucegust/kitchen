<?php
session_start();
session_destroy(); 
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
	<b>Admin Page Logout</b>			
	</td>			
	</tr>			
	<tr>			
	<td>&nbsp;<BR>			
	</td>			
	</tr>			
	<tr>		
	<td class="MainText">			
	<P>		
	You have successfully logged out. To login again, click <A HREF="default.php">here</a>.
	<P>
	Thanks!
	</td>			
	</tr>			
	</table>


</td>


</tr>


</table>	





<?php require_once('footer.php'); ?>		

