<?php 
    require('config.php');
    session_start();


    // ************** FUNÇÕES *********************

    function Remover($id_coment){
        include('config.php');
        $sqlInfo = "SELECT * FROM comentario where id_coment = '{$id_coment}'";
        $sql = "DELETE FROM comentario WHERE id_coment='{$id_coment}'";
        $res = $conn->query($sqlInfo);
        $row = $res->fetch_object();
        $conn->query($sql);
        print "<script>alert('comentario removido com sucesso')</script>";
        print "<script>location.href='aluno.php?id=".$row->matricula."'</script>";
    }

    function Comentar($id_us, $id_aluno, $comentario){
        include('config.php');
        $sql = "INSERT INTO comentario (matricula, id_us, descricao) VALUES ('".$id_aluno."', '".$id_us."', '".$comentario."')";
        $conn->query($sql) or die($conn->error);
        print "<script>alert('Comentário cadastrado com sucesso')</script>";
        print "<script>location.href='aluno.php?id=".$_POST['id']."'</script>";

    }

    function Editar($comentario, $id_coment, $id){
        include('config.php');
        $sql = "update comentario set descricao='{$comentario}' where id_coment='{$id_coment}'";
        $conn->query($sql) or die($conn->error);
        print "<script>alert('Comentário editado com sucesso')</script>";
        print "<script>location.href='aluno.php?id=".$id."'</script>";
    }

    // ************** CHECAGENS PARA A EXECUÇÃO DOS COMANDOS *****************
    if(isset($_POST['editarComen'])){
        if(empty($_POST) || empty($_POST['id']) || empty($_POST['id_coment']) || empty($_POST['coment'])){
            
            print "<script>alert('Você precisa inserir todas as informações necessárias')</script>";
            print "<script>location.href='aluno.php?id=".$_POST['id']."'</script>";
        } else {
            Editar($_POST['coment'], $_POST['id_coment'], $_POST['id']);
        }
    }
    if(isset($_REQUEST['comentar'])){
        if(empty($_POST) || empty($_POST['id_us']) || empty($_POST['id']) || empty($_POST['comentario'])){
            print "<script>alert('Você precisa inserir todas as informações necessárias')</script>";
            print "<script>location.href='aluno.php?id=".$_POST['id']."'</script>";
        } else {
            print $_POST['id_us'] . "<br>";
            print $_POST['id'] . "<br>";
            print $_POST['comentario'] . "<br>";
                Comentar($_POST['id_us'], $_POST['id'], $_POST['comentario']);
        }
    }
    if(isset($_REQUEST['remover'])){
        if(empty($_REQUEST['id_comentario']) || empty($_REQUEST)){
            echo "erro";
            echo "<script>location.href='alunos.php'</script>";
        } else {
            Remover($_REQUEST['id_comentario']);
        }
    }
?>