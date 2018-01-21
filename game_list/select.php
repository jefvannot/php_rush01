<?php
if (file_exists("list.csv"))
{
	$csv_file = file("list.csv", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach ($csv_file as $line) {
		$tmp = explode(";", $line, 2);
		$todos[$tmp[0]] = $tmp[1];
	}
	echo json_encode($todos);
}
?>