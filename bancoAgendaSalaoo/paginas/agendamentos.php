<h2>Cadastrar Agendamento</h2>
<form method="POST" action="salvar_agendamento.php">
    <label>Nome do Cliente:</label>
    <input type="text" name="nome_cliente" required><br>
    <label>Telefone do Cliente:</label>
    <input type="text" name="telefone_cliente"><br>
    <label>Data do Agendamento:</label>
    <input type="date" name="data_agendamento" required><br>
    <label>Horário do Agendamento:</label>
    <input type="time" name="horario_agendamento" required><br>
    <label>Serviço:</label>
    <select name="id_servico" required>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM servicos");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['nome_servico'] . "</option>";
        }
        ?>
    </select><br>
    <button type="submit" name="salvar">Salvar</button>
</form>


<h2>Listar Agendamentos</h2>
<form method="POST" action="">
    <input type="text" name="campo_busca" placeholder="Buscar por nome do cliente, telefone...">
    <button type="submit" name="buscar">Buscar</button>
</form>

<?php
$sql = "SELECT agendamentos.*, servicos.nome_servico FROM agendamentos JOIN servicos ON agendamentos.id_servico = servicos.id";
if (isset($_POST['buscar'])) {
    $busca = $_POST['campo_busca'];
    $sql .= " WHERE nome_cliente LIKE '%$busca%' OR telefone_cliente LIKE '%$busca%'";
}
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "Nome do Cliente: " . $row['nome_cliente'] . "<br>";
    echo "Telefone do Cliente: " . $row['telefone_cliente'] . "<br>";
    echo "Data do Agendamento: " . $row['data_agendamento'] . "<br>";
    echo "Horario do Agendamento: " . $row['horario_agendamento'] . "<br>";
    echo "Serviço: " . $row['nome_servico'] . "<br>";
    echo "<a href='editar_agendamento.php?id=" . $row['id'] . "'>Editar</a> | ";
    echo "<a href='deletar_agendamento.php?id=" . $row['id'] . "'>Deletar</a><br><br>";
}
?>

<h2>Editar Agendamento</h2>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM agendamentos WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<form method="POST" action="atualizar_agendamento.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label>Nome do Cliente:</label>
    <input type="text" name="nome_cliente" value="<?php echo $row['nome_cliente']; ?>" required><br>
    <label>Telefone do Cliente:</label>
    <input type="text" name="telefone_cliente" value="<?php echo $row['telefone_cliente']; ?>"><br>
    <label>Data e Hora do Agendamento:</label>
    <input type="datetime-local" name="data_agendamento" value="<?php echo date('Y-m-d\TH:i', strtotime($row['data_agendamento'])); ?>" required
