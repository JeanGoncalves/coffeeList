<?php 

/**
* Menu
*/
class Menu
{

    private $menus = Array(
                        Array('nome'=>'inicio','title'=>'Início','href'=>'index.php'),
                        Array('nome'=>'lista','title'=>'Lista','href'=>'list.php'),
                        Array('nome'=>'item','title'=>'Item','href'=>'item.php'),
                        Array('nome'=>'tipo','title'=>'Tipo','href'=>'type.php'),
                        Array('nome'=>'sugestoes','title'=>'Sugestões','href'=>'suggestion.php'),
                        Array('nome'=>'sobre','title'=>'Sobre','href'=>'sobre.php','align'=>'right')
                        );
    
    private $title;
    private $menuLeft;
    private $menuRight;

    function __construct( $title ) {
        $this->title = $title;
        self::init();
    }

    private function init() {
        echo '<div class="ui secondary pointing menu">';
        self::logo();
        self::menu();
        echo '</div>';
    }

    private function logo() {
        echo '<div class="item">
                    <div class="ui relaxed divided list">
                        <div class="item">
                            <i class="large food middle aligned icon"></i>
                            <div class="content">
                                <a class="header">AgênciaSys</a>
                                <div class="description">Lista do Café</div>
                            </div>
                        </div>
                    </div>
                </div>';
    }

    private function menu() {
        foreach ($this->menus as $value) {
            $active = '';
            if( $value['nome'] == $this->title )
                $active = ' active';
            if( $value['align'] == 'right' )
                $this->menuRight .= '<a href="'.$value['href'].'" class="item'.$active.'">'.$value['title'].'</a>';
            else
                $this->menuLeft .= '<a href="'.$value['href'].'" class="item'.$active.'">'.$value['title'].'</a>';
        }
        echo $this->menuLeft;
        echo '<div class="right menu">'.$this->menuRight.'</div>';
    }
}