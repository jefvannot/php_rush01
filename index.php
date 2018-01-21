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
			<iframe name="chat" src="chat/chat.php" width="100%" height="550px"></iframe>
			<iframe name="speak" src="chat/speak.php" width="100%" height="50px" style="border: none;"></iframe>
		</div>

		<div class="games-list">
			<h1>Liste des parties en cours</h1>

			<iframe name="speak" src="game_list/index.html" width="100%" height="500px"></iframe>
			<form action="game/index.php" method="POST">
				<!-- <input type="hidden" name="action" value="<?php echo $action ?>"> -->
				<!-- <input type="hidden" name="name" value="<?php echo $_SESSION['up_to'] ?>"> -->
				<div class="flex-center new-game">
					<input name="new-game" value="Nouvelle Partie" type="submit"/>
				</div>
			</form>
		</div>
	</a>
</div>


</body>
</html>
