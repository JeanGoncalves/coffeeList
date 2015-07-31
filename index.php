<!DOCTYPE html>
<html>
<head>
	<title>Coffee List | AgênciaSys</title>
	<meta charset="utf-8">

	<!-- SEMANTIC UI -->
	<link rel="stylesheet" type="text/css" href="semantic-ui/dist/semantic.min.css">
	<script src="semantic-ui/dist/semantic.min.js"></script>

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
	  <a class="item">Lista</a>
	  <a class="item">Ítem</a>
	  <a class="item">Histórico</a>
	</div>

	<div class="ui container">
		<div class="ui icon attached message">
			<i class="file text outline icon"></i>
			<div class="content">
				<div class="header">
					Já marcou na lista o que vai trazer para o café de sexta-feira (31/07)?
				</div>
				<p>Marque abaixo seu nome e o que vai trazer para o café. <i class="thumbs outline up icon"></i></p>
			</div>
		</div>
		<form class="ui form attached fluid segment" method="get">
			<div class="field">
				<div class="two fields">
					<div class="field">
						<label>Nome</label>
						<input name="nome" placeholder="Insira seu nome" type="text">
					</div>
					<div class="field">
						<label>Ítem</label>
						<select class="ui dropdown" name="item">
							<option value="">Selecione</option>
							<option value="1">Pão</option>
							<option value="2">Café</option>
							<option value="3">Presunto</option>
							<option value="4">Queijo</option>
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
					<tr>
						<td>
							<h4 class="ui header">
								<a class="ui red circular label">A</a>
								<div class="content">
									Ana <small>Maria</small>
								</div>
							</h4>
						</td>
						<td>Pão</td>
					</tr>
					<tr>
						<td>
							<h4 class="ui header">
								<a class="ui green circular label">J</a>
								<div class="content">
									João <small>Paulo</small>
								</div>
							</h4>
						</td>
						<td>Presunto</td>
					</tr>
					<tr>
						<td>
							<h4 class="ui header">
								<a class="ui blue circular label">M</a>
								<div class="content">
									Marcelo <small>Augusto</small>
								</div>
							</h4>
						</td>
						<td>Queijo</td>
					</tr>
			  </tbody>
			</table>
		</div>
	</div>

</body>
</html>