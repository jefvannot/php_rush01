<div class="green-floor">
	
	<h2>It's up to <?php echo ucfirst($_SESSION['up_to']) ?>:</h2>

	<div class='flex-center' style="justify-content: flex-start;">
		<p>Moves: </p>
		<img src='img/white_dice.png'>
		<?php
	// if ($_SESSION['pp_to_speed'] !== null && $_SESSION['pp_to_shield'] !== null && $_SESSION['pp_to_weapon'] !== null)
		// $pp_set = true;
		if (isset($_SESSION['speed_dice']) && $_SESSION['speed_dice'] != "")
			echo "<div>".$_SESSION['speed_dice']."</div>";
		else 
		{
			?>
			<form action="roll_dice.php" method="POST">
				<input type="hidden" name="action" value="move">
				<input type="hidden" name="name" value="<?php echo $_SESSION['up_to'] ?>">
				<div class="flex-center">
					<input name="dice" value="Roll" type="submit" <?php if (!$_SESSION['pp_set']) echo "disabled"; ?>/>
				</div>
			</form>
			<?php
		}
		?>
	</div>

	<div class='flex-center' style="justify-content: flex-start;">
		<p>Weapons: </p>
		<img src='img/white_dice.png'>
		<?php
		if (isset($_SESSION['weapon_dice']) && $_SESSION['weapon_dice'] != "")
			echo "<div>".$_SESSION['weapon_dice']."</div>";
		else 
		{
			?>
			<form action="roll_dice.php" method="POST">
				<input type="hidden" name="action" value="shoot">
				<input type="hidden" name="name" value="<?php echo $_SESSION['up_to'] ?>">
				<div class="flex-center">
					<input name="dice" value="Roll" type="submit" <?php if (!$_SESSION['pp_set']) echo "disabled"; ?>/>
				</div>
			</form>
			<?php
		}
		?>
	</div>

	<div class='pp'>
		<h4>PP to play</h4>
		<?php
		if (isset($_SESSION['pp_to_speed']) && $_SESSION['pp_to_speed'] !== null)
			echo "<div class='flex-between'><div>speed: </div><div>".$_SESSION['pp_to_speed']." <img src='img/dice-6.png'></div></div>";
		if (isset($_SESSION['pp_to_weapon']) && $_SESSION['pp_to_weapon'] !== null)
			echo "<div class='flex-between'><div>weapon: </div><div>".$_SESSION['pp_to_weapon']." <img src='img/dice-6.png'></div></div>";
		if (isset($_SESSION['pp_to_shield']) && $_SESSION['pp_to_shield'] !== null)
			echo "<div>shield: +".$_SESSION['pp_to_shield']."pts (already given)</div>";
		?>
	</div>
</div>
