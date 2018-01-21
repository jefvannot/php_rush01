<?php
if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] && $_POST['submit'] === "OK")
{
    if (!file_exists('../private'))
        mkdir("../private");
    if (file_exists('../private/passwd'))
        $account = unserialize(file_get_contents('../private/passwd'));
    if ($account 
        && ($key = array_search($_POST['login'], array_column($account, 'login'))) !== false
        && array_search(hash('whirlpool', $_POST['oldpw']), array_column($account, 'passwd')) !== false)
    {
        $account[$key]['passwd'] = hash('whirlpool', $_POST['newpw']);
        file_put_contents('../private/passwd', serialize($account));
        header('Location: index.html');
        echo "OK\n";
    }
    else 
        echo "ERROR\n";
}
else
    echo "ERROR\n";
?>
