<?php 
    include_once 'class/header.class.php';
    include_once 'class/menu.class.php';
?>

<!DOCTYPE html>
<html>
<head>
    <?php new Header('Tipo'); ?>
</head>
<body>
    
    <?php new Menu('tipo'); ?>

    <div class="ui container">
        <div class="ui icon attached message">
            <i class="file text outline icon"></i>
            <div class="content">
                <div class="header">
                    Tipos
                </div>
                <p>Tipos de quantidades para os Ítens</p>
            </div>
        </div>
        <form class="ui form attached fluid segment" method="POST" action="action/action.tipo.php">
            <input type="hidden" name="tipo" value="add">
            <div class="six fields">
                <div class="field">
                    <label>Tipo</label>
                    <div class="ui icon input">
                        <input name="nome" id="nome" class="validate" data-error="Insira um tipo." type="text">
                    </div>
                </div>
            </div>
            <button class="ui blue labeled icon button" tabindex="0">
                <i class="checkmark box icon"></i>
                Criar Tipo
            </button>
        </form>

        <div class="ui message">
            <table class="ui blue striped table">
                <thead>
                    <tr>
                        <th class="six wide center aligned">Nome</th>
                        <th class="six wide center aligned"></th>
                    </tr>
                </thead>
                <tbody>
                <?php 

                    include 'class/tipo.class.php';

                    $tipo = new Tipo;
                    $list = $tipo->loadTipos();

                    foreach ($list as $key => $value) {
                        echo "  <tr>
                                    <td class='center aligned'>{$value['type']}</td>
                                    <td class='right aligned'>
                                        <form action=\"action/action.tipo.php\" method=\"POST\">
                                            <input type=\"hidden\" name=\"tipo\" value=\"del\">
                                            <input type=\"hidden\" name=\"key\" value=\"{$key}\">
                                            <button class=\"ui red icon button\">
                                                <i class=\"trash icon\"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>";
                    }

                ?>
              </tbody>
            </table>
        </div>
    </div>

</body>
</html>