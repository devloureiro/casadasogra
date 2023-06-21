<?php 
// Incluir o arquivo da classe de conexão
require_once 'src/Class/Conection.php';

// Configurar as informações de conexão
$host = 'localhost:3306'; //lembrando que para quem usa mac tem que colocar a porta do mysql
$username = 'root';
$password = '';
$database = 'casa_da_sogra';

// Instanciar a classe de conexão
$db = new DatabaseConnection($host, $username, $password, $database);

// Estabelecer a conexão
$conn = $db->connect();

// Verificar se a conexão foi estabelecida com sucesso
if ($conn) {
    try {
        // Executar uma consulta na tabela "vagas"
        $query = "SELECT * FROM vagas";
        $result = $conn->query($query);

        // Verificar se a consulta retornou resultados
        if ($result->rowCount() > 0) {
            // Loop pelos resultados e exibir os dados
            while ($row = $result->fetch()) {
                echo "ID: " . $row['id_vagas'] . "<br>";
                echo "Titulo vaga: " . $row['titulo_vaga'] . "<br>";
                // Exibir outros campos da tabela, se houver
                echo "<br>";
            }
        } else {
            echo "Nenhum resultado encontrado.";
        }
    } catch (PDOException $e) {
        echo "Erro na consulta: " . $e->getMessage();
    }

    // Fechar a conexão quando não for mais necessária
    $db->closeConnection();
} else {
    // Tratar caso a conexão não possa ser estabelecida
    echo "Erro na conexão com o banco de dados.";
}
?>