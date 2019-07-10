<?php
    include "inc/header.php";
    include "inc/sidebar.php";
    $fm=new format();
    $db=new Database();
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock"> 
                <?php
                if(isset($_POST['submit']))
                {
                    $note=$fm->validation($_POST['note']); 
                    $note=mysqli_real_escape_string($db->link,$note); 
                    if($note == ""){
                        echo "<span class='error'>Field must not be empty!</span>";
                    }
                    else{
                        $sql="UPDATE tbl_footer SET text='$note' WHERE id='1'";
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
                    $query="SELECT * FROM tbl_footer";
                    $result=$db->select($query);
                    if($result)
                    {
                        $data=$result->fetch_assoc();
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php  echo $data['text'] ?>" name="note" class="large" />
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