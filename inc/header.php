<?php
	require "lib/session.php";
	require "lib/Database.php";
	require "helpers/format.php";
	$db=new database();
	$fm=new format();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>TO-LET</title>
    <meta charset="UTF-8"/>
		<meta meta name="viewport" content="width=device-width, user-scalable=no" /> 
		<script src="js/slider_jquery.js"></script>
		<link rel="stylesheet" href="fontawesome/css/all.css">
		<link rel="stylesheet" href="css/style.css"/>
		<?php 
					$query="SELECT * FROM tbl_theme;";
					$result=$db->select($query);
					if($result!="false")
					{
						$cat=$result->fetch_assoc(); 
						if($cat['theme']=="default")
						{ ?>
							<link rel="stylesheet" href="theme/default.css"/>
						<?php }elseif($cat['theme']=="orange")
						{ ?>
							<link rel="stylesheet" href="theme/orange.css"/>
						<?php }elseif($cat['theme']=="green")
						{ ?>
							<link rel="stylesheet" href="theme/green.css"/>
						<?php }elseif($cat['theme']=="magenta")
						{ ?>
							<link rel="stylesheet" href="theme/magenta.css"/>
						<?php }
					}
    ?>
		<!--********************Flex-slider-css*************************-->
		<link rel="stylesheet" href="Flex-Slider/css/flexslider.css" type="text/css" media="screen" />
	<script src="js/search.js"></script>
</head>
<body>
	<div class="container"> 
		<div class="top">
			<div class="contact">
				<?php
					$sql="SELECT * FROM tbl_contact_info WHERE id=1";
					$result=$db->select($sql)->fetch_assoc();
				?>
				<span class="left"><i class="fas fa-phone-volume "></i><span>Contact No. </span><span> <?php echo $result['phone_1'];?></span>
				<i class="fas fa-phone-volume "></i><span>Contact No. </span><span> <?php echo $result['phone_2'];?></span></span>
				<span class="right"><i class="fas fa-envelope"></i><span>Email:</span><span> <?php echo $result['email'];?></span></span>
			</div>
		</div>
		<div class="menu_section"><!-- Menu section start --> 
			<div class="navbar">
				<div id="mySidepanel" class="sidepanel">
					  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
					  <ul>
					  	<li><a href="index.php"><i class="fas fa-home "></i> Home</a></li>
					  	<li disabled><button disabled><i class="fas fa-eye "></i>View Ads: Category</button>
							<ul> 
								<li><a href="house.php"><i class="fas fa-building "></i>Houses</a></li>
								<li><a href="rent-a-car.php"><i class="fas fa-car-side "></i>Rent-A-Car</a></li>
								<li><a href="employment.php"><i class="fab fa-accessible-icon "></i>Employment</a></li>
							</ul>
						</li>
						<li><a href="contact_us.php"><i class="fas fa-phone-volume "></i>Contact Us</a></li>
						<li><a href="#"><i class="fas fa-question icon_style"></i>Help & Support</a></li>
						<?php
							$sql="SELECT * FROM tbl_page";
							$result=$db->select($sql);
							if($result!=false)
							{
								while($row=$result->fetch_assoc())
								{?>
									<li><a href="pages.php?id=<?php echo $row['id'];?>"><i class="fas fa-square icon_style"></i><?php echo $row["name"]?></a></li>
								<?php }
							}
						?>
					  </ul>
				</div>
				<button class="openbtn" onclick="openNav()" ><i class="fas fa-bars"></i>Menu</button>  
			</div>
			<div id="logo"> 
				<a href="index.php"> 
					<?php
						$query="SELECT * FROM title_slogan WHERE id=1";
						$result=$db->select($query);
						if($result!="false")
						{
							$row=$result->fetch_assoc();
					?>
					<img src="admin/upload/<?php echo $row['logo'];?>" alt="Logo" class="logo_icon"/>
					<span class="heading"><?php echo $row['title'];?></span><br>
					<span class="title"><?php echo $row['slogan'];?></span>
					<?php
						}
					?>
				</a>
			</div>
			<div class="signin_login"> 
				<form action="search_details.php" method="get" style="float:left;">
					<input type="text" name="search" placeholder="Search here.." class="search_bar" id="input_search"/>
					<button class="search"><i class="fas fa-search"></i></button>
				</form>
				<div class="show_search_result" id="div1">
				</div>
				<?php
					session::init();
					$check=session::get("login_user");
					if(!$check==false)
					{ ?>
						<div class="dropdown">
								<button onclick="myFunction()" class="dropbtn"><i class="fas fa-user"></i><?php echo session::get('user_name'); ?></button>
								<div id="myDropdown" class="dropdown-content">
										<a href="profile.php"><i class="far fa-user"></i>Profile</a>
										<a href="manage_adds.php"><i class="fas fa-ad"></i>Manage Adds</a>
										<a href="logout.php?logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
								</div>
						</div>
					<?php 
					}
					else{ ?>
						<a href="signup.php"><button class="signin" title="sigin">Signin</button></a>
						<a href="login.php"><button class="login" title="login">Login</button></a>
				<?php }
				?>
			</div>
		</div><!-- Menu section end -->
<script>
	/* When the user clicks on the button,
	toggle between hiding and showing the dropdown content */
	function myFunction() {
		document.getElementById("myDropdown").classList.toggle("show");
	}

	// Close the dropdown if the user clicks outside of it
	window.onclick = function(event) {
		if (!event.target.matches('.dropbtn')) {
			var dropdowns = document.getElementsByClassName("dropdown-content");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
				var openDropdown = dropdowns[i];
				if (openDropdown.classList.contains('show')) {
					openDropdown.classList.remove('show');
				}
			}
		}
	}
</script>