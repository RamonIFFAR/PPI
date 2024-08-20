<?php
    require('config.php');

    session_start();

    //variáveis para a checagem se o usuário é um setor

    $prof = $_REQUEST['id_prof'];
    
    if(isset($_REQUEST['excluir'])){
        $removerprofessorsql = "DELETE FROM professor WHERE id_prof = '{$prof}'";
        $removerusuariosql = "DELETE FROM usuario WHERE id_prof = '{$prof}'";
        $conn->query($removerprofessorsql);
        $conn->query($removerusuariosql);
        print "<script>location.href='professores.php'</script>";
    }

    $Checagem = "select * from setor where id_set = '{$_SESSION['id_us']}'";
    $ConsultaC = $conn->query($Checagem);
    $UsoC = $ConsultaC->fetch_object();
    $qtdChecagem = $ConsultaC->num_rows;

    function Atualizar($id, $cpf, $Siape, $email, $nome, $senha){
        include('config.php');
        $sql = "UPDATE usuario SET cpf = '{$cpf}', Siape = '{$Siape}', email = '{$email}', nome = '{$nome}', senha = '{$senha}' where id_us = '{$id}'";
        $conn->query($sql) or die($conn->error);
        print "<script> location.href='professores.php'</script>";
    }
    // Variáveis para a conferência do usuário
    $sql = "select * from usuario where id_us = '{$prof}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    

    if ($qtdChecagem > 0) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGE</title>
</head>
<body>
    <h1>Edite as informações desejadas</h1>
    <span>Deixe as informações como estão se não deseja alterá-la</span> <br>
    <?php 
        if(isset($_POST['atualiza'])){
            Atualizar($_POST['id_prof'], $_POST['cpf'], $_POST['siape'], $_POST['email'], $_POST['nome'], $_POST['senha']);
        }
        similar_text($UsoC->tipo, "DE", $percent);
        if($percent  == 100) {
            print "<form action='professor.php' method='POST'>
                        <input type='hidden' name='id_prof' value=" . $prof . "> <br>
                        <label>CPF</label>
                        <input type='text' name='cpf' value=" . $row->cpf ."> <br>
                        <label>Siape</label>
                        <input type='text' name='siape' value=" . $row->Siape . "> <br>
                        <label>Email</label>
                        <input type='text' name='email' value=" . $row->email ."> <br>
                        <label>Nome</label>
                        <input type='text' name='nome' value=" . $row->nome . "> <br>
                        <label>Senha</label>
                        <input type='text' name='senha' value=" . $row->senha . "> <br>
                        <button type=submit name='atualiza'>Salvar alterações</button>
                    </form> <br>
                    <button onclick=\"if(confirm('Tem certeza que deseja excluir esse perfil de professor?')){location.href='professor.php?id_prof=" . $prof ."&excluir=1';}else{false;} \">Excluir</button>";
        } else {
            while($row = $res->fetch_object()){
                print "<br>" . $row->nome;
                
            }
    }
    } else {
        print "<script>location.href='index.php'</script>";
    }
?>