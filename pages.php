<?php
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
    }else{
        header("Location: 404.php");
    }
?>
<?php include "inc/header.php";?>
<style>
    .page_wrapper {
        width: 750px;
        margin: 100px auto;
    }
    .page_wrapper .title {
        font-family: arial;
        font-size: 23px;
        background: #c60000;
        padding: 8px;
        padding-left: 33px;
        box-shadow: 0px 2px 7px #777;
        margin-bottom: 31px;
        color: white;
        text-shadow: 5px 2px 12px black;
    }
    .page_wrapper .body {
        font-family: alef;
        text-align: justify;
        font-size: 21px;
        color: #5e0053;
    }
</style>
<div class="page_wrapper">
    <?php
        $sql="SELECT * FROM tbl_page WHERE id='$id'";
        $result=$db->select($sql)->fetch_assoc();
    ?>
    <p class="title"><?php echo $result['title'];?></p>
    <div class="body"><?php echo $result['body'];?></div>
</div>
<?php include "inc/footer.php";?>