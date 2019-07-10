<?php
	include "../lib/session.php";
	session::init();
?>
<?php
require "../config/config.php";
	require "../lib/Database.php";
	require "../helpers/format.php";
?>
<?php
	$db=new Database();
	$format=new format();

?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if(isset($_POST['submit']))
			{
				$username=$format->validation($_POST['username']);
				$password=$format->validation(md5($_POST['password']));
				$username=mysqli_real_escape_string($db->link,$username);
				$password=mysqli_real_escape_string($db->link,$password);
				$query="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
				$result=$db->select($query);
				if($result)
				{
					$value=mysqli_fetch_array($result);
					$row=$result->num_rows;
					if($row>0)
					{
						session::set("login_admin","true");
						session::set("admin_username",$value['username']);
						session::set("admin_id",$value['id']);
						header("Location: index.php");
					}else{
						echo "<span style='color:red;font-size:18px;'>No Result Found</span>";
					}
				}else{
					echo "<span style='color:red;font-size:18px;'>Username or Password not matched!</span>";
				}
			}
		?>
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" name="submit"/>
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">House Rent</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>