<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/inc/header.php';
	include_once $filepath.'/lib/Database.php';
	$db = new Database();
?>	
<div class="card card-header">
	<h2>User List
		<a href="create.php" class="float-right btn btn-primray">Create</a>
	</h2>
</div>
<?php
	if ($_GET['msg']) {
		echo '<div class="alert alert-success mt-1">'.$_GET['msg'].'</div>';
	}
?>
	<table class="table table-striped">
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Email</th>
			<th>skill</th>
			<th>Action</th>
		</tr>
		<?php
			$query = "SELECT * FROM tbl_user";
			$read = $db->select($query);
			$read->fetch_assoc();
			if ($read) {
				foreach ($read as $data) {
		?>
		<tr>
			<td><?php echo $data['id']; ?></td>
			<td><?php echo $data['name']; ?></td>
			<td><?php echo $data['email']; ?></td>
			<td><?php echo $data['skill']; ?></td>
			<td><a class="btn btn-info" href="edit.php?id=<?php echo $data['id']; ?>">Edit</a></td>
		</tr>
		<?php
			}
			}else{
				echo "No Data Found";
			}
		?>
	</table>	

<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/inc/footer.php';
?>			