<?php
	require "../conn/conn.php";
	$query = "SELECT * FROM patient WHERE client=0";
	$result = $db->query($query);
	$patients = $result->fetch_all(MYSQLI_ASSOC);
	
	$query2 = "SELECT * FROM clients "; //LEFT JOIN patient ON patient.id=clients.patient_idx
	$result2 = $db->query($query2);
	$clients = $result2->fetch_all(MYSQLI_ASSOC);
	
	include "../common/header.php";
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		if ($_POST == null){
			echo "Please select both boxes";
		}else{
		$patient = $db->escape_string($_POST['patient']);
		$client = $db->escape_string($_POST['client']);

		$query3 = "UPDATE patient SET client=$client WHERE id=$patient";
		$update = $db->query($query3);
		header("location: index.php");
		}
		
	}


?>
<h1>connect patient to client</h1>
<form method="post" action="connect_patients.php">
<label for="patient">patient:</label>
	<select name="patient">
	<option disabled selected style="display" name="select">select patient</option>
<?php 
		foreach ($patients as $patient) { 

?>
				<option name="<?=$patient['name']?>" value="<?=$patient['id']?>"><?=$patient['name']?></option>
<?php	
		}
?>
	</select>
	<label for="client">client:</label>
	<select name="client">
	<option disabled selected style="display" name="select">select client</option>
<?php 
		foreach ($clients as $client) { 
			
?>				
				<option name="<?=$client['client']?>" value="<?=$client['client_id']?>"><?=$client['client']?></option>
<?php	
		}
?>
	</select>
	<input type="submit" value="Save">
	
</form>
<?php
	include "../common/footer.php";
?>