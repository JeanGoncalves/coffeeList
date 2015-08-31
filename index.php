<?php  
    include_once 'class/header.class.php';
    include_once 'class/menu.class.php';
	include_once 'class/action.class.php';
	
	$key = null;
	if( isset($_GET['key']) )
		$key = $_GET['key'];

	$item = null;
	if( isset($_GET['item']) )
		$item = urldecode($_GET['item']);

	$action = new Action;
	$return = $action->getDate( $key );
	$date = $return['date'];
	$key = $return['key'];
?>
<!DOCTYPE html>
<html>
<head>
    <?php new Header('Início'); ?>
</head>
<body>
    <?php new Menu('inicio'); ?>

	<?php if( $date ) { ?>
	<div class="ui container">
		<div class="ui icon attached message">
			<i class="file text outline icon"></i>
			<div class="content">
				<div class="header">
					Já marcou na lista o que vai trazer para o café do dia <?= $date ?>?
				</div>
				<p>Marque abaixo seu nome e o que vai trazer para o café. <i class="thumbs outline up icon"></i></p>
			</div>
		</div>
		<form class="ui form attached fluid segment" method="POST" action="action/action.list.php">
            <input type="hidden" id="data" value="<?= $date ?>">
            <input type="hidden" name="tipo" value="home">
            <input type="hidden" name="key" value="<?= $key ?>">
			<div class="field">
				<div class="two fields">
					<div class="field seven wide column">
						<label>Nome</label>
						<input name="nome" autofocus placeholder="Insira seu nome" class="validate" data-error="Insira seu nome." type="text">
					</div>
					<div class="field">
						<div class="ui grid">
							<div class="twelve field wide column">
								
								<label>Ítem</label>
								<div class="ui selection search dropdown">
									<input name="item" type="hidden" class="validate" data-error="Selecione um item." id="item" value="<?php echo $item; ?>">
									<i class="dropdown icon"></i>
									<div class="default text">Selecione</div>
									<div class="menu">
										<?php 

											include "class/item.class.php";

											$list = new Action;
											$itens = new Item;
											$item = $itens->loadItens();
											foreach ($item as $value) {
												$select = '';
												if( $item == $value['Item'] )
													$select = 'active selected';
												echo "<div class='item $selected' id='{$value['Tipo']}' data-value='{$value['Item']}'>";
												echo "<span class='text'>{$value['Item']}</span>";
												$names = $list->getNameItem( $key, $value['Item'] );
												foreach ($names as $name) {
													echo "<span class='description'>{$name}</span>";
												}
												echo "</div>";
												
											}
											
										?>
								  	</div>
								</div>
							</div>
							<div class="four wide field column disabled" id="componentQtd">
								
								<?php 

									include 'class/tipo.class.php';

									$tipos = new Tipo;
									$first = $tipos->firstTipo();
								?>
								<label>Quantidade</label>
								<div class="ui right labeled input" id="labelQtd">
									<input name="qtd" type="text" id="inputQtd" class="inputQtd validate" data-error="Insira a quantidade." disabled>
									<input type="hidden" class="type" name="type">
									<div class="ui label"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ui grid">
			  <div class="six wide column">
					<button class="ui blue labeled icon button" tabindex="0">
						<i class="checkmark box icon"></i>
						Vou trazer
					</button>
			  </div>
			  <div class="ten wide column">
					<div class="ui small icon yellow message hidden" id="notificationMessage">
					<i class="icon idea"></i>
					  Este item ja tem na lista e normalmente não passa dessa quantidade.Que tal trocar este item pelo Café?
					</div>
			  </div>
	    	</div>
		</form>

		<div class="ui message">
			<table class="ui blue striped table">
				<thead>
				    <tr>
				    	<th class="six wide">Nome</th>
				    	<th class="ten wide">Ítem</th>
				    	<th class="two wide"></th>
					</tr>
				</thead>
				<tbody>
				<?php 

					$list = $action->loadList( $key );
					foreach ($list as $reg => $value) {
						echo "	<tr>
									<td>
										<a class=\"ui {$action->getColor()} large circular label\">{$value['Letra']}</a>
										{$value['Nome']}
										<small>{$value['Sobrenome']}</small></td>
									<td>{$value['qtd']} {$value['type']} de {$value['Item']}</td>
									<td>
                                        <form action=\"action/action.list.php\" method=\"POST\">
                                            <input type=\"hidden\" name=\"tipo\" value=\"del\">
                                            <input type=\"hidden\" name=\"key\" value=\"{$key}\">
                                            <input type=\"hidden\" name=\"reg\" value=\"{$reg}\">
                                            <button class=\"ui red icon button\">
                                                <i class=\"trash icon\"></i>
                                            </button>
                                        </form>
									</td>
								</tr>";
					}

				?>
			  </tbody>
			</table>
		</div>
	</div>
	<?php } else { ?>

		<div class="ui container">
			<div class="ui icon attached message">
			<i class="calendar icon"></i>
			<div class="content">
				<div class="header">
					Não tem nenhuma lista adiante.
				</div>
				<p>Quer criar uma lista nova? Basta clicar no menu <strong>Lista</strong> ou <a href="list.php">Clique aqui</a>. <i class="thumbs outline up icon"></i></p>
			</div>
		</div>
		</div>

	<?php } ?>
</body>
</html>