<?php
    session_start();

    if(empty($_POST) or (empty($_POST["email"]) or (empty($_POST["senha"])))){
        echo "deu pau";
    } else {
    include("config.php");

    $senha = $_POST["senha"];
    $email = $_POST["email"];

    $sql = "select * from usuario where email = '{$email}' and senha = '{$senha}'";

    $res = $conn->query($sql) or die($conn->error); 
    $row = $res->fetch_object();
    $qtd = $res->num_rows;
    $chc = $res->fetch_assoc();

    $sqlH = "select * from usuario where email = '{$email}'";
    $resH = $conn->query($sqlH) or die($conn->error);
    $rowH = $resH->fetch_object();
    $senha_hash = $rowH->senha;
    echo var_dump($senha_hash);

    if(password_verify($senha, $senha_hash) == true){
        $_SESSION["senha"] = $senha_hash;
        $_SESSION["email"] = $rowH->email;
        $_SESSION["id_us"] = $rowH->id_us;
        print "<script>alert('Funcionou o cript')</script>";
        print"<script>location.href='painel.php'</script>";
    } else if($qtd > 0){
        $_SESSION["senha"] = $senha;
        $_SESSION["email"] = $row->email;
        $_SESSION["id_us"] = $row->id_us;
        print "<script>alert('Atenção: Por razões de segurança de sua privacidade, é de suma importância que você atualize sua senha')</script>";
        print "<script> location.href='edicao_senha.php' </script>";
        
    } else {
        echo "Ahh mano";
       // print "<script> location.href='index.php' </script>";
        
    }
    
    }
?>