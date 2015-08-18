<?php 

include '../class/script.class.php';

$item = $_GET['item'];
$data = $_GET['data'];

$script = new Script;
$arr = $script->getMediaItem($item);
$script->varDump($arr);
?>