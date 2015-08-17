<?php 

require_once 'helper.class.php';

/**
* script
*/
class Script extends Helper
{
    
    private $lista = Array();
    private $archives = Array(
                            'lista' => 'archives/arquivo.list'
                        );

    function __construct() {
        $this->lista = parent::ManipulateArchive($this->archives['lista'],'r');
    }

    public function getList() {
        parent::varDump($this->lista);
    }

    private function getItens() {

        $response = Array();
        foreach ($this->lista as $value) {
            foreach ($value['lista'] as $item) {
                array_push($response,Array('item' => $item['Item'], 'quantidade'=> $item['qtd']));
            }
        }
        return $response;
    }

    public function getMediaItem( $item ) {
        $itens = self::getItens();

        $response = Array();
        foreach ($itens as $key => $value) {
            $key = self::array_verify($value['item'], $response);
            if( $key != -1 ){
                $response[$key]['qtd'] = $response[$key]['qtd'] + 1;
                $response[$key]['sum'] = $response[$key]['sum'] + $value['quantidade'];
                $response[$key]['med'] = floor($response[$key]['sum'] / $response[$key]['qtd']);
            }
            else
                $response[] = Array('item'=>$value['item'],'sum'=>$value['quantidade'],'qtd'=>1,'med'=>$value['quantidade']);
        }

        foreach ($response as $key => $value) {
            if( $value['item'] == $item )
                return $response[$key];
        }
        return null;
    }

    private function array_verify( $val, $array ) {
        foreach ($array as $key => $value) {
            if( $value['item'] == $val )
                return $key;
        }
        return -1;
    }
}

?>