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
}

?>