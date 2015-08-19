<?php 
    include_once 'class/header.class.php';
    include_once 'class/menu.class.php';
?>
<!DOCTYPE html>
<html>
<head>
    <?php new Header('Sobre'); ?>
</head>
<body>
    <?php new Menu('sobre'); ?>
    
    <div class="ui container">
        <div class="ui icon attached message">
            <i class="file text outline icon"></i>
            <div class="content">
                <div class="header">
                    Sobre
                </div>
                <p>Sobre a ideia da aplicação</p>
            </div>
        </div>
    </div>


</body>
</html>