<?php
    include "inc/header.php";
    include "inc/sidebar.php";
    $db=new Database();
    $fm=new format();
    if(isset($_GET['id']))
    {
        $pageid=$_GET['id'];
    }else{
        echo "<script>window.location='../404.php'</script>";
    }
?>
<style>
    .actiondel{
        margin-left: 10px;
    }
    .actiondel a{
        background: #f0f0f0;
        border:1px solid #ddd;
        color:#444;
        cursor:pointer;
        font-size:20px;
        font-weight: normal;
        padding:4px 10px;
    }
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Page Post</h2>
        <div class="block">   
        <?php
                    if(isset($_POST['submit']))
                    {
                        $name=mysqli_real_escape_string($db->link,$_POST['name']);
                        $title=mysqli_real_escape_string($db->link,$_POST['title']);
                    $body=mysqli_real_escape_string($db->link,$_POST['body']);
                    if($name == "" || $body == "" || $title==""){
                        echo "<span class='error'>Field must not be empty!</span>";
                    }
                    else{
                        $sql="UPDATE tbl_page SET name='$name', title='$title',body='$body' WHERE id='$pageid'";
                        $update_social=$db->update($sql);
                        if($update_social=="true")
                        {
                            echo "<span class='success'>Page updated successfully!</span>";
                        }else{
                            "<span class='error'>Page updated failed!</span>";
                        }
                    }
                }
                ?> 
        <?PHP
            $query="SELECT * FROM tbl_page WHERE id='$pageid'";
            $result=$db->select($query);
            if($result)
            {
                while($data=$result->fetch_assoc())
                {
        ?>            
            <form action="" method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $data['name'] ?>" class="medium" name="name"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $data['title'] ?>" class="medium" name="title"/>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            <?php echo $data['body']; ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                        <span class="actiondel"><a href="delpage.php?delpage=<?php echo $data['id'];  ?>">Delete </a></span>
                    </td>
                </tr>
            </table>
            </form>
            <?php } } ?>
        </div>
    </div>
</div>
        <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
        <?php
         include "inc/footer.php";
        ?>
