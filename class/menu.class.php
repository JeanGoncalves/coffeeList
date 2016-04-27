<?php

/**
* Menu
*/
class Menu
{

    private $menus = array(
                        array('nome'=>'inicio','title'=>'Início','href'=>'index.php'),
                        array('nome'=>'cadastro','title'=>'Cadastro','dropdown'=> array(
                            array('nome'=>'lista','title'=>'Lista','href'=>'list.php'),
                            array('nome'=>'item','title'=>'Item','href'=>'item.php'),
                            array('nome'=>'tipo','title'=>'Tipo','href'=>'type.php'))
                            ),
                        array('nome'=>'relatorio','title'=>'Relatório','href'=>'relatorio.php'),
                        array('nome'=>'sugestoes','title'=>'Sugestões','href'=>'suggestion.php'),
                        array('nome'=>'sobre','title'=>'Sobre','href'=>'sobre.php','align'=>'right')
                        );

    private $title;
    private $menuLeft;
    private $menuRight;

    public function __construct($title)
    {
        $this->title = $title;
        self::init();
    }

    private function init()
    {
        echo '<div class="ui secondary pointing menu">';
        self::logo();
        self::menu();
        echo '</div>';
    }

    private function logo()
    {
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

    private function menu()
    {
        foreach ($this->menus as $value) {
            $active = '';
            if ($value['nome'] == $this->title) {
                $active = ' active';
            }
            if (isset($value['align']) && $value['align'] == 'right') {
                $this->menuRight .= '<a href="'.$value['href'].'" class="item'.$active.'">'.$value['title'].'</a>';
            } else {
                if (isset($value['dropdown'])) {
                    $this->menuLeft .= '<div class="ui dropdown item">'.$value['title'].' <i class="dropdown icon"></i><div class="menu">';
                    foreach ($value['dropdown'] as $drop) {
                        $this->menuLeft .= '<a href="'.$drop['href'].'" class="item'.$active.'">'.$drop['title'].'</a>';
                    }
                    $this->menuLeft .= '</div></div>';
                } else {
                    $this->menuLeft .= '<a href="'.$value['href'].'" class="item'.$active.'">'.$value['title'].'</a>';
                }
            }
        }
        echo $this->menuLeft;
        echo '<div class="right menu">'.$this->menuRight.'</div>';
    }
}
