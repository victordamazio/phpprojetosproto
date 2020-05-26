<!-- || -->

<?php include('server.php'); // Incluí o arquivo server.php como parte do index.php

	if (isset($_GET['edit'])) { // Se a variável edit estiver definida
		$id = $_GET['edit']; // pegar o id que vai ser editado
		$edit_state = true; // Variável que define que é hora de editar é verdadeira
		$rec = mysqli_query($db, "SELECT * FROM projetos1 WHERE projeto_id=$id"); // Seleciona no banco de dados só o ID do projeto a ser editado
		$record = mysqli_fetch_array($rec); // Salva numa matriz
		$nome = $record['projeto_nome']; // Salva as variaveis corretamente
		$ident = $record['projeto_identificacao'];
		$just = $record['projeto_justificativa'];
		$eixo = $record['projeto_eixo'];
		$id = $record['projeto_id'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Projetos do Smart Campus Facens num Banco de Dados SQL</title>
	<link rel="stylesheet" type="text/css" href="style.css"> <!-- Link para o arquivo css -->
</head>
<body>

	<?php if (isset($_SESSION['msg'])): ?>
		<div class="msg">
			<?php
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			?>
		</div>
	<?php endif ?> <!-- Mensagem ao usuário ao fazer alguma transação -->

	<table>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Identificação</th>
				<th>Justificativa</th>
				<th>Eixo</th>
				<th colspan="4">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($results)) { ?> <!-- Tabela local preenchida com os dados do banco -->
				<tr>					

					<td><?php echo $row['projeto_nome'] ?></td>
					<td><?php echo $row['projeto_identificacao'] ?></td>
					<td><?php echo $row['projeto_justificativa'] ?></td>
					<td><?php echo $row['projeto_eixo'] ?></td>

					<td>
						<a class="edit_btn" href="index.php?edit=<?php echo $row['projeto_id']; ?>">Edit</a> <!-- Botão de editar --> 
					</td>
					<td>
						<a class="del_btn" href="server.php?del=<?php echo $row['projeto_id']; ?>">Delete</a> <!-- Botão de deletar --> 
					</td>
				</tr>
			<?php } ?>			
		</tbody>
	</table>

	<form method="post" action="server.php">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>Nome</label>
			<input type="text" name="nome" value="<?php echo $nome; ?>">
		</div>
		<div class="input-group">
			<label>Identificação</label>
			<input type="text" name="ident" value="<?php echo $ident; ?>">
		</div>
		<div class="input-group">
			<label>Justificativa</label>
			<input type="text" name="just" value="<?php echo $just; ?>">
		</div>
		<div class="input-group">
			<label>Eixo</label>
			<input type="text" name="eixo" value="<?php echo $eixo; ?>">
		</div>
		<div class="input-group">
		<?php if ($edit_state == false): ?> <!-- Se o estado de edição for falso, o botão é o de Save, caso seja verdadeiro, temos o botão de Update --> 
			<button type="submit" name="save" class="btn">Save</button>
		<?php else: ?>
			<button type="submit" name="update" class="btn">Update</button>
		<?php endif ?>

		</div>
	</form>

</body>
</html>