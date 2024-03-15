<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verifica se a requisição HTTP foi feita com o método POST
   
    $nome = $_POST["nome"]; // Obtém o nome da promoção enviado via formulário
    $descricao = $_POST["descricao"]; // Obtém a descrição da promoção enviado via formulário
    $data_inicio = $_POST["data_inicio"]; // Obtém a data de início da promoção enviado via formulário
    $data_fim = $_POST["data_fim"]; // Obtém a data de término da promoção enviado via formulário
    $desconto = $_POST["desconto"]; // Obtém o desconto da promoção enviado via formulário

    $servidor = "localhost"; // Nome do servidor do banco de dados
	$usuario = "root"; // Nome de usuário do banco de dados
	$senha = ""; // Senha do banco de dados
	$dbname = "vita4u"; // Nome do banco de dados
	
	//Criar a conexao
	$conexao = mysqli_connect($servidor, $usuario, $senha, $dbname); // Conecta ao banco de dados MySQL
   
 
    if ($conexao->connect_error) { // Verifica se houve erro na conexão
        die("Erro na conexão: " . $conexao->connect_error); // Mostra mensagem de erro e encerra o script
    }

   
    $sql = "INSERT INTO promocoes (nome, descricao, data_inicio, data_fim, desconto) VALUES (?, ?, ?, ?, ?)"; // Consulta SQL para inserir os dados da nova promoção
    $stmt = $conexao->prepare($sql); // Prepara a consulta SQL
    $stmt->bind_param("ssssd", $nome, $descricao, $data_inicio, $data_fim, $desconto); // Faz o binding dos parâmetros à consulta

    if ($stmt->execute()) { // Executa a consulta preparada
        header("Location: promocoes.php"); // Redireciona para a página "promocoes.php" após adicionar a promoção com sucesso
    } else {
        echo "Erro ao adicionar a promoção: " . $stmt->error; // Mensagem de erro se houver problema ao adicionar a promoção
    }

    
    $conexao->close(); // Fecha a conexão com o banco de dados
}
?>
