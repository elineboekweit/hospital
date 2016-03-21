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
		if (isset($_POST['confirmed'])):
			require "../conn/conn.php";
		
			// Prepare data for delete
			$id = $db->escape_string($_POST["id"]);
	
			// Prepare query and execute
			$query = "delete from patient where id=$id";
			$result = $db->query($query);
		endif;
		
		// Tell the browser to go back to the index page.
		header("Location: ./");
		exit();
	endif;
	include "../common/header.php";
?>
	<h1>Delete patiënt</h1>
	<p>Are you sure you want to delete:</p>
	<form method="post">
		<div>
			<input type="hidden" name="id" value="<?=$patient['id']?>">
			<label for="name">Name:</label>
			<span><?=$patient['name']?></span>
		</div>
		<div>
			<label for="name">Species:</label>
			<span><?=$patient['species']?></span>
		</div>
		<div>
			<label></label>
			<input type="submit" name="confirmed" value="Yes">
			<input type="submit" name="canceled" value="No">
		</div>
	</form>
<?php
	include "../common/footer.php";
?>