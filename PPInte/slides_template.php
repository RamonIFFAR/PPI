<?php
require('config.php');
session_start();


if (isset($_REQUEST['sair'])) {
    session_destroy();
    print "<script>location.href='index.php'</script>";
}


$Checagem = "SELECT * FROM usuario WHERE senha = '{$_SESSION['senha']}' AND email= '{$_SESSION['email']}'";
$QChecagem = $conn->query($Checagem);
$procura = $QChecagem->num_rows;

if ($procura == 0) {
    print "<script>alert('Você precisa estar logado para poder acessar o sistema');</script>";
    print "<script>location.href='index.php';</script>";
    exit();
}

$turma = $_REQUEST['id_turma'];


$Baluno = "SELECT *, turma.nome AS turma FROM aluno 
           INNER JOIN turma ON aluno.id_turma = turma.id 
           WHERE turma.id = '{$turma}'";
$Bres = $conn->query($Baluno);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boletim Escolar</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .separator {
            border-top: 3px solid #000;
            margin: 20px 0;
            padding-top: 10px;
        }

      
        .logo {
            position: absolute;
            top: 50px;
            right: 10px;
            width: 150px;
        }

       
        .student-container {
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        
        .student-photo {
            width: 150px;
            height: 150px;
            border: 2px solid black;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
        }

        .student-photo img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body>
    <img src="Imagens/LogoIffar.png" alt="Logo da Instituição" class="logo">

    <?php while ($Brow = $Bres->fetch_object()): ?>
        <div class="separator"></div> 

        <div class="student-container">
            <div class="student-photo">
                <?php if (!empty($Brow->foto)): ?>
                    <img src="<?= htmlspecialchars($Brow->foto) ?>" alt="Foto do Aluno">
                <?php endif; ?>
            </div>

            <div>
                <h2>Aluno: <?= htmlspecialchars($Brow->nome) ?></h2>
                <p><strong>Matrícula:</strong> <?= htmlspecialchars($Brow->matricula) ?></p>
                <p><strong>Telefone:</strong> <?= htmlspecialchars($Brow->telefone) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($Brow->email) ?></p>
                <p><strong>Gênero:</strong> <?= htmlspecialchars($Brow->genero) ?></p>
                <p><strong>Cidade:</strong> <?= htmlspecialchars($Brow->cidade) ?></p>
                <p><strong>Data de Nascimento:</strong> <?= htmlspecialchars($Brow->dataNasc) ?></p>
                <p><strong>Moradia:</strong> <?= htmlspecialchars($Brow->moradia) ?></p>
                <p><strong>Cota:</strong> <?= htmlspecialchars($Brow->cota) ?></p>
                <p><strong>Bolsa:</strong> <?= htmlspecialchars($Brow->bolsa) ?></p>
                <p><strong>Orientador da Mostra Científica:</strong> <?= htmlspecialchars($Brow->orientador) ?></p>
                <p><strong>Reprovações:</strong> <?= htmlspecialchars($Brow->reprovacao) ?></p>
                <p><strong>Equipamento de TI Emprestado:</strong> <?= htmlspecialchars($Brow->equipTI) ?></p>
                <p><strong>Estágio:</strong> <?= htmlspecialchars($Brow->estagio) ?></p>
                <p><strong>Acompanhamento:</strong> <?= htmlspecialchars($Brow->acompanhamento) ?></p>
                <p><strong>Turma:</strong> <?= htmlspecialchars($Brow->turma) ?></p>
            </div>
        </div>

        <div style="page-break-after:always"></div>
    <?php endwhile; ?>
</body>
</html>
