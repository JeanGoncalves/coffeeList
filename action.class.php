<?php 

require_once 'helper.class.php';

class Action extends Helper
{		
	private $list = 'archives/arquivo.list';
	private $dateNow;
	private $arrayColor = Array("red","orange","yellow","olive","green","teal","blue","violet","purple","pink","brown","grey","black");

	function __construct() {
		$this->dateNow = date('Y-m-d');
	}

	public function loadList( $vKey ) {
		$read = parent::ManipulateArchive($this->list,'r');
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
		$lista = parent::ManipulateArchive($this->list, 'r');
		$key = count($lista);
		$obj = Array('Data'=>$date, 'lista'=> Array());
		array_push( $lista, $obj );
		parent::varDump($lista);
		$lista = json_encode($lista,JSON_UNESCAPED_SLASHES);
		$lista = parent::ManipulateArchive($this->list, 'w', $lista);
		header("location:index.php?key=".$key);

	}

	public function getLists() {
		$response = Array();
		$lists = parent::ManipulateArchive($this->list,'r');
		foreach ($lists as $key => $value) {
			$obj = Array('key'=> $key,'data'=>$value[Data], 'qtd'=>count($value[lista]));
			array_push($response, $obj);
		}
		return $response;
	}

	public function getDate( $vKey ) {
		$read = parent::ManipulateArchive($this->list,'r');
		if( isset( $vKey ) )
			$key = $vKey;
		else
			$key = self::nextList( $read, $key );
		return $read[$key][Data];
	}

	public function editList( $vKey, $obj ) {
		$lista = parent::ManipulateArchive($this->list,'r');
		if( isset( $vKey ) )
			$key = $vKey;
		else
			$key = self::nextList( $read, $key );
		$cont = count($lista[$key][lista]);
		array_push($lista[$key][lista],$obj);
		$lista = json_encode($lista,JSON_UNESCAPED_SLASHES);
		$lista = parent::ManipulateArchive($this->list, 'w', $lista);
		header("location:index.php?key=".$key);
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