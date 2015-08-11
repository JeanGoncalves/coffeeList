<?php 

require_once 'helper.class.php';

class Item extends Helper
{
	private $arq = "archives/itens.list";
	private $urlItem = "item.php";

	public function loadItens() {
		$itens = parent::ManipulateArchive($this->arq, 'r');
		return $itens;
	}

	public function listSelect() {
        $itens = self::loadItens();
		echo "<option>Selecione</option>";
		foreach ($itens as $value) {
			echo "<option value='{$value[Item]}'>{$value[Item]}</option>";
		}
	}

	public function addItem( $nome ) {
		$itens = parent::ManipulateArchive($this->arq, 'r');
		array_push($itens, Array('Item'=>$nome));
		$itens = json_encode($itens,JSON_UNESCAPED_SLASHES);
		parent::ManipulateArchive($this->arq, 'w', $itens);
		header('location:'.$this->urlItem);
	}

	public function deleteItem( $vKey ) {
		$itens = parent::ManipulateArchive($this->arq, 'r');
		unset($itens[$vKey]);
		$i = 0;
		foreach($itens as $key => $value) {
			if( $key > $i ) {
				$itens[$i] = $value;
				unset($itens[$key]);
			}
			$i++;
		}
		$itens = json_encode($itens,JSON_UNESCAPED_SLASHES);
		parent::ManipulateArchive($this->arq, 'w', $itens);
		header('location:'.$this->urlItem);
	}
}

?>