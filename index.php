
<?php
	include "inc/header.php";
?>
		<?php
			$query="SELECT * FROM tbl_social WHERE id=1";
			$result=$db->select($query);
			if($result!="false")
			{
				$social=$result->fetch_assoc();
		?>
		<ul id="social_area">

			<li><a href="<?php echo $social['facebook'];  ?>"><img src="img/facebook.png" alt="Facebook Share" /></a></li>
			<li><a href="<?php echo $social['google_plus'];  ?>"><img src="img/gplus.png" alt="Google Plus Share" /></a></li>
			<li><a href="<?php echo $social['linkedin'];  ?>"><img src="img/linkedin.png" alt="Linked in Share" /></a></li>
			<li><a href="<?php echo $social['youtube'];  ?>"><img src="img/youtube.png" alt="Youtube Share" /></a></li>
			<li><a href="<?php echo $social['twitter'];  ?>"><img src="img/twitter.png" alt="Twitter Share" /></a></li>
		</ul>
		<?php
			}
		?>
		
		<div class="main_body"> <!-- body section start -->
			<?php
				$msg=session::get('msg');
				if(isset($msg))
				{
					echo "<span style='color: #0a0;font-family: alef;font-size: 22px;width: 100%;float: left;margin-bottom: 16px;'>$msg</span>";
				}
				session::set('msg',NULL);
			?>
			<div class="post"> 
				<a href="cat_list.php"><img src="img/post.png" alt="" /><span>Post Your Ads</span></a>
			</div>
			<div class="house_section"> <!-- start house section -->
				<p class="house_header">House</p>
				<?php
					$sql="SELECT * FROM tbl_category WHERE cat_id=1";
					$result=$db->select($sql);
					if($result)
					{
						while($cat=$result->fetch_assoc())
						{
				?>
				<div class="mess"> 
					<a href="advertisements.php?cat_id=<?php echo $cat['id'] ?>" title="Find House">
						<img src="admin/upload/<?php echo $cat['cat_image'] ?>" alt="" />
						<hr>
						<h3><?php echo $cat['cat_name'] ?></h3>
					</a>
				</div>
				<?php
						}// End loop
					}// End if statement
					else{
						echo "No category available!";
					}
				?>
			</div><!-- End house section div  -->
			
			<div class="car_section"><!--- Start car section -->
				<p>RENT-A-CAR</p>
				<?php
					$sql="SELECT * FROM tbl_category WHERE cat_id=2";
					$result=$db->select($sql);
					if($result)
					{
						while($cat=$result->fetch_assoc())
						{
				?>
				<div class="mess"> 
					<a href="advertisements.php?cat_id=<?php echo $cat['id'] ?>" title="Rent-A-Car">
						<img src="admin/upload/<?php echo $cat['cat_image'] ?>" alt="" />
						<hr>
						<h3><?php echo $cat['cat_name'] ?></h3>
					</a>
				</div>
				<?php
						}// End loop
					}// End if statement
					else{
						echo "No category available!";
					}
				?>
			</div><!-- End car section -->
			
			<div class="employment_section"> <!-- Start employment_section -->
				<p>EMPLOYMENT</p>
					<?php
						$sql="SELECT * FROM tbl_category WHERE cat_id=3";
						$result=$db->select($sql);
						if($result)
						{
							while($cat=$result->fetch_assoc())
							{
					?>
					<div class="mess"> 
						<a href="advertisements.php?cat_id=<?php echo $cat['id'] ?>" title="Rent-A-Car">
							<img src="admin/upload/<?php echo $cat['cat_image'] ?>" alt="" />
							<hr>
							<h3><?php echo $cat['cat_name'] ?></h3>
						</a>
					</div>
					<?php
							}// End loop
						}// End if statement
						else{
							echo "No category available!";
						}
					?>
			</div><!-- End employment_section -->
			
		</div><!-- body section end -->
		<?php
			include "inc/footer.php";
		?>