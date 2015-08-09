<?php 

require_once 'helper.class.php';

class Item extends Helper
{
	private $arq = 'archives/itens.list';

	public function loadItens() {
		$read = parent::ManipulateArchive($this->arq, 'r');
		return $read;
	}

	public function listSelect() {
        $itens = self::loadItens();
		echo "<option>Selecione</option>";
		foreach ($itens as $value) {
			echo "<option value='{$value[Item]}'>{$value[Item]}</option>";
		}
	}
}

?>