<?php

//add_comment.php

$connect = new PDO('mysql:host=localhost;dbname=to-let', 'root', '');
$post_id=$_POST['post_id'];
$error = '';
$comment_name = '';
$comment_content = '';

if(empty($_POST["comment_name"]))
{
 $error .= '<p class="text-danger">Name is required</p>';
}
else
{
 $comment_name = $_POST["comment_name"];
}

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}

if($error == '')
{
 $query = "
 INSERT INTO tbl_comment 
 (parent_comment_id, comment, comment_sender_name,post_id) 
 VALUES (:parent_comment_id, :comment, :comment_sender_name, :post_id)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':parent_comment_id' => $_POST["comment_id"],
   ':comment'    => $comment_content,
   ':post_id'    => $post_id,
   ':comment_sender_name' => $comment_name
  )
 );
 $error = '<label class="text-success" style="font-family: alef;color: #068206;margin-left: 67px;display: block;margin-top: 11px;">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>