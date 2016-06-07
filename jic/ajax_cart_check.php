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
		$sql_2="insert into cart (session_id, door_id, product_id, product_cost, quantity) values ('$the_session_id', '$door_id', '$product_id', '$the_product_cost','$quantity')";
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
			$sql_3="insert into cart (session_id, door_id) values ('$the_session_id', '$door_id')";
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
			$sql_5="insert into cart (session_id, product_id, product_cost, quantity) values ('$the_session_id', '$product_id', '$the_product_cost','$quantity')";
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

function current_cart() {
	
	global $cxn;
	
	if(isset($_POST['product_id'])&&trim($_POST['product_id'])<>"")
	{
		$product_id=$_POST['product_id'];//id of the product in the database
		//$the_session_id=$_POST['session_id'];
		
		$the_session_id="5n97uc0rq3kl665hnk78bj0pb6";
	
		//show me what's in the shopping cart OTHER THAN what the product id is of the item that was just added to the cart
		/*$sql="select cart.session_id, cart.product_id, cart.product_cost, cart.option_id, cart.feature_id, cart.feature_cost, cart.door_id, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_id<>'$product_id' order by cart.product_cost, products.name";*/
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
			//$the_session_id=$_POST['ajax_session_id'];
			
			$the_session_id="5n97uc0rq3kl665hnk78bj0pb6";
	
			//show me everything in the cart based on the user's current session id
			$sql="select cart.session_id, cart.product_id, cart.product_cost, cart.door_id, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' order by product_name";
			/*$sql="select cart.session_id, cart.product_id, cart.product_cost, cart.option_id, cart.feature_id, cart.feature_cost, cart.door_id, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' order by product_category, products.name";*/
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
	else
	{

		//$the_session_id=$_GET['session_id'];
		$the_session_id="5n97uc0rq3kl665hnk78bj0pb6";
		
		//show me everything in the cart based on the user's current session id
		$sql="select cart.session_id, cart.product_id, cart.product_cost, cart.door_id, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' order by product_name";
		/*$sql="select cart.session_id, cart.product_id, cart.product_cost, cart.option_id, cart.feature_id, cart.feature_cost, cart.door_id, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' order by product_category, products.name";*/
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
	
		/*if(isset($_POST['session_id']))
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
		}*/
		
		$the_session_id="5n97uc0rq3kl665hnk78bj0pb6";
	
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

function feature_cart($product_id) {
	
	global $cxn;
	
		/*if(isset($_POST['session_id']))
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
		}*/
		
			$the_session_id="5n97uc0rq3kl665hnk78bj0pb6";
	
	$sql="select cart.session_id, cart.option_id, cart.feature_id, cart.feature_cost as feature_cost, features.featurecaption, features.featurename from cart INNER JOIN features on cart.feature_id=features.id where cart.session_id='$the_session_id' AND cart.product_id='$product_id' AND cart.option_id>0 ORDER BY features.featurecaption";
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
	
		/*if(isset($_POST['session_id']))
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
		}*/
		
		$the_session_id="5n97uc0rq3kl665hnk78bj0pb6";
	
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

function ajax_current_cart() {
					
	global $cxn; 
	
		/*if(isset($_POST['session_id']))
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
		}*/
		
	$the_session_id="7g40l1spe25n1d1p1kcoom2ab4";
	
	$sql="select cart.session_id, cart.product_id, cart.product_cost, cart.door_id, cart.door_cost, cart.quantity, products.name as product_name, products.categories as product_category from cart INNER JOIN products on cart.product_id = products.id where cart.session_id='$the_session_id' AND cart.product_cost>'0' order by product_name";
	if(!$query->$cxn->query($sql))
	{
		$error = "your ajax_current_cart thing failed<br>";
		$error.="the sql is: ";
		$error=$sql;
		echo $error;
	}
	$result_array=array();
	while($row=$query->fetch_array())
	{
		$result_array=$row;
	}
	return $result_array;
}

$cart_count=1; //this is for the sake of aesthetics

if(isset($_POST['session_id']))
{
	$form_up=1;
	$ring_it_up=add_to_cart();
}

$check_cart=current_cart();
$cart_count=1;
?>
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="css/carousel_stylesheet.css" rel="stylesheet" type="text/css" />
<link href="css/sidebar.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<table style="width:85%; margin:auto; padding:5px; border-collapse:separate; border-spacing:2px;" border="0"><form id="theForm" method="Post">
	<?php
	$quantity_count=0;
	foreach($check_cart as $till)
	{	
	//if your feature id is = 0, then you're looking at your product
	?>
		<tr>
			<?php
			if($cart_count>1)
			{
			?>
			<td style="background-color:#000000; color:#ffffff;" colspan="3">&nbsp;
			<?php
			}
			else
			{
			?>
			<td style="background-color:#000000; color:#ffffff; border-top-left-radius:5px; border-top-right-radius:5px;" colspan="3">&nbsp;
			<?php
			}
			?>
			<?php echo stripslashes($till['product_category']);?>
			</td>
		</tr>
		<tr>
			<td style="background-color:#cccccc; color:#000000;" colspan="3">&nbsp;
			<?php echo stripslashes($till['product_name']);?><div style="float:right; display:inline-block;">X&nbsp;&nbsp;</div>
			</td>
		</tr>
		<tr>
			<td style="width:400px;">&nbsp;&nbsp;&nbsp;<b>Qty</b></td>
			<td style="width:100px;"><b>Cost</b></td>
			<td style="width:100px;"><b>Total Price</b></td>
		</tr>
		<?php
		//your product cost is going to be whatever is under the "product_cost" column in the cart table divided by the quantity. That will accommodate any "special" or "sale price" that might be in place
		if($till['product_cost']>0.00)
		{
			$the_actual_cost = $till['product_cost']/$till['quantity'];
		}
		else
		{
			$the_actual_cost=0.00;
		}
		?>
			<!--you changed your session_id here-->
			<td><input type="text" size="4" style="text-align:center;" name="quantity_<?php echo $quantity_count.'_'.$till['product_id'];?>" id="quantity_<?php echo $quantity_count;?>" value="<?php echo $till['quantity']; ?>"></td>
			<td id="cost_<?php echo $quantity_count;?>">$<?php echo number_format($the_actual_cost, 2);?></td>
			<td id="price_<?php echo $quantity_count;?>">$<?php echo number_format($till['product_cost'],2);?></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;<br></td>
		</tr>
		<tr>
			<td colspan="3"><b><u>Features...</b></u> (<a href="#" class="show_hide">show / hide</a>)</td>
		</tr>
		<tr class="current_cart_features" style="display:none;">
			<td colspan="3">
				<table>
				<?php 
				$feature_roster=feature_cart($till['product_id']); 
				if($feature_roster)
				{
					$cabinet_color=cart_door($till['product_id'], $till['door_id']);
					foreach($cabinet_color as $color)
					{
					?>
					<tr>
						<td colspan="3"><b>Cabinet Color</b></td>
					</tr>
					<tr>
						<td colspan="2"><u><?php echo stripslashes($color['featurename']);?></u></td>
						<td>$<?php echo number_format($till['door_cost'],2);?></td>
					</tr>
					<?php
					}
					foreach($feature_roster as $cadillac)
					{
					?>
					<tr>
						<td colspan="3"><b><?php echo stripslashes($cadillac['featurecaption']);?></b></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo stripslashes($cadillac['featurename']);?></td>
						<td>$<?php echo number_format($cadillac['feature_cost'],2);?></td>
					</tr>
					<?php		
					}
				}
				?>
				</table>
			</td>
		</tr>
	<?php
	$cart_count=$cart_count+1;
	$quantity_count=$quantity_count+1;
	}
	?>
	<tr>
		<td colspan="3"><hr></td>
	</tr>
	<tr>
		<td colspan="2"><b>Total:</b></td>
		<td>$<?php $the_total=number_format(total_cart(), 2); echo $the_total;?></td>
	</tr>
	<tr>
		<td colspan="3" style="text-align:center;"><input type="hidden" name="quantity_count" value="<?php echo $quantity_count;?>"><input type="hidden" name="ajax_session_id" value="5n97uc0rq3kl665hnk78bj0pb6"><input type="image" src="images/update_cart.png"></td>
	</tr>
</table></form>


	
<script>

$(function(){
	
	$('.show_hide').click(function(e){
	e.preventDefault();
	$(this).parents('tr').next(".current_cart_features").toggle("slow");
	});

	$("#theForm").submit(function(e) {// use the correct ID
		e.preventDefault();// we don\'t want to submit anything until we\'ve first determined that the user\'s not get ready to duplicate something that\'s already in the database.
		
		var devTest = $( "#theForm" ).serialize(); //packaging all of our submitted variables into one, neat little var
		alert("Develop test, URL prams = "+devTest);// publish a little alert box that lets you see your posted variables
		$.post( "ajax_relay.php", devTest) // posting all of our variables to ajax.php 
		<?php
		for($i=1; $i<=$quantity_count; $i++)
		{
		?>
		 $("#quantity_<?php echo $quantity_count;?>").val(data);
		 <?php
		}
		?>
	});

});

</script>