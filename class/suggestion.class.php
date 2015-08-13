
<?php 

    require_once 'helper.class.php';

/**
* Sugestões
*/
class Sugestao extends Helper
{

    private $arq = "archives/sugestao.list";
    private $urlItem = "../suggestion.php";

    public function loadSugestao() {
        $sugestao = parent::ManipulateArchive($this->arq, 'r');
        return $sugestao;
    }

    public function addSugestao( $titulo, $descricao, $nome ) {
        $sugestao = parent::ManipulateArchive($this->arq, 'r');
        array_push($sugestao, Array('data'=>date('d/m/Y G:i:s'), 'titulo'=>$titulo,'descricao'=>$descricao, 'nome'=>$nome,'curtida'=>0));
        $sugestao = json_encode($sugestao,JSON_UNESCAPED_SLASHES);
        parent::ManipulateArchive($this->arq, 'w', $sugestao);

        header('location:'.$this->urlItem);
    }

    public function deleteSugestao( $vKey ) {
        $sugestao = parent::ManipulateArchive($this->arq, 'r');
        unset($sugestao[$vKey]);
        $i = 0;
        foreach($sugestao as $key => $value) {
            if( $key > $i ) {
                $sugestao[$i] = $value;
                unset($sugestao[$key]);
            }
            $i++;
        }
        $sugestao = json_encode($sugestao,JSON_UNESCAPED_SLASHES);
        parent::ManipulateArchive($this->arq, 'w', $sugestao);
        header('location:'.$this->urlItem);
    }

    public function likeSugestao( $vKey ) {
        $sugestao = parent::ManipulateArchive($this->arq, 'r');
        $like = $sugestao[$vKey]['curtida'];
        $sugestao[$vKey]['curtida'] = $like+1;
        $sugestao = json_encode($sugestao,JSON_UNESCAPED_SLASHES);
        parent::ManipulateArchive($this->arq, 'w', $sugestao);

        header('location:'.$this->urlItem);

    }
}

?>