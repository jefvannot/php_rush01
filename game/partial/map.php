<?php 

$file_path = 'db/games';
$db = unserialize(file_get_contents($file_path));
// echo "truc";
// echo $_GET['id'];
$arena = $db[$_GET['id']]['arena'];
// print_r($arena);
// echo $_GET['id'];
// echo $arena;
// echo "<br>";
// print_r($db);
// print_r($db[$_GET['id']]['ship']);
// echo "<br>";
// echo "<br>";
// print_r($db[$_GET['id']]['ship'][b]);
?>


<table>
	<?php
	$row = 0;
	while ($row < $arena->getHeight()) {
		$column = 0;
		?>
		<tr>
			<?php
			while ( $column < $arena->getWidth() ) {
				?>
				<td class="<?= getElemOnMap($column, $row, $arena)?>"></td>
				<?php
				$column++;
			}
			?>
		</tr>
		<?php
		$row++;
	}
	?>
</table>
<!-- <meta http-equiv="refresh" content="3"> -->
