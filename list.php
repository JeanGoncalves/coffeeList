<?php
include_once 'class/header.class.php';
include_once 'class/menu.class.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php new Header('Lista'); ?>
    </head>
    <body>
        <?php new Menu('lista'); ?>
        <div class="ui container">
            <div class="ui icon attached message">
                <i class="file text outline icon"></i>
                <div class="content">
                    <div class="header">
                        Lista
                    </div>
                    <p>Listas de café</p>
                </div>
            </div>
            <form class="ui form attached fluid segment" method="POST" action="action/action.list.php">
                <input type="hidden" name="tipo" value="lista">
                <div class="six fields">
                    <div class="field">
                        <label>Data</label>
                        <div class="ui icon input">
                            <input name="data" id="data" class="validate" data-error="Insira uma data." type="text">
                            <i class="calendar icon"></i>
                        </div>
                    </div>
                </div>
                <button class="ui blue labeled icon button" tabindex="0">
                <i class="checkmark box icon"></i>
                Criar Lista
                </button>
            </form>
            <div class="ui message">
                <table class="ui blue selectable striped table">
                    <thead>
                        <tr>
                            <th class="six wide">Data</th>
                            <th class="ten wide">Quantidade de pessoas que preencheram a lista</th>
                            <th class="two wide"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'class/action.class.php';
                        $action = new Action;
                        $list = $action->getLists();
                        foreach ($list as $key => $value) { ?>
                            <tr>
                                <td>
                                    <a href="index.php?key=<?= $value['key']; ?>"><?= $value['data'] ?></a>
                                </td>
                                <td>
                                    <a href="index.php?key=<?= $value['key']; ?>"><?= $value['qtd'] ?></a>
                                </td>
                                <td>
                                    <form action="action/action.list.php" method="POST">
                                        <input type="hidden" name="tipo" value="del">
                                        <input type="hidden" name="key" value="<?= $value['key'] ?>">
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
        <script type="text/javascript">
        $(function() {
            $('#data').mask("99/99/9999",{placeholder:"DD/MM/AAAA"});
        });
        </script>
    </body>
</html>