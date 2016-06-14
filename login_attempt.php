<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$form_up=0;


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

/*This is the page that looks to see if the customer has already set up an account. If they have their form will be filled in with all of their data. If not, they'll get a message that says nothing they entered matched what was in the database and they'll have the option of looking for their email and password
*/

function login_check() {
	
	global $cxn;
	
	$email=trim($_POST['login_email']);
	
	$sql="select * from customers where email='$email' and password='$_POST[login_password]'";
	$query=$cxn->query($sql);
	$count = $query->num_rows;
	if($count>0)
	{
	
	}
	else
	{
		
	}
}

function state_list() {
	
	global $cxn;
	
	$sql="select * from states order by state_name";
	$query=$cxn->query($sql);
	
	$result_array=array();
	
	while($row=$query->fetch_array())
	{
		$result_array[]=$row;
	}
	
	return $result_array;
}

function current_shipping($id) {
	
	global $cxn;
	
	$sql="select price from products where id='$id'";
	$query=$cxn->query($sql);
	$row=$query->fetch_object();
	$the_price=$row->price;
	
	return $the_price;
	
}

$the_res_price=current_shipping("392");

$the_lift_price=current_shipping("393");

?>

	If you're a returning customer, please login and all of your contact and shipping information will automatically populate below. If not, please fill in all of the fields and click on "proceed to checkout."<br>
	<br><form method="Post" id="loginForm">
		<table style="margin:auto; width:400px; height:auto; border:1px solid #cccccc; border-radius:10px;">
			<tr>
				<td style="border-top-left-radius:10px; padding-left:5px; padding-top:5px;">email:  &nbsp;<input type="text" style="width:135px; height:25px; border:1px solid #cccccc;" name="login_email"></td>
				<td style="border-top-right-radius:10px; padding-right:5px; padding-top:5px;">password:&nbsp;<input type="password" style="width:135px; height:25px; border:1px solid #cccccc;" name="login_password"></td>
			</tr>
			<tr>
				<td colspan="2" style="border-bottom-left-radius:10px; border-bottom-right-radius:10px; text-align:center;"><input type="image" src="images/long_login.png"></td>
			</tr>
		</table></form>
	</td>
</tr>
<tr>
	<td colspan="2" id="login_results">&nbsp;<br></td>
</tr>
<tr>
	<td colspan="3">
		<table style="width:100%;" border="1"><form action="checkout_post.php?session_id=<?php echo $_GET['session_id'];?>" method="Post" name="bigForm" onsubmit="return validateForm()">
			<tr>
				<td colspan="2"><b>shipping information</b></td>
			</tr>
			<tr>
				<td>first name</td>
				<td><input type="text" size="55" name="first_name" id="fname"></td>
			</tr>
			<tr>
				<td>last name</td>
				<td><input type="text" size="55" name="last_name" id="lname"></td>
			</tr>
			<tr>
				<td>street address 1</td>
				<td><input type="text" size="55" name="street_address_one" id="street1"></td>
			</tr>
			<tr>
				<td>street address 2</td>
				<td><input type="text" size="55" name="street_address_two" id="street2"></td>
			</tr>
			<tr>
				<td>city</td>
				<td><input type="text" size="55" name="city" id="city"></td>
			</tr>
			<tr>
				<td>state</td>
				<td><select name="state" style="width:379px;" id="state">
				<option></option>
				<?php 
				$select_state=state_list();
				foreach($select_state as $state)
				{
				?>
					<option><?php echo $state['abbreviation'];?></option>
				<?php
				}
				?>
				</select>											
				</td>
			</tr>
			<tr>
				<td>zip code</td>
				<td><input type="text" size="55" name="zip" id="zip"></td>
			</tr>
				<tr>
				<td>cell phone</td>
				<td><input type="text" size="55" name="cell_phone"></td>
			</tr>
			<tr>
				<td colspan="2"><b>billing information</b> &nbsp; if billing info is the same as shipping, check here...&nbsp;<input type="checkbox" id="bill_same"></td>
			</tr>
			<tr>
				<td>first name</td>
				<td><input type="text" size="55" name="billing_first_name" id="bill_fname"></td>
			</tr>
			<tr>
				<td>last name</td>
				<td><input type="text" size="55" name="billing_last_name" id="bill_lname"></td>
			</tr>
			<tr>
				<td>street address 1</td>
				<td><input type="text" size="55" name="billing_street_address_one" id="bill_street1"></td>
			</tr>
			<tr>
				<td>street address 2</td>
				<td><input type="text" size="55" name="billing_street_address_two" id="bill_street2"></td>
			</tr>
			<tr>
				<td>city</td>
				<td><input type="text" size="55" name="billing_city" id="bill_city"></td>
			</tr>
			<tr>
				<td>state</td>
				<td><select name="billing_state" style="width:379px;" id="bill_state">
				<option></option>
				<?php 
				$select_state_billing=state_list();
				foreach($select_state_billing as $state_billing)
				{
				?>
					<option><?php echo $state_billing['abbreviation'];?></option>
				<?php
				}
				?>
				</select>											
				</td>
			</tr>
			<tr>
				<td>zip code</td>
				<td><input type="text" size="55" name="billing_zip" id="bill_zip"></td>
			</tr>
			<tr>
				<td colspan="2"><b>login information</b></td>
			</tr>
			<tr>
				<td>email address</td>
				<td><input type="text" size="55" name="email_address"></td>
			</tr>
			<tr>
				<td>password</td>
				<td><input type="password" size="55" name="password"></td>
			</tr>
			<tr>
				<td>confirm password</td>
				<td><input type="password" size="55" name="confirm_password"></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center; vertical-align:middle;"><br><br><input type="hidden" name="session_id" value="<?php echo $_GET['session_id'];?>"><input type="hidden" name="residential_price" value="<?php echo $the_res_price;?>"><input type="hidden" name="liftgate_price" value="<?php echo $the_lift_price;?>"><input type="image" src="images/proceed_checkout.jpg" style="width:185px; margin-top:-36px; text-align:center;"></td>
			</tr>
		</table></form>
	</td>
</tr>

<script>

$('#bill_same').click(function(){

   var _chk = $('#bill_same').is(':checked');
	  if ( _chk == true ) { 

	  //set inputs
		$('#bill_fname').val( $('#fname').val() );
		$('#bill_lname').val( $('#lname').val() );
		$('#bill_street1').val( $('#street1').val() );
		$('#bill_street2').val( $('#street2').val() );
		$('#bill_city').val( $('#city').val() );
		$('#bill_state').val( $('#state').val() );
		$('#bill_zip').val( $('#zip').val() );
	  }else{
		  //Clear inputs
		$('#bill_fname').val(' ');
		$('#bill_lname').val(' ');
		$('#bill_street1').val(' ');
		$('#bill_street2').val(' ');
		$('#bill_city').val(' ');
		$('#bill_state').val(' ');
		$('#bill_zip').val(' ');
	 }
});

function validateForm() {
	alert("hello");
var a = document.forms["bigForm"]["password"].value;
var b = document.forms["bigForm"]["confirm_password"].value;
var c=document.forms["bigForm"]["fname"].value; 
var d=document.forms["bigForm"]["lname"].value;
var e=document.forms["bigForm"]["street1"].value;
var f=document.forms["bigForm"]["city"].value;
var g=document.forms["bigForm"]["state"].value;
var h=document.forms["bigForm"]["zip"].value;
var i=document.forms["bigForm"]["bill_fname"].value;
var j=document.forms["bigForm"]["bill_lname"].value;
var k=document.forms["bigForm"]["bill_street1"].value;
var l=document.forms["bigForm"]["bill_state"].value;
var m=document.forms["bigForm"]["bill_zip"].value;
var n=document.forms["bigForm"]["email_address"].value;

 if (c == null || c == "") {
		 alert("please include your first name");
		 return false;
	 }
	 
	 if (d == null || d == "") {
		 alert("please include your last name");
		 return false;
	 }
	 
	 if (e == null || e == "") {
		 alert("please include your street address");
		 return false;
	 }
	 
	 if (f == null || f == "") {
		 alert("please include your city");
		 return false;
	 }
	 
	 if (g == null || g == "") {
		 alert("please include your state");
		 return false;
	 }
	 
	 if (h == null || h == "") {
		 alert("please include your zip");
		 return false;
	 }
	 
	  if (i == null || i == "") {
		 alert("please include your billing first name");
		 return false;
	 }
	 
	  if (j == null || j == "") {
		 alert("please include your billing last name");
		 return false;
	 }
	 
	  if (k == null || k == "") {
		 alert("please include your billing street address");
		 return false;
	 }
	 
	  if (l == null || l == "") {
		 alert("please include your billing state");
		 return false;
	 }
	 
	  if (m == null || m == "") {
		 alert("please include your billing zip code");
		 return false;
	 }
	 
	  if (n == null || n == "") {
		 alert("please include your email address");
		 return false;
	 }

	 if (a == null || a == "") {
		 alert("please include a password");
		 return false;
	 }
	 if (b == null || b == "") {
		 alert("please confirm your password");
		 return false;
	 }
	  if (a!==b) {
		 alert("please make sure your password and your confirmed password match");
		 return false;
	 }
	 
 }

</script>