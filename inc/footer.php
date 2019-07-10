<div class="fotter_section"> 
			<div class="fotter_wrapper"> 
				<div class="left_section"> 
					<h4>Quick Link</h4>
					<hr>
					<a href="#"><p>About Us</p></a>
					<a href="#"><p>Contact Us</p></a>
					<a href="#"><p>Privacy Policy</p></a>
					<a href="#"><p>Terms & Condition</p></a>
				</div>
				<div class="middle_section"> 
					<h4>Help & Support</h4>
					<hr>
					<a href="#"><p>Faq</p></a>
					<a href="#"><p>Helps</p></a>
					<a href="#"><p>Careers</p></a>
				</div>
				<div class="right_section"> 
					<h4>Social Links</h4>
					<hr>
					<br><br>
					<?php
						$query="SELECT * FROM tbl_social WHERE id=1";
						$result=$db->select($query);
						if($result!="false")
						{
							$social=$result->fetch_assoc();
					?>
					<a href="<?php echo $social['facebook'];  ?>"><i class="fab fa-facebook"></i></a>
					<a href="<?php echo $social['google_plus'];  ?>"><i class="fab fa-google-plus"></i></a>
					<a href="<?php echo $social['linkedin'];  ?>"><i class="fab fa-linkedin"></i></a>
					<a href="<?php echo $social['youtube'];  ?>"><i class="fab fa-youtube-square"></i></a>
					<a href="<?php echo $social['twitter'];  ?>"><i class="fab fa-twitter-square"></i></a>
					<?php
						}
					?>
				</div>
				<div class="copyright"> 
				<?php
					$query="SELECT * FROM tbl_footer WHERE id=1";
					$result=$db->select($query);
					if($result!="false")
					{
						$footer=$result->fetch_assoc();
				?>
					<p>&copy; <?php echo $footer['text']." ".date("Y");?></p>
				<?php
					}
				?>
				</div>
			</div>
		</div>
		
	</div>
	<div class="scrolltotop">
		<script src="js/scrolltotop.js"></script>
	</div>
	<script>
		function openNav() {
		  document.getElementById("mySidepanel").style.width = "345px";
		  document.getElementById("mySidepanel").style.height = "450px";
		}

		function closeNav() {
		  document.getElementById("mySidepanel").style.width = "0";
		}
	</script>
</body>
</html>