<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">  
			<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="5%">No.</th>
					<th width="12%">Post Title</th>
					<th width="10%">Category</th>
					<th width="8%">Month</th>
					<th width="7%">Price</th>
					<th width="13%">Address</th>
					<th width="18%">Description</th>
					<th width="10%">Author</th>
					<th width="17%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query="SELECT tbl_post.*,tbl_category.cat_name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat=tbl_category.id";
					$result=$db->select($query);
					if($result)
					{
						$i=0;
						while($post=$result->fetch_assoc())
						{
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $post['title']; ?></td>
					<td><?php echo $post['cat_name']; ?></td>
					<td><?php echo $post['month']; ?></td>
					<td><?php echo $post['price']; ?></td>
					<td><?php echo $post['address']; ?></td>
					<td><?php echo $format->textShorten($post['short_details'],50); ?></td>
					<?php 
						$user_id=$post['user_id'];
						$status=$post['status'];
						if($status=="0")
						{
							$sql="SELECT name FROM tbl_user WHERE id='$user_id'";
							$user_name=$db->select($sql)->fetch_assoc();?>
							<td><?php echo $user_name['name']; ?></td>
						<?php }elseif($status=="1")
						{
							$sql="SELECT username FROM tbl_admin WHERE id='$user_id'";
							$user_name=$db->select($sql)->fetch_assoc();?>
							<td><?php echo $user_name['username']; ?></td>
						<?php }
					?>
					<td><a href="viewpost.php?viewid=<?php echo $post['id']; ?>">View</a> ||
					<a href="editpost.php?editid=<?php echo $post['id']; ?>">Edit</a> ||
					<a onclick="return confirm('Are you sure to delete!')" href="deletepost.php?deleteid=<?php echo $post['id']; ?>">Delete</a></td>
				</tr>
				<?php				
						}
					}
				?>
			</tbody>
		</table>

		</div>
	</div>
</div>
        
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
	</script>
	<?php include "inc/footer.php" ?>
