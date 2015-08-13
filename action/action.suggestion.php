<?php 

    include '../class/suggestion.class.php';
    
    $sugestao = new Sugestao;
    if( $_POST ) {

        if( $_POST['tipo'] == 'add' ) {
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $nome = $_POST['nome'];

            $sugestao->addSugestao( $titulo, $descricao, $nome );
        }
        else if( $_POST['tipo'] == 'del' ) {
            $key = $_POST['key'];

            $sugestao->deleteSugestao( $key );
        }
        else if( $_POST['tipo'] == 'like' ) {
            $key = $_POST['key'];

            $sugestao->likeSugestao( $key );
        }

    }
?>