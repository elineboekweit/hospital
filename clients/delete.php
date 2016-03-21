<?php 
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$client = null;
		if (isset($_GET['id'])){
			require "../conn/conn.php";
			$id = $db->escape_string($_GET['id']);

			$query = "SELECT client FROM clients WHERE client_id=$id";
			$result = $db->query($query);
			$client = $result->fetch_assoc();
		}
		if ($client == null){
			http_response_code(404);
			include("../common/not_found.php");
			exit();
		}
	}
	elseif ($_SERVER["REQUEST_METHOD"] == "POST"){
		if (isset($_POST['confirmed'])){
			require "../conn/conn.php";

			$id = $db->escape_string($_POST['id']);

			$query = "DELETE FROM clients WHERE client_id=$id";
			$result = $db->query($query);
		}
		var_dump($result);
		header("location: ./");
		exit();
	}
	include "../common/header.php";
?>
	<h1>delete client</h1>
	<p>Are you sure you want to delete:</p>
	<form method="post">
		<input type="hidden" name="id" value="<?=$id?>">
		<label for="client">client</label>
		<span><?=$client['client']?></span>

		<label></label>
		<input type="submit" name="confirmed" value="Yes">
		<input type="submit" name="canceled" value="No">
	</form>
<?php
	include "../common/footer.php";
	?>