<?php
    if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] && $_POST['submit'] === "OK")
    {
        if (!file_exists('../private'))
            mkdir("../private");
        if (file_exists('../private/passwd'))
            $account = unserialize(file_get_contents('../private/passwd'));
        if ($account && array_search($_POST['login'], array_column($account, 'login')) !== false)
            echo "ERROR\n";
        else 
        {
            $tmp['login'] = $_POST['login'];
            $tmp['passwd'] = hash('whirlpool', $_POST['passwd']);
            $account[] = $tmp;
            file_put_contents('../private/passwd', serialize($account));
            header('Location: index.html');
            echo "OK\n";
            exit();
        }
    }
    else
        echo "ERROR\n";
?>
