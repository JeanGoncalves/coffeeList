<?php
include_once 'class/header.class.php';
include_once 'class/menu.class.php';

$access = $_GET['access'];

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
                if (count($sugestoes) == 0) {
                    echo 'Ainda não possui nenhuma sugestão. <br>Escreva abaixo a primeira sugestão.';
                } else {
                    foreach ($sugestoes as $key => $value) {
                        if (count($sugestoes) == ($key+1)) {
                            $divider = '';
                        }

                        $people = "pessoa gostou";
                        if ($value['curtida'] > 1) {
                            $people = "pessoas gostaram";
                        }
                        ?>
                        <div class="ui comments">
                            <div class="comment">
                                <a class="avatar">
                                    <i class="comments outline big icon"></i>
                                </a>
                                <div class="content">
                                    <a class="author"><?= $value['nome'] ?></a>
                                    <div class="metadata">
                                        <div class="date"><?= $value['data'] ?></div>
                                        <div class="rating">
                                            <i class="thumbs up icon"></i>
                                            <?= $value['curtida'].' '.$people ?>
                                        </div>
                                    </div>
                                    <?php if (isset($value['concluido']) && $value['concluido']) { ?>
                                        <a class="ui green tag label">Sugestão Realizada</a>
                                    <?php } ?>
                                    <div class="text"><?= $value['descricao'] ?></div>
                                    <div class="actions buttons">
                                        <?php if (!isset($value['concluido']) || $value['concluido'] === false) { ?>
                                            <form action="action/action.suggestion.php" method="POST">
                                                <input type="hidden" name="key" value="<?= $key ?>">
                                                <input type="hidden" name="tipo" value="like">
                                                <button class="ui inverted blue mini button">
                                                    <a class="like">Like</a>
                                                </button>
                                            </form>
                                        <?php } ?>

                                        <?php if ((!isset($value['concluido']) || $value['concluido'] === false) && $access === '8020') { ?>
                                            <form action="action/action.suggestion.php" method="POST">
                                                <input type="hidden" name="key" value="<?= $key ?>">
                                                <input type="hidden" name="tipo" value="conclusion">

                                                    <button class="ui inverted green mini button">
                                                        <a class="conclusion">Concluído</a>
                                                    </button>
                                            </form>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?= $divider ?>
                    <?php
                    }
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