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

/*This is the page that's doing all of the adding and updating to the cart prior to the user checking out. You've got one of three difference scenarios happening. First is a brand new entry which is handled by "add_to_cart." One product, brand new session id and out the door. Results are displayed using the "ajax_register.php" page. That page is what's displayed after every form entry. Otherwise, the results are being displayed using the ajax_cart.php page. 

If any updates are done in the immediate aftermath of the user having added something to the cart, the results are being displayed with the "ajax_register_edit.php" page. The thing that makes both the ajax_register.php page and the ajax_register_edit.php page distintive is the way in which it displays the most recent entry at the top of the list with all of the features displayed. Everything else is listed with the features hidden.

If the user chooses to make any edits from the "ajax_register_edit.php" page - the one where a round of edits has already been done with the ajax_register.php page as the starting point - the "ajax_relay.php" page is going to be looking for the same data, but with different field names.


*/
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
	
	if($cart_count==0)
	{
		//add what's just been posted to the cart under current session id
		//start with the basics (door_id, session_id, etc. be aware of the door is on sale)
		$sql_2="insert into cart (session_id, door_id, product_id, product_cost, quantity, sequence) values ('$the_session_id', '$door_id', '$product_id', '$the_product_cost','$quantity','1')";
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
				$sql_3="insert into cart (session_id, product_id, option_id, feature_id, feature_cost) VALUES ('$the_session_id', '$product_id', '$pieces[0]', '$pieces[1]', '$pieces[2]')"; 
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
	}
	else
	{
		//first be sure to avoid duplicates, and then add what's new to the cart dynamic
		$sql_2="select id from cart where session_id='$the_session_id' AND door_id='$door_id'";
		//echo $sql_2;
		$query_2=$cxn->query($sql_2);
		$cart_count_2=mysqli_num_rows($query_2);
		
		if($cart_count==0)
		{
			//figure out what the sequence number needs to be 
			$sql_8="select sequence from cart where session_id='$the_session_id' and quantity>'0' order by sequence DESC LIMIT 1";
			$query_8=$cxn->query($sql_8);
			$row_8=$query_8->fetch_object();
			$new_sequence=$row_8['sequence']+1;
			
			$sql_3="insert into cart (session_id, door_id, sequence) values ('$the_session_id', '$door_id', '$new_sequence')";
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
		
		$sql_4="select id from cart where session_id='$the_session_id' AND product_id='$product_id'";
		$query_4=$cxn->query($sql_4);
		$cart_count_4=mysqli_num_rows($query_4);
		//echo $cart_count_4;
		if($cart_count_4==0)
		{
			//again, establish new sequence number
			$sql_9="select sequence from cart where session_id='$the_session_id' and quantity>'0' order by sequence DESC LIMIT 1";
			$query_9=$cxn->query($sql_9);
			$row_9=$query_9->fetch_object();
			$new_sequence_1=$row_9['sequence']+1;
			
			$sql_5="insert into cart (session_id, product_id, product_cost, quantity, sequence) values ('$the_session_id', '$product_id', '$the_product_cost','$quantity', '$new_sequence_1')";
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
					
					//start by checking for session id, option_id in the cart table
					$sql_6="select id from cart where session_id='$the_session_id' and option_id='$pieces[1]'";
					//echo $sql_6;
					$query_6=$cxn->query($sql_6);
					$cart_count_6=mysqli_num_rows($query_6);
					//echo $cart_count_6;
					if($cart_count_6==0)
					{
					//option doesn't exist
					$sql_7="insert into cart (session_id, product_id, option_id, feature_id, feature_cost) VALUES ('$the_session_id', '$product_id', '$pieces[0]', '$pieces[1]', '$pieces[2]')"; 
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
		//end of features
		}
	}
}  

function current_cart() {
	
	global $cxn;
	
	if(isset($_POST['product_id'])&&trim($_POST['product_id'])<>"")
	{
		$product_id=$_POST['product_id'];//id of the product in the database
		$the_session_id=$_POST['session_id'];
	
		//show me what's in the shopping cart OTHER THAN what the product id is of the item that was just added to the cart
		$sql="select cart.id, cart.session_id, cart.product_id, cart.product_cost, cart.door_id, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' AND cart.product_id<>'$product_id'  order by product_name";
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
			$sql="select cart.session_id, cart.product_id, cart.product_cost, cart.door_id, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' order by product_name";
			/*$sql="select cart.session_id, cart.product_id, cart.product_cost, cart.option_id, cart.feature_id, cart.feature_cost, cart.door_id, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' order by product_category, products.name";*/
			echo $sql;
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
		echo $the_session_id;
		//$the_session_id="jqmlgvelt0vqbqksl6bqnth8o5";
		echo "hello";
		//show me everything in the cart based on the user's current session id
		$sql="select cart.session_id, cart.product_id, cart.product_cost, cart.door_id, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' order by product_name";
		echo $sql;
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
	$sql="select featurename from features where product_id=(select part_id from products where id='$product_id') and part_number='$feature_door_id'";
	//$sql="select cart.session_id, cart.product_id, cart.door_id, cart.door_cost as door_cost, features.featurename as featurename from cart INNER JOIN features on cart.door_id=features.part_number where session_id='$the_session_id'";
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
	
	$sql="SELECT SUM(feature_cost) as total_feature, SUM(product_cost) as total_product FROM cart where session_id='$the_session_id'";
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
	}
	$total_thus_far= $total_feature_cost + $total_product_cost;
	
	return $total_thus_far;	
	
}

$cart_count=1; //this is for the sake of aesthetics

if(isset($_POST['session_id']))
{
	$form_up=1;
	$ring_it_up=add_to_cart();
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
//echo $form_up;
if($form_up>0)
{
	//this is the code you're using when someone enters something in the shopping cart
	include("ajax_register.php");
}
else
{
	//this is the view the user gets when they just "view cart." They haven't submitted anything, this is just what's in the cart currently
	//this is where all of the user's edits are going to show up

	$check_cart=current_cart();
	$cart_count=1;
	if(!$check_cart AND !isset($_POST['product_id'])) //there's nothing in the cart and nothing is being posted
	{
		echo "<br><div style=\"margin:auto;background-color:#000000; color:#ffffff; text-align:center; width:400px; height:25px; padding-left:5px; padding-right:5px; padding-bottom:5px; padding-top:3px; border-radius:10px;\">you have nothing in your shopping cart at this time...</div>";
	}
	else
	{
		include("ajax_cart.php");
	}
}
?>

