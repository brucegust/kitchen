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

/*This is the page that's doing all of the adding and updating to the cart prior to the user checking out. You've got one of three difference scenarios happening. First is a brand new entry which is handled by "add_to_cart." One product, brand new session id and out the door. Results are displayed using the "ajax_register.php" page. That page is what's displayed after every form entry. Otherwise, the results are being displayed using the ajax_cart.php page. That's what the user sees when they click on the "view cart" button.

If any updates are done in the immediate aftermath of the user having added something to the cart, the results are being displayed with the "ajax_register_edit.php" page. The thing that makes both the ajax_register.php page and the ajax_register_edit.php page distintive is the way in which it displays the most recent entry at the top of the list with all of the features displayed. Everything else is listed with the features hidden.

If the user chooses to make any edits from the "ajax_register_edit.php" page - the one where a round of edits has already been done with the ajax_register.php page as the starting point - the "ajax_relay.php" page is going to be looking for the same data, but with different field names.


*/

function sample_door_add() {
	
	global $cxn;
	
	$product_id=$_POST['product_id'];//id of the product in the database
	$the_session_id=$_POST['session_id'];
	$door_id=$_POST['feature_door_id'];
	$door_cost=$_POST['price'];
	
	if(isset($_POST['quantity'])&&trim($_POST['quantity']==""))
	{
		$quantity=1;
	}
	else
	{
		$quantity=trim($_POST['quantity']);
	}
	$sql="select id from cart where session_id='$the_session_id'";
	$query=$cxn->query($sql);
	$cart_count=mysqli_num_rows($query);
	
	//brand new user and item
	if($cart_count==0)
	{
	
		$sql_21="insert into cart(session_id, product_id, product_cost, door_id, quantity, sequence) VALUES('$the_session_id', '$product_id','$door_cost', '$door_id', '$quantity', '1')";
		if(!$query_21=$cxn->query($sql_21))
		{
			$err_21='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query_21
			.PHP_EOL;
			trigger_error($err_5, E_USER_WARNING);			
		}
	}
	else
	{
		$sql_8="select sequence from cart where session_id='$the_session_id' and quantity>'0' order by sequence DESC LIMIT 1";
		$query_8=$cxn->query($sql_8);
		$row_8=$query_8->fetch_object();
		$new_sequence=$row_8->sequence+1;
		
		$sql_21="insert into cart(session_id, product_id, product_cost, door_id, quantity, sequence) VALUES('$the_session_id', '$product_id','$door_cost', '$door_id', '$quantity', '$new_sequence')";
		if(!$query_21=$cxn->query($sql_21))
		{
			$err_21='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query_21
			.PHP_EOL;
			trigger_error($err_21, E_USER_WARNING);			
		}
		
	}
}

function add_to_cart() {
	//check to see if there's anything already in the cart under the current session id
	
	global $cxn;
	
	$the_count= $_POST['the_count'];
	$part_id=$_POST['part_id'];
	$product_id=$_POST['product_id'];//id of the product in the database
	$product_name=$_POST['product_name'];
	$price=$_POST['price'];
	$the_session_id=$_POST['session_id'];
	$door_id=$_POST['feature_door_id'];
	$door_cost=$_POST['door_price'];
	if(isset($_POST['quantity'])&&trim($_POST['quantity']==""))
	{
		$quantity=1;
	}
	else
	{
		$quantity=trim($_POST['quantity']);
	}
	
	$the_product_cost=$price * $quantity;

	$sql="select id from cart where session_id='$the_session_id'";
	$query=$cxn->query($sql);
	$cart_count=mysqli_num_rows($query);
	
	//brand new user and item
	if($cart_count==0)
	{
		
		//add what's just been posted to the cart under current session id
		//start with the basics (door_id, session_id, etc. be aware of if the door is on sale)
		//your first entry is the door_id and the door_cost irrespective of the product_id. That way you can delete any product and still be able to define the color
		
		$sql_5="insert into cart(session_id, door_id, product_id, door_cost, sequence) values('$the_session_id', '$door_id', '$product_id', '$door_cost', '1')";
		//echo $sql_5;
		if(!$query_5=$cxn->query($sql_5))
		{
			$err_5='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query_5
			.PHP_EOL;
			trigger_error($err_5, E_USER_WARNING);			
		}
	
		//insert your door_id alongside your product_id so you can keep track of those products that are the same, but have a different finish / color
		$sql_2="insert into cart (session_id, product_id, product_cost, door_id, quantity, sequence) values ('$the_session_id', '$product_id', '$the_product_cost', '$door_id', '$quantity','2')";
		//echo $sql_2;
		if(!$query_2=$cxn->query($sql_2))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query_2
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		
		//now you're going through all of the features that were just posted
		
		for($x=1; $x<=$the_count; $x++)
		{
			if(isset($_POST['select_'.$x])&&trim($_POST['select_'.$x])<>"")
			{
				$pieces=explode("_", $_POST['select_'.$x]);
				//$pieces[0] - this is the option_name_id in your feature table, if there's a cost, it will show up here
				//$pieces[1] - this is the id of of the option as it appears in the features table
				//$pieces[2] - this is the cost including any adjustment that's been made if the corresponding door is on sale
				$sql_3="insert into cart (session_id, product_id, option_id, feature_id, feature_cost, door_id) VALUES ('$the_session_id', '$product_id', '$pieces[0]', '$pieces[1]', '$pieces[2]', '$door_id')"; 
				if(!$query_3=$cxn->query($sql_3))
				{
					$err_3='your course list didn\'t happen because: '
					.'ERRNO: '
					.$cxn->errno
					.' ERROR: '
					.$cxn->error
					.' for this query: '
					.$query
					.PHP_EOL;
					trigger_error($err, E_USER_WARNING);
				}
			}
		}
	//next is what happens when the user's session id is already in the cart
	}
	else
	{
	//figure out what the sequence number needs to be 
	$sql_8="select sequence from cart where session_id='$the_session_id' and quantity>'0' order by sequence DESC LIMIT 1";
	$query_8=$cxn->query($sql_8);
	$row_8=$query_8->fetch_object();
	$new_sequence=$row_8->sequence+1;

	//figure out if user is adding a different door. If so, add it here

		$sql_3="insert into cart (session_id, door_id, product_id, door_cost, sequence) values ('$the_session_id', '$door_id', '$product_id', '$door_cost', '$new_sequence')";
		if(!$query_3=$cxn->query($sql_3))
		{
			$err_3='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		//increase the sequence value by 10px
		$new_sequence=$new_sequence+1;
		
		//the user is adding another door, so go ahead and enter whatever products they just inserted according to the same sequence number	
		$sql_5="insert into cart (session_id, product_id, product_cost, quantity, sequence, door_id) values ('$the_session_id', '$product_id', '$the_product_cost','$quantity', '$new_sequence', '$door_id')";
		//echo $sql_5;
		if(!$query_5=$cxn->query($sql_5))
		{
			$err_5='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		//features
		for($x=1; $x<=$the_count; $x++)
		{
			if(isset($_POST['select_'.$x])&&trim($_POST['select_'.$x])<>"")
			{
				$pieces=explode("_", $_POST['select_'.$x]);
				//$pieces[0] - this is the option_name_id in your feature table, if there's a cost, it will show up here
				//$pieces[1] - this is the id of of the option as it appears in the features table
				//$pieces[2] - this is the cost including any adjustment that's been made if the corresponding door is on sale
				//we don't worry about sequence here because all of the options/features are tied to a product id
					
				//option doesn't exist
				$sql_7="insert into cart (session_id, product_id, option_id, feature_id, feature_cost, door_id) VALUES ('$the_session_id', '$product_id', '$pieces[0]', '$pieces[1]', '$pieces[2]', '$door_id')"; 
				if(!$query_7=$cxn->query($sql_7))
				{
					$err_7='your course list didn\'t happen because: '
					.'ERRNO: '
					.$cxn->errno
					.' ERROR: '
					.$cxn->error
					.' for this query: '
					.$query
					.PHP_EOL;
					trigger_error($err, E_USER_WARNING);
				}
			}
		}
	}  
}

function current_cart() {
	
	global $cxn;
	
	//current_cart is called either when the user has added something to the cart and you're looking to see if anything is there other than what was just posted OR if the user has made a change to their cart. 
	//In other words, they didn't add anything using the form, but they made a change to the cart. This first part is for when the user has just added something to the cart and you're looking for whatever else is there
	if(isset($_POST['product_id'])&&trim($_POST['product_id'])<>"")
	{
		//in order to find everything OTHER THAN what was just added, you need to list everything less than the greatest sequential number
		$the_session_id=$_POST['session_id'];
		
		$sql_2="select DISTINCT sequence from cart where session_id='$the_session_id' ORDER by sequence DESC LIMIT 1";
		$query_2=$cxn->query($sql_2);
		$row_2=$query_2->fetch_object();
		$the_sequence_number=$row_2->sequence;
	
		//show me what's in the shopping cart OTHER THAN what the product id is of the item that was just added to the cart not any shipping charges
		$sql="select cart.id, cart.session_id, cart.door_id, cart.product_id, cart.sequence, cart.product_cost, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' AND sequence<'$the_sequence_number' order by sequence DESC";
		//echo $sql;
		if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		$result_array = array();
	
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
	}
		elseif(isset($_POST['ajax_session_id'])&&$_POST['ajax_session_id']<>"")
		{
			$the_session_id=$_POST['ajax_session_id'];
	
			//show me everything in the cart based on the user's current session id
			$sql="select cart.id, cart.session_id, cart.product_id, cart.door_id, cart.sequence, cart.product_cost, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' order by sequence DESC";
			if(!$query=$cxn->query($sql))
			{
				$err='your course list didn\'t happen because: '
				.'ERRNO: '
				.$cxn->errno
				.' ERROR: '
				.$cxn->error
				.' for this query: '
				.$query
				.PHP_EOL;
				trigger_error($err, E_USER_WARNING);
			}
			$result_array = array();
		
			while($row=$query->fetch_array())
			{
				$result_array[]=$row;
			}
		}
	else
	{

		$the_session_id=$_GET['session_id'];
		//$the_session_id="jqmlgvelt0vqbqksl6bqnth8o5";
		
		//show me everything in the cart based on the user's current session id
		$sql="select cart.id, cart.session_id, cart.product_id, cart.door_id, cart.sequence, cart.product_cost, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' order by sequence DESC";
		//echo $sql;
		if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		$result_array = array();
	
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
	}
	return $result_array;
}

function cart_door($product_id, $feature_door_id) {
	
	global $cxn;
	
		if(isset($_POST['session_id']))
		{
			$the_session_id=$_POST['session_id'];
		}
			elseif(isset($_POST['ajax_session_id']))
			{
				$the_session_id=$_POST['ajax_session_id'];
			}
		else
		{
			$the_session_id=$_GET['session_id'];
		}
	
	//this is giving our the door / cabinet color and any corresponding costs
	$sql="select featurename, featureprice from features where product_id=(select part_id from products where id='$product_id') and part_number='$feature_door_id'";
	//echo $sql;
	if(!$query=$cxn->query($sql))
	{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
	}
	$result_array=array();
	
	while($row=$query->fetch_array())
	{
		$result_array[]=$row;
	}
	return $result_array;
	
}

function feature_cart($product_id, $door_id) {
	
	global $cxn;
	
		if(isset($_POST['session_id']))
		{
			$the_session_id=$_POST['session_id'];
		}
			elseif(isset($_POST['ajax_session_id']))
			{
				$the_session_id=$_POST['ajax_session_id'];
			}
		else
		{
			$the_session_id=$_GET['session_id'];
		}
	
	$sql="select cart.session_id, cart.option_id, cart.feature_id, cart.feature_cost as feature_cost, features.featurecaption, features.featurename from cart INNER JOIN features on cart.feature_id=features.id where cart.session_id='$the_session_id' AND cart.product_id='$product_id' AND door_id='$door_id' AND cart.option_id>0 ORDER BY features.featurecaption";
	//echo $sql;
	if(!$query=$cxn->query($sql))
	{
		$err='your course list didn\'t happen because: '
		.'ERRNO: '
		.$cxn->errno
		.' ERROR: '
		.$cxn->error
		.' for this query: '
		.$query
		.PHP_EOL;
		trigger_error($err, E_USER_WARNING);
	}
	
	$result_array="";
	
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
		
	return $result_array;
}

function total_cart() {
	
	global $cxn;
	
		if(isset($_POST['session_id']))
		{
			$the_session_id=$_POST['session_id'];
		}
			elseif(isset($_POST['ajax_session_id']))
			{
				$the_session_id=$_POST['ajax_session_id'];
			}
		else
		{
			$the_session_id=$_GET['session_id'];
		}
	
	$sql="SELECT SUM(feature_cost) as total_feature, SUM(product_cost) as total_product , SUM(door_cost) as total_door FROM cart where session_id='$the_session_id'";
	$query=$cxn->query($sql);
	$result_array=array();
		while ($row=$query->fetch_array())
		{
			//this is your odd number of results
			$result_array[]=$row;
		}
	foreach($result_array as $cost)
	{
		$total_feature_cost=$cost['total_feature'];
		$total_product_cost=$cost['total_product'];
		$total_door_cost=$cost['total_door'];
	}
	$total_thus_far= $total_feature_cost + $total_product_cost + $total_door_cost;
	
	return $total_thus_far;	
	
}

function duplicate() {
	
	global $cxn;
	
	$alert=0;
	
	$product_id=$_POST['product_id'];//id of the product in the database
	$the_session_id=$_POST['session_id'];
	$door_id=$_POST['feature_door_id'];
	
	$sql="select id from cart where session_id='$the_session_id' AND product_id='$product_id' AND door_id='$door_id'";
	$query=$cxn->query($sql);
	$count=mysqli_num_rows($query);
	if($count>0)
	{
		$alert=1;
	}
	else
	{
		$alert=0;
	}
	
	return $alert;
	
}

$cart_count=1; //this is for the sake of aesthetics

if(isset($_POST['sample_door_alert'])&&$_POST['sample_door_alert']==1)
{
	$form_up=1;
	$dummy_check=duplicate();
	if($dummy_check==0)
	{
		$sample_door_insert=sample_door_add();
	}
}
else
{
	if(isset($_POST['session_id']))
	{
		$form_up=1;
		$dummy_check=duplicate();
		if($dummy_check==0)
		{
			$ring_it_up=add_to_cart();
		}
	}
}

if(isset($_POST['session_id']))
{
	$the_session_id=$_POST['session_id'];
}
	elseif(isset($_POST['ajax_session_id']))
	{
		$the_session_id=$_POST['ajax_session_id'];
	}
else
{
	$the_session_id=$_GET['session_id'];
}
	
?>

<?php

//figure out if anything needs to be displayed
$check_cart=current_cart();
if(!$check_cart AND !isset($_POST['product_id']) AND !isset($_POST['sample_door_alert'])) //there's nothing in the cart and nothing is being posted
{
	echo "<br><div style=\"margin:auto;background-color:#000000; color:#ffffff; text-align:center; width:400px; height:25px; padding-left:5px; padding-right:5px; padding-bottom:5px; padding-top:3px; border-radius:10px;\">you have nothing in your shopping cart at this time...</div>";
}
else
{
	if(isset($_POST['sample_door_alert'])&&$_POST['sample_door_alert']==1)
	{
		if($dummy_check>0)
		{
			include("ajax_warning.php");
		}
		else
		{
		//this is the code you're using when someone enters something in the shopping cart - you're adding a sample door
		include("ajax_register.php");
		}
	}
	else
	{
		if($form_up>0)
		{
			//make sure user isn't getting ready to enter a product that has the same id and the same door id as a previous entry
			if($dummy_check>0)
			{
				include("ajax_warning.php");
			}
			else
			{
			//this is the code you're using when someone enters a product in the shopping cart
				include("ajax_register.php");
			}
		}
			elseif(isset($_GET['register'])&&$_GET['register']==1) //displays edited content in a format that matches what the user just entered
			{
				include("ajax_register_edit.php");
			}
		else
		{
			//this is what the user gets when they click on "view cart"
			$cart_count=1;
			include("ajax_cart.php");
		}
	}
}
?>