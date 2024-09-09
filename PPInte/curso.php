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

    // Função usada para excluir curso
    if(isset($_REQUEST['excluir'])){
        $removercursosql = "DELETE FROM curso WHERE id_curso = '{$curso}'";
        $conn->query($removercursosql);
        print "<script>alert('Curso excluído com sucesso!')</script>";
        print "<script>location.href='painel.php'</script>";
    }
    // XXXXXXXXXX If que confere se o usuário está logado XXXXXXXXXXXXXX
    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }

    // Funções referentes à alteração das informações do curso
    function Atualizar($id, $nome, $duracao, $descricao, $foto){
        include('config.php');
        $sql = "UPDATE curso SET nome='{$nome}', duracao='{$duracao}', descricao='{$descricao}', foto='{$foto}' where id_curso = '{$id}'";
        $conn->query($sql) or die($conn->error);
        print "<script> location.href='painel.php'</script>";
    }

    function Atualizar2($id, $nome, $duracao, $descricao){
        include('config.php');
        $sql = "UPDATE curso SET nome='{$nome}', duracao='{$duracao}', descricao='{$descricao}' where id_curso = '{$id}'";
        $conn->query($sql) or die($conn->error);
        print "<script> location.href='painel.php'</script>";
    }

    function deletar($id){
        include('config.php');
        $sql = "DELETE FROM curso WHERE id_curso = '{$id}'";
        $conn->query($sql) or die($conn->error);
        print "<script> alert('curso removido com sucesso')</script>";
        print "<script> location.href='painel.php'</script>";
    }

    $sql = "select * from curso where id_curso = '{$curso}'";
    $res = $conn->query($sql);
    $resSet = $res->fetch_object();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Seja bem-vindo, aqui você poderá ver informações relacionadas ao curso</h1>
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
                        Atualizar($_POST['id'], $_POST['nome'], $_POST['duracao'], $_POST['descricao'], $caminho.$novoNome);
                    }else {
                        echo "faha no upload";
                    }
                }
            } else {
                Atualizar2($_POST['id'], $_POST['nome'], $_POST['duracao'], $_POST['descricao']);
            }
        }
        similar_text($UsoC->tipo, "DE", $percent);
        if($percent  == 100) { ?>
                    <form action='curso.php' method='POST' enctype="multipart/form-data"> 
                        <input type='hidden' name='id' value='<?php echo $curso ?>'>
                        <label>Nome</label> <br>
                        <input type='text' name='nome' value="<?php echo $resSet->nome ?>"> <br>
                        <label>Duração</label> <br>
                        <input type='text' name='duracao' value="<?php echo $resSet->duracao ?>"> <br>
                        <label>Descrição</label> <br>
                        <input type='text' name='descricao' value="<?php echo $resSet->descricao ?>"> <br>
                        <label>Foto</label> <br>
                        <input type="file" name="foto"> <br>
                        <button type='submit' name='atualiza'>Salvar</button>
                    </form>
                    <button onclick="if(confirm('Tem certeza que deseja excluir este curso?')){location.href='curso.php?id=<?php echo $curso?> &excluir=1'};">excluir</button>
             <?php } else {
                print $resSet->nome . "<br>";
                print $resSet->duracao . "<br>";
                print $resSet->descricao . "<br>";
    }
?>
</body>
</html>