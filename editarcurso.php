<?php 
    require('config.php');

    session_start();

    $curso = $_REQUEST['id'];
    
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

    // Procura os professores disponpiveis para serem coordenadores
    $PProfessor = "select usuario.nome, professor.id_prof from usuario inner join professor on usuario.id_us = professor.id_prof inner join curso on not professor.id_prof = curso.id_coord";
    $Cres = $conn->query($PProfessor);

    // Função usada para excluir curso
    if(isset($_REQUEST['excluir'])){
        $removercursosql = "DELETE FROM curso WHERE id_curso = '{$curso}'";
        $conn->query($removercursosql);
        print "<script>alert('Curso excluído com sucesso!')</script>";
        print "<script>location.href='cursos.php'</script>";
    }
    // XXXXXXXXXX If que confere se o usuário está logado XXXXXXXXXXXXXX
    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }

    // Funções referentes à alteração das informações do curso
    function Atualizar($id, $nome, $duracao, $descricao, $foto, $id_coord){
        include('config.php');
        if($id_coord == 'none'){
            $sql = "UPDATE curso SET nome='{$nome}', duracao='{$duracao}', descricao='{$descricao}', foto='{$foto}' where id_curso = '{$id}'";
            $conn->query($sql) or die($conn->error);
            echo "<script>alert('Atualização feita com sucesso')</script>";
        } else {
            $sql = "UPDATE curso SET nome='{$nome}', duracao='{$duracao}', descricao='{$descricao}', foto='{$foto}', id_coord='{$id_coord}' where id_curso = '{$id}'";
            $conn->query($sql) or die($conn->error);
            echo "<script>alert('Atualização feita com sucesso')</script>";
        }
        echo $foto;
        print "<script> location.href='cursos.php'</script>";
    }

    function Atualizar2($id, $nome, $duracao, $descricao, $id_coord){
        include('config.php');
        if($id_coord == 'none'){
            $sql = "UPDATE curso SET nome='{$nome}', duracao='{$duracao}', descricao='{$descricao}' where id_curso = '{$id}'";
            $conn->query($sql) or die($conn->error);
            echo "<script>alert('Atualização feita com sucesso')</script>";
        } else {
            $sql = "UPDATE curso SET nome='{$nome}', duracao='{$duracao}', descricao='{$descricao}', id_coord='{$id_coord}' where id_curso = '{$id}'";
            $conn->query($sql) or die($conn->error);
            echo "<script>alert('Atualização feita com sucesso')</script>";
        }
        print "<script> location.href='cursos.php'</script>";
    }

    function deletar($id){
        include('config.php');
        $sql = "DELETE FROM curso WHERE id_curso = '{$id}'";
        $conn->query($sql) or die($conn->error);
        print "<script> alert('curso removido com sucesso')</script>";
        print "<script> location.href='cursos.php'</script>";
    }

    $sql = "select * from curso where id_curso = '{$curso}'";
    $res = $conn->query($sql);
    $resSet = $res->fetch_object();

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
        <link rel="stylesheet" href="editarcursocss.css">
    </head>

    <body class="Fundo">

        <div class="Background1"></div>

        <form action="editarcurso.php" method="POST" enctype="multipart/form-data">
            <h1> Informações Cursos</h1>
            <?php 
                if(isset($_POST['atualiza'])){
                if (! empty($_FILES['foto']['name'])){
                $nomeFoto = $_FILES['foto']['name'];
                $tipo = $_FILES['foto']['type'];
                                    $nomeTemporario = $_FILES['foto']['tmp_name'];
                                    $tamanho = $_FILES['foto']['size'];
                                    $erros = array();  

                                    $tamanhoMax = 1024 * 1024 * 50;

                                    if($tamanho > $tamanhoMax){
                                        $erros[] = "Tamanho do arquivo excedido";
                                    }

                                    $arquivosPermitidos = ["png", "jpeg", "jpg"];
                                    $extensao = pathinfo($nomeFoto, PATHINFO_EXTENSION);
                                    if ( ! in_array($extensao, $arquivosPermitidos)){
                                        $erros[] = "Arquivo inválido";
                                    }

                                    $tiposPermitidos = ["image/png", "image/jpeg", "image/jpg"];
                                    if ( ! in_array($tipo, $tiposPermitidos)){
                                        $erros[] = "Tipo de arquivo inválido";
                                    }

                                    if (! empty($erros)) {
                                        foreach ($erros as $erro){
                                            echo $erro;
                                        }
                                    } else {
                                        $caminho = "fotos/";
                                        $hoje = date("d-m-Y");
                                        $novoNome = $hoje."-".$nomeFoto;
                                        if(move_uploaded_file($nomeTemporario, $caminho.$novoNome)) {
                                            echo 'upload com sucesso';
                                            Atualizar($_POST['id'], $_POST['nome'], $_POST['duracao'], $_POST['descricao'], $caminho.$novoNome, $_POST['coordenador']);
                                        }else {
                                            echo "faha no upload";
                                        }
                                    }
                                } else {
                                    Atualizar2($_POST['id'], $_POST['nome'], $_POST['duracao'], $_POST['descricao'], $_POST['coordenador']);
                                }
                            }
                            if ($qtdChecagem > 0){
                                similar_text($UsoC->tipo, "DE", $percent);
                                echo $curso;
                                if($percent  == 100) { ?>
                                    <form action='editarcurso.php' method='POST'>

                                    <div class="NomeCompleto">
                                        <label>Nome do curso:</label> <br>
                                        <input type='text' name='nome' value=" <?php echo $resSet->nome ?>"> <br>
                                        <input type='hidden' name='id' value="<?php echo $curso ?>"> <br>
                                    </div>

                                    <div class="CPF">
                                        <label>Duração do curso:</label> <br>
                                        <input type='text' name='duracao' value=" <?php echo $resSet->duracao ?>"><br>
                                    </div>

                                    <div class="MatriculaSiape">
                                        <label>Descrição:</label> <br>
                                        <input type='text' name='descricao' value=" <?php echo $resSet->descricao ?> "></a><br>
                                    </div>

                                    <div class="Foto">
                                        <label for="foto">Insira uma foto:</label>
                                        <label for="foto" class="custom-file-upload">
                                        <input type="file" id="foto" name="foto" style="display: none;">
                                            <img src="Imagens/Foto.png" alt="Escolher arquivo"> <!-- Imagem que funciona como botão -->
                                        </label>
                                    </div>
                                    
                                    <div class="DefinirCod">
                                        <label>Definir coordenador do curso:</label>
                                        <br>
                                        <select id='coord' name='coordenador'>
                                            <option value='none' selected>--------</option>
                                            <?php 
                                                while($Crow = $Cres->fetch_object()){
                                                    echo "<option value='" . $Crow->id_prof . "'>" . $Crow->nome . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="Posicao">
                                        <button type="submit" name="atualiza">Salvar</button>
                                    </div>
                    
                                    <a href="curso.php?id=<?php echo $curso ?>">Cancelar</a>
                    <?php } 
                        }   else {
                                    print $resSet->nome . "<br>";
                                    print $resSet->duracao . "<br>";
                                    print $resSet->descricao . "<br>";
                                    print "<br> <img src='".$resSet->foto."' alt='foto curso'<br>";
                        }

                        ?>
        </form>
    </body>
</html>