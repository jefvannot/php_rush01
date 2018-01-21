<?php
session_start();
include("install.php");

$css_path = "./";
$css_file = "index_about_contact.css";
include('partial/head.php');
include('partial/header.php');

// print_r($_SESSION);
// echo "test";
?>
<body>
	<?php
	if ($_SESSION['flag_profil_updated'] == "OK")
	{
		echo "<div class='flag'><p>Votre profil a bien été modifié\n</p></div>";
		$_SESSION['flag_profil_updated'] = NULL;
	}

	if ($_SESSION['flag_passwd_updated'] == "OK")
	{
		echo "<div class='flag'><p>Votre mot de passe a bien été modifié\n</p></div>";
		$_SESSION['flag_passwd_updated'] = NULL;
	}

	if ($_SESSION['flag_user_created'] == "OK")
	{
		echo "<div class='flag'><p>Votre compte a bien été créé\n</p></div>";
		$_SESSION['flag_user_created'] = NULL;
	}

	if ($_SESSION['flag_user_deleted'] == "OK")
	{
		echo "<div class='flag'><p>Votre compte a bien été supprimé\n</p></div>";
		$_SESSION['flag_user_deleted'] = NULL;
	}
	if ($_SESSION['basket_saved'] == "OK")
	{
		echo "<div class='flag'><p>Votre panier a bien été sauvegardé\n</p></div>";
		$_SESSION['basket_saved'] = NULL;
	}
	?>
	<div class="container index">
		<div class="chat">
			<div class="test-frame"></div>
			<iframe id="chat-frame" name="chat" src="chat/chat.php" width="100%" height="550px"></iframe>
			<iframe id="speak-frame" name="speak" src="chat/speak.php" width="100%" height="50px" style="border: none;"></iframe>
		</div>

		<?php
		if (isset($_SESSION['logged_on_user'])) {
			// echo $_SESSION['logged_on_user'];
			?>
			<div class="games-list" id="gamelist">
				<h1>Parties en cours</h1>
				<div class="g-list">
					<?php include  'game_list/index.php' ?>
				</div>
			</div>
			<?php
		}
		else
		{
			echo "<h3>Pour jouer, veuillez vous connecter</h3>";
		}
		?>

	</div>
	<script src="game_list/todo.js"></script>
</body>
</html>
