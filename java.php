<?php
// Arquivo onde os dados serão armazenados
$arquivo = "pacientes.json";

// Carrega dados existentes
if (file_exists($arquivo)) {
    $pacientes = json_decode(file_get_contents($arquivo), true);
} else {
    $pacientes = [];
}

// Se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Novo paciente
    $novoPaciente = [
        "id" => $_POST["id"],
        "nome" => $_POST["nome"],
        "idade" => $_POST["idade"],
        "imc" => $_POST["imc"],
        "sistolica" => $_POST["sistolica"]
    ];

    // Adiciona ao array
    $pacientes[] = $novoPaciente;

    // Salva no arquivo JSON
    file_put_contents($arquivo, json_encode($pacientes, JSON_PRETTY_PRINT));

    // Evita reenvio do formulário
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🏥 Monitoramento de Pacientes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <h1>Sistema de Monitoramento de Pacientes</h1>
        
        <form method="POST" action="">
            <h2>Registro de Dados</h2>
            <div>
                <label for="id">ID do Paciente:</label>
                <input type="text" id="id" name="id" required>
            </div>
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div>
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" min="0" required>
            </div>
            <div>
                <label for="imc">IMC (Índice de Massa Corporal):</label>
                <input type="number" id="imc" name="imc" step="0.1" required>
            </div>
            <div>
                <label for="sistolica">Pressão Sistólica (mmHg):</label>
                <input type="number" id="sistolica" name="sistolica" min="50" required>
            </div>
            <button type="submit">Adicionar Paciente</button>
        </form>

        <hr>

        <h2>Pacientes Monitorados</h2>

        <table id="patientTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>IMC</th>
                    <th>Pressão Sistólica</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pacientes as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p["id"]) ?></td>
                        <td><?= htmlspecialchars($p["nome"]) ?></td>
                        <td><?= htmlspecialchars($p["idade"]) ?></td>
                        <td><?= htmlspecialchars($p["imc"]) ?></td>
                        <td><?= htmlspecialchars($p["sistolica"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
