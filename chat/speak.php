<?php
session_start();
if ($_SESSION['logged_on_user'])
{
    if ($_POST['msg']) {
        if (!file_exists('../private'))
            mkdir("../private");
        if (!file_exists('../private/chat'))
            file_put_contents('../private/chat', null);
        $file = unserialize(file_get_contents('../private/chat'));
        $fp = fopen('../private/chat', "w");
        flock($fp, LOCK_EX);
        $tmp['login'] = $_SESSION['logged_on_user'];
        $tmp['time'] = time();
        $tmp['msg'] = $_POST['msg'];
        $file[] = $tmp;
        file_put_contents('../private/chat', serialize($file));
        fclose($fp);
    }
    ?>
    <html>
    <head>
        <script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
    </head>
    <body>
        <form action="speak.php" method="POST">
            <input type="text" name="msg" value=""/><input type="submit" name="submit" value="Send"/>
        </form>
    </body>
    <?php
}
else
    echo "ERROR\n";
?>