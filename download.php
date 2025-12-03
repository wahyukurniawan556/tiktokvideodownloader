<?php
if (!isset($_GET['url']) || !isset($_GET['name'])) {
    die("Invalid request");
}

$url  = $_GET['url'];   
$name = $_GET['name'];  


header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Transfer-Encoding: binary");
header("Cache-Control: must-revalidate");
header("Pragma: public");


readfile($url);
exit;
