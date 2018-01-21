<?php
function auth($db, $email, $passwd) {
    if (!$db || array_search($email, array_column($db, 'mail')) === false)
    {
        $_SESSION['flag_unknown_mail'] = "ON";
		header('Location: login.php?mail');
        exit();
    }
    if ($db) {
        foreach ($db as $k => $v) {
            if ($v['email'] === $mail && $v['passwd'] === hash('whirlpool', $passwd))
                return $v;
        }
    }
    return false;
}
?>