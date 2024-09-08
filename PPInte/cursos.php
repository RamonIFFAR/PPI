<?php 
    require("config.php");

    session_start();

    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    $sql = "select * from usuario inner join setor where usuario.senha = '{$_SESSION["senha"]}' and setor.id_set = '{$_SESSION["id_us"]}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $qtd = $res->num_rows;

    $sqlCurso = "select * from curso";
    $Cres = $conn->query($sqlCurso);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE</title>
</head>
<body>
    <button onclick="location.href='painel.php?sair=1'" name='sair'>sair</button> <br>
    <?php

        while ($Crow = $Cres->fetch_object()){
            echo "<br><img src='".$Crow->foto."'alt='foto curso' width='80' height='80'><br>";
            echo "<br> Nome do curso: " . $Crow->nome . "<br>";
            echo "<a href='curso.php?id=" . $Crow->id_curso ."'>Ver detalhes<a> <br>";
            echo "<a href='turmas.php?id=". $Crow->id_curso ."'>Ver turmas <a> <br>";
        }

    ?>
    
</body>
</html>