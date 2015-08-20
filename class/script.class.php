<?php 

require_once 'helper.class.php';
require_once 'item.class.php';

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

    public function getList( $param ) {
        $list = $this->lista;
        switch ($param) {
            case 'count':
                    return self::Count($list);
                break;
            case 'indices':
                    return self::Indices($list[0]);
            default:
                    return $list[0];
                break;
        }
    }

    private function Count($arr) {
        return count($arr);
    }

    private function Indices($arr) {
        return array_keys($arr);
    }

    private function getItens() {

        $response = Array();
        foreach ($this->lista as $key => $value) {
            foreach ($value['lista'] as $item) {
                array_push($response,Array('item' => $item['Item'], 'quantidade'=> $item['qtd'], 'lista'=>$key));
            }
        }
        return $response;
    }

    public function getQtdList( $data, $item ) {
        $lista = $this->lista;
        $keyList = -1;
        $cont = 0;
        foreach ($lista as $key => $list) {
            if( $list['Data'] == $data )
                $keyList = $key;
        }

        if( $keyList == -1 )
            return 0;
        else{
            foreach ($lista[$keyList]['lista'] as $value) {
                if( $value['Item'] == $item )
                    $cont = $value['qtd'] + $cont;
            }
            return $cont;
        }

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

    public function randomItem( $data ) {
        while($data) {
            $item = new Item;
            $item = $item->loadItens();
            $response = Array();
            foreach ($item as $value) {
                array_push($response,$value["Item"]);
            }
            $cont = count($response)-1;
            $select = $response[rand(0,$cont)];
            $media = self::getMediaItem($select);
            $qtdList = self::getQtdList( $data, $select );
            if( $media['med'] > $qtdList )
                return $select;
            else if( empty($media) && $qtdList == 0 )
                return $select;
        }
    }
}

?>