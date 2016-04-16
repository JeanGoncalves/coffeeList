<?php

include '../class/tipo.class.php';

$tipo = new Tipo;
if ($_POST) {
    if ($_POST['tipo'] == 'add') {
        $nome = $_POST['nome'];
        $type = $_POST['type'];
        $tipo->addTipo($nome, $type);
    } elseif ($_POST['tipo'] == 'del') {
        $key = $_POST['key'];

        $tipo->deleteTipo($key);
    }
}
