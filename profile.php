
<?php
    require "inc/header.php";
?>
<?php
    if(session::get('login_user')==true)
    {
        $user_id=session::get('user_id');
    }else{
        header("Location: 404.php");
    }
?>
<link rel="stylesheet" href="css/contact_us.css"/>
<style>
    .phone_2 {
        float: right;
        margin-top: 15px;
        margin-left:0px;
    }
    .email, .name {
        margin-left: 96px;
    }
    .p_submit {
        width: 81px;
        height: 37px;
        margin-left: 156px;
        margin-top: 42px;
    }
    .c_pass {
        width: 148px;
        background: #00c7ff;
        margin-left: 0px;
        padding: 10px;
        font-family: arial;
    }
</style>
<div class="contact_us">
    <?php
    if(isset($_POST['submit']))
	{
		$name=$fm->validation($_POST['name']);
		$email=$fm->validation($_POST['email']);
		$mobile_number=$fm->validation($_POST['m_number']);
		$name=mysqli_real_escape_string($db->link,$name);
		$email=mysqli_real_escape_string($db->link,$email);
		$mobile_number=mysqli_real_escape_string($db->link,$mobile_number);
		$error="";
		if(empty($name))
		{
			$error="First name must not be empty!";
		}
		elseif(empty($email))
		{
			$error="Email must not be empty!";
		}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$error="Invalid email address!";
        }
        elseif(empty($mobile_number))
        {
            $error="Mobile number must not be empty!";
        }
        else{
			$query="UPDATE tbl_user SET name='$name', email='$email', mobile_number='$mobile_number' WHERE id='$user_id'";
			$result=$db->update($query);
			if($result!=false)
			{
				$msg="Profile updated successfully!";
			}else{
				$error="Profile updated failed!";
			}
		}
    }?>
    <p class="contact_header">Update Profile :</p>
    <?php if(isset($error))
    {
        echo "<span style='color:red;font-family:arial;font-size:18px;'>$error</span>";
    }
    if(isset($msg))
    {
        echo "<span style='color:green;font-family:arial;font-size:18px;'>$msg</span>";
    }
    ?>
    <?php
        $sql="SELECT * FROM tbl_user WHERE id='$user_id'";
        $result=$db->select($sql);
        if($result!=false)
        {
            $row=$result->fetch_assoc();
    ?>
    <form action="" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo $row['name'];?>" class="name"><br>
        <label for="email">E-mail</label>
        <input type="email" name="email" value="<?php echo $row['email'];?>" class="email"><br>
        <label for="email">Mobile Number</label>
        <input type="text" name="m_number" value="<?php echo $row['mobile_number'];?>"" class="phone_2"><br>
        <input type="submit" name="submit" value="Update" class="p_submit">
        <a href="change_password.php" style="text-decoration:none;" class="p_submit c_pass">Change Password</a>
    </form>
    <?php
        }
    ?>
    
</div>
<?php require "inc/footer.php"; ?>