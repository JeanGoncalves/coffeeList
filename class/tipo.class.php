
<?php

require_once 'helper.class.php';

/**
* Quantidade
*/
class Tipo extends Helper
{

    private $arq = "archives/tipo.list";
    private $urlItem = "../type.php";

    public function loadTipos()
    {
        $tipos = parent::ManipulateArchive($this->arq, 'r');
        return $tipos;
    }

    public function addTipo($nome, $tipo)
    {
        $tipos = parent::ManipulateArchive($this->arq, 'r');
        array_push($tipos, array('nome'=>$nome, 'type'=>$tipo));
        $tipos = json_encode($tipos, JSON_UNESCAPED_SLASHES);
        parent::ManipulateArchive($this->arq, 'w', $tipos);

        header('location:'.$this->urlItem);
    }

    public function firstTipo()
    {
        $tipos = self::loadTipos();
        return isset($tipos[0]['type']) ? $tipos[0]['type'] : '';
    }

    public function deleteTipo($vKey)
    {
        $tipos = parent::ManipulateArchive($this->arq, 'r');
        unset($tipos[$vKey]);
        $position = 0;
        foreach ($tipos as $key => $value) {
            if ($key > $position) {
                $tipos[$position] = $value;
                unset($tipos[$key]);
            }
            $position++;
        }
        $tipos = json_encode($tipos, JSON_UNESCAPED_SLASHES);
        parent::ManipulateArchive($this->arq, 'w', $tipos);
        header('location:'.$this->urlItem);
    }
}
