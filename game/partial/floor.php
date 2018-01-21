<div class="green-floor">
	
	<h2>It's up to <?php echo ucfirst($_SESSION['up_to']) ?>:</h2>

	<div class='flex-between'>
		<div><p>Moves: </p></div>
		<div class='flex-center'>
			<img src='img/white_dice.png'>
			<?php
			if (isset($_SESSION['speed_dice']) && $_SESSION['speed_dice'] !== null) // si le de a ete joue
				echo "<div>".$_SESSION['speed_dice']."</div>";
			else 
			{
				$action = 'move'; 
				include('dice_form.php');
			}
			?>
		</div>
		<div>
			<?php
			if (isset($_SESSION['pp_to_speed']) && $_SESSION['pp_to_speed'] !== null && $_SESSION['pp_to_speed'] > 0)
				echo "<p>+ ".$_SESSION['pp_to_speed']."</p>";
			?>
		</div>
	</div>

	<div class='flex-between'>
		<div><p>Weapons: </p></div>
		<div class='flex-center'>
			<img src='img/white_dice.png'>
			<?php
			if (isset($_SESSION['weapon_dice']) && $_SESSION['weapon_dice'] !== null) // si le de a ete joue
			echo "<div>".$_SESSION['weapon_dice']."</div>";
			else 
			{
				$action = 'shoot';
				include('dice_form.php');
			}
			?>
		</div>
		<div>
			<?php
			if (isset($_SESSION['pp_to_weapon']) && $_SESSION['pp_to_weapon'] !== null && $_SESSION['pp_to_weapon'] > 0)
				echo "<p>+ ".$_SESSION['pp_to_weapon']."</p>";
			?>
		</div>
	</div>

	<!-- <div class='pp'> -->
		<!-- <h4>PP to play</h4> -->
		<!-- <?php 
		// if (isset($_SESSION['pp_to_speed']) && $_SESSION['pp_to_speed'] !== null)
			// echo "<div class='flex-between'><div>speed: </div><div>".$_SESSION['pp_to_speed']." <img src='img/dice-6.png'></div></div>";
		// if (isset($_SESSION['pp_to_weapon']) && $_SESSION['pp_to_weapon'] !== null)
			// echo "<div class='flex-between'><div>weapon: </div><div>".$_SESSION['pp_to_weapon']." <img src='img/dice-6.png'></div></div>";
		// if (isset($_SESSION['pp_to_shield']) && $_SESSION['pp_to_shield'] !== null)
			// echo "<div>shield: +".$_SESSION['pp_to_shield']."pts (already given)</div>";
		?> -->
		<!-- </div> -->

</div>
