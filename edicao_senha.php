<?php 
    require("config.php");

    session_start();

    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    if(isset($_REQUEST['atSenha'])){
        atualizarSenha($_POST['id'], $_POST['senha'], $_POST['senha2']);
    }

    function atualizarSenha($id, $senha1, $senha2){
        similar_text($senha1, $senha2, $percent);
        if($percent == 100){
            include('config.php');
            $SQLat = "update usuario set senha= '{$senha1}' where id_us = '{$id}'";
            $SQLexe = $conn->query($SQLat);
            echo "<script> alert('Senha alterada com sucesso!') </script>";
        } else{
            echo "<script>alert('As duas senhas não correspondem')</script>";
        }
        echo "<script>location.href='perfil.php'</script>";
    }

    $sql = "SELECT * FROM usuario WHERE senha = '{$_SESSION["senha"]}' and email = '{$_SESSION["email"]}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $qtd = $res->num_rows;

    if($qtd > 0){

    } else{
        print"<script> location.href='painel.php' </script>";
    }

    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar senha</title>
    <form method='POST' action=''>
        <input type='hidden' name='id' value='<?php echo $row->id_us ?>'>
        <label>Insira sua senha</label>
        <input type='password' name='senha'>
        <label>Insira sua senha novamente</label>
        <input type='password' name='senha2'>
        <button type='submit' name='atSenha'>atualizar</button>
    </form>
</head>
<body>
    
</body>
</html>