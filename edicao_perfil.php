<?php
    require("config.php");

    session_start();

    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    $sql = "SELECT * FROM usuario WHERE senha = '{$_SESSION["senha"]}' and email = '{$_SESSION["email"]}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $qtd = $res->num_rows;

    function editar($id_us, $nome, $fone){
        include("config.php");
        $SQLatu = "update usuario set nome = '{$nome}', fone = '{$fone}' where id_us = '{$id_us}'";
        $SQLexe = $conn->query($SQLatu);
        echo "<script>location.href='perfil.php'</script>";
    }

    if($qtd > 0){

    } else{
        print"<script> location.href='painel.php' </script>";
    }
    if(isset($_REQUEST['editar'])){
       editar($_POST['id_us'], $_POST['nome'], $_POST['fone']);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE:Editando Perfil</title>
</head>
<body>
    <form method='POST' enctype="multipart/form-data" action="edicao_perfil.php">
        <input type='hidden' name='id_us' value='<?php echo $row->id_us ?>'>
        <label>Nome</label>
        <input type='text' name='nome' value='<?php echo $row->nome?>'>
        <label>Telefone</label>
        <input type='text' name='fone' value='<?php echo $row->fone?>'>
        <button type='submit' name='editar'>Salvar</button>
    </form>
    
</body>
</html>