<?php 

class Item
{
	private $arq = 'archives/itens.list';

	public function loadItens() {
		$list = fopen( $this->arq,'r' ) or die( "Itens não encontrada." );
		$read = fread( $list, filesize( $this->arq ) );
		$read = json_decode( $read, 1 );
		return $read;
	}

	public function listSelect() {
        $itens = self::loadItens();
		echo "<option>Selecione</option>";
		foreach ($itens as $value) {
			echo "<option value='{$value->Item}'>{$value->Item}</option>";
		}
	}

    public function varDump( $obj ) {
        echo '<div class="ui red message">';
        echo '<pre>'.print_r($obj,1).'</pre>';
        echo '</div>';
    }
}

?>