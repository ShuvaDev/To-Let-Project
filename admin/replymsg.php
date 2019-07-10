<?php
    include "inc/header.php";
    include "inc/sidebar.php";
    require "../php_mailer/PHPMailerAutoload.php";
    $db=new Database();
    $fm=new format();
?>
<?php
    if(isset($_GET['msgid']))
    {
        $msgid=$_GET['msgid'];
    }else{
        //header("Location: catlist.php");
        echo "<script>window.location = 'inbox.php';</script>";
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View Message</h2>
        <div class="block">     
            <?php
                if(isset($_POST['submit']))
                {
                    $to=$_POST['toEmail'];
                    $subject=$_POST['subject'];
                    $body=$_POST['message'];
                    $mail = new PHPMailer;
            
                    $mail->isSMTP();            
                    $mail->Host = 'smtp.gmail.com';  
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;           
                    $mail->SMTPSecure = 'tls';                      
                    $mail->Username = 'allsuportstolet@gmail.com';     
                    $mail->Password = '123456789tolet';   
                
                    $mail->setFrom('allsuportstolet@gmail.com', 'To-Let');
                    $mail->addAddress($to);
                    $mail->addReplyTo('allsuportstolet@gmail.com');
                    
                    $mail->isHTML(true);      
                    $mail->Subject = $subject;
                    $mail->Body    =$body;
                    if(!$mail->send()) {
                        echo '<span class="error">Message could not be sent.</span>';
                    } else {
                        echo "<span class='success'>Message sent successfully!</span>";
                    }
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <?php
                    $query="SELECT * FROM tbl_contact WHERE id=$msgid";
                    $result=$db->select($query);
                    if($result)
                    {
                        while($row=$result->fetch_assoc())
                        {
				?>
                <tr>
                    <td>
                        <label>To</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row['email']?>" readonly class="medium" name="toEmail"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Subject</label>
                    </td>
                    <td>
                    <input type="text" placeholder="Please enter your subject" class="medium" name="subject"/>
                    </td>
                </tr>
        
                <tr>
                    <td>
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea  name="message" cols="62" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Send" />
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
            </form>
        </div>
    </div>
</div>
        <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
        <?php
         include "inc/footer.php";
        ?>
