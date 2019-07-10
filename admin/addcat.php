<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
               <?php
                    if(isset($_POST['submit']))
                    {
                        $cat_name=mysqli_real_escape_string($db->link,$_POST['cat_name']);
                        $cat_id=$_POST['cat_id'];
                        $permited  = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = $_FILES['file']['name'];
                        $file_size = $_FILES['file']['size'];
                        $file_temp = $_FILES['file']['tmp_name'];

                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $uploaded_image = "upload/".$unique_image;
                        if($cat_name =="" || $file_name=="" ){
                            echo "<span class='error'>Field must not be empty!</span>";
                        }
                        else{
                            if ($file_size >2048567) {
                                echo "<span class='error'>Image Size should be less then 2MB!</span>";
                            
                            } elseif (in_array($file_ext, $permited) !=1) {
                                echo "<span class='error'>You can upload only:-"
                                .implode(', ', $permited)."</span>";
                            } 
                            else{
                                move_uploaded_file($file_temp, $uploaded_image);
                                $sql="INSERT INTO tbl_category(cat_name,cat_id,cat_image) VALUES('$cat_name','$cat_id','$unique_image')";
                                $insert_cat=$db->insert($sql);
                                if($insert_cat=="true")
                                {
                                    echo "<span class='success'>Category inserted successfully!</span>";
                                }else{
                                    "<span class='error'>Category inserted failed!</span>";
                                }
                            }
                        }// else (if not empty all file)
                    }// check submit if end
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
                                <input type="text" placeholder="Enter your category name.." class="medium" name="cat_name"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Select Category :</label>
                            </td>
                        </tr>				
                        <tr>
                            <td>
                                <select id="select" name="cat_id">
                                    <option value="1">House</option>
                                    <option value="2">Rent-A-Car</option>
                                    <option value="3">Employment</option>
                                </select>
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
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <?php
    include "inc/footer.php";
    ?>