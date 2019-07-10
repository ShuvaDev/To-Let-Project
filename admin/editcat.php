<?php require "inc/header.php"; ?>
<?php require "inc/sidebar.php"; ?>
<?php
    if(isset($_GET['cat_id']))
    {
        $cat_id=$_GET['cat_id'];
    }else{
        //header("Location: catlist.php");
        echo "<script>window.location = 'catlist.php';</script>";
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category</h2>
        <div class="block copyblock"> 
        <?php
            if(isset($_POST['submit']))
            {
                $cat_name=mysqli_real_escape_string($db->link,$_POST['cat_name']);
                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['file']['name'];
                $file_size = $_FILES['file']['size'];
                $file_temp = $_FILES['file']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "upload/".$unique_image;
                if($cat_name == ""){
                    echo "<span class='error'>Field must not be empty!</span>";
                }
                else{
                    if(!empty($file_name))
                    {
                        if ($file_size >2048567) {
                            echo "<span class='error'>Image Size should be less then 2MB!</span>";
                        
                        } elseif (in_array($file_ext, $permited) !=1) {
                            echo "<span class='error'>You can upload only:-"
                            .implode(', ', $permited)."</span>";
                        } 
                        else{
                            move_uploaded_file($file_temp, $uploaded_image);
                            $sql="UPDATE tbl_category SET cat_name='$cat_name', cat_image='$unique_image' WHERE id='$cat_id'";
                            $update_cat=$db->update($sql);
                            if($update_cat=="true")
                            {
                                echo "<span class='success'>Category updated successfully!</span>";
                            }else{
                                "<span class='error'>Category updated failed!</span>";
                            }
                        }
                    }// file name empty checker if
                    else{
                        $sql="UPDATE tbl_category SET cat_name='$cat_name' WHERE id='$cat_id'";
                        $update_post=$db->update($sql);
                        if($update_post=="true")
                        {
                            echo "<span class='success'>Post updated successfully!</span>";
                        }else{
                            "<span class='error'>Post updated failed!</span>";
                        }
                    }
                }// else (if not empty all file)
            }// check submit if end
        ?>
        <?php 
            $query="SELECT * FROM tbl_category WHERE id='$cat_id' order by id desc";
            $result=$db->select($query);
            if($result)
            {
                while($cat=$result->fetch_assoc())
                {
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="form">	
                <tr>
                    <td>
                        <label>Category Name :</label>
                    </td>
                </tr>				
                <tr>
                    <td>
                        <input type="text" value="<?php echo $cat['cat_name']; ?>" class="medium" name="cat_name"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Category Image :</label>
                    </td>
                </tr>				
                <tr>
                    <td>
                        <input type="file" class="medium" name="file"/>
                        <img src="upload/<?php echo $cat['cat_image']; ?>" style="width: 100px;height: 80px;float:right;margin-right: 40px;margin-top: -32px;"/>
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
        </form>

        <?php
                }
            }else{
                echo "<script>window.location = '../404.php';</script>";
            }
        ?>
            
        </div>
    </div>
</div>
<div class="clear"></div>
</div>
    <?php include "inc/footer.php"; ?>