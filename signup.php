<?php
    include "lib/user.php";
    $user=new user();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Signup</title>
    <link rel="stylesheet" type="text/css" href="css/signup_login.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
    <h1>User Registration</h1>
    <?php
        
        if(isset($_POST['submit']))
        {
            $msg=$user->user_registration($_POST);
            echo $msg;
        }
    ?>
		<form action="" method="post">
			<div>
				<input type="text" placeholder="Name" required="" name="name"/>
			</div>
			<div>
				<input type="text" placeholder="E-mail Address" required="" name="email"/>
			</div>
			<div>
				<input type="text" placeholder="Phone Number" required="" name="m_number"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="password" placeholder="Confirm Password" required="" name="c_password"/>
			</div>
			<div>
				<input type="submit" value="Register" name="submit"/>
			</div>
		</form><!-- form -->
		<div class="button">
			
			<a href="login.php">Already has account? Click here to Login</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>