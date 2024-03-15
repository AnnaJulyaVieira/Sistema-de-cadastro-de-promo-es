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

    $sql = "DELETE FROM promocoes WHERE id = ?"; // Consulta SQL para excluir a promoção com o ID fornecido
    $stmt = $conexao->prepare($sql); // Prepara a consulta SQL
    $stmt->bind_param("i", $id); // Faz o binding do parâmetro ID à consulta

    if ($stmt->execute()) { // Executa a consulta preparada
        header("Location: promocoes.php"); // Redireciona para a página "promocoes.php" após excluir a promoção com sucesso
    } else {
        echo "Erro ao excluir a promoção: " . $stmt->error; // Mensagem de erro se houver problema ao excluir a promoção
    }

    $conexao->close(); // Fecha a conexão com o banco de dados
}
?>
