<?php
session_start();

if (isset($_SESSION['logged_on_user']) && !empty($_SESSION['logged_on_user'])) {
	header('Location: index.php');
	exit();
}
$css_path = "./";
$css_file = "signup_login.css";
include('partial/head.php');
include('partial/header.php');
?>
<body>
	<div class="container">
		<div class="log-box">

			<?php
			if ($_SESSION['mail_already_registered'] == "ON")
			{
				echo "<div class='error-login'><p>Un compte existe déjà avec cette adresse mail\n</p></div>";
				$_SESSION['mail_already_registered'] = NULL;
			}
			if ($_SESSION['flag_cmp_passwd'] == "KO")
			{
				echo "<div class='error-login'><p>Les deux mots de passe ne correspondent pas\n</p></div>";
				$_SESSION['flag_cmp_passwd'] = NULL;
			}
			if ($_SESSION['flag_empty_fields'] == "ON")
			{
				echo "<div class='error-login'><p>Veuillez remplir tous les champs çi-dessous\n</p></div>";
				$_SESSION['flag_empty_fields'] = NULL;
			}
			?>


			<h1>Inscription</h1>
			<form action="model_users.php" method="post">
				<input type="text" name="prenom" placeholder="Prenom" class="<?php echo isset($_GET['prenom']) ? 'error' : '' ; ?>">
				<input type="text" name="nom" placeholder="Nom" class="<?php echo isset($_GET['nom']) ? 'error' : '' ; ?>">
				<input type="email" name="mail" placeholder="E-mail" class="<?php echo isset($_GET['mail']) ? 'error' : '' ; ?>">
				<input type="password" name="passwd1" placeholder="Mot de passe" class="<?php echo isset($_GET['passwd1']) ? 'error' : '' ; ?>">
				<input type="password" name="passwd2" placeholder="Vérification du mot de passe" class="<?php echo isset($_GET['passwd2']) ? 'error' : '' ; ?>">
				<button type="submit" class="btn btn-default" value="send">S'inscrire</button>
				<!-- <input type="submit" name = "submit" value="Envoyer" /> -->
				<input type="hidden" name="action" value="register">
				<!-- <input type="hidden" name="success" value="login"> -->
				<p>Tu es déjà inscrit ? <a href="login.php">Connecte toi</a></p>
			</form>
		</div>
	</div>
</body>
</html>

