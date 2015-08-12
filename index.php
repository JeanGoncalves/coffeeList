<?php  
	include 'class/action.class.php';

	$key = null;
	if( isset($_GET['key']) )
		$key = $_GET['key'];

	$action = new Action;
	$date = $action->getDate( $key );
?>
<!DOCTYPE html>
<html>
<head>
	<title>Coffee List | AgênciaSys</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- SEMANTIC UI -->
    <script type="text/javascript" src="maskedinput/jquery-1.11.3.min.js"></script>
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
	  <a class="item active">Início</a>
	  <a href="list.php" class="item">Lista</a>
	  <a href="item.php" class="item">Ítem</a>
	  <a href="type.php" class="item">Tipo</a>
	</div>

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
            <input type="hidden" name="tipo" value="home">
            <input type="hidden" name="key" value="<?= $key ?>">
			<div class="field">
				<div class="two fields">
					<div class="field seven wide column">
						<label>Nome</label>
						<input name="nome" placeholder="Insira seu nome" type="text">
					</div>
					<div class="field">
						<div class="ui grid">
							<div class="twelve field wide column">
								
								<label>Ítem</label>
								<select class="ui dropdown" name="item">
								<?php 

									include "class/item.class.php";

									$itens = new Item;
									$itens->listSelect();
									
								?>
								</select>

							</div>
							<div class="four wide field column">
								
								<label>Quantidade</label>
								<div class="ui right labeled input">
									<input name="qtd" type="text">
									<div class="ui dropdown label">
									<input type="hidden" name="type">
										<div class="text">Lt</div>
										<i class="dropdown icon"></i>
										<div class="menu">
											<?php 

												include 'class/tipo.class.php';

												$tipos = new Tipo;
												$arr = $tipos->loadTipos();
												foreach ($arr as $value) {
													echo "<div class='item'>".$value['qtd']."</div>";
												}
											?>
										</div>

									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<button class="ui blue labeled icon button" tabindex="0">
				<i class="checkmark box icon"></i>
				Vou trazer
			</button>
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
										<a class=\"ui {$action->getColor()} large circular label\">{$value[Letra]}</a>
										{$value[Nome]}
										<small>{$value[Sobrenome]}</small></td>
									<td>{$value['qtd']}{$value['type']} {$value[Item]}</td>
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
	<script type="text/javascript">
	$(document).ready(function() {
		$('.ui .dropdown').dropdown();
	})
	</script>

</body>
</html>