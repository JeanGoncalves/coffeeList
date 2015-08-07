<!DOCTYPE html>
<html>
<head>
    <title>Lista | AgênciaSys</title>
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
      <a class="item active">Lista</a>
      <a href="item.php" class="item">Ítem</a>
      <a href="history.php" class="item">Histórico</a>
    </div>

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

        <div class="ui message">
            <table class="ui blue striped table">
                <thead>
                    <tr>
                        <th class="six wide">Nome</th>
                        <th class="ten wide">Ítem</th>
                    </tr>
                </thead>
                <tbody>
                <?php 

                    include 'action.class.php';

                    $action = new Action;
                    $list = $action->loadList();

                    foreach ($list as $value) {
                        $action->listHtml( $value );
                    }

                ?>
              </tbody>
            </table>
        </div>
    </div>

</body>
</html>