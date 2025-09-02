<?php
    require('config.php');

    // Inicia a sessão
    session_start();

    $turma = $_REQUEST['id_turma'];
    $disciplina = $_REQUEST['id_disc'];
    $professor = $_SESSION['id_us'];

    // Finaliza a sessão
    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    // XXXXXXXXXX Confere se o usuário está logado XXXXXXXXXXXXXX
    $Checagem = "select * from usuario where senha = '{$_SESSION['senha']}' and email= '{$_SESSION['email']}'";
    $QChecagem = $conn->query($Checagem);
    $tes = $QChecagem->fetch_object();
    $procura = $QChecagem->num_rows; 

    // XXXXXXXXXX If que confere se o usuário está logado XXXXXXXXXXXXXX
    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }

    function enviaArquivo($professor, $turma, $disciplina, $arquivo){
        include('config.php');

        $busca1 = "select * from lembrete where limite_relatorio = 1";
        $resB1 = $conn->query($busca1) or die($conn->error);
        $qtdB1 = $resB1->num_rows;
        $rowB1 = $resB1->fetch_object();

        

        $busca4 = "select * from relatorio where prof = '{$professor}' and disc = '{$disciplina}' and turma = '{$turma}'";
        $resB4 = $conn->query($busca4) or die($conn->error);
        $qtdB4 = $resB4->num_rows;

        if($qtdB1 > 0){
            $busca2 = "select * from relatorio where prof = '{$professor}' and disc = '{$disciplina}' and turma = '{$turma}' and dat <= '{$rowB1->dt}'";
            $resB2 = $conn->query($busca2) or die($conn->error);
            $qtdB2 = $resB2->num_rows;

            $busca3 = "select * from relatorio where prof = '{$professor}' and disc = '{$disciplina}' and turma = '{$turma}' and dat > '{$rowB1->dt}'";
            $resB3 = $conn->query($busca3) or die($conn->error);
            $qtdB3 = $resB3->num_rows;
            if($rowB1->dt > date("Y-m-d")){
                if($qtdB2 == 0){
                    $sql1 = "insert into relatorio(prof, turma, disc, arquivo, dat) values('{$professor}', '{$turma}', '{$disciplina}', '{$arquivo}', '".date('Y-m-d')."')";
                    $conn->query($sql1) or die($conn->error);
                } else if ($qtdB2 > 0){
                    $rowB2 = $resB2->fetch_object();
                    echo "é no B2 <br>";
                    echo date('Y-m-d')."<br>";
                    $sql2 = "update relatorio set arquivo = '{$arquivo}', dat = '".date('Y-m-d')."' where id = '{$rowB2->id}'";
                    $conn->query($sql2) or die($conn->error);
                }
            } else if($rowB1->dt < date("Y-m-d")){
                if($qtdB3 == 0){
                    $sql1 = "insert into relatorio(prof, turma, disc, arquivo, dat) values('{$professor}', '{$turma}', '{$disciplina}', '{$arquivo}', '".date('Y-m-d')."')";
                    $conn->query($sql1) or die($conn->error);
                } else if ($qtdB3 > 0){
                    $rowB3 = $resB3->fetch_object();
                    echo "é no B3";
                    $sql2 = "update relatorio set arquivo = '{$arquivo}', dat = '".date('Y-m-d')."' where id = '{$rowB3->id}'";
                    $conn->query($sql2) or die($conn->error);
                }
            }
        } else{
            if($qtdB4 == 0){
                $sql1 = "insert into relatorio(prof, turma, disc, arquivo, dat) values('{$professor}', '{$turma}', '{$disciplina}', '{$arquivo}', '".date('Y-m-d')."')";
                $conn->query($sql1) or die($conn->error);
            } else {
                $rowB4 = $resB4->fetch_object();
                echo "é no b4";
                $sql2 = "update relatorio set arquivo = '{$arquivo}', dat = '".date('Y-m-d')."' where id = '{$rowB4->id}'";
                $conn->query($sql2) or die($conn->error);
            }
        }
        echo "<script>location.href='turma.php?id=".$turma."'</script>";
    }

    if(isset($_POST['enviar'])){
        if(! empty($_FILES['arquivo']['name'])){

            $nomeArquivo = $_FILES['arquivo']['name'];
            $tipo = $_FILES['arquivo']['type'];
            $nomeTemp = $_FILES['arquivo']['tmp_name'];
            $tamanho = $_FILES['arquivo']['size'];
            $erros = array();

            $tamanhoMaximo = 1024 * 1024 * 50; // 50 mb
            if ($tamanho > $tamanhoMaximo){
                $erros[] = "Tamanho máximo excedido <br>"; 
            }

            $arquivosPermitidos = ['pdf'];
            $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
            if (!in_array($extensao, $arquivosPermitidos)){
                $erros[] = "Arquivo não permitido <br>";
            }

            $typesPermitidos = ['application/pdf'];
            if(!in_array($tipo, $typesPermitidos)){
                $erros[] = "Tipo de arquivo não permitido <br>";
            }

            if(!empty($erros)){
                $resultado = "";
                foreach($erros as $erro){
                    
                    $resultado .= $erro;
                }
                print "<script>alert('".$resultado."')</script>";
            } else {
                $caminho = "relatorios/";
                $hoje = date("Y-m-d_h-1");
                $novoNome = $hoje.'-'.$nomeArquivo;
                echo $novoNome;
                move_uploaded_file($nomeTemp, $caminho.$novoNome);
                enviaArquivo($professor, $turma, $disciplina, $caminho.$novoNome);
            }

        }
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de relatório de atividades</title>
</head>
<body>
    <form action='relatorio.php' method='POST' enctype='multipart/form-data'>
        <label>Insira o arquivo PDF desejado</label>
        <input type='hidden' name='id_turma' value='<?php echo $turma ?>'>
        <input type='hidden' name='id_disc' value='<?php echo $disciplina ?>'>
        <input type='file' name='arquivo'> <br>
        <button type='submit' name='enviar'>Enviar</button>
    <form>
</body>
</html>