<?php

require_once 'helper.class.php';

class Action extends Helper
{
    private $list = "archives/arquivo.list";
    private $dateNow;
    private $arrayColor = array("red","orange","yellow","olive","green","teal","blue","violet","purple","pink","brown","grey","black");
    private $urlIndex = "../index.php";
    private $urlList = "../list.php";

    public function __construct()
    {
        $this->dateNow = date('Y-m-d');
    }

    public function loadList($vKey)
    {
        $read = parent::ManipulateArchive($this->list, 'r');
        if (isset($vKey)) {
            $key = $vKey;
        } else {
            $key = self::nextList($read, $key);
        }
        if ($read == -1) {
            echo '<tr><td>Não tem lista futura.</td></tr>';
        }
        $read = self::FirstLetter($read[$vKey]['lista']);
        if (isset($list)) {
            fclose($list);
        }
        asort($read);
        return $read;
    }

    public function createList($date)
    {
        $lista = parent::ManipulateArchive($this->list, 'r');
        $key = count($lista);
        $obj = array('Data'=>$date, 'lista'=> array());
        array_push($lista, $obj);
        $lista = json_encode($lista, JSON_UNESCAPED_SLASHES);
        $lista = parent::ManipulateArchive($this->list, 'w', $lista);
        header("location:{$this->urlIndex}?key=".$key);
    }

    public function getNameItem($vKey, $item)
    {
        $read = parent::ManipulateArchive($this->list, 'r');
        $read = self::FirstLetter($read[$vKey]['lista']);
        $response = array();
        foreach ($read as $value) {
            if (strtoupper($item) == strtoupper($value['Item'])) {
                array_push($response, $value['Nome']);
            }
        }
        return $response;
    }

    public function getLists()
    {
        $response = array();
        $lists = parent::ManipulateArchive($this->list, 'r');
        foreach ($lists as $key => $value) {
            $obj = array('key'=> $key,'data'=>$value['Data'], 'qtd'=>count($value['lista']));
            array_push($response, $obj);
        }
        return array_reverse($response);
    }

    public function getDate($vKey)
    {
        $read = parent::ManipulateArchive($this->list, 'r');
        if (!isset($vKey) || $vKey === '') {
            $vKey = self::nextList($read);
        }
        if (isset($vKey)) {
            return array('date'=>$read[$vKey]['Data'],'key'=>$vKey);
        }
        return false;
    }

    /*public function getDate( $vKey )
    {
        $read = parent::ManipulateArchive($this->list,'r');
        if( isset( $vKey ) ) {
            $key = $vKey;
        }
        if (isset($key)) {
            $key = self::nextList( $read, $key );
            return array('date'=>$read[$vKey]['Data'],'key'=>$key);
        }
        return false;
    }*/

    public function editList($vKey, $obj)
    {
        $lista = parent::ManipulateArchive($this->list, 'r');
        if (isset($vKey)) {
            $key = $vKey;
        } else {
            $key = self::nextList($lista, $key);
        }
        array_push($lista[$key]['lista'], $obj);
        $lista = json_encode($lista, JSON_UNESCAPED_SLASHES);
        $lista = parent::ManipulateArchive($this->list, 'w', $lista);
        header("location:{$this->urlIndex}?key=".$key);
    }

    public function deleteKey($vKey, $reg = null)
    {
        $lista = parent::ManipulateArchive($this->list, 'r');
        if (isset($vKey)) {
            $key = $vKey;
        } else {
            die('É necessário inserir pelo menos a chave a ser deletada.');
        }

        $i = 0;
        if (!is_null($reg)) {
            unset($lista[$vKey]['lista'][$reg]);
            foreach ($lista[$vKey]['lista'] as $key => $value) {
                if ($key > $i) {
                    $lista[$vKey]['lista'][$i] = $value;
                    unset($lista[$vKey]['lista'][$key]);
                }
                $i++;
            }
            $url = $this->urlIndex."?key=".$vKey;
        } else {
            $cont = (count($lista) - 1);
            unset($lista[$vKey]);
            foreach ($lista as $key => $value) {
                if ($key > $i) {
                    $lista[$i] = $value;
                    unset($lista[$key]);
                }
                $i++;
            }
            $url = $this->urlList;
        }
        $lista = json_encode($lista, JSON_UNESCAPED_SLASHES);
        $lista = parent::ManipulateArchive($this->list, 'w', $lista);
        header("location:".$url);
    }

    public function getColor()
    {
        $color = array_rand($this->arrayColor, 1);
        return $this->arrayColor[$color];
    }

    private function nextList($obj, $vKey = null)
    {
        foreach ($obj as $key => $list) {
            $data = explode('/', $list['Data']);
            $data = $data[2].'-'.$data[1].'-'.$data[0];
            if (self::compareDate($this->dateNow, $data)) {
                return $key;
            }
        }
        return null;
    }

    private function compareDate($now, $date)
    {
        if (strtotime($now) > strtotime(date($date))) {
            return 0;
        } elseif (strtotime($now) <= strtotime(date($date))) {
            return 1;
        }
    }

    private function FirstLetter($obj)
    {
        foreach ($obj as $key => $value) {
            $sobrenome = '';
            $nome = explode(' ', $value['Nome']);
            for ($i = 1;$i <= count($nome)-1; $i++) {
                $sobrenome .= $nome[$i].' ';
            }
            $obj[$key]['Sobrenome'] = $sobrenome;
            $obj[$key]['Nome'] = $nome[0];
            $obj[$key]['Letra'] = strtoupper(substr($value['Nome'], 0, 1));
        }
        return $obj;
    }
}
