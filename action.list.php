<?php 

	include 'action.class.php';
	
	if( $_POST ) {

		$nome = $_POST['nome'];
		$item = $_POST['item'];

		$obj = Array("Nome" => $nome, "Item" => $item);

		$action = new Action;
		$action->editList( $obj );
	}

?>