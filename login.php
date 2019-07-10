<?php
    include "lib/user.php";
    $user=new user();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/signup_login.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
    <h1>User Login</h1>
    <?php
        
        if(isset($_POST['submit']))
        {
            $msg=$user->user_login($_POST);
            echo $msg;
        }
    ?>
		<form action="" method="post">
			<div>
				<input type="text" placeholder="E-mail Address" required="" name="email"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Login" name="submit"/>
			</div>
		</form><!-- form -->
		<div class="button">
			
			<a href="signup.php">Not have a account? Click here to Registration.</a><br>
			<a href="forgetpassword.php">Forget Password?</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>