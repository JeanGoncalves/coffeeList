<?php 

	include '../class/item.class.php';

	$item = new Item;
	if( $_POST ) {

		if( $_POST['tipo'] == 'add' ) {
			$nome = $_POST['nome'];
			$type = $_POST['type'];

			$item->addItem( $nome, $type );
		} else if( $_POST['tipo'] == 'del' ) {
			$key = $_POST['key'];

			$item->deleteItem( $key );
		}

	}

?>