<?php
	if ($_SERVER["REQUEST_METHOD"] == "GET"):
		$patient = NULL;
		if (isset($_GET['id'])):
			// Get Patient for id
			require "../conn/conn.php";
			$id = $db->escape_string($_GET["id"]);
			
			$query = "select * from patient where id=$id";
			$result = $db->query($query);
		
			$patient = $result->fetch_assoc();		
		endif;
		if ($patient == NULL):
			// No patient found
			http_response_code(404);
			include("../common/not_found.php");
			exit();
		endif;
	elseif ($_SERVER["REQUEST_METHOD"] == "POST"):
		require "../conn/conn.php";
		
		// Prepare data for update
		$id = $db->escape_string($_POST["id"]);
		$name = $db->escape_string($_POST["name"]);
		$species = $db->escape_string($_POST["species"]);
		$gender = $db->escape_string($_POST["gender"]);
		$status = $db->escape_string($_POST["status"]);
		
		// Prepare query and execute
		$query = "update patient set name='$name', species='$species', gender='$gender', status='$status' where id=$id";
		$result = $db->query($query);
	
    // Tell the browser to go back to the index page.
    header("Location: ./");
    exit();
	endif;

	include "../common/header.php";
?>
	<h1>Edit patiënt</h1>
	<form method="post">
		<div>
			<input type="hidden" name="id" value="<?=$patient['id']?>">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" value="<?=$patient['name']?>">
		</div>
		<div>
			<label for="name">Species:</label>
			<input type="text" id="species" name="species" value="<?=$patient['species']?>">
		</div>
		<div>
			<label for="name">Gender:</label>
			<input type="radio" name="gender" value="male">Male
			<input type="radio" name="gender" value="female">Female
		</div>
		<div>
			<label for="name">Species:</label>
			<textarea id="status" name="status"><?=$patient['status']?></textarea>
		</div>
		<div>
			<label></label>
			<input type="submit" value="Save">
		</div>
	</form>
<?php
	include "../common/footer.php";
?>