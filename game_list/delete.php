<?php
$list = array();
if (file_exists("list.csv") && isset($_GET["id"]) && $_GET["id"] !== null)
{
	echo "truc";
	$csv_file = file("list.csv", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach ($csv_file as $line) {
		$tmp = explode(";", $line, 2);
		if ($tmp[0] != $_GET["id"])
			$list[] = $tmp[0].";".$tmp[1].PHP_EOL;
	}
	file_put_contents("list.csv", $list);
}
?>
