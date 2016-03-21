<?php
	require "../common/header.php";
	require "../conn/conn.php";
	$query = "SELECT client_id, client FROM clients";
	$result = $db->query($query);
	$clients = $result->fetch_all(MYSQLI_ASSOC);
?>
<h1>Clients</h1>
<p class="options"><a href="create.php">create</a></p>
<table>
	<thead>
		<tr>
			<th>Client</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php 
	foreach ($clients as $client):
?>
		<tr>
			<td><?=$client['client']?></td>
			<td class="center"><a href="edit.php?id=<?=$client['client_id']?>">edit</a></td>
			<td class="center"><a href="delete.php?id=<?=$client['client_id']?>">delete</a></td>
		</tr>
<?php
	endforeach;
?>
	</tbody>
</table>
<?php
	include "../common/footer.php";
?>