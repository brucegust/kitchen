<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include("carter.inc");
$mysqli = new mysqli($host,$user,$password,$database);
if($mysqli->connect_errno)
{
	$err="CONNECT FAIL: "
	.$mysqli->connect_errno
	. ' '
	.$mysqli->connect_error
	;
	trigger_error($err, E_USER_ERROR);
}

function update_cart() {
	
	global $mysqli;
	
	$current_cost="";
	$current_quantity="";
	$unit_price="";
	$the_new_quantity="";
	$arly_array=array();
	
	//check to see if there's anything already in the cart under the current session id
	$the_session_id=$_POST['ajax_session_id'];
	$the_quantity_count=$_POST['quantity_count'];
	//$the_session_id="toe73d5maufrbujvufhn9uc0j2";
	//$the_quantity_count=1;
	
	//grab all of your product_ids in the shopping cart that match the session id of this user
	$sql="select DISTINCT id, product_id, door_id from cart where session_id='$the_session_id' AND quantity>0";
	//echo $sql;
	$query=$mysqli->query($sql);
	$result_array=array();
	
	while($row=$query->fetch_array())
	{
		$result_array[]=$row;
	}
	
	foreach($result_array as $arly)
	{
		for($x=0; $x<=$the_quantity_count; $x++)
		{
			if(isset($_POST['quantity_'.$x.'_'.$arly['id']])&&trim($_POST['quantity_'.$x.'_'.$arly['id']])<>"")
			{
				$the_new_quantity=$_POST['quantity_'.$x.'_'.$arly['id']];
			
				//you've also got to update your product_cost field which means you have to take the current product cost and divide that by the current quantity value so...
				
				$sql_7 = "select product_cost, quantity from cart where id='$arly[id]'";
				if(!$query_7=$mysqli->query($sql_7))
				{
					$err='your product cost query didn\'t happen because: '
					.'ERRNO: '
					.$mysqli->errno
					.' ERROR: '
					.$mysqli->error
					.' for this query: '
					.$query_7
					.PHP_EOL;
					trigger_error($err, E_USER_WARNING);
				}
				$result_array_7=array();
				
				while($row_7=$query_7->fetch_array())
				{
					$result_array_7[]=$row_7;
				}
				
				foreach($result_array_7 as $doodle)
				{
					$current_cost=$doodle['product_cost'];
					$current_quantity=$doodle['quantity'];
				}
				
				//this is "just in case." Make sure that you've got a quantity before you run the risk of dividing by zero
				if($current_quantity>0)
				{
					$unit_price=$current_cost / $current_quantity;
					$new_product_cost=$unit_price * $the_new_quantity;

					$sql_6="update cart set quantity='$the_new_quantity', product_cost='$new_product_cost' where id='$arly[id]'";
					//echo $sql_6;
					if(!$query_6=$mysqli->query($sql_6))
					{
						echo "Error";
					}
				}
			}
			//here I'm looking to see if the user wants to delete anything based on whether or not they've got a checkmark by the trash can image 
			if(isset($_POST['product_'.$arly['product_id'].'_'.$arly['door_id']])&&$_POST['product_'.$arly['product_id'].'_'.$arly['door_id']]=="Y")
			{
					$sql_9="delete from cart where session_id='$the_session_id' and product_id='$arly[product_id]' AND door_id='$arly[door_id]'";
					if(!$query_9=$mysqli->query($sql_9))
					{
						$error="didn't work!";
						die($error);
					}			
			}
		$arly_array[$x]=$arly['id'];//I was originally thinking that I was going to have to pack all of the ids that were effected by this update query, but then it just became a way of identifying the fact that the query ran successfully
		}
	}
	return $arly_array;
}

function update_register() {
	
	global $mysqli;
	
	$query_check=0;
	$the_session_id=$_POST['ajax_session_id'];
	
	$sql="select DISTINCT product_id, id, door_id from cart where session_id='$the_session_id' AND quantity>0";
	//echo $sql;
	$query=$mysqli->query($sql);
	$result_array=array();
	
	while($row=$query->fetch_array())
	{
		$result_array[]=$row;
	}
	
	foreach($result_array as $arly)
	{
		if(isset($_POST['ajax_quantity_'.$arly['product_id'].'_'.$arly['door_id']])&&$_POST['ajax_quantity_'.$arly['product_id'].'_'.$arly['door_id']]<>"")
		{
		//echo "anything";
		$the_new_quantity=$_POST['ajax_quantity_'.$arly['product_id'].'_'.$arly['door_id']];
		$pieces=explode("_", $_POST['ajax_quantity_'.$arly['product_id'].'_'.$arly['door_id']]);
		//$pieces[0] - this is your ajax_quantity text
		//$pieces[1] - this is your product_id
		
		//you've also got to update your product_cost field which means you have to take the current product cost and divide that by the current quantity value so...
		
		$sql_7 = "select product_cost, quantity from cart where id='$arly[id]'";
		//echo $sql_7;
		if(!$query_7=$mysqli->query($sql_7))
		{
			$err='your product cost query didn\'t happen because: '
			.'ERRNO: '
			.$mysqli->errno
			.' ERROR: '
			.$mysqli->error
			.' for this query: '
			.$query_7
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		$result_array_7=array();
		
		while($row_7=$query_7->fetch_array())
		{
			$result_array_7[]=$row_7;
		}
			
			foreach($result_array_7 as $doodle)
			{
				$current_cost=$doodle['product_cost'];
				$current_quantity=$doodle['quantity'];
			}
			
			$unit_price=$current_cost / $current_quantity;
			$new_product_cost=$unit_price * $the_new_quantity;

			$sql_6="update cart set quantity='$the_new_quantity', product_cost='$new_product_cost' where id='$arly[id]'";
			echo $sql_6;
			if(!$query_6=$mysqli->query($sql_6))
			{
				echo "Error";
			}
		}
		//here I'm looking to see if the user wants to delete the product they just entered into the cart
		if(isset($_POST['ajax_product_'.$arly['product_id'].'_'.$arly['door_id']])&&$_POST['ajax_product_'.$arly['product_id'].'_'.$arly['door_id']]=="Y")
		{
			//echo "hello";
				$sql_9="delete from cart where session_id='$the_session_id' and product_id='$arly[product_id]' AND door_id='$arly[door_id]'";
				/*if(!$query_9=$mysqli->query($sql_9))
				{
					$error="didn't work!";
					die($error);
				}	*/		
		}
	$query_check=$query_check+1;
	}
return $query_check;
}



if($_POST['form_up_value']==0)
{
	//echo "hello";
	//nothing is being updated as far as what was just entered into the Cart. The user is updating what's in there currently
	$hit_it=update_cart();

	if($hit_it)
	{
		//print_r(array_values($hit_it));
		echo "yes";
	}
	else
	{
		echo "fail";
	}
}
else
{
//you're going to update what the user just entered as well as whatever else may be in the cart
$good_to_go=0;
$new_register=update_register(); 
/*this is checking for values in the ajax_register.php page that are entitled "ajax_product_..." This is the product that's displayed with all of the features listed
*/

	if($_POST['current_cart_value']>0)
	{
		echo "current_cart";
		$hit_it=update_cart();
		if($hit_it)
		{
			if($new_register>0)
			{
			$good_to_go=1;
			}
		}
	}
	else
	{
		if($new_register>0)
		{
			$good_to_go=1;
			//echo "done";
		}
	}
//if both $new_register and $hit_it happened, you need to determine whether a "success" value was determined for both	
	if($good_to_go>0)
	{
		echo "yes";
	}
	else
	{
		echo "fail";
	}
}




?>