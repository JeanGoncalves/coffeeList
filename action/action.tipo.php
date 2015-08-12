<?php 

	include '../class/tipo.class.php';
	
	$tipo = new Tipo;
	if( $_POST ) {

		if( $_POST['tipo'] == 'add' ) {
			$nome = $_POST['nome'];

			$tipo->addTipo( $nome );
		}
		else if( $_POST['tipo'] == 'del' ) {
			$key = $_POST['key'];

			$tipo->deleteTipo( $key );
		}

	}
?>