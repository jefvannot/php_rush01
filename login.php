<?php
session_start();

if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) {
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
			if ($_SESSION['flag_empty_fields'] == "ON")
			{
				echo "<div class='error-login'><p>Veuillez remplir tous les champs çi-dessous\n</p></div>";
				$_SESSION['flag_empty_fields'] = NULL;
			}
			if ($_SESSION['flag_unknown_mail'] == "ON")
			{
				echo "<div class='error-login'><p>Votre e-mail nous est inconnu</p></div>";
				$_SESSION['flag_unknown_mail'] = NULL;
			}
			if ($_SESSION['flag_bad_passwd'] == "ON")
			{
				echo "<div class='error-login'><p>Votre mot de passe n'est pas le bon</p></div>";
				$_SESSION['flag_bad_passwd'] = NULL;
			}
			?> 
			<h1>Connexion</h1>
			<form action="model_users.php" method="post">
				<input type="email" name="mail" placeholder="E-mail" class="<?php echo isset($_GET['mail']) ? 'error' : '' ; ?>">
				<input type="password" name="passwd" placeholder="Mot de passe" class="<?php echo isset($_GET['passwd']) ? 'error' : '' ; ?>">
				<button type="submit" class="btn btn-default">Connection</button>
				<input type="hidden" name="action" value="login">
				<!-- <input type="hidden" name="success" value="index"> -->
				<p>Tu n'es pas encore inscrit ? <a href="signup.php">Inscris toi</a></p>
			</form>
		</div>
		
	</div>
</body>
</html>