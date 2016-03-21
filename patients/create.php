<?php
		require "../conn/conn.php";
	if ($_SERVER["REQUEST_METHOD"] == "POST"):
		
		// Prepare data for insertion
		$name = $db->escape_string($_POST["name"]);
		$name = strip_tags($name);
		$species = $db->escape_string($_POST["species"]);
		$gender = $db->escape_string($_POST["gender"]);
		$status = $db->escape_string($_POST["status"]);
		// Prepare query and execute
		$query = "INSERT INTO patient (name, species, gender, status) VALUES ('$name', '$species', '$gender', '$status')"; 
		$result = $db->query($query);

	    // Tell the browser to go back to the index page.
	   	header("Location: ./");

	    exit();
	endif;

	$query = "SELECT * FROM species";
	$result = $db->query($query);
	include "../common/header.php";
?>
	<h1>New patiënt</h1>
	<form method="post">
		<div>
			<label for="name">Name:</label>
			<input type="text" id="name" name="name">
		</div>
		<div>
			<label for="name">Species:</label>
			<select name="species">
<?php 			foreach ($result as $species):?>
					<option name="<?=$species['list']?>"><?=$species['list']?></option>
<?php 			endforeach;
?>
			</select>
		</div>
		<div>
			<label for="name">Gender:</label>
			<input type="radio" name="gender" value="male">Male
			<input type="radio" name="gender" value="female">Female

		</div>
		<div>
			<label for="name">Status:</label>
			<textarea id="status" name="status"></textarea>
		</div>
		<div>
			<label></label>
			<input type="submit" value="Save">
		</div>
	</form>
<?php
	include "../common/footer.php";
?>