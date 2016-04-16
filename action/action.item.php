<?php

include '../class/item.class.php';

$item = new Item;
if ($_POST) {
    if ($_POST['tipo'] == 'add') {
        $nome = $_POST['nome'];
        $type = $_POST['type'];
        $minimo = $_POST['minimo'];

        $item->addItem($nome, $type, $minimo);
    } elseif ($_POST['tipo'] == 'del') {
        $key = $_POST['key'];

        $item->deleteItem($key);
    }
}
