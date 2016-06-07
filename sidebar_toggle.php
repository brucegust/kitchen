<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>KitchenCabinetCo.com by Online Cabinets Direct</title>
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="css/carousel_stylesheet.css" rel="stylesheet" type="text/css" />
<link href="css/sidebar.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script>
$(document).ready(function(){
	 
//this is your starting point where all your slidingNavTerms are hidden and your display_hide links are displayed

		$(".slidingNavTerms").hide();
		$(".display_hide").show();
 
//here's your actual function, as far as a user clicking on a link in order to see the "hidden" link beneath it 
 
		$('.display_hide').click(function(){
		$(this).next().slideToggle();
		//$(this).html("System Performance &#9650;");
		});
	
//this is the command that corresponds to all of the links on your main nav bar in that anytime the user hovers over a "primary" link, it sets all of the previously exposed links to "hidden." This way
//any expanded menus don't linger. Since I've got graphic to correspond with every link, I gave each link a function. It may not be the most elegant approach, but it got the job done.	

	$('.restore').hover(function(){
	$(".slidingNavTerms").hide();
	$(".display_hide").show();
	});
	
	$('.button').click(function() {
	//$('.screen'+$(this).val()).text('Button clicked: ' + $(this).val());
	$('#screen').show();
	$(this).next().show("slow");
	});
	
	$('.close_window').click(function() {
	//$('.screen'+$(this).val()).text('Button clicked: ' + $(this).val());
	$('#screen').hide();
	//$(this).prev().hide("slow");
	//$(this).hide("slow");
	$(".box").hide("slow");
	});
	
	$("#menu_toggle").click(function(e){
	e.preventDefault();
	$("#wrapper").toggleClass("menuDisplayed");
	 //alert("The paragraph was clicked.");
	});
	
	$("#menu_toggle_option").click(function(e){
	e.preventDefault();
	$('#screen').hide();
	//$(this).prev().hide("slow");
	//$(this).hide("slow");
	$(".box").hide("slow");
	$("#wrapper").toggleClass("menuDisplayed");
	return false;
	 //alert("The paragraph was clicked.");
	});
});


</script>

</head>
<body>
<div id="screen"></div>
<div class="navbar_background">
<div style="background-color:#000000; height:49px; width:100%; position:absolute; z-index:-2"></div>
	<div class="bbb_logo"></div>
	<div class="social_icons">
		<a href="http://facebook.com" target="_blank"><div class="facebook_link"></div></a>
		<div class="blog_link"></div>
		<div class="store_link"></div>
	</div>
	<div class="no_cam_sign"></div>
	<!-- this is your navbar -->
	

<div class="navbar">
		<div class="navcontainer">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="#" class="restore">About</a>
					<ul>
						<li><a href="about.php">About</li>
						<li><a href="construction.php">Construction</a></li>
						<li><a href="about.php#specs">Specifications</a></li>
						<li><a href="why.php">Why Buy RTA Cabinets...</a></li>
						<li><a href="#" class="display_hide" style="outline:0;">Policies  &#9660;</a>
							<div class="slidingNavTerms">
								<a href="returns.php" style="line-height:26px; outline:0;">Return Policy</a>
								<a href="privacy.php" style="line-height:26px; outline:0;">Privacy Policy</a>
								<a href="damage.php" style="line-height:26px; outline:0;">Damage Policy</a>
							</div>
						</li>
					</ul>
				</li>
				<li><a href="gallery_full.php" class="restore">Gallery</a>
					<ul style="width:400px; height:auto; background-color:#ffffff;">
										<br>
						<table border="0" style="width:auto; margin:auto;">
						<tr>

						
							<td style="text-align:center;">
								<table style="width:125px; margin:auto;" border="0">
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
																				<A HREF="gallery.php?category=558"><img src="Photos/crop.php?h=85&w=85&f=BlackIslandDistress[1].jpg"  border="0" alt="558" style="margin-left:-28px;"></a>
										Black Distressed										</td>
									</tr>
								</table>
														</td>

						
							<td style="text-align:center;">
								<table style="width:125px; margin:auto;" border="0">
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
																				<A HREF="gallery.php?category=389"><img src="Photos/crop.php?h=85&w=85&f=bwine_shaker.jpg"  border="0" alt="389" style="margin-left:-28px;"></a>
										Brandywine Shaker										</td>
									</tr>
								</table>
														</td>

						
							<td style="text-align:center;">
								<table style="width:125px; margin:auto;" border="0">
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
																				<A HREF="gallery.php?category=753"><img src="Photos/crop.php?h=85&w=85&f=IMG_2641[1].jpg"  border="0" alt="753" style="margin-left:-28px;"></a>
										Charcoal Mist										</td>
									</tr>
								</table>
														</td>

						</tr><tr>
							<td style="text-align:center;">
								<table style="width:125px; margin:auto;" border="0">
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
																				<A HREF="gallery.php?category=548"><img src="Photos/crop.php?h=85&w=85&f=2909GeorgiaAveKitchenC.jpg"  border="0" alt="548" style="margin-left:-28px;"></a>
										Chocolate Mist										</td>
									</tr>
								</table>
														</td>

						
							<td style="text-align:center;">
								<table style="width:125px; margin:auto;" border="0">
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
																				<A HREF="gallery.php?category=324"><img src="Photos/crop.php?h=85&w=85&f=FrenchVanilla2.jpg"  border="0" alt="324" style="margin-left:-28px;"></a>
										French Vanilla Deluxe										</td>
									</tr>
								</table>
														</td>

						
							<td style="text-align:center;">
								<table style="width:125px; margin:auto;" border="0">
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
																				<A HREF="gallery.php?category=323"><img src="Photos/crop.php?h=85&w=85&f=kitchen010.jpg"  border="0" alt="323" style="margin-left:-28px;"></a>
										Ginger Deluxe										</td>
									</tr>
								</table>
														</td>

						</tr><tr>
							<td style="text-align:center;">
								<table style="width:125px; margin:auto;" border="0">
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
																				<A HREF="gallery.php?category=304"><img src="Photos/crop.php?h=85&w=85&f=Mocha Hood 2.jpg"  border="0" alt="304" style="margin-left:-28px;"></a>
										Mocha Deluxe										</td>
									</tr>
								</table>
														</td>

						
							<td style="text-align:center;">
								<table style="width:125px; margin:auto;" border="0">
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
																				<A HREF="gallery.php?category=773"><img src="Photos/crop.php?h=85&w=85&f=white_deluxe.jpg"  border="0" alt="773" style="margin-left:-28px;"></a>
										White Deluxe										</td>
									</tr>
								</table>
														</td>

						<td>&nbsp;</td></tr></table><br>	
					</ul>					
				</li>
				<li><a href="all_doors.php" class="restore">Door Styles</a>
					<ul style="width:480px; height:auto; background-color:#ffffff;">
					<!-- code for feature doors -->					
											<table border="0" style="width:450px; margin:auto;">
							<tr>
							<td colspan="4" style="padding-top:5px; padding-bottom:5px;"><a href="rta_doors.php" class="doors">view standard finishes...</a></td>
						</tr>
						<tr>
						
							<td style="text-align:center;">
								<table border="0" style="margin:auto;">
									<tr>
										<td style="text-align:center;">
																				<A HREF="door_samples.php?id=389"><img src="assets/images/door_colors/Brandywine Shaker.jpg" border="0" alt="Brandywine Shaker Sample Door" style="width:75px; margin-left:-22px;;"></a>
										</td>
									</tr>
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
										Brandywine Shaker										</td>
									</tr>
								</table>
														</td>

						
							<td style="text-align:center;">
								<table border="0" style="margin:auto;">
									<tr>
										<td style="text-align:center;">
																				<A HREF="door_samples.php?id=324"><img src="assets/images/door_colors/3FV12.jpg" border="0" alt="French Vanilla Deluxe Door Sample" style="width:75px; margin-left:-22px;;"></a>
										</td>
									</tr>
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
										French Vanilla Deluxe										</td>
									</tr>
								</table>
														</td>

						
							<td style="text-align:center;">
								<table border="0" style="margin:auto;">
									<tr>
										<td style="text-align:center;">
																				<A HREF="door_samples.php?id=323"><img src="assets/images/door_colors/Ginger.jpg" border="0" alt="Ginger Deluxe Door Sample" style="width:75px; margin-left:-22px;;"></a>
										</td>
									</tr>
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
										Ginger Deluxe										</td>
									</tr>
								</table>
														</td>

						
							<td style="text-align:center;">
								<table border="0" style="margin:auto;">
									<tr>
										<td style="text-align:center;">
																				<A HREF="door_samples.php?id=555"><img src="assets/images/door_colors/HARVEST3.jpg" border="0" alt="Harvest Deluxe Door Sample" style="width:75px; margin-left:-22px;;"></a>
										</td>
									</tr>
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
										Harvest Deluxe										</td>
									</tr>
								</table>
														</td>

						</tr><tr>
							<td style="text-align:center;">
								<table border="0" style="margin:auto;">
									<tr>
										<td style="text-align:center;">
																				<A HREF="door_samples.php?id=304"><img src="assets/images/door_colors/Mocha.jpg" border="0" alt="Mocha Deluxe Door Sample" style="width:75px; margin-left:-22px;;"></a>
										</td>
									</tr>
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
										Mocha Deluxe										</td>
									</tr>
								</table>
														</td>

						
							<td style="text-align:center;">
								<table border="0" style="margin:auto;">
									<tr>
										<td style="text-align:center;">
																				<A HREF="door_samples.php?id=725"><img src="assets/images/door_colors/WhiteChocolatePen.jpg" border="0" alt="White Deluxe Chocolate Glaze Door Sample" style="width:75px; margin-left:-22px;;"></a>
										</td>
									</tr>
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
										Chocolate Glaze										</td>
									</tr>
								</table>
														</td>

						
							<td style="text-align:center;">
								<table border="0" style="margin:auto;">
									<tr>
										<td style="text-align:center;">
																				<A HREF="door_samples.php?id=692"><img src="assets/images/door_colors/WhiteShaker.jpg" border="0" alt="White Shaker Door Sample" style="width:75px; margin-left:-22px;;"></a>
										</td>
									</tr>
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
										White Shaker										</td>
									</tr>
								</table>
														</td>

						<td>&nbsp;</td></tr>						 <tr>
							<td colspan="4"><a href="custom_doors.php" class="doors">view custom finishes...</a></td>
						</tr>
						</table><br>					</ul>	
				
				</li>
				<li><a href="#" class="restore">How to Design Your Kitchen</a>
					<ul>
						<li><a href="design.php">Design</a></li>
						<li><a href="assembly.php">Assembly</a></li>
					</ul>
				</li>
				<li><a href="faqs.php" class="restore">Faqs</a></li>
				<li><a href="reviews.php" class="restore">Reviews</a></li>
				<li><a href="contact.php" class="restore">Contact</a></li>
			</ul>
		</div>	
	</div></div>
<div id="wrapper"><br>
	<div id="page_content_wrapper">
<div id="sidebar_wrapper"><a href="#" id="menu_toggle">where am I</a><br><br></div>
<div style="margin:auto; width:1000px; height:auto; margin-bottom:50px;">
<br><br>
	<div style="background-image:url(images/satellite_text_header.jpg); background-repeat:no-repeat; width:857px; height:81px; margin:auto;">
	<a href="index.php"><div style="width:328px; height:45px; position:relative; display:inline-block;"></div></a>
	<a href="all_doors.php"><div style="width:82px; height:22px; position:relative; display:inline-block; margin-left:10px;"></div></a>
	<a href="cabinets_home.php"><div style="width:52px; height:22px; position:relative; display:inline-block; margin-left:-3px;"></div></a>
	<a href="cabinets_home.php"><div style="width:98px; height:22px; position:relative; display:inline-block; margin-left:-1px;"></div></a>
	<a href="posts_home.php"><div style="width:138px; height:22px; position:relative; display:inline-block; margin-left:2px;"></div></a>
	<a href="posts_home.php"><div style="width:113px; height:22px; position:relative; display:inline-block; margin-left:2px;"></div></a>
	</div>
	
	<div style="background-image:url(images/satellite_filler.jpg); background-repeat:y-repeat; width:857px; height:auto; margin:auto;">
	
		<div style="width:790px; min-height:750px; margin-left:50px;"><br><!--main content-->		
			<div style="position:absolute; width:182px; height:48px; margin-top:-45px; margin-left:320px;"><a href="all_doors.php"><img src="images/back_to_doors.jpg" border="0"></a></div><br>
			<table style="width:700px; margin:auto;" border="0">
				<tr>
					<td style="text-align:center;" rowspan="2"><img src="assets/images/door_colors/Brandywine Shaker.jpg" style="width:225px;">
										</td>
					<td style="vertical-align:top; text-align:center;"><span class="satellite_title">Brandywine Shaker Sample Door</span><hr style="margin-top:-2px;"><a href="door_samples.php?id=389"><img src="images/information_button.jpg" border="0" style="margin-top:-2px;"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="gallery.php?category=389"><img src="images/gallery_button.jpg" border="0" style="margin-top:-2px;"></a>
				</tr>
				<tr style="height:250px;">
					<td style="vertical-align:top;"><br><ul><li><b>Name:</b> Brandywine Shaker Sample Door</li><li><b>Manufacturer:</b> Timberland Cabinetry</li><li><b>Your Price:</b> $20.00</li></ul>
					<div style="position:relative; width:84px; height:86px; float:right;"><img src="images/add_to_cart.png"></div>Choose from the pulldowns to begin building your dream collection of cabinetry!<br><br><div style="text-align:center;"><b>FREE SHIPPING ON ALL DOOR SAMPLES!</b></div>				
					</td>
				</tr>
			</table>
			<div class="shop_navbar">
				<div class="shop_navbar_container">
					<ul>
						<li><a href="#">Cabinets &#9660;</a>
							<ul>
															<li><a href="#">Base Cabinets</a>
									<ul>
																			<li><a href="door_shop.php?category_id=1&door_id=389">Corner Base Cabinets</a></li>
																			<li><a href="door_shop.php?category_id=2&door_id=389">Drawer Base Cabinets</a></li>
																			<li><a href="door_shop.php?category_id=3&door_id=389">Full Height Base Cabinets</a></li>
																			<li><a href="door_shop.php?category_id=4&door_id=389">Peninsula Base Cabinets</a></li>
																			<li><a href="door_shop.php?category_id=5&door_id=389">Sink Base Cabinets</a></li>
																			<li><a href="door_shop.php?category_id=6&door_id=389">Specialty Base Cabinets</a></li>
																			<li><a href="door_shop.php?category_id=7&door_id=389">Standard Base Cabinets</a></li>
																			<li><a href="door_shop.php?category_id=8&door_id=389">Trimmable Knee Drawers & Desk File Drawers</a></li>
																			<li><a href="door_shop.php?category_id=9&door_id=389">Trimmable Knee Drawers & Desk File Drawers@Vanity Cabinets</a></li>
																		</ul>
								</li>
															<li><a href="#">Tall Cabinets</a>
									<ul>
																			<li><a href="door_shop.php?category_id=14&door_id=389">Tall Cabinets</a></li>
																		</ul>
								</li>
															<li><a href="#">Vanity Cabinets</a>
									<ul>
																			<li><a href="door_shop.php?category_id=23&door_id=389">Vanity Cabinets</a></li>
																		</ul>
								</li>
															<li><a href="#">Wall Cabinets</a>
									<ul>
																			<li><a href="door_shop.php?category_id=24&door_id=389">Blind Corner Wall Cabinets</a></li>
																			<li><a href="door_shop.php?category_id=25&door_id=389">Chimney Hoods</a></li>
																		</ul>
								</li>
														</ul>
						</li>
						<li><a href="#">Trim & Details &#9660;</a></li>
						<li><a href="#">Posts, Corbels & Onlays &#9660;</a></li>
						<li><a href="#">Accessories &#9660;</a></li>
					</ul>
				</div>
			</div><!-- this concludes your product nav bar-->
			<!-- here is where you put your product info -->
						<br>
					<table border="0" style="margin:auto;">
						<tr>
							<td style="text-align:center; padding-left:10px; padding-right:10px;">
														<img src="assets/images/2010cabinetimages/B15.jpg" border="0" alt="B15" style="height:180px;">
									
							</td>
							<td><br>
							<div class="product_label">
							<b>Standard Base Cabinets</b><br>
							<b>Part Number:</b> B15<br>
							<b>Your Price:</b> $165.00							</div>
							<input type="image"  src="images/select_options.png" class="button" style="margin:auto; margin-top:3px;">
							<!-- right in here is your hidden "box" div-->
							<div class="box">
								<!--beginning of bordered div-->
								<div style="width:580px; height:auto; margin:auto; border:1px solid #cccccc; padding:5px; margin-top:10px; border-radius:10px;">
								
									<!--beginning text and nameplate-->
									Select your cabinet options from the pulldown menu below. Then be sure to enter the quantity at the bottom. If you have any questions, be sure to contact us at  (615) 828-8377 or email: <a href="mailto:orders@onlinecabinetsdirect.com" style="color:#000000;">orders@onlinecabinetsdirect.com</a>.<br><br>
									<div style="background-color:#000000; color:#ffffff; font-weight:bold; width:560px; height:25px; margin:auto; text-align:center; padding-top:3px;">B15 | Standard Base Cabinets | $165.00</div><br>
									<!--end of beginning text and nameplate-->
									<table style="width:475px; margin:auto;" border="0">
																															<tr>
												<td><b>Add Roll Out Tray</b></td>
											</tr>
											<tr>
												<td><select name="Do Not Add Roll Out Trays" style="width:450px;">
												<option></option>
																								<option value="5">Add 2 ROTB15</option>
																								<option value="3">Add 1 ROTB15</option>
																								<option value="4">Do Not Add Roll Out Trays</option>
																								</select>
												<br><br></td>
											</tr>
																																																							<tr>
												<td><b>Add Pull Out Trash Can</b></td>
											</tr>
											<tr>
												<td><select name="Do Not Add Trash Can Pull Out" style="width:450px;">
												<option></option>
																								<option value="1">Add Pull Out Trash Can</option>
																								<option value="2">Do Not Add Trash Can Pull Out</option>
																								</select>
												<br><br></td>
											</tr>
																																												<tr>
												<td><b>Hinge Direction</b></td>
											</tr>
											<tr>
												<td><select name="Hinge Right" style="width:450px;">
												<option></option>
																								<option value="14">Hinge Left</option>
																								<option value="13">Hinge Right</option>
																								</select>
												<br><br></td>
											</tr>
																																												<tr>
												<td><b>Cabinet Assembly</b></td>
											</tr>
											<tr>
												<td><select name="No Assembly / Customer Will Assemble Upon Receipt" style="width:450px;">
												<option></option>
																								<option value="7">Standard Finish Utility / Oven Cabinet Assembly</option>
																								<option value="6">Standard Finish Base / Wall Cabinet Assembly</option>
																								<option value="8">No Assembly / Customer Will Assemble Upon Receipt</option>
																								</select>
												<br><br></td>
											</tr>
																																																							<tr>
												<td><b>Finished Side Panel Skins As You Are Looking At The Cabinet Front</b></td>
											</tr>
											<tr>
												<td><select name="No Side Exposed" style="width:450px;">
												<option></option>
																								<option value="12">Both Side Exposed</option>
																								<option value="10">Right Side Exposed</option>
																								<option value="9">Left Side Exposed</option>
																								<option value="11">No Side Exposed</option>
																								</select>
												<br><br></td>
											</tr>
																																																					
									</table>
								</div>
								<!--end of bordered div-->
								
								<!-- close button -->
								<div style="bottom:0; left:0; right:0; position:absolute; padding-bottom:5px; width:248px; height:50px; text-align:center; margin:auto;"><input type="image" src="images/cancel.png" class="close_window" style="float:left;">&nbsp;&nbsp;<a href="#" id="menu_toggle_option"><img src="images/add_to_cart_button.png" style="float:left;" border="0"></div>
								<!--end of close button-->
								
							</div>
							<!-- end of hidden box div-->
							</td>
						</tr>
					</table>
			</div><!--this is the div that closes your main content -->
	</div><!-- this is the div that closes your satellite filler -->
	<div style="background-image:url(images/satellite_text_footer.jpg); background-repeat:no-repeat; width:857px; height:25px; margin-left:72px; margin-top:-10px;"></div>
	</div><!-- here's where you close your #page_wrapper div-->
</div><!-- here's where you close your #wrapper div-->
	
</div>
<div class="footer">Kitchen Cabinet Company | rtakitchencabinetsonline.com |  (p) 615-828-8377 | (e) admin@kitchencabinetsonline.com</div>
</body>
</html>
