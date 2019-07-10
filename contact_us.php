<?php
    require "inc/header.php";
?>
<link rel="stylesheet" href="css/contact_us.css"/>;
<div class="contact_us">
    <?php
    if(isset($_POST['submit']))
	{
		$firstname=$fm->validation($_POST['fname']);
		$lastname=$fm->validation($_POST['lname']);
		$email=$fm->validation($_POST['email']);
		$body=$fm->validation($_POST['message']);
		$firstname=mysqli_real_escape_string($db->link,$firstname);
		$lastname=mysqli_real_escape_string($db->link,$lastname);
		$email=mysqli_real_escape_string($db->link,$email);
		$body=mysqli_real_escape_string($db->link,$body);
		$error="";
		if(empty($firstname))
		{
			$error="First name must not be empty!";
		}elseif(empty($lastname))
		{
			$error="Last name must not be empty!";
		}
		elseif(empty($email))
		{
			$error="Email must not be empty!";
		}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$error="Invalid email address!";
		}else{
			$query="INSERT INTO tbl_contact(firstname,lastname,email,body)VALUES('$firstname','$lastname','$email','$body')";
			$result=$db->insert($query);
			if($result!=false)
			{
				$msg="Message sent successfully!";
			}else{
				$error="Message not sent!";
			}
		}
    }?>
    <p class="contact_header">Contact Us Form :</p>
    <?php if(isset($error))
    {
        echo "<span style='color:red;font-family:arial;font-size:18px;'>$error</span>";
    }
    if(isset($msg))
    {
        echo "<span style='color:green;font-family:arial;font-size:18px;'>$msg</span>";
    }
    ?>
    <form action="" method="post">
        
        <label for="name">First Name</label>
        <input type="text" name="fname" placeholder="Enter your first name" class="name"><br>
        <label for="name">Last Name</label>
        <input type="text" name="lname" placeholder="Enter your last name" class="name"><br>
        <label for="email">E-mail</label>
        <input type="email" name="email" placeholder="Email address" class="email"><br>
        
        <label for="area_name">Message</label>
        <textarea name="message" placeholder="Message" name="message" class="area"></textarea>
        
        <input type="submit" name="submit" value="Send" class="p_submit">
    </form>
</div>



<?php require "inc/footer.php"; ?>