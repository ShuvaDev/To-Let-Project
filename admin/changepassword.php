<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
<?php
    $id=session::get('admin_id');
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Change Password</h2>
                <div class="block">     
                    <?php
                        if(isset($_POST['submit']))
                        {
                            $old_password=$_POST['o_pass'];
                            $new_password=$_POST['n_pass'];
                            $old_password=md5($old_password);
                            $sql="SELECT * FROM tbl_admin WHERE password='$old_password' AND id='$id'";
                            if(($db->select($sql))=="false")
                            {
                                echo "<span class='error'>Please enter correct old password!</span>";
                            }else{
                                $new_password=md5($new_password);
                                $sql="UPDATE tbl_admin SET password='$new_password' WHERE password='$old_password' AND id='$id'";
                                if($db->update($sql)==true)
                                {
                                    echo "<span class='success'>Password changed successfully!</span>";
                                }
                                else{
                                    echo "<span class='error'>Password changed failed!</span>";
                                }
                                
                            }
                        }
                    ?>
                 <form method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Old Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter Old Password..."  name="o_pass" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>New Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter New Password..." name="n_pass" class="medium" />
                            </td>
                        </tr>
						 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <?php
    include "inc/footer.php";
?>