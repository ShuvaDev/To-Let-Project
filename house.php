<?php
    $per_page=6;
	if(isset($_GET['page']))
	{
		$page=$_GET['page'];
	}else{
		$page=1;
	}
	$start_form=($page-1)*$per_page;
?>

<?php include "inc/header.php";?>
<link rel="stylesheet" href="css/advertisement.css";>
<script>
  var elements = document.getElementsByClassName("cat_wrapper");
  var cat_img = document.getElementsByClassName("cat_img");
  var cat_price = document.getElementsByClassName("price");
  var i;
  // List View
  function listView() {
    for (i = 0; i < elements.length; i++) {
      elements[i].style.width = "75%";
      cat_img[i].style.float = "left";
      elements[i].style.height = "244px";
      elements[i].style.float = "right";
      cat_price[i].style.marginLeft = "527px";
    }
  }
  // Grid View
  function gridView() {
    for (i = 0; i < elements.length; i++) {
      elements[i].style.width = "264px";
      elements[i].style.height = "500px";
      elements[i].style.float = "left";
      cat_price[i].style.marginLeft = "78px";
    }
  }
</script>
<div class="advertisement_wrapper">
<?php include "inc/sidebar.php";?>
    <div id="btnContainer">
        <button class="btn" onclick="listView()"><i class="fa fa-bars"></i> List</button> 
        <button class="btn active" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
    </div>
    <div class="advertisement">
        <?php
            $query="SELECT tbl_post.*,tbl_category.cat_id FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat=tbl_category.id AND tbl_category.cat_id=1";
            $result=$db->select($query);
            if($result!=false)
            {
                $total_row=mysqli_num_rows($result);
            }
            $query="SELECT tbl_post.*,tbl_category.cat_id FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat=tbl_category.id AND tbl_category.cat_id=1 LIMIT $start_form, $per_page";
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
                                $query1="SELECT cat_name FROM tbl_category WHERE id='$cat'";
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
                echo "<span style='color:red;font-family:arial;font-size:22px;'>No Post Found!</span>";
            }
        ?>
    </div>
    <!-- Pagination -->
    <?php
            
                if($total_row>6)
                {
                    
        ?>
                <div class="pagination_wrapper">
                    <div class="pagination">
                        <?php
                            
                            $total_page=ceil($total_row/$per_page);
                            echo "<span class='pagination'><a href='?page=1'>".'First Page'."</a>";
                            for($i=1;$i<=$total_page;$i++)
                            {
                                echo "<a href='?page=$i'>"."$i"."</a>";
                            } 
                            echo "<a href='?page=$total_page'>".'Last Page'."</a></span>" ;
                        ?>
                    </div>
                </div>
        <?php 
                }
    ?>
</div>
<?php include "inc/footer.php";?>