<?php
	require "../conn/conn.php";
	$order = isset($_GET['sort']) ? $_GET['sort']: 'name';
	$ascdesc = isset($_GET['ascdesc']) ? $_GET['ascdesc'] : 'ASC';
	
	if(isset($ascdesc) and $ascdesc=="asc"){
		$ascdesc="desc";
	}else{
		$ascdesc="asc";
	}

	$query = "SELECT * FROM patient LEFT JOIN clients ON patient.client=clients.client_id";

	$result = $db->query($query);
	$patients = $result->fetch_all(MYSQLI_ASSOC);


	include "../common/header.php";
?>
	<h1>Patiënts</h1>
	<p class="options"><a href="create.php">create</a></p>
	<table>
		<thead>
			<tr>
				<th><a href="index.php?sort=name&ascdesc=<?=$ascdesc?>">Name</a></th>
				<th><a href="index.php?sort=species&ascdesc=<?=$ascdesc?>">Species</th>
				<th><a href="index.php?sort=gender&ascdesc=<?=$ascdesc?>">Gender</th>
				<th><a href="index.php?sort=status&ascdesc=<?=$ascdesc?>">Status</th>
				<th></th>
				<th></th>
				<th><a href="index.php?sort=client&ascdesc=<?=$ascdesc?>">Client</th>
			</tr>
		</thead>
		</tbody>
<?php
	foreach($patients as $patient):
?>
			<tr>
				<td><?=$patient['name']?></td>
				<td><?=$patient['species']?></td>
				<td><?=$patient['gender']?></td>
				<td><?=$patient['status']?></td>
				<td class="center"><a href="edit.php?id=<?=$patient['id']?>">edit</a></td>
				<td class="center"><a href="delete.php?id=<?=$patient['id']?>">delete</a></td>
				<td><?=$patient['client']?></td>
			</tr>

<?php
	endforeach;
?>
		</tbody>
	</table>
	<p class="options"><a href="connect_patients.php">Connect a patient to a client</a></p>
<?php
	include "../common/footer.php";
?>