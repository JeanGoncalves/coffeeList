<?php

/**
* Helper
*/
class Helper
{
    public function varDump($obj)
    {
        echo '<div class="ui red message">';
        echo '<pre>'.print_r($obj, 1).'</pre>';
        echo '</div>';
        die('<hr>Finish Vardump');
    }

    /**
     * Manipula o arquivo, lendo ou escrevendo de acordo com o tipo que for passado
     * @param STRING $archive Localização do arquivo
     * @param STRING $type    Tipo de manipulação do arquivo.(r,w)
     * @param STRING $string  Caso seja tipo w(escrita) o que vier dessa variável que será escrito no arquivo
     */
    public function ManipulateArchive($archive, $type, $string = null)
    {
        $read = array();
        if (file_exists('archives/')) {
            if (!file_exists($archive)) {
                self::createArchive($archive);
            }
        } elseif (file_exists('../archives/')) {
            $archive = '../'.$archive;
            if (!file_exists($archive)) {
                self::createArchive($archive);
            }
        }

        $list = fopen($archive, $type) or die("Não foi possivel carregar o arquivo <strong>$archive</strong>. Tipo: <strong>$type</strong>");
        if ($type == 'r') {
            $read = fread($list, filesize($archive));
            $read = json_decode($read, 1);
        } elseif ($type == 'w') {
            fwrite($list, $string);
        }

        fclose($list);
        return !empty($read) ? $read : [];
    }

    private function createArchive($archive)
    {
        $arq = fopen($archive, 'x+');
        fwrite($arq, json_encode([]));
        fclose($arq);
    }

    public function verifyAmbiance()
    {
        $response = false;
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $response = true;
        }
        return $response;
    }
}
