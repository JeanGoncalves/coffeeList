<?php 

	include 'action.class.php';
	
	$action = new Action;
	if( $_POST ) {

		if( $_POST['tipo'] == 'home' ) {
			$key = $_POST['key'];
			$nome = $_POST['nome'];
			$item = $_POST['item'];

			$obj = Array("Nome" => $nome, "Item" => $item);

			$action->editList( $key, $obj );
		} else if( $_POST['tipo'] == 'lista' ) {
			$data = $_POST['data'];

			$action->createList( $data );
		}
	}

?>