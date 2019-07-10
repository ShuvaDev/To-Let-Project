<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock"> 
        <?php
            if(isset($_POST['submit']))
            {
                $name=$format->validation($_POST['name']);
                $username=$format->validation($_POST['username']);
                $email=$format->validation($_POST['email']);
                $mobile_number=$format->validation($_POST['m_number']);
                $password=$format->validation($_POST['password']);
                $name=mysqli_real_escape_string($db->link,$_POST['name']);
                $username=mysqli_real_escape_string($db->link,$_POST['username']);
                $email=mysqli_real_escape_string($db->link,$_POST['email']);
                $mobile_number=mysqli_real_escape_string($db->link,$_POST['m_number']);
                if(empty($name) || empty($username) || empty($email) || empty($mobile_number) || empty($password))
                {
                    echo "<span class='error'>Field must not be empty!</span>";
                }else{
                    $password=md5($password);
                    $query="INSERT INTO tbl_admin(name,username,password,email,mobile_number) VALUES('$name','$username','$password','$email','$mobile_number')";
                    $insert_cat=$db->insert($query);
                    if($insert_cat)
                    {
                        echo "<span class='success'>User created successfully!</span>";
                    }else{
                        echo "<span class='error'>User not created!</span>";
                    }
                }
            }
        ?>
            <form action="" method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter your name.." class="medium" name="name"/>
                    </td>
                </tr>					
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter your username.." class="medium" name="username"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Enter your email.." class="medium" name="email"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Mobile Number</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter your mobile number.." class="medium" name="m_number"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter your password.." class="medium" name="password"/>
                    </td>
                </tr>
                <tr> 
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Create" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<div class="clear">
</div>
    </div>
    <?php
    include "inc/footer.php";
    ?>