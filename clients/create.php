<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		require "../conn/conn.php";

		$clients = $db->escape_string($_POST['clients']);
		$clients = strip_tags($clients);
		$query = "INSERT INTO clients (client) VALUES ('$clients')";
		$result = $db->query($query);

		header("location: ./");
		exit();		
	}

	include "../common/header.php";
?>
	<h1>New client</h1>
	<form method="post">
		<label for="clients">Client</label>
		<input type="text" id="clients" name="clients">
		<label></label>
		<input type="submit" value="submit">
	</form>
<?php 
	include "../common/footer.php";
?>