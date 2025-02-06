<?php
require('config.php');
session_start();


if (isset($_REQUEST['sair'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}


if (!isset($_SESSION['senha'], $_SESSION['email'])) {
    echo "<script>alert('Você precisa estar logado para acessar o sistema'); location.href='index.php';</script>";
    exit();
}

$turma = $_REQUEST['id_turma'] ?? null;

if (!$turma) {
    echo "<script>alert('Turma inválida!'); location.href='index.php';</script>";
    exit();
}


$stmt = $conn->prepare("SELECT * FROM usuario WHERE senha = ? AND email = ?");
$stmt->bind_param("ss", $_SESSION['senha'], $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Você precisa estar logado para acessar o sistema'); location.href='index.php';</script>";
    exit();
}


$stmt = $conn->prepare("SELECT matricula, nome FROM aluno WHERE id_turma = ?");
$stmt->bind_param("i", $turma);
$stmt->execute();
$alunos = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boletim Escolar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        .logo {
            width: 150px;
            height: auto;
        }
        .titulo {
            flex-grow: 1;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .boletim-container {
            margin-top: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <?php while ($aluno = $alunos->fetch_object()): ?>
    <div class="header">
        <div class="titulo">Boletim Escolar</div>
        <img src="Imagens/LogoIffar.png" alt="Logo da Instituição" class="logo">
    </div>

    <div class="boletim-container">
        
            <h2>Aluno: <?= htmlspecialchars($aluno->nome) ?> | Matrícula: <?= htmlspecialchars($aluno->matricula) ?></h2>

            <?php
            $stmt = $conn->prepare("
                SELECT d.nome AS disciplina, a.NOTA1, a.NOTA2, f.faltas 
                FROM disciplina d
                INNER JOIN avaliacao a ON a.id_disc = d.id
                INNER JOIN frequencia f ON f.disciplina = d.id
                WHERE f.matricula = ? AND a.id_aluno = ?
            ");
            $stmt->bind_param("ii", $aluno->matricula, $aluno->matricula);
            $stmt->execute();
            $notas = $stmt->get_result();
            ?>

            <table>
                <tr>
                    <th>Disciplina</th>
                    <th>1º Semestre</th>
                    <th>2º Semestre</th>
                    <th>Faltas</th>
                </tr>
                <?php while ($nota = $notas->fetch_object()): ?>
                    <tr>
                        <td><?= htmlspecialchars($nota->disciplina) ?></td>
                        <td><?= htmlspecialchars($nota->NOTA2) ?></td>
                        <td><?= htmlspecialchars($nota->NOTA1) ?></td>
                        <td><?= htmlspecialchars($nota->faltas) ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>

            <div class="page-break"></div>
        <?php endwhile; ?>
    </div>

</body>
</html>
