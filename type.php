<!DOCTYPE html>
<html>
<head>
    <title>História | AgênciaSys</title>
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
      <a href="list.php"  class="item">Lista</a>
      <a href="item.php" class="item ">Ítem</a>
      <a class="item active">Tipo</a>
    </div>

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
                        <input name="nome" id="nome" type="text">
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