<table>
	<?php
	$row = 0;
	while ($row < $_SESSION['arena']->getHeight()) {
		$column = 0;
		?>
		<tr>
			<?php
			while ( $column < $_SESSION['arena']->getWidth() ) {
				?>
				<td class="<?= getElemOnMap($column, $row, $_SESSION['arena'])?>"></td>
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