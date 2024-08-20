<?php 
    require("config.php");

    session_start();

    $sql = "select * from usuario inner join setor where usuario.senha = '{$_SESSION["senha"]}' and setor.id_set = '{$_SESSION["id_us"]}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $qtd = $res->num_rows;
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SGAE</title>
            </head>
            <body>
                <?php 
                    if ($qtd > 0) {
                        echo "<a href='professores.php'>Professores</a> <br>";
                        echo "<a href='disciplinas.php'>Disciplinas</a> <br>"; // Ainda não funciona
                    }
                ?>
                <a href="turmas.php">Turmas<a/> <br> <!-- ***Ainda não funciona*** -->
                <a href="alunos.php">Alunos<a/> <br> <!-- ***Ainda não funciona*** -->
            </body>
            </html>

        <?php
?>

