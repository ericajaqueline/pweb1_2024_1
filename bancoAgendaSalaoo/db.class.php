<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $port = "3306";
    private $dbname ="bancoagendasalaoo";
    private $conn;

    // Conectar ao banco de dados
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }

   

//     $db = new db();
//     $db->conn();

// // Exemplo de execução de uma consulta
// $sql = "SELECT * FROM servicos";
// $stmt = $conn->query($sql);

// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     echo $row['nome_servico'] . "<br>";
// }

// $db->close();

}




?>



