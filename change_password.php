
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
    .email{
        float: right;
        margin-top: -25px;
        width: 458px;
    }
    .p_submit {
        width: 81px;
        height: 37px;
        margin-left: 169px;
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
		$old_password=$fm->validation($_POST['old_password']);
		$new_password=$fm->validation($_POST['n_password']);
		$confirm_password=$fm->validation($_POST['c_password']);
		$old_password=mysqli_real_escape_string($db->link,$old_password);
		$new_password=mysqli_real_escape_string($db->link,$new_password);
		$confirm_password=mysqli_real_escape_string($db->link,$confirm_password);
        $error="";
        if($old_password=="" || $new_password=="" || $new_password=="")
        {
            $error="Field name must not be empty!";
        }
        else{
            $old_password=md5($old_password);
            $query="SELECT * FROM tbl_user WHERE password='$old_password' AND id='$user_id'";
            $result=$db->select($query);
            if($result==false)
            {
                $error="Please enter correct old password!";
            }elseif(strlen($old_password)<5)
            {
                $error="You must be give 6 character password!";
            }elseif($confirm_password!=$new_password)
            {
                $error="New password and confirm password not match!";
            }
            else{
                $new_password=md5($new_password);
                $query="UPDATE tbl_user SET password='$new_password' WHERE id='$user_id'";
                $result=$db->update($query);
                if($result!=false)
                {
                    echo "<script>window.location='logout.php?logout';</script>";
                }else{
                    $error="Password updated failed!";
                }
            }
        }
    }?>
    <p class="contact_header">Change Password :</p>
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
        <label for="Old Password">Old Password</label>
        <input type="password" name="old_password" placeholder="Enter your old password.." class="email"><br>
        <label for="New Password">New Password</label>
        <input type="password" name="n_password" placeholder="Enter your new password.." class="email"><br>
        <label for="Confirm Password">Confirm Password</label>
        <input type="password" name="c_password" placeholder="Enter your confirm password.." class="email"><br>
        <input type="submit" name="submit" value="Update" class="p_submit">
    </form>
    
</div>
<?php require "inc/footer.php"; ?>