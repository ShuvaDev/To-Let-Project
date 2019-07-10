<?php
    include "inc/header.php";
    include "inc/sidebar.php";
    $db=new database();
    $fm=new format();
?>
<style>
    .left_side{
        float:left;
        width:70%;
    }
    .right_side{
        float:left;
        width:20%;
    }
    .right_side img{
        height:160px;
        width:170px;
    }
</style>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <div class="block sloginblock">  
                <div class="left_side">
                    <?php
                        if(isset($_POST['submit']))
                        {
                            $title=$fm->validation($_POST['title']);
                            $slogan=$fm->validation($_POST['slogan']);
                            $title=mysqli_real_escape_string($db->link,$title);
                            $slogan=mysqli_real_escape_string($db->link,$slogan);
                            $permited  = array('jpg', 'jpeg', 'png', 'gif');
                            $file_name = $_FILES['logo']['name'];
                            $file_size = $_FILES['logo']['size'];
                            $file_temp = $_FILES['logo']['tmp_name'];

                            $div = explode('.', $file_name);
                            $file_ext = strtolower(end($div));
                            $same_image = 'logo'.'.'.$file_ext;
                            $uploaded_image = "upload/".$same_image;
                            if($title == "" || $slogan == ""){
                                echo "<span class='error'>Field must not be empty!</span>";
                            }
                            else{
                                if(!empty($file_name))
                                {
                                    if ($file_size >2048567) {
                                        echo "<span class='error'>Image Size should be less then 2MB!</span>";
                                    
                                    } elseif (in_array($file_ext, $permited) === false) {
                                        echo "<span class='error'>You can upload only:-"
                                        .implode(', ', $permited)."</span>";
                                    } 
                                    else{
                                        move_uploaded_file($file_temp, $uploaded_image);
                                        $sql="UPDATE title_slogan SET title='$title', slogan='$slogan', logo='$same_image' WHERE id='1'";
                                        $update_post=$db->update($sql);
                                        if($update_post=="true")
                                        {
                                            echo "<span class='success'>Data updated successfully!</span>";
                                        }else{
                                            "<span class='error'>Data updated failed!</span>";
                                        }
                                    }
                                }// file name empty checker if
                                else{
                                    $sql="UPDATE title_slogan SET title='$title', slogan='$slogan' WHERE id='1'";
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
                    <?PHP
                        $query="SELECT * FROM title_slogan";
                        $result=$db->select($query);
                        if($result)
                        {
                            $data=$result->fetch_assoc();
                        }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">					
                            <tr>
                                <td>
                                    <label>Website Title</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $data['title'] ?>" name="title" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Website Slogan</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $data['slogan'] ?>" name="slogan" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Upload Logo</label>
                                </td>
                                <td>
                                    <input type="file" name="logo"/>
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
                    </div><!--Left side -->
                    <div class="right_side">
                        <img src="upload/<?php echo $data['logo'];?>" alt="">
                    </div>
                </div>
            </div>
        </div>
        <?php
    include "inc/footer.php";
    ?>