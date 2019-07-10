<?php
    include "lib/Database.php";
    $db=new database();
    $search = $_POST['search'];
    $search=htmlspecialchars($search);
    $search=trim($search);
    $search=stripslashes($search);
    $search=mysqli_real_escape_string($db->link,$search);
    $sql="SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR address LIKE '%$search%' OR price LIKE '%$search%'";
    $result=$db->select($sql);
    if(!$result==false)
    {
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            { ?>
                <a href ="advertisement_details.php?id=<?php echo $row['id'];?>">
                    <?php
                        $post_random_num=$row['random_num'];
                        $query2="SELECT * FROM tbl_image WHERE img_random_num='$post_random_num'";
                        $result2=$db->select($query2);
                        $row2=$result2->fetch_assoc();
                    ?>
                    <img src="admin/upload/<?php echo $row2['post_image'] ?>">
                    <p class="title"><?php echo $row['title'] ?></p><br>
                    <p class="tk">BDT <?php echo $row['price'] ?></p>
                    <p class="location"><?php echo $row['address'] ?></p>
                </a>
           <?php
            }
        }
    }
    else{
        echo "<span style='padding-left:5px;font-family:arial;font-size:18px;'>Result Not Found!</span>";
    }
    
?>