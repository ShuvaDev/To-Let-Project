<?php require "inc/header.php"; ?>
<?php require "inc/sidebar.php"; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Theme</h2>
        <div class="block copyblock"> 
        <?php
            if(isset($_POST['submit']))
            {
                $theme=$_POST['theme'];
                $sql="UPDATE tbl_theme SET theme='$theme' WHERE id='1'";
                $update_post=$db->update($sql);
                if($update_post=="true")
                {
                    echo "<span class='success'>Theme updated successfully!</span>";
                }else{
                    "<span class='error'>Theme updated failed!</span>";
                }
            }// check submit if end
        ?>
        <?php 
            $query="SELECT * FROM tbl_theme;";
            $result=$db->select($query);
            if($result)
            {
                while($cat=$result->fetch_assoc())
                {
        ?>
        <form action="" method="post">
            <table class="form">
                <tr>
                    <td>
                        <input <?php if($cat['theme']=="default"){echo "checked";} ?> type="radio" name="theme" value="default">Default<br>
                        <input <?php if($cat['theme']=="orange"){echo "checked";} ?> type="radio" name="theme" value="orange">Orange<br>
                        <input <?php if($cat['theme']=="green"){echo "checked";} ?> type="radio" name="theme" value="green">Green<br>
                        <input <?php if($cat['theme']=="magenta"){echo "checked";} ?> type="radio" name="theme" value="magenta">Magenta
                    </td>
                </tr>	
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Change" />
                    </td>
                </tr>
            </table>
        </form>

        <?php
                }
            }
        ?>
            
        </div>
    </div>
</div>
<div class="clear"></div>
</div>
    <?php include "inc/footer.php"; ?>