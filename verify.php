<?php 

if( $_POST ) {

	$item = $_POST['item'];
	$data = $_POST['data'];
	$qtd = $_POST['qtd'];

	include 'class/script.class.php';

	$script = new Script;
	$media = $script->getMediaItem($item);
	$qtd2 = $script->getQtdList($data,$item);

	// echo $qtd2.'|'.$media['med'];

	// Primeiro verifica a média de itens comparando com os itens que tem na lista
	$response = Array();
	if( $media['med'] > 0 ) {
		if( $qtd2 >= $media['med'] ) {
			$response = Array('retorno'=>false,'tipo'=>'lista','qtd'=>$qtd2,'med'=>$media['med'],'recomendado'=>$script->randomItem($data));
		} else if( ($qtd2+$qtd) >= $media['med'] ) {
			$response = Array('retorno'=>false,'tipo'=>'item','qtd'=>$qtd2,'med'=>$media['med']);
		} else
			$response = Array('retorno'=>true);
	} else
		$response = Array('retorno'=>true);
	echo json_encode($response);
}