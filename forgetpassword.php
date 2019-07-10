<?php
    include "lib/Database.php";
    require "php_mailer/PHPMailerAutoload.php";
    $db=new database();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/signup_login.css" media="screen" />
    <style>
        #content form input[type="text"]{
	        padding: 0 7px 5px 20px;
        }
        .error {
            background: #f8d7da;
            color: #722a40;
            float: left;
            padding: 9px;
            font-size: 17px;
            margin-bottom: 11px;
            width: 91%;
            margin-left: 4px;
            border: 1px solid #f5c7cb;
            border-radius: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="container">
	<section id="content">
    <h1>Reset Password</h1>
    <?php
        
        if(isset($_POST['submit']))
        {
            $email=$_POST['email'];
            $email=htmlspecialchars($email);
            $email=mysqli_real_escape_string($db->link,$email);
            $sql="SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
            $result=$db->select($sql)->fetch_assoc();
            if($result==false)
            {
                echo "<span class='error'>Email address not found!</span>";
            }
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
                echo "<span class='error'>Email address is not valid!</span>";
			}else{
                $mail = new PHPMailer;
            
                $mail->isSMTP();            
                $mail->Host = 'smtp.gmail.com';  
                $mail->Port = 587;
                $mail->SMTPAuth = true;           
                $mail->SMTPSecure = 'tls';                      
                $mail->Username = 'allsuportstolet@gmail.com';     
                $mail->Password = '123456789tolet';   
            
                $mail->setFrom('allsuportstolet@gmail.com', 'To-Let');
                $mail->addAddress($email);
                $mail->addReplyTo('allsuportstolet@gmail.com');
                
                $mail->isHTML(true);      
                $mail->Subject = 'To-Let Reset Password.';
                $mail->Body    ='<p style="color: #589b1a;font-family: alef;font-size: 21px;">To reset your password click reset password button:</p>'.'<br>'.'<a style="text-decoration: none; color: white;background: black;padding: 9px;float: left;margin-top: -11px;margin-left: 378px;" href="localhost/to-let/recover_password.php?vkey='.$result["vkey"].'">Reset Password</a>';
                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                } else {
                    header("Location: reset_message.php");
                }
            }
        }
    ?>
		<form action="" method="post">
			<div>
				<input type="text" placeholder="E-mail Address" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send" name="submit"/>
			</div>
		</form><!-- form -->
		<div class="button">
			
			<a href="signup.php">Not have a account? Click here to Registration.</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>