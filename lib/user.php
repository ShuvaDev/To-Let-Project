<style>
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


<?php
    include "Database.php";
    include "session.php";
    include "helpers/format.php";
    require "php_mailer/PHPMailerAutoload.php";
    class user
    {
        public $db;
        public function __construct()
        {
            $this->db=new database();
        }
        public function user_registration($data)
        {
            $name=$this->validation($data['name']);
            $email=$this->validation($data['email']);
            $m_number=$this->validation($data['m_number']);
            $password=$this->validation($data['password']);
            $c_password=$this->validation($data['c_password']);
            $name=mysqli_real_escape_string($this->db->link,$name);
            $email=mysqli_real_escape_string($this->db->link,$email);
            $password=mysqli_real_escape_string($this->db->link,$password);
            $c_password=mysqli_real_escape_string($this->db->link,$c_password);
            $v_key=md5(time().$name);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                $msg= "<span class='error'>Invalid email address!</span>";
                return $msg;
            }
            else if($this->check_email($email)==true)
            {
                $msg="<span class='error'>Email address already exits!</span>";
                return $msg;
            }
            else if ($this->validate_phone_number($m_number) == false) {
                $msg="<span class='error'>Invalid phone number!</span>";
                return $msg;
            }
            else if(strlen($password)<5)
            {
                $msg= "<span class='error'>Password must be give 6 character!</span>";
                return $msg;
            }
            else if($password!=$c_password)
            {
                $msg= "<span class='error'>Password and confirm password does not match!</span>";
                return $msg;
            }
            $password=md5($password);
			$sql="INSERT INTO tbl_user(name,email,mobile_number,password,vkey) VALUES('$name','$email','$m_number','$password','$v_key')";
			$result=$this->db->insert($sql);
			if($result=="true")
            {
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
                $mail->Subject = 'To-Let Email Verification.';
                $mail->Body    ='<p style="color: #589b1a;font-family: alef;font-size: 21px;">Thanks for registering with to-let. Please click this button to complete your registration:</p>'.'<br>'.'<a style="text-decoration: none; color: white;background: black;padding: 9px;float: left;margin-top: -11px;margin-left: 378px;" href="localhost/to-let/verify_email.php?vkey='.$v_key.'">Verify Email</a>';
                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                } else {
                    header("Location: verification_message.html");
                }
            }
            else{
                $msg="<span class='error'>Registration failed!</span>";
                return $msg;
            }
        }// user registration
        public function user_login($data)
		{
			$email=$data['email'];
			$password=$data['password'];
			$email_check=$this->check_email($email);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
                $msg="<span class='error'>Email address is not valid!!</span>";
				return $msg;
			}
			if($email_check==false)
			{
                $msg="<span class='error'>Email address not found!</span>";
				return $msg;
            }
            $password=md5($password);
            $check_reg=$this->getloginuser($email,$password);
            if(!$check_reg==false)
            {
                if($check_reg['verified']==0)
                {
                    $msg="<span class='error'>Please verify your email address!</span>";
				    return $msg;
                }
                else{
                    session::init();
                    session::set("login_user",true);
                    session::set("user_id",$check_reg['id']);
                    session::set("user_name",$check_reg['name']);
                    session::set("msg","<div>Welcome! You are successfully logged in.</div>");
                    header("Location: index.php");
                }
            }
            else{
                $msg="<span class='error'>Email address or password not match!</span>";
				return $msg;
            }
			
		}// user login


        public function check_email($email)
        {
            $sql="SELECT * FROM tbl_user WHERE email='$email'";
            $result=$this->db->select($sql);
            if($result)
            {
                if($result->num_rows>0)
                {
                    return true;
                }
                else{
                    return false;
                }
            }
        }
        function validate_phone_number($phone)
        {
             // Allow +, - and . in phone number
             $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
             // Remove "-" from number
             $phone_to_check = str_replace("-", "", $filtered_phone_number);
             // Check the lenght of number
             // This can be customized if you want phone number from a specific country
             if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
                return false;
             } else {
               return true;
             }
        }
        public function getloginuser($email,$password)
        {
            $sql="SELECT * FROM tbl_user WHERE email='$email' AND password='$password' LIMIT 1";
            $result=$this->db->select($sql);
            if($result)
            {
                $result=$result->fetch_assoc();
                return $result;
            }
            else{
                return false;
            }
            
        }
        public function validation($data)
        {
            $data=trim($data);
            $data=stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }
    }

?>