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
      <a href="item.php" class="item">Ítem</a>
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

        <div class="ui message">


                <?php 

                    include "class/suggestion.class.php";

                    $sugestao = new Sugestao;
                    $sugestoes = $sugestao->loadSugestao();
                    $divider = "<div class=\"ui divider\"></div>";

                    if( count($sugestoes) == 0 ) {
                        echo 'Ainda não posui nenhuma sugestão. <br>Escreva abaixo a primeira sugestão.';
                    } else
                    foreach ($sugestoes as $key => $value) {
                    if( count($sugestoes) == ($key+1) )
                        $divider = '';

                        
                    echo "  <div class=\"ui comments\">
                                <div class=\"comment\">
                                    <a class=\"avatar\">
                                        <i class=\"comments outline big icon\"></i>
                                    </a>
                                    <div class=\"content\">
                                        <a class=\"author\">{$value['nome']}</a>
                                        <div class=\"metadata\">
                                            <div class=\"date\">{$value['data']}</div>";
                                    if( $value['curtida'] > 0 ) {
                                        $people = "pessoa gostou";
                                        if( $value['curtida'] > 1 )
                                            $people = "pessoas gostaram";
                                    echo "  <div class=\"rating\">
                                                <i class=\"thumbs up icon\"></i>
                                                {$value['curtida']} {$people}
                                            </div>";
                                    }
                                    echo "</div>
                                        <div class=\"text\">{$value['descricao']}</div>
                                        <div class=\"actions buttons\">
                                            <form action=\"action/action.suggestion.php\" method=\"POST\">
                                                <input type=\"hidden\" name=\"key\" value=\"{$key}\">
                                                <input type=\"hidden\" name=\"tipo\" value=\"like\">
                                                <button class=\"ui basic mini button\">
                                                <a class=\"like\">Like</a>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {$divider}";

                    }

                ?>
        </div>
        <div class="ui attached message">
            <p class="header">Deixe abaixo sua Sugestão</p>
            <div class="content">
                <form class="ui form attached fluid segment" action="action/action.suggestion.php" method="POST">
                    <input type="hidden" name="tipo" value="add">
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>Nome</label>
                                <input name="nome" placeholder="Insira seu nome" type="text">
                            </div>
                        </div>
                        <div class="field">
                            <label>Descrição</label>
                            <textarea name="descricao" placeholder="Insira a descrição" rows="2"></textarea>
                        </div>
                    </div>
                    <button class="ui blue labeled icon button" tabindex="0">
                        <i class="checkmark box icon"></i>
                        Gravar
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>