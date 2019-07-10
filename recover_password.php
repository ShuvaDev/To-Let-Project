<?php
    if(isset($_GET['vkey']))
    {
        $vkey=$_GET['vkey'];
    }else{
        header("Location: 404.php");
    }
?>

<?php
    require "lib/Database.php";
    $db= new database();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/signup_login.css" media="screen" />
    <style>
        #content form input[type="password"]{
	        padding: 0 7px 5px 20px;
        }
    </style>
</head>
<body>
<div class="container">
	<section id="content">
    <h1>Recover Password</h1>
    <?php
        
        if(isset($_POST['submit']))
        {
            echo $password=mysqli_real_escape_string($db->link,$_POST['password']);
            echo $cpassword=mysqli_real_escape_string($db->link,$_POST['cpassword']);
            if(strlen($password)<5)
            {
                echo "<span class='error'>Password must be give 6 character!</span>";
            }
            elseif($password!=$cpassword)
            {
                echo "<span class='error'>Password and confirm password does not match!</span>";
            }
            else{
                $password=md5($password);
                $query="UPDATE tbl_user SET password='$password' WHERE vkey='$vkey'";
                $result=$db->update($query);
                if($result==false)
                {
                    echo "<span class='error'>Password update failed!</span>";
                }else{
                    header("Location: login.php");
                }
            }
            
            
        }
    ?>
		<form action="" method="post">
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
            </div>
            <div>
				<input type="password" placeholder="Confirm Password" required="" name="cpassword"/>
			</div>
			<div>
				<input type="submit" value="Reset" name="submit"/>
			</div>
		</form><!-- form -->
		<div class="button">
			
			<a href="signup.php">Not have a account? Click here to Registration.</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>