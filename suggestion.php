<!DOCTYPE html>
<html>
<head>
    <title>Sugestões | AgênciaSys</title>
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
      <a href="item.php" class="item active">Ítem</a>
      <a href="type.php" class="item">Tipo</a>
      <a class="item active">Sugestões</a>
    </div>

    <div class="ui container">
        <div class="ui icon attached message">
            <i class="file text outline icon"></i>
            <div class="content">
                <div class="header">
                    Sugestões
                </div>
                <p>Esta é a área para que sejam enviadas sugestões para implementação e correção neste projeto de Lista de Café</p>
            </div>
        </div>
        <form class="ui form attached fluid segment" action="action/action.suggestion.php" method="POST">
            <input type="hidden" name="tipo" value="add">
            <div class="field">
                    <div class="field">
                        <label>Título</label>
                        <input name="titulo" placeholder="Insira um titulo" type="text">
                    </div>
                    <div class="field">
                        <label>Descrição</label>
                        <textarea name="descricao" placeholder="Insira a descrição" rows="2"></textarea>
                    </div>
                <div class="two fields">
                    <div class="field">
                        <label>Nome</label>
                        <input name="nome" placeholder="Insira seu nome" type="text">
                    </div>
                </div>
            </div>
            <button class="ui blue labeled icon button" tabindex="0">
                <i class="checkmark box icon"></i>
                Gravar
            </button>
        </form>

        <div class="ui message">
                <?php 

                    include "class/suggestion.class.php";

                    $sugestao = new Sugestao;
                    $sugestoes = $sugestao->loadSugestao();

                    foreach ($sugestoes as $key => $value) {
                        echo "<div class=\"ui info message\">

                                <div class=\"ui items\">
                                    <div class=\"item\">
                                        <div class=\"content\">
                                            <a class=\"header\">{$value['titulo']}</a>
                                            <div class=\"description\">
                                                <p>{$value['descricao']}</p>
                                            </div>
                                            <small>
                                                <div class=\"extra\">
                                                    <i><label>{$value['curtida']}</label> pessoas gostaram</i>
                                                </div><br>
                                                <form action=\"action/action.suggestion.php\" method=\"POST\">
                                                    <input type=\"hidden\" name=\"key\" value=\"{$key}\">
                                                    <input type=\"hidden\" name=\"tipo\" value=\"like\">
                                                    <button class=\"ui blue mini circular thumbs up icon submit button\">
                                                        <i class=\"thumbs up icon\"></i>
                                                    </button>
                                                </form>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                            </div>";
                    }

                ?>
        </div>
    </div>

</body>
</html>