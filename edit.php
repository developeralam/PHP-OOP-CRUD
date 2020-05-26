<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/inc/header.php';
	include_once $filepath.'/lib/Database.php';
	$db = new Database();
	$msg = '';
	//Fetch Data
	$id = $_GET['id'];
	$query= "SELECT * FROM tbl_user WHERE id=$id LIMIT 1";
	$getData = $db->select($query)->fetch_assoc();

	//Update Data
	if ($_SERVER['REQUEST_METHOD']== 'POST') {
		$name = mysqli_real_escape_string($db->link, $_POST['name']);
		$email = mysqli_real_escape_string($db->link, $_POST['email']);
		$skill = mysqli_real_escape_string($db->link, $_POST['skill']);
		if (empty($name) or empty($email) or empty($skill)) {
			$msg = '<div class="alert alert-danger">Field Must Not Be Empty</div>';
			echo $msg;
		}else{
			$query = "UPDATE tbl_user
					SET
					name= '$name',
					email = '$email',
					skill = '$skill'
					WHERE id = $id";
			$update = $db->update($query);
		}
	}
	if(isset($msg)){
		$msg;
	}
?>	
<div class="card card-header" style="overflow: hidden;">
	<h2>Edit User
		<a href="index.php" class="float-right btn btn-primray">back</a>
	</h2>
</div>
<div class="card-body">
	<form action="" method="post">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" value="<?php echo $getData['name'];?>" name="name">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" class="form-control" value="<?php echo $getData['email'] ?>" name="email">
		</div>
		<div class="form-group">
			<label for="skill">Skill</label>
			<input type="text" class="form-control" value="<?php echo $getData['skill'] ?>" name="skill">
		</div>
		<input type="submit" class="btn btn-success" value="Update">
	</form>
</div>
	

<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/inc/footer.php';
?>			