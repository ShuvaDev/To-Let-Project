<?php
    include "inc/header.php";
    include "inc/sidebar.php";
    $fm=new format();
    $db=new Database();
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Contact Info</h2>
                <div class="block copyblock"> 
                <?php
                if(isset($_POST['submit']))
                {
                    $phone_1=$fm->validation($_POST['phone_1']); 
                    $phone_2=$fm->validation($_POST['phone_2']); 
                    $email=$fm->validation($_POST['email']); 
                    if($phone_1 == "" || $phone_2=="" || $email==""){
                        echo "<span class='error'>Field must not be empty!</span>";
                    }
                    else{
                        $sql="UPDATE tbl_contact_info SET phone_1='$phone_1', phone_2='$phone_2', email='$email' WHERE id='1'";
                        $update_social=$db->update($sql);
                        if($update_social=="true")
                        {
                            echo "<span class='success'>Data updated successfully!</span>";
                        }else{
                            "<span class='error'>Data failed!</span>";
                        }
                    }
                }
                ?> 
                <?PHP
                    $query="SELECT * FROM tbl_contact_info";
                    $result=$db->select($query);
                    if($result)
                    {
                        $data=$result->fetch_assoc();
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                Mobile Number1:
                            </td>
                            <td>
                                <input type="text" value="<?php  echo $data['phone_1'] ?>" name="phone_1" class="large" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mobile Number2:
                            </td>
                            <td>
                                <input type="text" value="<?php  echo $data['phone_2'] ?>" name="phone_2" class="large" />
                            </td>
                        </tr>
						<tr>
                            <td>
                                Email:
                            </td>
                            <td>
                                <input type="email" value="<?php  echo $data['email'] ?>" name="email" class="large" />
                            </td>
                        </tr>
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php  }
                 ?>
                </div>
            </div>
        </div>
        <?php
    include "inc/footer.php";
?>