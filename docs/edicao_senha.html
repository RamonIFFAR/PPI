<?php 

    /*
    *
    * CORRIGIDOOOOOOOOOOOOOOO
    * 
    */
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
            $hashed_password = password_hash($senha1, PASSWORD_DEFAULT);
            $SQLat = "update usuario set senha= '{$hashed_password}' where id_us = '{$id}'";
            $SQLexe = $conn->query($SQLat);
            echo "<script> alert('Senha alterada com sucesso!') </script>";
            $_SESSION['senha'] = $hashed_password;
        } else{
            echo "<script>alert('As duas senhas não correspondem')</script>";
        }
        echo "<script>location.href='edicao_perfil.php'</script>";
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
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="edicao_senhacss.css?v=<?php echo time(); ?>">
</head>
<body class='Fundo'>
    <div class="Background1"></div>
        <form method='POST' action=''>
            <h1>Mudar Senha</h1>
            <div class="ConfigurarTurmas">
                <input type='hidden' name='id' value='<?php echo $row->id_us ?>'>
                <label>Insira sua senha:</label>
                <input type='password' name='senha' required>
            </div>
            <div class="ConfigurarTurmas2">
                <label>Insira sua senha novamente:</label>
                <input type='password' name='senha2' required>
            </div>
            <button type='submit' name='atSenha'>Atualizar</button>
            <a href="edicao_perfil.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
