
<link rel="stylesheet" href="css/sidebar.css"/>
    <div class="left_sidebar">
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
            <a href="advertisements.php?cat_id=<?php echo $cat['id']?>">
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
            <a href="advertisements.php?cat_id=<?php echo $cat['id']?>">
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
            <a href="advertisements.php?cat_id=<?php echo $cat['id']?>">
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
    