<?php
session_start();
date_default_timezone_set('Europe/Paris');
if (file_exists('../private') && file_exists('../private/chat')) {
    $file = unserialize(file_get_contents('../private/chat'));
    foreach ($file as $message) {
        echo "[".date('H:i', $message['time'])."] <b>".$message['login']."</b>: ".$message['msg']."<br />"."\n";
    }
}
?>
<meta http-equiv="refresh" content="4">