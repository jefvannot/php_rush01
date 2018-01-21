<form action="roll_dice.php" method="POST">
	<input type="hidden" name="game_id" value="<?php echo $_GET['id'] ?>">
	<input type="hidden" name="action" value="<?php echo $action ?>">
	<div class="flex-center">
		<input name="dice" value="Roll" type="submit" <?php if (!$db[$_GET['id']]['pp_set']) echo "disabled"; ?>/>
	</div>
</form>