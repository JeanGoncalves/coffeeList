<?php 
    include_once 'class/header.class.php';
    include_once 'class/menu.class.php';
    include_once 'class/script.class.php';
?>
<!DOCTYPE html>
<html>
<head>
    <?php new Header('Relatório'); ?>
</head>
<body>
    <?php new Menu('relatorio'); ?>
    
    <div class="ui container">
        <div class="ui icon attached message">
            <i class="file text outline icon"></i>
            <div class="content">
                <div class="header">
                    Relatório
                </div>
                <p>Relatório sobre as listas e os produtos</p>
            </div>
        </div>

        <?php 

            $script = new Script;

            // $script->varDump($script->getList('indices'));

        ?>

        <div class="ui message">
            <div class="ui statistics">
                <div class="statistic">
                    <div class="value"><?php echo $script->getList('count');  ?></div>
                    <div class="label">
                        <div class="ui simple dropdown">
                          <div class="text">Listas</div>
                          <div class="right menu">
                            <div class="item">
                                <i class="dropdown icon"></i>
                                00/00/0000
                                <div class="menu">
                                    <div class="item">3 Itens</div>
                                    <div class="item">1 Item</div>
                                    <div class="item">5 Itens</div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="statistic">
                    <div class="text value">Three<br>Thousand</div>
                    <div class="label">Signups</div>
                </div>
                <div class="statistic">
                    <div class="value"><i class="plane icon"></i> 5</div>
                    <div class="label">Flights</div>
                </div>
                <div class="statistic">
                    <div class="value"><img src="/images/avatar/small/joe.jpg" class="ui circular inline image">42</div>
                    <div class="label">Team Members</div>
                </div> -->
            </div>
        </div>
    </div>

</body>
</html>