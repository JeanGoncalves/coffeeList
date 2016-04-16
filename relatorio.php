<?php
    include_once 'class/header.class.php';
    include_once 'class/menu.class.php';
    include_once 'class/script.class.php';
    include_once 'class/tipo.class.php';
    include_once 'class/item.class.php';
?>
<!DOCTYPE html>
<html>
<head>
    <?php new Header('Relatório'); ?>
</head>
<body>
    <?php new Menu('relatorio'); ?>

    <div class="ui container">
        <div class="ui icon attached message">
            <i class="file text outline icon"></i>
            <div class="content">
                <div class="header">
                    Relatório
                </div>
                <p>Relatório sobre as listas e os produtos</p>
            </div>
        </div>

        <?php
            $script = new Script;
            $tipo = new Tipo;
            $item = new Item;
        ?>

        <div class="ui message">
            <?php
                if ($_GET) {
                    $listOrd = array();

                    $listKey = null;
                    // Agrupa os itens iguais somando a quantidade
                    foreach ($script->getList() as $key => $list) {
                        if ($list['Data'] == $_GET['list']) {
                            $listKey = $key;
                            foreach ($list['lista'] as $key => $registro) {
                                $indice = array_search($registro['Item'], array_column($listOrd, 'item'));
                                if ($indice !== false) {
                                    array_push($listOrd[$indice]['pessoas'], $registro['Nome']);
                                    $listOrd[$indice]['qtd'] += $registro['qtd'];
                                } else {
                                    array_push($listOrd, array('item'=>$registro['Item'], 'qtd'=>$registro['qtd'], 'tipo'=>$registro['type'], 'pessoas'=>array($registro['Nome'])));
                                }
                            }
                        }
                    }

                    // Insere os itens que ninguem selecionou
                    foreach ($item->loadItens() as $value) {
                        $indice = array_search($value['Item'], array_column($listOrd, 'item'));
                        if ($indice === false) {
                            array_push($listOrd, array('item'=>$value['Item'], 'qtd'=>'0', 'tipo'=>$value['Tipo']));
                        }
                    }

                    // cria os itens que vão entrar no container
                    function createItem($key, $item)
                    {
                        $popup = '';
                        if (isset($item['pessoas'])) {
                            $popup = implode(' | ', $item['pessoas']);
                        }
                        $number = '';
                        if (isset($item['qtd']) && $item['qtd'] != '') {
                            $number = '<div class="ui circular horizontal label">'.$item['qtd'].$item['tipo'].'</div>';
                        }
                        return '<a data-html="'.$popup.'" href="index.php?key='.$key.'&item='.urlencode($item['nome']).'" class="item popup">'.$number.$item['nome'].'</a>';
                    }

                    // Cria o container com o tipo e os itens de cada tipo
                    function createContainer($container)
                    {
                        return '<div class="column"><div class="ui raised segment"><a class="ui '.$container['color'].' ribbon label">'.$container['nome'].'</a>
                                <div class="ui selection list">'.$container['itens'].'<div class="ui divider"></div>'.$container['itensNull'].'</div></div></div>';
                    }

                    // Cria o container com os itens separados por tipo
                    $arrContainer = null;
                    foreach ($tipo->loadTipos() as $itemTipo) {
                        $arrItem = null;
                        $arrItemNull = null;
                        foreach ($listOrd as $item) {
                            if ($item['tipo'] == strtolower($itemTipo['type']) && $item['qtd'] != '0') {
                                $arrItem .= createItem($listKey, array('nome'=>$item['item'], 'qtd'=>$item['qtd'], 'tipo'=>$itemTipo['type'], 'pessoas'=>$item['pessoas']));
                            } elseif ($item['tipo'] == strtolower($itemTipo['type']) && $item['qtd'] == '0') {
                                $arrItemNull .= createItem($listKey, array('nome'=>$item['item'], 'tipo'=>$itemTipo['type']));
                            }
                        }
                        $arrContainer .= createContainer(array('color'=>'red', 'nome'=>$itemTipo['nome'], 'itens'=>$arrItem, 'itensNull'=>$arrItemNull));
                    }
                }
            ?>

            <div class="ui grid">
                <div class="four wide column">
                <div class="header">Listas</div>
                    <div class="ui secondary vertical pointing menu">
                    <?php

                    foreach ($script->getList() as $value) {
                        $active = '';
                        if (isset($_GET['list']) && $_GET['list'] == $value['Data']) {
                            $active = 'active';
                        }
                        echo '<a class="item '.$active.'" href="?list='.$value['Data'].'">'.$value['Data'].'</a>';
                    }
                    ?>
                    </div>
                </div>
                <div class="twelve wide column">
                    <div class="header"><?php echo isset($_GET['list']) ? $_GET['list'] : ''; ?></div>
                    <br>
                    <div class="ui three column grid">
                        <?php echo isset($arrContainer) ? $arrContainer : ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>