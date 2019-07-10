<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
<?php
    if(isset($_GET['user_id']))
    {
        $user_id=$_GET['user_id'];
    }else{
        //header("Location: catlist.php");
        echo "<script>window.location = 'userlist.php';</script>";
    }
?>
<?php
    if(isset($_POST['submit']))
    {
        echo "<script>window.location = 'userlist.php';</script>";
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User Details</h2>
                <div class="block">   
                <?php
                    $sql="SELECT * FROM tbl_admin WHERE id=$user_id";
                    $result=$db->select($sql);
                    if($result)
                    {
                        while($post_result=$result->fetch_assoc())
                        {
                ?>            
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $post_result['name'] ?>" class="medium" name="name" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User Name</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $post_result['username'] ?>" class="medium" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $post_result['email'] ?>" class="medium" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Mobile Number</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $post_result['mobile_number'] ?>" class="medium" readonly/>
                            </td>
                        </tr>
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <?php
         include "inc/footer.php";
        ?>
