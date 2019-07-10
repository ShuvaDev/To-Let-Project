
<?php
    require "inc/header.php";
    if(session::get('login_user')!=true)
    {
        header("Location: 404.php");
    }
?>
<?php
    if(isset($_GET['delpostid']))
    {
        $delpostid=$_GET['delpostid'];
        $sql="DELETE FROM `tbl_post` WHERE id='$delpostid'";
        $result=$db->delete($sql);
    }
?>
<style>
    .manage_ad{
        width:800px;
        margin:20px auto;
        margin-bottom: 400px;
    }
    .poster {
        background: #f9f9f9;
        padding: 37px 0px;
        border: 1px solid #dbdbdb;
        border-radius: 4px;
    }
    .post_p1,.post_p2{
        text-align: center;
    }
    .post_p1 {
        font-family: alef;
        font-size: 26px;
        margin-bottom: 7px;
    }
    .post_p2 {
        font-family: arial;
    }
    .post_header {
        font-family: arial;
        margin-left: 83px;
        margin-top: 25px;
        font-size: 20px;
    }
    .total_ad {
        background: #373737;
        color: white;
        padding: 3px;
        border-radius: 100% 100% 100% 100%;
        padding-right: 8px;
        margin-left: 8px;
    }
    .ad {
        border: 1px solid #d7d7d7;
        width: 569px;
        margin-left: 83px;
        margin-top: 19px;
        border-radius: 2px;
    }
    .post_title {
        padding-left: 17px;
        padding-top: 12px;
        padding-bottom: 4px;
        font-family: arial;
        font-size: 16px;
    }
    .post_date {
        padding-left: 15px;
        padding-bottom: 23px;
        padding-top: 6px;
        font-family: calibri;
    }
    .post_edit {
        text-decoration: none;
        color: white;
        background: #3c3a3a;
        padding: 6px 51px;
        font-family: calibri;
        border-radius: 4px;
        border: 1px solid black;
        margin-left: 106px;
        margin-top: 5px;
    }
    .post_delete {
        background: red;
        padding: 6px 51px;
        border-radius: 4px;
        border: 1px solid #f90e0e;
        text-decoration: none;
        font-family: calibri;
        color: white;
        margin-left: 15px;
    }
</style>
<?php   
    $user_id=session::get('user_id');
    $sql="SELECT * FROM tbl_post WHERE user_id='$user_id' AND status='0'";
    $result=$db->select($sql);
    if($result!=false)
    {
        $total_post=mysqli_num_rows($result);
    }
?>
<div class="manage_ad">
    <div class="poster">
        <p class="post_p1">Manage Your Advertisements</p>
        <p class="post_p2">You have posted <?php if(isset($total_post)){echo $total_post;}else{echo "0";} ?> Advertisements</p>
    </div>
    <p class="post_header">My Advertisements<span class="total_ad"> <?php if(isset($total_post)){echo $total_post;}else{echo "0";} ?></span></p>
    <?php
        if($result!=false)
        {
            while($row=$result->fetch_assoc())
            {
    ?>
    <div class="ad">
        <p class="post_title"><?php echo $row['title']; ?></p>
        <P class="post_date"><b>
        <?php
            $cat=$row['cat'];
            $query="SELECT cat_name FROM tbl_category WHERE id='$cat' LIMIT 1";
            $cat_name=$db->select($query)->fetch_assoc();
            echo $cat_name['cat_name'];
        ?>
        : </b><?php echo $fm->formatDate($row['date']); ?></P>
        <p style="border-bottom: 1px solid #d7d7d7;"></p>
        <a href="editpost.php?editpostid=<?php echo $row['id'];?>" class="post_edit"><i class="far fa-edit"></i>Edit</a>
        <a href="?delpostid=<?php echo $row['id'];?>" class="post_delete" onclick="return confirm('Are you sure to delete this post?')"><i class="fas fa-trash-alt"></i>Delete</a>
    </div>
    <?php
            }
        }
    ?>
</div>

<?php
    require "inc/footer.php";
?>