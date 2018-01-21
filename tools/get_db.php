<?php
function get_db($path, $file) {
    if (!file_exists($path))
		mkdir ($path);
	if (file_exists($file))
    	$account = unserialize(file_get_contents($file));
    return ($account);
}
?>