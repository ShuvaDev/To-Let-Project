<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
<?php
    $userid=session::get('admin_id');
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Profile</h2>
                <?php
                    if(isset($_POST['submit']))
                    {
                        $name=mysqli_real_escape_string($db->link,$_POST['name']);
                        $username=mysqli_real_escape_string($db->link,$_POST['uname']);
                        $email=mysqli_real_escape_string($db->link,$_POST['email']);
                        $m_number=mysqli_real_escape_string($db->link,$_POST['m_number']);
                        $sql="UPDATE tbl_admin SET name='$name', username='$username', email='$email', mobile_number='$m_number' WHERE id='$userid'";
                        $update_post=$db->update($sql);
                        if($update_post=="true")
                        {
                            echo "<span class='success'>Profile updated successfully!</span>";
                        }else{
                            "<span class='error'>Profile updated failed!</span>";
                        }
                    }// check submit if end
                ?>
                <div class="block">   
                <?php
                    $sql="SELECT * FROM tbl_admin WHERE id='$userid'";
                    $result=$db->select($sql);
                    if($result)
                    {
                        $post_result=$result->fetch_assoc();
                        
                ?>            
                 <form action="" method="post">
                    <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" class="medium" name="name" value="<?php echo $post_result['name'] ?>" />
                        </td>
                    </tr>
                        <tr>
                            <td>
                                <label>User Name</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $post_result['username'] ?>" class="medium" name="uname"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $post_result['email'] ?>" class="medium" name="email"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Mobile Number</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $post_result['mobile_number'] ?>" class="medium" name="m_number"/>
                            </td>
                        </tr>
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                        }
                    ?>
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
