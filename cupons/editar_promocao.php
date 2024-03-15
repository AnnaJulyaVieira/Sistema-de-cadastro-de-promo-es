<?php
if (isset($_GET["id"])) { // Verifica se o parâmetro "id" foi passado via URL
    $id = $_GET["id"]; // Obtém o valor do parâmetro "id" da URL

    $servidor = "localhost"; // Nome do servidor do banco de dados
	$usuario = "root"; // Nome de usuário do banco de dados
	$senha = ""; // Senha do banco de dados
	$dbname = "vita4u"; // Nome do banco de dados
	
	$conexao = mysqli_connect($servidor, $usuario, $senha, $dbname); // Conecta ao banco de dados MySQL

    if ($conexao->connect_error) { // Verifica se houve erro na conexão
        die("Erro na conexão: " . $conexao->connect_error); // Mostra mensagem de erro e encerra o script
    }

    $sql = "SELECT * FROM promocoes WHERE id = ?"; // Consulta SQL para selecionar a promoção com o ID fornecido
    $stmt = $conexao->prepare($sql); // Prepara a consulta SQL
    $stmt->bind_param("i", $id); // Faz o binding do parâmetro ID à consulta

    if ($stmt->execute()) { // Executa a consulta preparada
        $result = $stmt->get_result(); // Obtém o resultado da consulta
        if ($result->num_rows === 1) { // Verifica se foi retornada exatamente uma linha
            $row = $result->fetch_assoc(); // Obtém os dados da promoção
        } else {
            echo "Promoção não encontrada."; // Mensagem se a promoção não for encontrada
            exit; // Encerra o script
        }
    } else {
        echo "Erro ao recuperar dados da promoção: " . $stmt->error; // Mensagem de erro se houver problema na execução da consulta
        exit; // Encerra o script
    }

    $conexao->close(); // Fecha a conexão com o banco de dados
}
?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="edita.css"> <!-- Importa um arquivo de estilo CSS chamado "edita.css" -->
<head>
    <title>Editar Promoção</title> <!-- Título da página -->
</head>
<body>
    <h1>Editar Promoção</h1> <!-- Título principal da página -->
    <form action="processar_edicao.php" method="POST"> <!-- Formulário para editar a promoção, com método de envio POST e ação para "processar_edicao.php" -->
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!-- Campo oculto para enviar o ID da promoção -->
        
        <label for="nome">Nome da Promoção:</label> <!-- Rótulo para o campo de entrada "nome" -->
        <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required><br><br> <!-- Campo de entrada para o nome da promoção, com o valor pré-preenchido com o nome atual da promoção -->
        
        <label for="descricao">Descrição da Promoção:</label> <!-- Rótulo para o campo de entrada "descricao" -->
        <textarea id="descricao" name="descricao" required><?php echo $row['descricao']; ?></textarea><br><br> <!-- Campo de entrada para a descrição da promoção, com o valor pré-preenchido com a descrição atual da promoção -->
        
        <label for="data_inicio">Data de Início:</label> <!-- Rótulo para o campo de entrada "data_inicio" -->
        <input type="date" id="data_inicio" name="data_inicio" value="<?php echo $row['data_inicio']; ?>" required><br><br> <!-- Campo de entrada para a data de início da promoção, com o valor pré-preenchido com a data atual da promoção -->
        
        <label for="data_fim">Data de Término:</label> <!-- Rótulo para o campo de entrada "data_fim" -->
        <input type="date" id="data_fim" name="data_fim" value="<?php echo $row['data_fim']; ?>" required><br><br> <!-- Campo de entrada para a data de término da promoção, com o valor pré-preenchido com a data atual da promoção -->
        
        <label for="desconto">Desconto:</label> <!-- Rótulo para o campo de entrada "desconto" -->
        <input type="number" id="desconto" name="desconto" step="0.01" value="<?php echo $row['desconto']; ?>" required> %<br><br> <!-- Campo de entrada para o desconto da promoção, com o valor pré-preenchido com o desconto atual da promoção -->
        
        <input type="submit" value="Editar Promoção"> <!-- Botão de envio do formulário para editar a promoção -->
    </form> <!-- Fim do formulário -->
</body>
</html> <!-- Fim do elemento HTML -->
