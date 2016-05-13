<?php

/**
* Header
*/
class Header
{
    public function __construct($type)
    {
        self::setTitle($type);
        self::getCharset();
        self::getMobileView();
        self::getJquery();
        self::getMaskedin();
        self::getSemanticUi();
        self::getValidation();
        self::getStyle();

        if ($type == 'Início') {
            self::getInicio();
        }
        if ($type == 'Sugestão') {
            self::getSuggestion();
        }
    }

    private function setTitle($title)
    {
        echo "<title>$title | AgênciaSys</title>";
    }

    private function getCharset()
    {
        echo '<meta Content-type: text/html; charset="utf-8">';
    }

    private function getMobileView()
    {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    }

    private function getJquery()
    {
        echo '<script type="text/javascript" src="maskedinput/jquery-1.11.3.min.js"></script>';
    }

    private function getMaskedin()
    {
        echo '<script type="text/javascript" src="maskedinput/jquery.maskedinput.min.js"></script>';
    }


    private function getSemanticUi()
    {
        echo '<link rel="stylesheet" type="text/css" href="Semantic-UI/dist/semantic.min.css">';
        echo '<script src="Semantic-UI/dist/semantic.min.js"></script>';
    }

    private function getValidation()
    {
        echo '<script type="text/javascript" src="js/validation.js"></script>';
    }

    private function getInicio()
    {
        echo '<script type="text/javascript" src="js/index.js"></script>';
    }

    private function getSuggestion()
    {
        echo '<script type="text/javascript" src="js/suggestion.js"></script>';
    }

    private function getStyle()
    {
        echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
    }
}
