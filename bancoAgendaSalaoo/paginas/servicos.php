<h2>Cadastrar Serviço</h2>
<form method="POST" action="salvar_servico.php">
    <label>Nome do Serviço:</label>
    <input type="text" name="nome_servico" required><br>
    <label>Descrição:</label>
    <textarea name="descricao"></textarea><br>
    <label>Preço:</label>
    <input type="text" name="preco" required><br>
    <button type="submit" name="salvar">Salvar</button>
</form>

<h2>Listar Serviços</h2>
<form method="POST" action="">
    <input type="text" name="campo_busca" placeholder="Buscar por nome, descrição...">
    <button type="submit" name="buscar">Buscar</button>
</form>

<?php
include "./db.class.php";
$sql = "SELECT * FROM servicos";

head();

$db = new db();
$db->conn();


if (isset($_POST['buscar'])) {
    $busca = $_POST['campo_busca'];
    $sql .= " WHERE nome_servico LIKE '%$busca%' OR descricao LIKE '%$busca%'";
}
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "Nome do Serviço: " . $row['nome_servico'] . "<br>";
    echo "Descrição: " . $row['descricao'] . "<br>";
    echo "Preço: " . $row['preco'] . "<br>";
    echo "<a href='editar_servico.php?id=" . $row['id'] . "'>Editar</a> | ";
    echo "<a href='deletar_servico.php?id=" . $row['id'] . "'>Deletar</a><br><br>";
}



?>

<!-- <h2>Editar Serviço</h2>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM servicos WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<form method="POST" action="atualizar_servico.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label>Nome do Serviço:</label>
    <input type="text" name="nome_servico" value="<?php echo $row['nome_servico']; ?>" required><br>
    <label>Descrição:</label>
    <textarea name="descricao"><?php echo $row['descricao']; ?></textarea><br>
    <label>Preço:</label>
    <input type="text" name="preco" value="<?php echo $row['preco']; ?>" required><br>
    <button type="submit" name="atualizar">Atualizar</button>
</form>


<?php
$id = $_GET['id'];
$sql = "DELETE FROM servicos WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    echo "Serviço deletado com sucesso!";
} else {
    echo "Erro ao deletar serviço: " . mysqli_error($conn);
}
?>
<a href="listar_servicos.php">Voltar à listagem</a> -->


