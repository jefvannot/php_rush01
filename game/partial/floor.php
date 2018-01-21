<div class="green-floor">
	
	<!-- <h2>It's up to <?php #echo ucfirst($db[$_GET['id']]['up_to']) ?>:</h2> -->


	<?php 
	if (($db[$_GET['id']][creator] == $_SESSION[logged_on_user] && $db[$_GET['id']]['up_to'] == 'a')
		|| ($db[$_GET['id']][creator] != $_SESSION[logged_on_user] && $db[$_GET['id']]['up_to'] == 'b'))
	{
		?>
		<h2>It's your turn</h2>
		<div class='flex-between'>
			<div><p>Moves: </p></div>
			<div class='flex-center'>
				<img src='img/white_dice.png'>
				<?php
			if (isset($db[$_GET['id']]['speed_dice']) && $db[$_GET['id']]['speed_dice'] !== null) // si le de a ete joue
			echo "<div>".$db[$_GET['id']]['speed_dice']."</div>";
			else 
			{
				$action = 'move'; 
				include('dice_form.php');
			}
			?>
		</div>
		<div>
			<?php
			if (isset($db[$_GET['id']]['pp_to_speed']) && $db[$_GET['id']]['pp_to_speed'] !== null && $db[$_GET['id']]['pp_to_speed'] > 0)
				echo "<p>+ ".$db[$_GET['id']]['pp_to_speed']."</p>";
			?>
		</div>
	</div>

	<div class='flex-between'>
		<div><p>Weapons: </p></div>
		<div class='flex-center'>
			<img src='img/white_dice.png'>
			<?php
			if (isset($db[$_GET['id']]['weapon_dice']) && $db[$_GET['id']]['weapon_dice'] !== null) // si le de a ete joue
			echo "<div>".$db[$_GET['id']]['weapon_dice']."</div>";
			else 
			{
				$action = 'shoot';
				include('dice_form.php');
			}
			?>
		</div>
		<div>
			<?php
			if (isset($db[$_GET['id']]['pp_to_weapon']) && $db[$_GET['id']]['pp_to_weapon'] !== null && $db[$_GET['id']]['pp_to_weapon'] > 0)
				echo "<p>+ ".$db[$_GET['id']]['pp_to_weapon']."</p>";
			?>
		</div>
	</div>
	<?php
}
else
{
	echo "<h2>Let's wait for ".ucfirst($db[$_GET['id']]['up_to'])." to play</h2>";
}
?>

</div>
