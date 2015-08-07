<?php  
	include 'action.class.php';

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
	  <a href="history.php" class="item">Histórico</a>
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
		<form class="ui form attached fluid segment" method="POST" action="action.list.php">
			<div class="field">
				<div class="two fields">
					<div class="field">
						<label>Nome</label>
						<input name="nome" placeholder="Insira seu nome" type="text">
					</div>
					<div class="field">
						<label>Ítem</label>
						<select class="ui dropdown" name="item">
						<?php 

							include "item.class.php";

							$itens = new Item;
							$itens->listSelect();

						?>
						</select>
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
					</tr>
				</thead>
				<tbody>
				<?php 

					$list = $action->loadList( $key );
					foreach ($list as $value) {
						$action->listHtml( $value );
					}

				?>
			  </tbody>
			</table>
		</div>
	</div>

</body>
</html>