<?php
    if(isset($_GET['cat_id']))
    {
        $cat_id=$_GET['cat_id'];
    }else{
        header("Location: 404.php");
    }
?>
<?php include "inc/header.php";?>
<?php
    if(session::get('user_id')!=true)
    {
        header("Location: index.php");
    }
?>
<style>
.error {
    background: #f8d7da;
    color: #722a40;
    padding: 9px;
    font-size: 17px;
    margin-bottom: 11px;
    width: 91%;
    margin-left: 4px;
    border: 1px solid #f5c7cb;
    border-radius: 5px;
    text-align: left;
    margin-top: 30px;
}.success {
	background: #d6ffdc;
	color: #63a478;
	padding: 9px;
	font-size: 19px;
	margin-bottom: 11px;
	width: 91%;
	margin-left: 4px;
	border: 1px solid #acffc7;
	border-radius: 5px;
	text-align: left;
	margin-top: 30px;
}
</style>
<link href="file_upload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="file_upload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<script src="file_upload/js/jquery.filer.min.js"></script>
<link rel="stylesheet" href="css/post_adds_form.css">


<div class="post_add_form_contain">
    <?php include "inc/sidebar.php";?>
    <div class="right_sidebar">
            <div class="top_poster">
                <?php
                    $query="SELECT * FROM tbl_category WHERE id=$cat_id";
                    $result=$db->select($query);
                    if($result)
                    {
                        $row=$result->fetch_assoc();
                ?>
                <p><img src="admin/upload/<?php echo  $row['cat_image'] ?>" alt="">
                <span><?php echo  $row['cat_name'] ?></span></p>
                <?php 
                    }
                ?>
            </div>
            <?php
                if(isset($_POST['submit']))
                {
                    $title=$_POST['title'];
                    $total_image=count($_FILES['upload']['name']);
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

                    if($total_image>5)
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
            <form action="" method="post" enctype="multipart/form-data">
                <br><label for="title" class="title_label">Title</label>
                <input type="text" name="title" class="p_title" placeholder="Enter title for your advertisement" required><br>
                <label for="Photos">Photos</label>
                <input name="upload[]" type="file" multiple="multiple" id="filer_input" required/><br>
                <label for="month" class="month_label">Month</label>
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
                </select><br>
                <label for="rent" class="rent_label">Price</label>
                <input type="number" name="price" placeholder="Price(Tk)" class="rent" required><br>
                <label for="Address" class="address_label">Address</label>
                <input type="text" name="address" placeholder="Enter your full address" class="address" required><br>
                <label for="short_details" class="short_details_label">Short Details</label>
                <textarea name="short_details" placeholder="Write attractive description" class="short_details" required></textarea><br>

                
                <input type="reset" value="Reset" class="p_reset">
                <input type="submit" name="submit" value="Submit" class="p_submit">
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#filer_input').filer();       
    });
</script>
<?php include "inc/footer.php";?>
<?php
    function img_manupulation($data)
    {
        $db=new database();
        $user_id=session::get('user_id');
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
			$uploaded_image = "admin/upload/".$unique_image;
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
        $sql="INSERT INTO tbl_post(cat,user_id,title,month,price,address,short_details,random_num) VALUES('$cat_id','$user_id','$title','$month','$price','$address','$short_details','$random_num')";
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