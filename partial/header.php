<header>
	<div class="logo">
		<a href="<?php echo $home_path ?>index.php"><img src="<?php echo $home_path ?>img/SB-logo.png" alt=""></a>
	</div>
	<div class="menu">
		<!-- <a href="products.php">Nos produits</a> -->
		<!-- <a href="about.php">Qui sommes-nous ?</a> -->
		<!-- <a href="contact.php">Contact</a> -->
	</div>
	<div class="login">
<!-- 		<div class="basket">
			<a href="basket.php">
				<img src="img/shop_logo.png" alt="">
				<p><?php if ($_SESSION['basket']){foreach ($_SESSION['basket'] as $nb) {$qte += $nb;}}; echo $qte ? $qte : '0' ?> articles</p>
			</a>
		</div> -->
		<?php
		if (isset($_SESSION['logged_on_user']) && !empty($_SESSION['logged_on_user']))
		{
			?>
			<div class="user">
				<p>Bonjour <?php echo $_SESSION['logged_on_user']; ?></p>
				<!-- <img src="img/caret-down.svg" alt=""> -->
				<ul class="choice">
					<!-- <li><a href="user_orders.php">Voir l'historique de mes achats</a></li> -->
					<li><a href="modif_profil.php">Modifier mon profil</a></li>
					<li><a href="modif_pwd.php">Modifier mon mot de passe</a></li>
					<li><a href="delete.php">Supprimer mon compte</a></li>

				</ul>
			</div>
			<?php
			if ($_SESSION['logged_on_user'] == "admin")
			{
				?>

				<div class="user">
					<p style="text-decoration: underline;">Back Office</p>
					<img src="img/caret-down.svg" alt="">
					<ul class="choice">
						<li><a href='admin_basket.php'>Voir toutes les commandes</a></li>
						<li><a href='admin_users.php'>Gérer les utilisateurs</a></li>
						<li><a href='admin_products.php'>Gérer les produits</a></li>
						<li><a href='admin_categories.php'>Gérer les catégories</a></li>
					</ul>
				</div>
				<?php
			}
			?>


			<div><a href="logout.php">Déconnexion</a></div>

			<?php
		} else {
			echo '<div><a href="signup.php">Inscription</a></div>';
			echo '<div><a href="login.php">Connexion</a></div>';
		}
		?>
	</div>
</header>
