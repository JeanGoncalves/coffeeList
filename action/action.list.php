<?php
include '../class/action.class.php';

$action = new Action;
if ($_POST) {
    if ($_POST['tipo'] == 'home') {
        $key  = $_POST['key'];
        $nome = $_POST['nome'];
        $item = $_POST['item'];
        $qtd  = $_POST['qtd'];
        $type = $_POST['type'];

        $obj = array("Nome" => $nome, "Item" => $item, "qtd"=>$qtd, "type" => $type);

        $action->editList($key, $obj);
    } elseif ($_POST['tipo'] == 'lista') {
        $data = $_POST['data'];

        $action->createList($data);
    } elseif ($_POST['tipo'] == 'del') {
        $key = $_POST['key'];
        $reg = null;
        if (!is_null($_POST['reg'])) {
            $reg = $_POST['reg'];
        }

        $action->deleteKey($key, $reg);
    }
}
