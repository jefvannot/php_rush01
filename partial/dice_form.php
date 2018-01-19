<form action="roll_dice.php" method="POST">
	<input type="hidden" name="action" value="<?php echo $action ?>">
	<input type="hidden" name="name" value="<?php echo $_SESSION['up_to'] ?>">
	<div class="flex-center">
		<input name="dice" value="Roll" type="submit" <?php if (!$_SESSION['pp_set']) echo "disabled"; ?>/>
	</div>
</form>