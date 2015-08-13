<!DOCTYPE html>
<html>
<head>
    <title>Item | AgênciaSys</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEMANTIC UI -->
    <link rel="stylesheet" type="text/css" href="Semantic-UI/dist/semantic.min.css">
    <script src="Semantic-UI/dist/semantic.min.js"></script>

</head>
<body>
    
    <div class="ui secondary pointing menu">
        <div class="item">
            <div class="ui relaxed divided list">
                <div class="item">
                    <i class="large food middle aligned icon"></i>
                    <div class="content">
                        <a class="header">AgênciaSys</a>
                        <div class="description">Lista do Café</div>
                    </div>
                </div>
            </div>
        </div>
      <a href="index.php" class="item">Início</a>
      <a href="list.php" class="item">Lista</a>
      <a class="item active">Ítem</a>
      <a href="type.php" class="item">Tipo</a>
      <a href="suggestion.php" class="item">Sugestões</a>
    </div>

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
                <div class="two fields">
                    <div class="field">
                        <label>Item</label>
                        <input name="nome" placeholder="Insira o Item" type="text">
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
                        <th class="sixteen wide">Ítem</th>
                        <th class="two wide"></th>
                    </tr>
                </thead>
                <tbody>
                <?php 

                    include "class/item.class.php";

                    $itens = new Item;
                    $item = $itens->loadItens();

                    foreach ($item as $key => $value) {
                        echo "  <tr>
                                    <td>{$value[Item]}</td>
                                    <td>
                                        <form action=\"action/action.item.php\" method=\"POST\">
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