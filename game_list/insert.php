<?php
if (file_exists("list.csv") && isset($_GET["todo"]) && $_GET["todo"] !== null)
{
	$csv_file = file("list.csv", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach ($csv_file as $line)
		$tmp[] = explode(";", $line, 2)[0];
	$id = ($tmp) ? max($tmp) + 1 : 0;


	
	file_put_contents("list.csv", $id . ";" . $_GET["todo"] . PHP_EOL, FILE_APPEND);
}
?>