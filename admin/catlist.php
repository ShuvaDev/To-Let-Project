<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
        <div class="grid_10">
            <div class="box round first grid">
				<h2>Category List</h2>
				<?php
					if(isset($_GET['delcat_id']))
					{
						$delcat_id=$_GET['delcat_id'];
						$sql="DELETE FROM tbl_category WHERE id='$delcat_id'";
						$result=$db->delete($sql);
						if($result=="true")
                            {
                                echo "<span class='success'>Category Deleted successfully!</span>";
                            }else{
								echo "<span class='error'>Category deleted failed!</span>";
							}
					}
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Category Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query="SELECT * FROM tbl_category";
							$category=$db->select($query);
							if($category)
							{
								$i=0;
								while($cat=$category->fetch_assoc())
								{
									$i++;
						?>
							<tr class="odd gradeX">
								<td><?php echo $i;?></td>
								<td><?php echo $cat['cat_name'] ?></td>
								<td><img src="upload/<?php echo $cat['cat_image'] ?>" style="width: 50px;height: 50px;"></td>
								<td><a href="editcat.php?cat_id=<?php echo $cat['id'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete!')" href="?delcat_id=<?php echo $cat['id'] ?>">Delete</a></td>
							</tr>
						<?php
								}// end loop
							}//end if
							else{

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
