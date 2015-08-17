<?php 

include '../class/script.class.php';

$item = $_GET['item'];

$script = new Script;
$arr = $script->getMediaItem($item);
var_dump($arr);
?>