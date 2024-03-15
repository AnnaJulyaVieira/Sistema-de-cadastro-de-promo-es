<!DOCTYPE html> <!-- Declaração do tipo de documento HTML -->

<link rel="stylesheet" href="estilo.css"> <!-- Importa um arquivo de estilo CSS chamado "estilo.css" -->
<link rel="stylesheet" href="reset.css"> <!-- Importa um arquivo de estilo CSS chamado "reset.css" -->

<html> <!-- Início do elemento HTML -->
<head> <!-- Início da seção do cabeçalho -->
    <title>Promoções Exclusivas</title> <!-- Título da página -->

</head>
<body> <!-- Início do corpo da página -->

  <header> <!-- Início do cabeçalho da página -->
        <div class="logo"> <!-- Div para o logotipo -->
            <strong class="logo2">VITA4U</strong> <!-- Texto do logotipo -->
        </div>
        <nav> <!-- Início da navegação -->
            <ul> <!-- Lista não ordenada -->
                <li><a href="#">Entregado</a></li> <!-- Item da lista com um link para "Entregado" -->
                <li><a href="#">Restaurante</a></li> <!-- Item da lista com um link para "Restaurante" -->
                <li><a href="#">Usuário</a></li> <!-- Item da lista com um link para "Usuário" -->
                <li><a href="#">Home</a></li> <!-- Item da lista com um link para "Home" -->
                <li><a href="#">Contato</a></li> <!-- Item da lista com um link para "Contato" -->
                <span class="icons"> <!-- Elemento de span com classe "icons" -->
                <a href="#"><img src="carrinho.png" alt="Carrinho"></a> <!-- Link com uma imagem de carrinho -->
                <a href="#"><img src="usuario.png" alt="Usuário"></a> <!-- Link com uma imagem de usuário -->
                <span> <!-- Elemento de span -->

            </ul> <!-- Fim da lista não ordenada -->


        </nav> <!-- Fim da navegação -->
       
    </header> <!-- Fim do cabeçalho -->


    <h1 class="texto">Promoções Exclusivas do Restaurante</h1> <!-- Título principal da página -->

    <div class="cadastro"> <!-- Div para o formulário de cadastro -->
    <form action="processar_promocao.php" method="POST"> <!-- Formulário com método de envio POST e ação para "processar_promocao.php" -->
        <label for="nome">Nome da Promoção:</label> <!-- Rótulo para o campo de entrada "nome" -->
        <input type="text" id="nome" name="nome" required><br> <!-- Campo de entrada para o nome da promoção -->

        <label for="descricao">Descrição da Promoção:</label> <!-- Rótulo para o campo de entrada "descricao" -->
        <textarea id="descricao" name="descricao" required></textarea><br> <!-- Campo de entrada para a descrição da promoção -->

        <label for="data_inicio">Data de Início:</label> <!-- Rótulo para o campo de entrada "data_inicio" -->
        <input type="date" id="data_inicio" name="data_inicio" required><br> <!-- Campo de entrada para a data de início -->

        <label for="data_fim">Data de Término:</label> <!-- Rótulo para o campo de entrada "data_fim" -->
        <input type="date" id="data_fim" name="data_fim" required><br> <!-- Campo de entrada para a data de término -->

        <label for="desconto">Desconto:</label> <!-- Rótulo para o campo de entrada "desconto" -->
        <input type="number" id="desconto" name="desconto" step="0.01" required> %<br> <!-- Campo de entrada para o desconto -->

        <input type="submit" value="Adicionar Promoção"> <!-- Botão de envio do formulário -->
    </form> <!-- Fim do formulário -->
    </div> <!-- Fim da div de cadastro -->


    <?php
    $servidor = "localhost"; // Nome do servidor do banco de dados
	$usuario = "root"; // Nome de usuário do banco de dados
	$senha = ""; // Senha do banco de dados
	$dbname = "vita4u"; // Nome do banco de dados
	
	$conexao = mysqli_connect($servidor, $usuario, $senha, $dbname); // Conecta ao banco de dados MySQL

    if ($conexao->connect_error) { // Verifica se houve erro na conexão
        die("Erro na conexão: " . $conexao->connect_error); // Mostra mensagem de erro e encerra o script
    }

    $sql = "SELECT * FROM promocoes"; // Consulta SQL para selecionar todas as promoções
    $result = $conexao->query($sql); // Executa a consulta

    if ($result->num_rows > 0) { // Verifica se há linhas retornadas na consulta
        echo "<h2>Promoções Existentes:</h2>"; // Imprime o cabeçalho das promoções existentes
        echo "<ul>"; // Início de uma lista não ordenada
        while ($row = $result->fetch_assoc()) { // Loop pelas linhas retornadas pela consulta
            echo "<li>"; // Início de um item da lista
            echo "Nome: " . $row["nome"] . "<br>"; // Imprime o nome da promoção
            echo "Descrição: " . $row["descricao"] . "<br>"; // Imprime a descrição da promoção
            echo "Data de Início: " . $row["data_inicio"] . "<br>"; // Imprime a data de início da promoção
            echo "Data de Término: " . $row["data_fim"] . "<br>"; // Imprime a data de término da promoção
            echo "Desconto: " . $row["desconto"] . "%<br>"; // Imprime o desconto da promoção
            echo "<a href='editar_promocao.php?id=" . $row["id"] . "'>Editar</a> | "; // Link para editar a promoção
            echo "<a href='excluir_promocao.php?id=" . $row["id"] . "'>Excluir</a>"; // Link para excluir a promoção
            echo "</li>"; // Fim do item da lista
        }
        echo "</ul>"; // Fim da lista
    } else {
        echo "Nenhuma promoção encontrada."; // Mensagem se não houver promoções
    }
   
    $conexao->close(); // Fecha a conexão com o banco de dados
    ?>
</body> <!-- Fim do corpo da página -->
</html> <!-- Fim do elemento HTML -->
