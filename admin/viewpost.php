<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
<?php
    if(isset($_GET['viewid']))
    {
        $viewid=$_GET['viewid'];
    }else{
        //header("Location: catlist.php");
        echo "<script>window.location = 'postlist.php';</script>";
    }
?>
<?php
    if(isset($_POST['submit']))
    {
        echo "<script>window.location = 'postlist.php';</script>";
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Post</h2>
                <div class="block">   
                <?php
                    $sql="SELECT * FROM tbl_post WHERE id=$viewid";
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
                                <input type="text" readonly value="<?php echo $post_result['title'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Month</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $post_result['month'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Price</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $post_result['price'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Address</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $post_result['address'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                 <?php echo $post_result['short_details'] ?>
                                </textarea>
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
