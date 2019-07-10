<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <?php
                    if(isset($_POST['submit']))
                    {
                        $title=$_POST['title'];
                        $total_image=count($_FILES['upload']['name']);
                        $cat_id=$_POST['cat_name'];
                        $month=$_POST['month'];
                        $price=$_POST['price'];
                        $address=$_POST['address'];
                        $short_details=$_POST['short_details'];
                        // Sanitization
                        $title=mysqli_real_escape_string($db->link,$title);
                        $month=mysqli_real_escape_string($db->link,$month);
                        $price=mysqli_real_escape_string($db->link,$price);
                        $address=mysqli_real_escape_string($db->link,$address);
                        $short_details=mysqli_real_escape_string($db->link,$short_details);
                        if($cat_id=="")
                        {
                            echo "<div class='error'><b>Error! </b>Category name must not be empty!</div><br>";
                        }
                        elseif($total_image>5)
                        {
                            echo "<div class='error'><b>Error! </b>You give only 5 files!</div><br>";
                        }
                        elseif(strlen($short_details)<10)
                        {
                            echo "<div class='error'><b>Error! </b>You must be give 10 character!</div><br>";
                        }
                        else{
                            $msg=img_manupulation($_FILES);
                        }
                    }
                    if(isset($msg))
                    {
                        echo $msg;
                    }
                ?>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Post Title..." class="medium" name="title" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Select Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat_name">
                                    <option>Select Category</option>
                                    <option style="font-weight:bold;color:white;background:black;" disabled>House</option>
                                    <?php 
                                        $query="SELECT * FROM tbl_category WHERE cat_id=1";
                                        $result=$db->select($query);
                                        if($result)
                                        {
                                            while($row=$result->fetch_assoc())
                                            {
                                    ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['cat_name'];?></option>
                                    <?php      }
                                        }
                                    ?>
                                    <option style="font-weight:bold;color:white;background:black;" disabled>Rent-A-Car</option>
                                    <?php 
                                        $query="SELECT * FROM tbl_category WHERE cat_id=2";
                                        $result=$db->select($query);
                                        if($result)
                                        {
                                            while($row=$result->fetch_assoc())
                                            {
                                    ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['cat_name'];?></option>
                                    <?php      }
                                        }
                                    ?>
                                    <option style="font-weight:bold;color:white;background:black;" disabled>Employment</option>
                                    <?php 
                                        $query="SELECT * FROM tbl_category WHERE cat_id=3";
                                        $result=$db->select($query);
                                        if($result)
                                        {
                                            while($row=$result->fetch_assoc())
                                            {
                                    ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['cat_name'];?></option>
                                    <?php      }
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input name="upload[]" type="file" multiple="multiple" required/><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Month</label>
                            </td>
                            <td>
                                <select name="month" class="month" required>
                                    <option>Select A Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Price</label>
                            </td>
                            <td>
                                <input type="number" name="price" placeholder="Price(Tk)" class="rent" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Address</label>
                            </td>
                            <td>
                                <input type="text" name="address" placeholder="Enter your full address" class="address" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Short Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="short_details"></textarea>
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
<?php
    function img_manupulation($data)
    {
        $db=new database();
        $user_id=session::get('admin_id');
        $random_num=substr(md5(time()), 0, 8);
        $permitted  = array('jpg', 'jpeg', 'png', 'gif');
        for($i=0;$i<count($data['upload']['name']);$i++)
        {
            $file_name=$data['upload']['name'][$i];
            $file_size=$data['upload']['size'][$i];
            $file_temp=$data['upload']['tmp_name'][$i];
            $div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).$file_name;
			$uploaded_image = "upload/".$unique_image;
            if ($file_size >2048567) {
                $msg= "<div class='error'>Image Size should be less then 2MB!</div><br>";
                return $msg;
            } elseif (in_array($file_ext, $permitted) !=1) {
                $msg= "<div class='error'>You can upload only:-"
                .implode(', ', $permitted)."</div><br>";
                return $msg;
            } 
            else{
                move_uploaded_file($file_temp, $uploaded_image);
                $sql="INSERT INTO tbl_image(img_random_num,user_id,post_image) VALUES('$random_num','$user_id','$unique_image')";
                $result=$db->insert($sql);
                if($result==false)
                {
                    $msg="<div class='error'>Image uploaded failed!</div>";
                    return $msg;
                }
            }
        }
        global $title,$month,$price,$address,$short_details,$cat_id;
        $sql="INSERT INTO tbl_post(cat,user_id,title,month,price,address,short_details,random_num,status) VALUES('$cat_id','$user_id','$title','$month','$price','$address','$short_details','$random_num','1')";
        $result=$db->insert($sql);
        if($result==true)
        {
            $msg="<div class='success'>Post inserted successfully!</div>";
            return $msg;
            
        }else{
            $msg="<div class='error'>Post inserted failed!</div>";
            return $msg;
        }
    }
?>
