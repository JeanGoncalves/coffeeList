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

        <div class="ui message">
            <p>
                Na empresa Softers | AgênciaSys, toda a sexta-feira é iniciada com um belo café corporativo, onde todos ajudam comprando os itens que compôem este café.
                E funcionava com uma lista de papel sendo passada por cada funcionário todo dia anterior. Visando a economia de papel e a melhor elaboração do café, foi criada a idéia de 
                ter um sistema capaz de fazer.
            </p>
            <div class="ui special cards">
              <div class="card">
                <div class="blurring dimmable image">
                  <div class="ui dimmer">
                    <div class="content">
                      <div class="center">
                        <div class="ui inverted button">Add Friend</div>
                      </div>
                    </div>
                  </div>
                  <img src="/images/avatar/large/elliot.jpg">
                </div>
                <div class="content">
                  <a class="header">Team Fu</a>
                  <div class="meta">
                    <span class="date">Create in Sep 2014</span>
                  </div>
                </div>
                <div class="extra content">
                  <a>
                    <i class="users icon"></i>
                    2 Members
                  </a>
                </div>
              </div>
              <div class="card">
                <div class="blurring dimmable image">
                  <div class="ui inverted dimmer">
                    <div class="content">
                      <div class="center">
                        <div class="ui primary button">Add Friend</div>
                      </div>
                    </div>
                  </div>
                  <img src="/images/avatar/large/jenny.jpg">
                </div>
                <div class="content">
                  <a class="header">Team Hess</a>
                  <div class="meta">
                    <span class="date">Create in Aug 2014</span>
                  </div>
                </div>
                <div class="extra content">
                  <a>
                    <i class="users icon"></i>
                    2 Members
                  </a>
                </div>
              </div>
            </div>
        </div>
    </div>


</body>
</html>