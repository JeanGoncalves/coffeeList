<?php 

    error_reporting(0);

    include_once 'class/header.class.php';
    include_once 'class/menu.class.php';
?>

<!DOCTYPE html>
<html>
<head>
    <?php new Header('Sugestão'); ?>
</head>
<body>
    <?php new Menu('sugestoes'); ?>
    
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
                                <label>Título</label>
                                <input name="nome" class="validate" data-error="Insira um título para sugestão." placeholder="Insira seu nome" type="text">
                            </div>
                        </div>
                        <div class="field">
                            <label>Descrição</label>
                            <textarea name="descricao" class="validate" data-error="insira a descrição para a sugestão." placeholder="Insira a descrição" rows="2"></textarea>
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