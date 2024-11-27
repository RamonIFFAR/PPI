<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="criarcurso.css">
    <title>SGAE</title>
</head>
<body class="Fundo">
    <?php 
       require('config.php');
   
       session_start();
   
       // Função para criar um novo curso
       function CriarCurso($nome, $duracao, $descricao, $foto){
           require('config.php'); // Inclui o arquivo de configuração novamente se necessário
           if (empty($nome) || empty($duracao) || empty($descricao)){
               echo "É preciso preencher todos os campos para adicionar um novo curso";
           } else {
               // Prepara e executa a query para inserir o curso no banco de dados
               $sql = "INSERT INTO curso (duracao, descricao, nome, foto) 
                       VALUES ('{$duracao}', '{$descricao}', '{$nome}', '{$foto}')";
               if ($conn->query($sql)) {
                   echo "Curso criado com sucesso";
                   echo "<script>location.href='cursos.php'</script>";
               } else {
                   echo "Erro ao criar o curso: " . $conn->error;
               }
           }
       }
   
       if(isset($_POST['cadastro'])){
           if (!empty($_FILES['foto']['name'])){
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
               if (!in_array($extensao, $arquivosPermitidos)){
                   $erros[] = "Arquivo inválido";
               }
   
               $tiposPermitidos = ["image/png", "image/jpeg", "image/jpg"];
               if (!in_array($tipo, $tiposPermitidos)){
                   $erros[] = "Tipo de arquivo inválido";
               }
   
               if (!empty($erros)) {
                   foreach ($erros as $erro){
                       echo $erro;
                   }
               } else {
                   $caminho = "fotos/";
                   $hoje = date("d-m-Y");
                   $novoNome = $hoje."-".$nomeFoto;
                   if(move_uploaded_file($nomeTemporario, $caminho.$novoNome)) {
                       echo 'Upload com sucesso';
                       CriarCurso($_POST['nome'], $_POST['duracao'], $_POST['descricao'], $caminho.$novoNome);
                   } else {
                       echo "Falha no upload";
                   }
               }
           } else {
               echo "Nenhum arquivo foi selecionado";
           }
       }
   ?>
   

    <div class="Background1"></div>
    <form action="criar_curso.php" method="POST" enctype="multipart/form-data">
        <h1>Adicionar Curso</h1>

        <div class="Nome">
            <label>Insira o nome:</label><br>
            <input type="text" name="nome" value="<?php echo @$_POST['nome']?>"> <br>
        </div>

        <div class="Duracao">
            <label>Duração do curso</label><br>
            <input type="text" name="duracao" value="<?php echo @$_POST['duracao']?>"> <br>
        </div>

        <div class="EmailInsti">
            <label>Descrição</label><br>
            <input type="text" name="descricao" value="<?php echo @$_POST['descricao']?>"> <br>
        </div>

        <div class="Foto">
        <label for="foto">Insira uma foto:</label>
            <label for="foto" class="custom-file-upload">
                <img src="Imagens/Foto.png" alt="Escolher arquivo"> <!-- Imagem que funciona como botão -->
            </label>
            <input id="foto" type="file" name="foto" style="display: none;"> <!-- Campo de input escondido -->
        </div>

        <button type="submit" name="cadastro">Criar curso</button>
        <a href="cursos.php">Cancelar</a>
    </form>

</body>
</html>
