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
    if(isset($_GET['delpage']))
    {
        $delpage=$_GET['delpage'];
    }else{
        //header("Location: catlist.php");
        echo "<script>window.location = '404.php';</script>";
    }
    $query="DELETE FROM tbl_page WHERE id='$delpage'";
    $result=$db->delete($query);
    if($result=="true")
    {
        echo "<script>alert('Page deleted successfully!')</script>";
        echo "<script>window.location='addpage.php';</script>";
    }
    else{
        echo "<script>alert('Page deleted failed!')</script>";
        echo "<script>window.location='addpage.php';</script>";
    }
?>
<?php

?>