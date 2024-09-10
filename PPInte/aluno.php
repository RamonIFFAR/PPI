<?php 
    require('config.php');

    session_start();

    $aluno = $_REQUEST['id'];


    // XXXXXXXXXX Confere se o usuário está logado XXXXXXXXXXXXXX
    $Checagem = "select * from usuario where senha = '{$_SESSION['senha']}' and email= '{$_SESSION['email']}'";
    $QChecagem = $conn->query($Checagem);
    $tes = $QChecagem->fetch_object();
    $procura = $QChecagem->num_rows; 

    // Usado para conferir o tipo do setor
    $Checagem = "select * from setor where id_set = '{$_SESSION['id_us']}'";
    $ConsultaC = $conn->query($Checagem);
    $UsoC = $ConsultaC->fetch_object();
    $qtdChecagem = $ConsultaC->num_rows;






    // Função usada para excluir aluno
    if(isset($_REQUEST['excluir'])){
        $removeralunosql = "DELETE FROM aluno WHERE matricula = '{$aluno}'";
        $conn->query($removeralunosql);
        print "<script>location.href='alunos.php'</script>";
    }
    // XXXXXXXXXX If que confere se o usuário está logado XXXXXXXXXXXXXX
    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }


    // Seleciona coisas do aluno
    $sql = "select * from aluno where matricula = '{$aluno}'";
    $res = $conn->query($sql);
    $resSet = $res->fetch_assoc();

    // Seleciona comentários
    $sqlComentario = "select * from comentario inner join usuario where comentario.id_us = usuario.id_us and matricula = '{$aluno}'";
    $resComentario = $conn->query($sqlComentario);
    $ComentInfo = $res->fetch_assoc();




    function Atualizar($id, $matricula, $telefone, $email, $nome, $genero, $cidade, $dataNasc, $moradia, $cota, $bolsa, $orientador, $reprovacao, $equipTI, $estagio, $cpf, $acompanhamento){
        include('config.php');
        $sql = "UPDATE aluno SET matricula='{$matricula}', telefone='{$telefone}', email='{$email}', nome='{$nome}', genero='{$genero}', cidade='{$cidade}', dataNasc='{$dataNasc}', moradia='{$moradia}', cota='{$cota}', bolsa='{$bolsa}', orientador='{$orientador}', reprovacao='{$reprovacao}', equipTI='{$equipTI}', estagio='{$estagio}', cpf='{$cpf}', acompanhamento='{$acompanhamento}' where matricula = '{$id}'";
        $conn->query($sql) or die($conn->error);
        print "<script> location.href='alunos.php'</script>";
    }


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE</title>
</head>
<body>
    <?php 
        if(isset($_POST['atualizar'])){
            Atualizar($_POST['id'], $_POST['matricula'], $_POST['telefone'], $_POST['email'], $_POST['nome'], $_POST['genero'], $_POST['cidade'], $_POST['dataNasc'], $_POST['moradia'], $_POST['cota'], $_POST['bolsa'], $_POST['orientador'], $_POST['reprovacao'], $_POST['equipTI'], $_POST['estagio'], $_POST['cpf'], $_POST['acompanhamento']);
        }
        similar_text($UsoC->tipo, "DE", $percent);
        if($percent  == 100) { ?>
                    <form action='aluno.php' method='POST'>
                        <input type='hidden' name='id' value="<?php echo $aluno ?>"> <br>
                        <label>Matrícula</label>
                        <input type='text' name='matricula' value="<?php echo $aluno ?>"> <br>
                        <label>Telefone</label>
                        <input type='text' name='telefone' value="<?php echo $resSet['telefone'] ?>"> <br>
                        <label>Email</label>
                        <input type='email' name='email' value="<?php echo $resSet['email'] ?>"> <br>
                        <label>Nome</label>
                        <input type='text' name='nome' value="<?php echo $resSet['nome'] ?>"> <br>
                        <label>Gênero</label>
                        <input type='text' name='genero' value="<?php echo $resSet['genero'] ?>"> <br>
                        <label>Cidade</label>
                        <input type='text' name='cidade' value="<?php echo $resSet['cidade']?>"> <br>
                        <label>Data de Nascimento</label>
                        <input type='text' name='dataNasc' value="<?php echo $resSet['dataNasc'] ?>"> <br>
                        <label>Moradia</label>
                        <input type='text' name='moradia' value="<?php echo $resSet['moradia'] ?>"> <br>
                        <label>Cota</label>
                        <input type='text' name='cota' value="<?php echo $resSet['cota'] ?>"> <br>
                        <label>Bolsa</label>
                        <input type='text' name='bolsa' value="<?php echo $resSet['bolsa'] ?>"> <br>
                        <label>Orientador</label>
                        <input type='text' name='orientador' value="<?php echo $resSet['orientador'] ?>"> <br>
                        <label>Reprovação</label>
                        <input type='text' name='reprovacao' value="<?php echo  $resSet['reprovacao'] ?>"> <br>
                        <label>Equipamento TI</label>
                        <input type='text' name='equipTI' value="<?php echo $resSet['equipTI'] ?>"> <br>
                        <label>Estágio</label>
                        <input type='text' name='estagio' value="<?php echo $resSet['estagio'] ?>"> <br>
                        <label>CPF</label>
                        <input type='text' name='cpf' value="<?php echo $resSet['cpf'] ?>"> <br>
                        <label>Acompanhamento</label>
                        <input type='text' name='acompanhamento' value="<?php echo $resSet['acompanhamento'] ?>"> <br>
                        <button type='submit' name='atualizar'>Cadastrar</button>
                    </form>
                    <button onclick="if(confirm('Tem certeza que deseja excluir esse aluno?')){location.href='aluno.php?id= <?php echo $aluno ?>&excluir=1'}">Excluir</button>
        <?php } else {
                print $resSet['matricula'] . "<br>";
                print $resSet['telefone'] . "<br>";
                print $resSet['email'] . "<br>";
                print $resSet['nome'] . "<br>";
                /* print $resSet->genero . "<br>";
                print $resSet->cidade . "<br>";
                print $resSet->dataNasc . "<br>";
                print $resSet->moradia . "<br>";
                print $resSet->cota . "<br>";
                print $resSet->bolsa . "<br>";
                print $resSet->orientador . "<br>";
                print $resSet->reprovacao . "<br>";
                print $resSet->equipTI . "<br>"; */
    }
?>
<br> <span>Comentários</span> <br>
    <button onclick="location.href='aluno.php?id= <?php echo $aluno ?>&adicao=1'">Adicionar comentário</button>
    <?php
    if(isset($_REQUEST['adicao'])){
        ?>
        <form action='add_comentario.php' method='POST'>
            <input type='hidden' name='id_us' value='<?php echo $_SESSION['id_us'] ?>'>
            <input type='hidden' name='id' value='<?php echo $aluno ?>'>
            <label>Comentário</label> <br>
            <input type='text' name='comentario'>
            <button type='submit' name='comentar'>Adicionar comentário</button>
        </form>

        <?php
    }
        while ($row = $resComentario->fetch_object()){
            print "<br> <br>" . $row->nome . "<br>";
            print $row->descricao;
            if ($row->id_us == $_SESSION['id_us']){
                print "<br> <button onclick=\"location.href='ed_comentario.php?id_comentario=".$row->id_coment."'\">Editar comentário</button>";
                print "<br> <button onclick=\"location.href='add_comentario.php?remover=1&id_comentario=" . $row->id_coment . "'\">Remover Comentário</button>";
            }
            }
    ?>
</body>
</html>