<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		require "../conn/conn.php";

		$species = $db->escape_string($_POST['species']);
		$species = strip_tags($species);
		$query = "INSERT INTO species (list) VALUES ('$species')";
		$result = $db->query($query);

		header("location: ./");
		exit();
	}
	include "../common/header.php";
	?>
	<h1>New species</h1>
	<form method="post">
		<label for="species">Specie</label>
		<input type="text" id="species" name="species">
		<label></label>
		<input type="submit" value="submit">
	</form>
	<?php
		include "../common/footer.php";
	?>