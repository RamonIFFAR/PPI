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

    if($qtd > 0){
        $_SESSION["senha"] = $senha;
        $_SESSION["email"] = $row->email;
        $_SESSION["id_us"] = $row->id_us;
        print "<script> location.href='painel.php' </script>";
        
    } else {
        echo "Ahh mano";
        print "<script> location.href='index.php' </script>";
        
    }
    
    }
?>