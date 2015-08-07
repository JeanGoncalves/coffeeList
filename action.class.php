<?php 

class Action
{		
	private $list = 'archives/arquivo.list';
	private $dateNow;
	private $arrayColor = Array("red","orange","yellow","olive","green","teal","blue","violet","purple","pink","brown","grey","black");

	function __construct() {
		$this->dateNow = date('Y-m-d');
	}

	public function loadList( $vKey ) {
		$list = fopen( $this->list,'r' ) or die( "Lista não encontrada ao Carregar Lista." );
		$read = fread( $list, filesize( $this->list ) );
		$read = json_decode( $read,1 );
		if( isset( $vKey ) )
			$key = $vKey;
		else
			$key = self::nextList( $read, $key );
		if( $read == -1 )
			echo '<tr><td>Não tem lista futura.</td></tr>';
		$read = self::FirstLetter( $read[$key][lista] );
		fclose( $list );
		return $read;
	}

	public function createList( $date ) {

	}

	public function readList( $date ) {
		$list = fopen( $this->list,'r' ) or die( "Lista não encontrada ao Ler Lista." );
		$read = fread( $list, filesize( $this->list ) );
		$read = json_decode($read,1);
		return $read;
	}

	public function getLists() {
		$response = Array();
		$lists = self::readList();
		foreach ($lists as $key => $value) {
			$obj = Array('key'=> $key,'data'=>$value[Data], 'qtd'=>count($value[lista]));
			array_push($response, $obj);
		}
		return $response;
	}

	public function getDate( $vKey ) {
		$list = fopen( $this->list,'r' ) or die( "Lista não encontrada ao Carregar Lista." );
		$read = fread( $list, filesize( $this->list ) );
		$read = json_decode( $read,1 );
		if( isset( $vKey ) )
			$key = $vKey;
		else
			$key = self::nextList( $read, $key );
		return $read[$key][Data];

	}

	public function editList( $obj ) {
		$lista = self::readList();
		$key = self::nextList( $lista );
		$cont = count($lista[$key][lista]);
		array_push($lista[$key][lista],$obj);
		$lista = json_encode($lista,JSON_UNESCAPED_SLASHES);
		$list = fopen( $this->list,'w' ) or die( "Lista não encontrada ao Editar Lista." );
		fwrite($list, $lista);
		fclose($list);
		header("location:index.php");
	}

	public function listHtml( $obj ) {
		$color = array_rand($this->arrayColor,1);
		echo "	<tr>
					<td>
						<h4 class='ui header'>
							<a class='ui {$this->arrayColor[$color]} circular label'>{$obj[Letra]}</a>
							<div class='content'>
								{$obj[Nome]} <small>{$obj[Sobrenome]}</small>
							</div>
						</h4>
					</td>
					<td>{$obj[Item]}</td>
				</tr>";
	}

	private function nextList( $obj, $vKey ) {
		foreach ($obj as $key => $list) {
			$data = explode('/',$list[Data]);
			$data = $data[2].'-'.$data[1].'-'.$data[0];
			if( self::compareDate( $this->dateNow, $data ) )
				return $key;
		}
		return -1;
	}

	private function compareDate( $now, $date ) {
		if(strtotime($now) > strtotime(date($date)))
			return 0;
		elseif(strtotime($now) <= strtotime(date($date)))
			return 1;
	}

	private function FirstLetter( $obj ) {
		foreach ($obj as $key => $value) {
			$sobrenome = '';
			$nome = explode(' ', $value[Nome]);
			for($i = 1;$i <= count($nome)-1; $i++ )
				$sobrenome .= $nome[$i].' ';
			$obj[$key][Sobrenome] = $sobrenome;
			$obj[$key][Nome] = $nome[0];
			$obj[$key][Letra] = substr($value[Nome],0,1);
		}
		return $obj;
	}
}

?>