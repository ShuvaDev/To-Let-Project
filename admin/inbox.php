<?php
    include "inc/header.php";
	include "inc/sidebar.php";
?>
<?php
	if(isset($_GET['seenid']))
	{
		$seenid=$_GET['seenid'];
		$sql="UPDATE tbl_contact
		SET status = 1
		WHERE id='$seenid'"; 
		$update_row=$db->update($sql);
		if(($update_row == "true"))
		{
			echo "<span class='success'>Message moved successfully!</span>";
		}else{
			echo "<span class='error'>Message moved failed!</span>";
		}
	}?>
	

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query="SELECT * FROM tbl_contact WHERE status='0'";
							$result=$db->select($query);
							$i=0;
							if($result)
							{
								while($row=$result->fetch_assoc())
								{
									$i++;
						?>
						<tr class="odd gradeX">
							<th><?php echo $i?></th>
							<th><?php echo $row['firstname']." ".$row['lastname']?></th>
							<th><?php echo $row['email']?></th>
							<th><?php echo $format->textShorten($row['body'],30)?></th>
							<th><?php echo $format->formatDate($row['date'])?></th>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $row['id']; ?>">View</a> || 
								<a href="replymsg.php?msgid=<?php echo $row['id']; ?>">Reply</a> || 
								<a href="?seenid=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure to move the message?')" >Seen</a> 
							</td>
						</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
               </div>
			</div>
			<div class="box round first grid">
				<h2>Seen Message</h2>
				<?php
					if(isset($_GET['delmsg']))
					{
						$delcat_id=$_GET['delmsg'];
						$sql="DELETE FROM tbl_contact WHERE id='$delcat_id'";
						$result=$db->delete($sql);
						if($result=="true")
							{
								echo "<span class='success'>Message Deleted successfully!</span>";
							}else{
								echo "<span class='error'>Message deleted failed!</span>";
							}
					}
				?>
                <div class="block">        
				<table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query="SELECT * FROM tbl_contact WHERE status='1'";
							$result=$db->select($query);
							$i=0;
							if($result)
							{
								while($row=$result->fetch_assoc())
								{
									$i++;
						?>
						<tr class="odd gradeX">
							<th><?php echo $i?></th>
							<th><?php echo $row['firstname']." ".$row['lastname']?></th>
							<th><?php echo $row['email']?></th>
							<th><?php echo $format->textShorten($row['body'],30)?></th>
							<th><?php echo $format->formatDate($row['date'])?></th>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $row['id']; ?>">View</a> ||
								<a href="?delmsg=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure to delete this message?')">Delete</a>
							</td>
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
        <?php
    include "inc/footer.php";
?>
