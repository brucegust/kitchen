<div class="shop_navbar">
	<div class="shop_navbar_container">
		<ul>
		<!--here's where you put your first function that's calling all of your macro_categories sans RTA Cabinet Door Samples and Shippiing-->
		<?php
		$menu_url="";
		$the_menu_url="";
		$big_bear_list=$new_door->big_bear_category();
		foreach($big_bear_list as $big_bear)
		{
		?>
		<!-- Cabinet Accessories and Posts, Corbels and Onlays don't have any subcategories, so there's no submenu for them -->
			<?php
			if($big_bear['id']==3)
			{
			?>
				<li><a href="accessories.php?category_id=10"><?php echo stripslashes($big_bear['macro_category']);?></a></li>
			<?php
			}
				elseif($big_bear['id']==4)
				{
				?>
					<li><a href="posts.php?category_id=11"><?php echo stripslashes($big_bear['macro_category']);?></a></li>
				<?php
				}
			else
			{
			?>
				<li><a href="#"><?php echo stripslashes($big_bear['macro_category']);?> &#9660;</a>
				<!-- here are your submenus. With "Trim & Details," you've got several subcategories that require a little more width so that's why there's an if statement here -->
				<?php
				if($big_bear['id']==2)//trim and details
				{
				?>
				<ul style="white-space:nowrap; width:250px;">
				<?php
				}
				else
				{
				?>
				<ul>
				<?php
				}
				?>
				<?php
				$macro_list=$new_door->category_list($big_bear['id']);
				foreach($macro_list as $macro)
				{
				?>
				<?php 
				$sub_list=$new_door->subcategory_list($macro['category']);
					if(count($sub_list)>1)
					{
					//you've got more than one subcategory so, display the additional menu out to the side
					?>
					<li><a href="#"><?php echo stripslashes($macro['category']);?></a>
						<ul>
						<?php
						foreach($sub_list as $sub)
						{
							//similar to breadcrumb_map
							if($sub['macro_category']=="Cabinets")
							{
								$menu_url="cabinets.php?category_id=";
								$menu_url .=$sub['id'];
							}
							else
							{
								$menu_url="trim.php?category_id=";
								$menu_url .=$sub['id'];
							}
						?>
							<li><a href="<?php echo $menu_url;?>">
							<?php 
							$position = 38;					
							$message = stripslashes($sub['sub_category']);				
							$post = substr($message,$position,1); 										
								if($post !=" ") {					
								$length = strlen( $message );					
									while($post !=" " && $position < $length){					
									$i =1;					
									$position = $position+$i;					
									$post = substr($message,$position,1); 							
									}					
								}
							if(strlen($message>38))
							{
								$post = substr($message,0,$position).'...'; 
							}
							else
							{	
								$post = substr($message,0,$position);
							}
							echo $post;
							?>
							</a></li>
						<?php
						}
						?>
						</ul>
						</li>
						<?php
						}
						else
						{
							foreach($sub_list as $minisub)
							{
								if($minisub['category']=="Tall Cabinets")
								{
									$the_menu_url="cabinets.php?category_id=";
									$the_menu_url .=$minisub['id'];
								}
									elseif($minisub['category']=="Vanity Cabinets")
									{
										$the_menu_url="cabinets.php?category_id=";
										$the_menu_url .=$minisub['id'];
									}
									elseif($minisub['category']=="Decorative Door Panels")
									{
										$the_menu_url="trim.php?category_id=";
										$the_menu_url .=$minisub['id'];
									}
									elseif($minisub['category']=="Fillers")
									{
										$the_menu_url="trim.php?category_id=";
										$the_menu_url .=$minisub['id'];
									}
									elseif($minisub['category']=="Hood Box Columns")
									{
										$the_menu_url="trim.php?category_id=";
										$the_menu_url .=$minisub['id'];
									}
									elseif($minisub['category']=="Moldings & Trim")
									{
										$the_menu_url="trim.php?category_id=";
										$the_menu_url .=$minisub['id'];
									}
									elseif($minisub['category']=="Moldings & Trim@Trim & Details/Panels & Toe Kick")
									{
										$the_menu_url="trim.php?category_id=";
										$the_menu_url .=$minisub['id'];
									}
									elseif($minisub['category']=="Panels & Toe Kick")
									{
										$the_menu_url="trim.php?category_id=";
										$the_menu_url .=$minisub['id'];
									}
									elseif($minisub['category']=="Touch Up Kits")
									{
										$the_menu_url="trim.php?category_id=";
										$the_menu_url .=$minisub['id'];
									}
								else
								{
									$the_menu_url="trim.php?category_id=";
									$the_menu_url .=$minisub['id'];
								}
							?>
							<li><a href="<?php echo $the_menu_url;?>">
							<?php
							if(stripslashes($minisub['category'])=="Moldings & Trim@Trim & Details/Panels & Toe Kick")
							{
								echo "Moldings & Trim@Trim &...";
							}
							else
							{
								echo stripslashes($minisub['category']);
							}
						
							?>
							</a></li>
							<?php
							}
						}	
					}
				?>
				</ul>
				<?php
				}
				?>
				<!-- end of submenus -->
			</li>
		<?php
		}
		?>
		</ul>
	</div>
</div><!-- this concludes your product nav bar-->