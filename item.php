<?php
include_once 'class/header.class.php';
include_once 'class/menu.class.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php new Header('Item'); ?>
    </head>
    <body>
        <?php new Menu('item'); ?>
        <div class="ui container">
            <div class="ui icon attached message">
                <i class="file text outline icon"></i>
                <div class="content">
                    <div class="header">
                        Itens
                    </div>
                    <p>Listas dos Itens disponíveis</p>
                </div>
            </div>
            <form class="ui form attached fluid segment" action="action/action.item.php" method="POST">
                <input type="hidden" name="tipo" value="add">
                <div class="field">
                    <div class="three fields">
                        <div class="field">
                            <label>Item</label>
                            <input name="nome" autofocus placeholder="Insira o Item" class="validate" data-error="Insira um item." type="text">
                        </div>
                        <div class="one wide field">
                            <label>Mínimo</label>
                            <input name="minimo" autofocus type="text">
                        </div>
                        <div class="field">
                            <?php
                            include 'class/tipo.class.php';
                            $tipos = new Tipo;
                            $first = $tipos->firstTipo();
                            ?>
                            <label>Tipo</label>
                            <div class="ui dropdown button">
                                <input type="hidden" value="<?= $first ?>" name="type">
                                <span class="text"><?= $first ?></span>
                                <div class="menu">
                                    <?php
                                    $arr = $tipos->loadTipos();
                                    foreach ($arr as $value) { ?>
                                        <div class='item'><?= $value['type'] ?></div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="ui blue labeled icon button" tabindex="0">
                <i class="checkmark box icon"></i>
                Gravar
                </button>
            </form>
            <div class="ui message">
                <table class="ui blue striped table">
                    <thead>
                        <tr>
                            <th class="thirteen wide">Ítem</th>
                            <th class="two wide">Mínimo</th>
                            <th class="three wide">Tipo</th>
                            <th class="two wide"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "class/item.class.php";
                        $itens = new Item;
                        $item = $itens->loadItens();
                        foreach ($item as $key => $value) { ?>
                            <tr>
                                <td><?= $value['Item'] ?></td>
                                <td><?= $value['Minimo'] ?></td>
                                <td><?= $value['Tipo'] ?></td>
                                <td>
                                    <form action="action/action.item.php" method="POST">
                                        <input type="hidden" name="tipo" value="del">
                                        <input type="hidden" name="key" value="<?= $key ?>">
                                        <button class="ui red icon button">
                                        <i class="trash icon"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>