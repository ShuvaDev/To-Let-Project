<?php
    if(isset($_GET['editpostid']))
    {
        $editpostid=$_GET['editpostid'];
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
<link rel="stylesheet" href="css/post_adds_form.css">
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
.top_poster span {
	font-family: alef;
	font-size: 26px;
}
.top_poster {
	border: 1px solid #dbdbdb;
	border-radius: 4px;
	text-align: center;
	height: 0;
	padding: 30px 24px;
	padding-bottom: 72px;
}
.right_sidebar {
	margin: 55px auto;
}
.p_submit{
    margin-left: 118px;
}
</style>

<div class="post_add_form_contain">
    <div class="right_sidebar">
            <div class="top_poster">
                <span>Update Advertisement</span></p>
            </div>
            <?php
                if(isset($_POST['submit']))
                {
                    $title=$_POST['title'];
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
                    if($title=="" || $month=="" || $price=="" || $address=="" || $short_details=="")
                    {
                        echo "<div class='error'>Field name must not be empty!</div>";
                    }
                    if(strlen($short_details)<10)
                    {
                        echo "<div class='error'><b>Error! </b>You must be give 10 character!</div><br>";
                    }
                    else{
                        $sql="UPDATE tbl_post SET title='$title', price='$price', month='$month', address='$address', short_details='$short_details' WHERE id='$editpostid'";
                        $result=$db->update($sql);
                        if($result==false)
                        {
                            echo "<div class='error'>Post updated failed!</div>";
                        }else{
                            echo "<div class='success'>Post updated successfully!</div>";
                        }
                    }
                }
            ?>
            <?php
                $sql="SELECT * FROM tbl_post WHERE id='$editpostid'";
                $result=$db->select($sql)->fetch_assoc();
            ?>
            <form action="" method="post">
                <br><label for="title" class="title_label">Title</label>
                <input type="text" name="title" class="p_title" value="<?php echo $result['title'];?>" required><br>
                <label for="month" class="month_label">Month</label>
                <select name="month" class="month" required>
                    <option>Select A Month</option>
                    <option value="January" <?php if($result['month']=="January"){echo "selected";} ?>>January</option>
                    <option value="February" <?php if($result['month']=="February"){echo "selected";} ?>>February</option>
                    <option value="March" <?php if($result['month']=="March"){echo "selected";} ?>>March</option>
                    <option value="April" <?php if($result['month']=="April"){echo "selected";} ?>>April</option>
                    <option value="May" <?php if($result['month']=="May"){echo "selected";} ?>>May</option>
                    <option value="June" <?php if($result['month']=="June"){echo "selected";} ?>>June</option>
                    <option value="July" <?php if($result['month']=="July"){echo "selected";} ?>>July</option>
                    <option value="August" <?php if($result['month']=="August"){echo "selected";} ?>>August</option>
                    <option value="September" <?php if($result['month']=="September"){echo "selected";} ?>>September</option>
                    <option value="October" <?php if($result['month']=="October"){echo "selected";} ?>>October</option>
                    <option value="November" <?php if($result['month']=="November"){echo "selected";} ?>>November</option>
                    <option value="December" <?php if($result['month']=="December"){echo "selected";} ?>>December</option>
                </select><br>
                <label for="rent" class="rent_label">Price</label>
                <input type="number" name="price" value="<?php echo $result['price'];?>" class="rent" required><br>
                <label for="Address" class="address_label">Address</label>
                <input type="text" name="address" value="<?php echo $result['address'];?>" class="address" required><br>
                <label for="short_details" class="short_details_label">Short Details</label>
                <textarea name="short_details" class="short_details" required><?php echo $result['short_details'];?></textarea><br>
                <input type="submit" name="submit" value="Update" class="p_submit">
            </form>
        </div>
    </div>
</div>
<?php include "inc/footer.php";?>