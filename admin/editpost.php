<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
<?php
    if(isset($_GET['editid']))
    {
        $editid=$_GET['editid'];
    }else{
        //header("Location: catlist.php");
        echo "<script>window.location = 'postlist.php';</script>";
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Post</h2>
                <?php
                    if(isset($_POST['submit']))
                    {
                        $title=mysqli_real_escape_string($db->link,$_POST['title']);
                        $month=mysqli_real_escape_string($db->link,$_POST['month']);
                        $price=mysqli_real_escape_string($db->link,$_POST['price']);
                        $address=mysqli_real_escape_string($db->link,$_POST['address']);
                        $short_details=mysqli_real_escape_string($db->link,$_POST['short_details']);
                        if($title=="" || $month=="" || $price=="" || $address=="" || $short_details=="")
                        {
                            echo "<span class='error'>Field name must not be empty!</span>";
                        }elseif(strlen($short_details)<5){
                            echo "<span class='error'>Short details is too short!</span>";
                        }
                        else{
                            $sql="UPDATE tbl_post SET title='$title', month='$month', price='$price', address='$address', short_details='$short_details' WHERE id='$editid'";
                            $update_post=$db->update($sql);
                            if($update_post=="true")
                            {
                                echo "<span class='success'>Post updated successfully!</span>";
                            }else{
                                "<span class='error'>Post updated failed!</span>";
                            }
                            }
                        }// else (if not empty all file)
                ?>
                <div class="block">   
                <?php
                    $sql="SELECT * FROM tbl_post WHERE id=$editid";
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
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text"  value="<?php echo $post_result['title'] ?>" class="medium" name="title"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Month</label>
                            </td>
                            <td>
                                <input type="text"  value="<?php echo $post_result['month'] ?>" class="medium" name="month"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Price</label>
                            </td>
                            <td>
                                <input type="text"  value="<?php echo $post_result['price'] ?>" class="medium" name="price"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Address</label>
                            </td>
                            <td>
                                <input type="text"  value="<?php echo $post_result['address'] ?>" class="medium" name="address"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="short_details">
                                 <?php echo $post_result['short_details'] ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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
