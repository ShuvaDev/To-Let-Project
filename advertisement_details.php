<?php
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
    }else{
        header("Location: 404.php");
    }
?>

<?php
    require "inc/header.php";
?>
<link rel="stylesheet" href="css/advertisement_details.css">
    <div class="house_add_details_wrapper">
        <div class="details">
            <?php
                $sql="SELECT * FROM tbl_post WHERE id=$id";
                $result=$db->select($sql);
                if($result!=false)
                {
                    $row=$result->fetch_assoc();
            ?>
            <p class="details-title"><?php echo $row['title'];?></p>
            
            <!---------Slider--------->
            <div class="slider">
                <div class="flexslider">
                    <ul class="slides">
                        <?php
                            $random_num=$row['random_num'];
                            $query1="SELECT * FROM tbl_image WHERE img_random_num='$random_num' LIMIT 4";
                            $result2=$db->select($query1);
                            if($result2!=false)
                            {
                                while($row2=$result2->fetch_assoc())
                                {
                        ?>
                                <li><img src="admin/upload/<?php echo $row2['post_image'] ?>" /></li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <!----------Slider End----------->
            <?php 
                $user_id=$row['user_id'];
                $status=$row['status'];
                if($status==0){
                $query="SELECT * FROM tbl_user WHERE id=$user_id";
                $result1=$db->select($query);
                if($result1!=false)
                {
                    $row1=$result1->fetch_assoc();
            ?>
            <div class="slider_right">
                <p class="add_name">Advertised by <?php echo $row1['name']; ?></p>
                <p class="contact">Contact</p>
                <p class="contact_name"><?php echo $row1['mobile_number']; ?></p>
                <p class="contact_name"><?php echo $row1['email']; ?></p>
            </div>
            <?php
                }
            }
            elseif($status=="1")
            {
                $query="SELECT * FROM tbl_admin WHERE id=$user_id";
                $result1=$db->select($query);
                if($result1!=false)
                {
                    $row1=$result1->fetch_assoc();
            ?>
                <div class="slider_right">
                    <p class="add_name">Advertised by <?php echo $row1['username']; ?></p>
                    <p class="contact">Contact</p>
                    <p class="contact_name"><?php echo $row1['mobile_number']; ?></p>
                    <p class="contact_name"><?php echo $row1['email']; ?></p>
                </div>
        <?php
                }
            }
            ?>
            <div id="short_details">
                <p id="d_title">TO-LET DETAILS</p>
                <p id="d_month">Month  :  <?php echo $row['month'];?></p>
                <p id="d_rent">Rent  :  BDT <?php echo $row['price'];?></p>
                <p id="d_address"> Address  :  <?php echo $row['address'];?></p>

            </div>
            <div class="address">
                <p><?php echo $fm->formatDate($row['date']);?></p>
                <p>1312 Views</p>
            </div>
            <div class="description">
                <p><b>Description : </b></p>
                <p><?php echo $row['short_details'];?></p>
            </div>
            <?php
                }
            ?>
        </div>
        <p style="color: #ac1010;font-family: arial;font-size: 19px;margin-left: 68px;margin-top: 40px;">Comment :</p>
        <div class="comment_box">
            <form method="POST" id="comment_form">
                <input type="text" name="comment_name" id="comment_name" placeholder="Enter Name" />
                <textarea name="comment_content" id="comment_content" placeholder="Enter Comment" rows="5"></textarea>
                <input type="hidden" name="comment_id" id="comment_id" value="0" />
                <input type="hidden" name="post_id" id="comment_id" value="<?php echo $id;?>" />
                <br><input type="submit" name="submit" id="submit" value="Submit" />
            </form>
            <span id="comment_message"></span>
            <br />
            <div id="display_comment"></div>
        </div>
    </div>
    <!-- jQuery -->
	
    <!-- FlexSlider js-->
    <script defer src="Flex-Slider/js/jquery.flexslider.js"></script>
    <!---Start-flax-slider-function-->
	<script>
            $(function(){
              SyntaxHighlighter.all();
            });
            $(window).load(function(){
              $('.flexslider').flexslider({
                animation: "slide",
                start: function(slider){
                  $('body').removeClass('loading');
                }
              });
            });
          </script>
    <!---End-flax-slider-function-->
    <!-- Comment script -->
    <script src="js/jquery.js"></script>
    <script>
        $(document).ready(function(){
        
        $('#comment_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
        url:"add_comment.php",
        method:"POST",
        data:form_data,
        dataType:"JSON",
        success:function(data)
        {
            if(data.error != '')
            {
            $('#comment_form')[0].reset();
            $('#comment_message').html(data.error);
            $('#comment_id').val('0');
            load_comment();
            }
        }
        })
        });

        load_comment();

        function load_comment()
        {
        $.ajax({
        url:"fetch_comment.php?id=<?php echo $id?>",
        method:"POST",
        success:function(data)
        {
            $('#display_comment').html(data);
        }
        })
        }

        $(document).on('click', '.reply', function(){
        var comment_id = $(this).attr("id");
        $('#comment_id').val(comment_id);
        $('#comment_name').focus();
        });
        
        });
    </script>
<?php require "inc/footer.php"; ?>