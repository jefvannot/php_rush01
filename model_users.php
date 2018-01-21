<?php
session_start();

include("tools/auth.php");
include('tools/get_db.php');


function passwd_update(array $data) {
	$path = "private";
	$file = $path."/passwd";
    $db = get_db($path, $file);
	$key = array_search($_SESSION['mail'], array_column($db, 'mail'));

	if ($data['oldpwd'] == "")
		$error[] = 'oldpwd';
	if ($data['newpwd1'] == "")
		$error[] = 'newpwd1';
	if ($data['newpwd2'] == "")
		$error[] = 'newpwd2';
	if ($error)
	{
		$_SESSION['flag_empty_fields'] = "ON";
		header('Location: modif_pwd.php?'.implode('&', $error));
		exit();
	}
	if ($db[$key]['passwd'] != hash('whirlpool', $data['oldpwd'])) {
		$_SESSION['flag_bad_passwd'] = "ON";
		header('Location: modif_pwd.php?'.implode('&', $error));
		exit();
	}
    if ($data['newpwd1'] != $data['newpwd2'])
	{
		$_SESSION['flag_cmp_passwd'] = "KO";
		header('Location: modif_pwd.php');
		exit();
	}
	$db[$key]['passwd'] = hash('whirlpool', $data['newpwd1']);
	file_put_contents($file, serialize($db));
	$_SESSION['flag_password_updated'] = "OK";
	header('Location: index.php');
	exit();
}

function profil_update(array $data) {
	$path = "private";
	$file = $path."/passwd";
    $db = get_db($path, $file);
	if ($data['mail'] != $_SESSION['mail'] && array_search($data['mail'], array_column($db, 'mail')) !== false)
	{
		$_SESSION['mail_already_registered'] = "ON";
		header('Location: modif_profil.php');
		exit();
	}
	$key = array_search($_SESSION['mail'], array_column($db, 'mail'));
	$db[$key]['prenom'] = $data['prenom'];
	$db[$key]['nom'] = $data['nom'];
	$db[$key]['mail'] = $data['mail'];
	file_put_contents($file, serialize($db));
	$_SESSION['logged_on_user'] = $data['prenom'];
	$_SESSION['nom'] = $data['nom'];
	$_SESSION['mail'] = $data['mail'];
	$_SESSION['flag_profil_updated'] = "OK";
	header('Location: index.php');
	exit();
}

function login(array $data) {
	$path = "private";
	$file = $path."/passwd";
    $db = get_db($path, $file);
	if ($data['mail'] == "")
		$error[] = 'mail';
	if ($data['passwd'] == "")
		$error[] = 'passwd';
	if ($error)
	{
		$_SESSION['flag_empty_fields'] = "ON";
		header('Location: login.php?'.implode('&', $error));
		exit();
	}
	if ($user = auth($db, $data['mail'], $data['passwd']))
	{
		$_SESSION['logged_on_user'] = $user['prenom'];
		$_SESSION['nom'] = $user['nom'];
		$_SESSION['mail'] = $user['mail'];
		$_SESSION['flag_log'] = "OK";
		header('Location: index.php');
		exit();
	}
	else
	{
		$_SESSION['flag_bad_passwd'] = "ON";
		$_SESSION['logged_on_user'] = "";
		header('Location: login.php?passwd');
		exit();
	}
}

function create_user(array $data) {
	$path = "private";
	$file = $path."/passwd";
    $db = get_db($path, $file);
    $new_user['nom'] = $data['nom'];
	$new_user['prenom'] = $data['prenom'];
	$new_user['mail'] = $data['mail'];
	$new_user['passwd'] = hash('whirlpool', $data['passwd1']);
	if ($db && array_search($data['mail'], array_column($db, 'mail')) !== false) // plus l'admin a gerer
	{
		$_SESSION['mail_already_registered'] = "ON";
		header('Location: signup.php');
		exit();
	}
	$db[] = $new_user;
	file_put_contents($file, serialize($db));
	$_SESSION['flag_user_created'] = "OK";
	$_SESSION['logged_on_user'] = $new_user['prenom'];
	header('Location: index.php');
	exit();
}

function register(array $data) {
	$error = NULL;

	if ($data['prenom'] == "")
		$error[] = 'prenom';
	if ($data['nom'] == "")
		$error[] = 'nom';
	if ($data['mail'] == "")
		$error[] = 'mail';
	if ($data['passwd1'] == "")
		$error[] = 'passwd1';
	if ($data['passwd2'] == "")
		$error[] = 'passwd2';
	if ($error)
	{
		$_SESSION['flag_empty_fields'] = "ON";
		header('Location: signup.php?'.implode('&', $error));
		exit();
	}
	if ($data['passwd1'] != $data['passwd2'])
	{
		$_SESSION['flag_cmp_passwd'] = "KO";
		header('Location: signup.php');
		exit();
	}
	create_user($data);
}

$action_array = array('login', 'register', 'profil_update', 'passwd_update');

if ($_POST['action'] && in_array($_POST['action'], $action_array))
	$_POST['action']($_POST);
?>
