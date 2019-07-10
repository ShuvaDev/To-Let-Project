<?php
    include "inc/header.php";
    include "inc/sidebar.php";
    $db=new Database();
    $fm=new format();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Post</h2>
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
                    $sql="INSERT INTO tbl_page(title, body,name) VALUES ('$title', '$body','$name')";
                    $post=$db->insert($sql);
                    if($post=="true")
                    {
                        echo "<span class='success'>Page created successfully!</span>";
                    }else{
                        "<span class='error'>Page created failed!</span>";
                    }
                }
            }// check submit if end
        ?>
        <div class="block">               
            <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter page name..." class="medium" name="name"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Post Title..." class="medium" name="title"/>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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
