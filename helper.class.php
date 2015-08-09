<?php 

/**
* Helper
*/
class Helper
{
    public function varDump( $obj ) {
        echo '<div class="ui red message">';
        echo '<pre>'.print_r($obj,1).'</pre>';
        echo '</div>';
    }

    public function ManipulateArchive( $archive, $type, $string = null ) {
    	$list = fopen( $archive,$type ) or die( "Não foi possivel carregar o arquivo ". $archive );
    	if( $type == 'r' ) {
			$read = fread( $list, filesize( $archive ) );
			$read = json_decode( $read,1 );
    	}
		elseif( $type == 'w' ) {
			fwrite($list, $string);
		}
		fclose($list);
		return $read;
    }
}

?>