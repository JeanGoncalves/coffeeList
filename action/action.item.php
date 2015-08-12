<?php 

	include '../class/item.class.php';

	$item = new Item;
	if( $_POST ) {

		if( $_POST['tipo'] == 'add' ) {
			$nome = $_POST['nome'];

			$item->addItem( $nome );
		} else if( $_POST['tipo'] == 'del' ) {
			$key = $_POST['key'];

			$item->deleteItem( $key );
		}

	}

?>