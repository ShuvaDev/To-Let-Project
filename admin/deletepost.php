<?php
    require "../lib/session.php";
	session::checksession();
?>
<?php
	require "../lib/Database.php";
    require "../helpers/format.php";
    $db=new Database();
?>
<?php
    if(isset($_GET['deleteid']))
    {
        $deleteid=$_GET['deleteid'];
    }else{
        //header("Location: catlist.php");
        echo "<script>window.location = '404.php';</script>";
    }
    $query="DELETE FROM tbl_post WHERE id='$deleteid'";
    $result=$db->delete($query);
    if($result=="true")
    {
        echo "<script>alert('Data deleted successfully!')</script>";
        echo "<script>window.location='postlist.php';</script>";
    }
    else{
        echo "<script>alert('Data deleted failed!')</script>";
        echo "<script>window.location='postlist.php';</script>";
    }
?>
<?php

?>