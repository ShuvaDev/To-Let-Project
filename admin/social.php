<?php
    include "inc/header.php";
    include "inc/sidebar.php";
    $db=new Database();
    $fm=new format();
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block">
                <?php
                if(isset($_POST['submit']))
                {
                    $facebook=$fm->validation($_POST['facebook']);
                    $google_plus=$fm->validation($_POST['google_plus']);
                    $linkedin=$fm->validation($_POST['linkedin']);
                    $youtube=$fm->validation($_POST['youtube']);
                    $twitter=$fm->validation($_POST['twitter']);
                    $facebook=mysqli_real_escape_string($db->link,$facebook);
                    $google_plus=mysqli_real_escape_string($db->link,$google_plus); 
                    $linkedin=mysqli_real_escape_string($db->link,$linkedin); 
                    $youtube=mysqli_real_escape_string($db->link,$youtube); 
                    $twitter=mysqli_real_escape_string($db->link,$twitter); 
                    if($facebook == "" || $google_plus == "" || $linkedin == "" || $youtube == "" || $twitter==""){
                        echo "<span class='error'>Field must not be empty!</span>";
                    }
                    else{
                        $sql="UPDATE tbl_social SET facebook='$facebook', google_plus='$google_plus', linkedin='$linkedin', youtube='$youtube', twitter='$twitter' WHERE id='1'";
                        $update_social=$db->update($sql);
                        if($update_social=="true")
                        {
                            echo "<span class='success'>Social link updated successfully!</span>";
                        }else{
                            "<span class='error'>Social link failed!</span>";
                        }
                    }
                }
                ?>    
                <?php
                    $query="SELECT * FROM tbl_social WHERE id='1'";
                    $result=$db->select($query);
                    if($result)
                    {
                        $social=$result->fetch_assoc();
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" value="<?php echo $social['facebook'];?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="google_plus" value="<?php echo $social['google_plus'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" value="<?php echo $social['linkedin'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Youtube</label>
                            </td>
                            <td>
                                <input type="text" name="youtube" value="<?php echo $social['youtube'];?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" value="<?php echo $social['twitter'];?>" class="medium" />
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
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    include "inc/footer.php";
?>
