<?php include "inc/header.php"; ?>
<?php
    if(session::get('login_user')!=true)
    {
        header("Location: index.php");
    }
?>
<link rel="stylesheet" href="css/cat_list.css"/>
<div class="category">
    <div class="houses_category">
        <p>House</p> 
        <?php
            $sql="SELECT * FROM tbl_category WHERE cat_id=1";
            $result=$db->select($sql);
            if($result)
            {
                while($cat=$result->fetch_assoc())
                {
		?>
        <a href="post_adds_form.php?cat_id=<?php echo $cat['id']?>">
            <div class="all_cat_style">
                <img src="admin/upload/<?php echo $cat['cat_image']?>" alt="">
                <span><?php echo $cat['cat_name'] ?></span><br>
            </div>
         </a>
         <?php
                }// loop end here    
            }// if statement end here
            else{
                echo "No category available!";
            }
         ?>
    </div>
    <div class="employment">
        <p>Employment</p> 
        <?php
            $sql="SELECT * FROM tbl_category WHERE cat_id=2";
            $result=$db->select($sql);
            if($result)
            {
                while($cat=$result->fetch_assoc())
                {
        ?>
        <a href="post_adds_form.php?cat_id=<?php echo $cat['id']?>">
            <div class="all_cat_style">
                <img src="admin/upload/<?php echo $cat['cat_image']?>" alt="">
                <span><?php echo $cat['cat_name'] ?></span><br>
            </div>
         </a>
         <?php
                }// loop end here    
            }// if statement end here
            else{
                echo "No category available!";
            }
         ?>
    </div>
    <div class="rent_a_car">
    <p>Rent-A-Car</p> 
        <?php
            $sql="SELECT * FROM tbl_category WHERE cat_id=3";
            $result=$db->select($sql);
            if($result)
            {
                while($cat=$result->fetch_assoc())
                {
        ?>
        <a href="post_adds_form.php?cat_id=<?php echo $cat['id']?>">
            <div class="all_cat_style">
                <img src="admin/upload/<?php echo $cat['cat_image']?>" alt="">
                <span><?php echo $cat['cat_name'] ?></span><br>
            </div>
         </a>
         <?php
                }// loop end here    
            }// if statement end here
            else{
                echo "No category available!";
            }
         ?>
    </div>
</div>
<?php include "inc/footer.php"; ?>