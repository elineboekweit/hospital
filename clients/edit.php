<?php
	if ($_SERVER["REQUEST_METHOD"] == "GET"){
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
		require "../conn/conn.php";

		$id = $db->escape_string($_POST['id']);
		$client = $db->escape_string($_POST['client']);
		$client = strip_tags($client);
		$query = "UPDATE clients SET client='$client' WHERE client_id=$id";
		$result = $db->query($query);
		header("location: ./");
		exit();
	}
include "../common/header.php";
?>
<h1>Edit Client</h1>
<form method="post">
	<input type="hidden" name="id" value="<?=$id?>">
	<label for="client">Client</label>
	<input type="text" id="client" name="client" value="<?=$client['client']?>">

	<label></label>
	<input type="submit" value="Save">
</form>
<?php
	include "../common/footer.php";
?>