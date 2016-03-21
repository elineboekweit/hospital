<?php
	if ($_SERVER["REQUEST_METHOD"] == "GET"){
		if (isset($_GET['id'])){
			require "../conn/conn.php";
			$id = $db->escape_string($_GET['id']);
			$query = "SELECT list FROM species WHERE id=$id";
			$result = $db->query($query);
			$species = $result->fetch_assoc();

		}
		if ($species == null){
			http_response_code(404);
			include("../common/not_found.php");
			exit();
		}
	}
	elseif ($_SERVER["REQUEST_METHOD"] == "POST"){
		require "../conn/conn.php";

		$id = $db->escape_string($_POST['id']);
		$species = $db->escape_string($_POST['species']);
		$species = strip_tags($species);
		$query = "UPDATE species SET list='$species' WHERE id=$id";
		$result = $db->query($query);
		header("location: ./");
		exit();
	}
	include "../common/header.php";
	?>
	<h1>Edit species</h1>
	<form method="post">
		<input type="hidden" name="id" value="<?=$id?>">
		<label for="species">Species:</label>
		<input type="text" id="species" name="species" value="<?=$species['list']?>">
	
		<label></label>
		<input type="submit" value="Save">
	</form>
<?php
	include "../common/footer.php";
?>