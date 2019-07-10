<?php
    if(isset($_GET['search']))
    {
        $search_key=$_GET['search'];
    }else{
        header("Location: 404.php");
    }
?>
<?php
    $per_page=4;
	if(isset($_GET['page']))
	{
		$page=$_GET['page'];
	}else{
		$page=1;
	}
	$start_form=($page-1)*$per_page;
?>
<?php include "inc/header.php";?>
<?php
    $search_key=htmlspecialchars($search_key);
    $search_key=trim($search_key);
    $search_key=stripslashes($search_key);
    $search_key=mysqli_real_escape_string($db->link,$search_key);
?>
<link rel="stylesheet" href="css/advertisement.css";>
<div class="advertisement_wrapper" style="width: 910px;">

    <div class="advertisement">
    <span style="padding-left: 15px;margin-bottom: 20px;display: block;font-family: alef;color: #c40b0b;font-size: 25px;text-shadow: 2px 2px 2px #6d7762;">Search Result:</span><br>
        <?php
            $query="SELECT * FROM tbl_post WHERE title LIKE '%$search_key%' OR address LIKE '%$search_key%' OR price LIKE '%$search_key%' ";
            $result=$db->select($query);
            if($result!=false)
            {
                while($row=$result->fetch_assoc())
                {
        ?>
                    <div class="category">
                        <a href="advertisement_details.php?id=<?php echo $row['id'];?>" class="cat_wrapper">
                            <?php
                                $post_random_num=$row['random_num'];
                                $query2="SELECT * FROM tbl_image WHERE img_random_num='$post_random_num'";
                                $result2=$db->select($query2);
                                $row2=$result2->fetch_assoc();
                            ?>
                            <img src="admin/upload/<?php echo $row2['post_image'] ?>" alt="" class="cat_img">
                            <?php
                                $cat=$row['cat'];
                                $query1="SELECT cat_name FROM tbl_category WHERE cat_id='$cat'";
                                $cat_name=$db->select($query1);
                                if($cat_name!=false)
                                { 
                                    $category_name=$cat_name->fetch_assoc();
                                ?>
                                    <p class="cat_name"><?php echo  $category_name['cat_name'];?></p>
                            <?php    
                                }
                            ?>
                            
                            <p class="date"><i class="far fa-clock"></i><?php echo $fm->formatDate($row['date']);?></p>
                            <p class="location"><i class="fas fa-map-marker-alt"></i><?php echo $row['address'];?></p>
                            <p class="price">BDT <?php echo $row['price'];?></p>
                            <p class="details"><?php echo $fm->textShorten($row['short_details'],80);?></p>
                        </a>
                    </div>
        <?php
                }
            }
            else{
                echo "<span style='color:red;font-family:arial;font-size:22px;'>No Data Found!</span>";
            }
        ?>
    </div>
</div>
<?php include "inc/footer.php";?>