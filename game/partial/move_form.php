<div class='player-ctrl' style='<?php if ($_SESSION['up_to'] == $player) echo "border: 2px solid #ff0000;"; ?>'>
	<div class='title flex-center <?php echo $player ?>'>
		<h4>Player <?php echo ucfirst($player) ?></h4>&nbsp;-&nbsp;
		<p><?php echo($myplayer->getName()); ?></p>
	</div>
	<hr>

	<div>
		<?php 

		$pp_to_do = false;
		if ($_SESSION['up_to'] == $player) {
			// if ($_SESSION['pp_to_speed'] !== null && $_SESSION['pp_to_shield'] !== null && $_SESSION['pp_to_weapon'] !== null)
			if (!$_SESSION['pp_set'])
				$pp_to_do = true;

			if (isset($_SESSION['speed_dice']) && $_SESSION['speed_dice'] != "" && $_SESSION['speed_dice'] != "played")
				$move_playable = true;
			else if ($_SESSION['speed_dice'] == 'played' && $_SESSION['pp_to_speed'] > 0)
				$move_playable = true;
			else
				$move_playable = false;

			if (isset($_SESSION['weapon_dice']) && $_SESSION['weapon_dice'] != "" && $_SESSION['weapon_dice'] != "played")
				$shoot_playable = true;
			else if ($_SESSION['weapon_dice'] == 'played' && $_SESSION['pp_to_weapon'] > 0)
				$shoot_playable = true;
			else
				$shoot_playable = false;
		}

		$pp_to_spend = getPPToSpend($player, $_SESSION['arena']);
		
		
		$all_boats = getArrayShipByPlayer($myplayer->getTeam(), $_SESSION['arena']);
			//echo("numero player:" . $_SESSION['player1'] . PHP_EOL);
		//print_r( $_SESSION['player1'] );
		//print_r( $all_boats );
		$l = 0;
		$r = 0;
		?>
		<script src="../js/inter.js">
			//player = <?php echo($player === 'a')?(0):(1); ?>;
			function next_boat()
			{
				//imgnumb = (player)?(l++):(r++);
				document.getElementById('imgboat_<?php echo($player === 'a')?(0):(1); ?>').src = <?php echo '"' . $all_boats[($player === 'a')?($l++):($r++)]->getSprite() ?>";
			}
			function prev_boat()
			{
				if ($l !== 0 && $r !== 0)
					document.getElementById('imgboat_<?php echo($player === 'a')?(0):(1); ?>').src = <?php echo '"' . $all_boats[($player === 'a')?($l--):($r--)]->getSprite() ?>";
			}
		</script>
		<div class="flex-center">
			<p>Select a boat:</p>
		</div>
		<img id="imgboat_<?php echo ($player === 'a')?(0):(1); ?>" class="flex-center boat_img" src="<?php echo $all_boats[$l]->getSprite(); ?>">
		<div class="flex-center">
			<p><a id="lb_<?php echo ($player === 'a')?(0):(1); ?>" onclick="prev_boat();" href="#"><?php echo "<</a>".$curr_boat; ?>
			<?php echo( $all_boats[$l]->getName() ); ?>
			<a id="rb_<?php echo ($player === 'a')?(0):(1); ?>" onclick="next_boat();" href="#"><?php echo "></a>".$curr_boat; ?>
			</p>
		</div>
		<div class="flex-center pp-input">
			<p>PP to spend:</p>
			<p><?php echo $pp_to_spend; ?></p>
		</div>
		<form action="pp_to_spend.php" method="POST">
			<input type="hidden" name="pp_to_spend" value="<?php echo $pp_to_spend ?>">
			<input type="hidden" name="name" value="<?php echo $player ?>">
			<div class="">
				<div class="flex-center pp-input">
					<p>for moves</p>
					<input name="pp_speed" value="" type="text" />
				</div>
				<div class="flex-center pp-input">
					<p>for shield</p>
					<input name="pp_shield" value="" type="text" />
				</div>
				<div class="flex-center pp-input">
					<p>for weapon</p>
					<input name="pp_weapon" value="" type="text" />
				</div>
				<div class="flex-center" style="justify-content: flex-end;">
					<input name="OK" value="OK" type="submit" <?php if (!$pp_to_do) echo "disabled"; ?>/>
				</div>
			</div>
		</form>
	</div>

	<hr>

	<div>
		<form action="move.php" method="POST">
			<input type="hidden" name="name" value="<?php echo $player ?>">
			<div class="moves-btn">
				<div class="flex-center">
					<input name="move" value="up" type="submit" <?php if (!$move_playable) echo "disabled"; ?>/>
				</div>
				<div class="flex-around">
					<input name="move" value="<" type="submit" <?php if (!$move_playable) echo "disabled"; ?>/>
					<input name="move" value=">" type="submit" <?php if (!$move_playable) echo "disabled"; ?>/>
				</div>
				<div class="flex-center">
					<input name="move" value="down" type="submit" <?php if (!$move_playable) echo "disabled"; ?>/>
				</div>
			</div>
		</form>
	</div>

	<hr>

	<div class="flex-around">
		<p>Fire</p>
		<form action="shoot.php" method="POST">
			<input type="hidden" name="name" value="<?php echo $player ?>">
			<div>
				<input name="shoot" value="up" type="submit" <?php if (!$shoot_playable) echo "disabled"; ?>>
			</div>
			<div>
				<input name="shoot" value="down" type="submit" <?php if (!$shoot_playable) echo "disabled"; ?>>
			</div>
		</form>
	</div>
	<hr>

	<div class="stats flex-around">
		<p>Shell</p>
		<p><?php printHealthStats($player, $_SESSION['arena']); ?></p>
	</div>

	<div class="stats flex-around <?php if ($_SESSION['pp_to_shield'] && $_SESSION['up_to'] == $player) {echo $player;} ?>" >
		<p>Shield</p>
		<p><?php printShieldStats($player, $_SESSION['arena']); ?></p>
	</div>
</div>



