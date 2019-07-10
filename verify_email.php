<style> 
    body{
        background:black;
    }
    a{
        text-decoration: none;
        color: white;
        background: #00a3ff;
        font-size: 25px;
        padding: 5px 28px;
        border-radius: 3px;
        border: 1px dashed;
        margin-left: 279px;
        float: left;
        margin-top: 50px;
    }
    span{
        color: white;
        font-family: arial;
        font-size: 55px;
        margin-left: 283px;
        float: left;
        margin-top: 188px;
    }
</style>
<?php
    include "lib/Database.php";
    $db=new database();
    if(isset($_GET['vkey']))
    {
        $vkey=$_GET['vkey'];
        $sql="SELECT * FROM tbl_user WHERE verified=0 AND vkey='$vkey' LIMIT 1";
        $result=$db->select($sql);
        if($result)
        {
            if($result->num_rows>0)
            {
                $sql="UPDATE tbl_user SET verified=1 WHERE vkey='$vkey' LIMIT 1";
                $result=$db->update($sql);
                if($result=="true")
                {
                    header("Location: login.php");
                }
            }
        }else{
            echo "<span>This account already verified.<br>
            <a href='login.php'>Login</a>
            </span>";
        }

    }else{
        
    }

?>