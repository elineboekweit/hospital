<?php
	require "../conn/conn.php";
	$query = "SELECT id, list FROM species";
	$result = $db->query($query);
	$species = $result->fetch_all(MYSQLI_ASSOC);
	
	include "../common/header.php";
?>
	<h1>Species</h1>
	<p class="options"><a href="create.php">create</a></p>
	<table>
	<thead>
		<tr>
			<th>species</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	</tbody>
<?php
	foreach ($species as $species):
?>
		<tr>
			<td><?=$species['list']?></td>
			<td class="center"><a href="edit.php?id=<?=$species['id']?>">edit</a></td>
			<td class="center"><a href="delete.php?id=<?=$species['id']?>">delete</a></td>
		</tr>

<?php
	endforeach;
?>
	</tbody>
</table>
<?php
	include "../common/footer.php";
?>