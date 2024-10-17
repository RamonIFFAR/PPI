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
        print "<script>location.href='cursos.php'</script>";
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
        print "<script> location.href='cursos.php'</script>";
    }

    function Atualizar2($id, $nome, $duracao, $descricao){
        include('config.php');
        $sql = "UPDATE curso SET nome='{$nome}', duracao='{$duracao}', descricao='{$descricao}' where id_curso = '{$id}'";
        $conn->query($sql) or die($conn->error);
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
                <link rel="stylesheet" href="cursocss.css">
            </head>
            <body>
                
                <div class="top-bar">
                    <div class="menu-container">
                        <div class="menu-abriricon" onclick="openMenu()">☰</div> <!-- Ícone do menu -->
                        <div class="floating-menu">
                            <div class="design-menu"></div>
                            <div class="design-menu2"></div>
                            <div class="design-menu3"></div>
                            <div class="Titulo-menu">
                                <img src="Imagens/TituloMenu.png">
                            </div>
                            <div class="menu-fecharicon" onclick="closeMenu()">☰</div>
                            <ul>
                                <li><a href="painel.php">Início</a></li>
                                <li><a href="cursos.php">Cursos</a></li>
                                <li><a href="disciplinas.php">Disciplinas</a></li>
                                <li><a href="alunos.php">Alunos</a></li>
                                <li><a href="professores.php">Professores</a></li>
                                <li><a href="turmas.php">Turmas</a></li>
                            </ul>
                            <a class="textPosition" href="index.php">Sair</a>

                            <div class="imagem-menu2"><img src="Imagens/inicio.png"></div>
                        </div>
                    </div>
                </div>

                <!-- Barra verde -->
                <div class="green-bar"></div>

                <!-- Nova barra cinza -->
                <div class="bottom-bar">
                <div class="iconeNotificacao">
                        <img src="Imagens/Notificacao.png">
                    </div>
                    <div class="iconeTitulo">
                        <img src="Imagens/Titulo.png">
                    </div>
                    <div class="iconePerfil">
                        <img src="Imagens/Perfil.png">
                    </div>
                </div>

                <!-- Nova barra verde abaixo da nova barra cinza -->
                <div class="new-green-bar">
                    <div class="Posicao">
                        <?php if($qtdChecagem > 0){
                            similar_text($UsoC->tipo, "DE", $percent);
                                if($percent  == 100) { ?>
                        <button onclick="if(confirm('Tem certeza que deseja excluir esse curso?')){location.href='curso.php?id=<?php echo $curso ?>&excluir=1'}">
                            <img src="Imagens/Lixeira.png" alt="Excluir" class="img-button">
                        </button>
                        <?php 
                             }}
                        ?>
                        
                    </div>
                    
                    <div class="Posicao2">
                    <?php if($qtdChecagem > 0){
                            similar_text($UsoC->tipo, "DE", $percent);
                                if($percent  == 100) { ?>
                        <a href="editarcurso.php?id=<?php echo $curso ?>">
                            <button>
                                <img src="Imagens/editar.png" alt="Editar" class="img-button">
                            </button>
                        </a>
                        <?php 
                                }
                            }
                        ?>
                    </div>

                    <div class="Titulo-Professores">
                        <h1>Informações do Curso</h1>
                    </div>

                </div>

                <!-- Nova barra cinza abaixo da nova barra verde -->
                <div class="new-bottom-bar">
                    <div class="box-center">
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
                            if ($qtdChecagem > 0){
                                similar_text($UsoC->tipo, "DE", $percent);
                                if($percent  == 100) { ?>
                                    <form action='curso.php' method='POST'>

                                        <div class="Nome">
                                        <label>Nome:</label> <br>
                                        <a type='text' name='nome'><?php echo $resSet->nome ?></a> <br>
                                        <input type='hidden' name='id_curso' value="<?php echo $curso ?>"> <br>
                                        </div>

                                        <div class="CPF">
                                            <label>Duração:</label> <br>
                                            <a type='text' name='duracao'><?php echo $resSet->duracao ?></a><br>
                                        </div>

                                        <br>

                                    <div class="SIAPE">
                                        <label>Descrição:</label> <br>
                                        <a type='text' name='descricao'><?php echo $resSet->descricao ?></a><br>
                                    </div>
                                    <br>
                                    </form> <br>
                                <?php } 
                        }   else {
                                    print 
                                    "<div class='Nome'>
                                    <label>Nome:</label> <br>
                                    <a type='text' name='nome'>". $resSet->nome ."</a> <br>
                                    </div>";
                                    print 
                                    "<div class='CPF'>
                                    <label>Duracao:</label> <br>
                                    <a type='text' name='nome'>". $resSet->duracao ."</a> <br>
                                    </div>";
                                    print 
                                    "<div class='SIAPE'>
                                    <label>Descrição:</label> <br>
                                    <a type='text' name='nome'>". $resSet->descricao ."</a> <br>
                                    </div>";
                                    print 
                                    "<div class='Fone'>
                                    <label>Foto:</label> <br>
                                    <img src='".$resSet->foto."'></img> <br>
                                    </div>";
                        }

                        ?>
                    </div>
                </div>

                <script>
                    function openMenu() {
                        var menu = document.querySelector('.floating-menu');
                        menu.style.display = 'block';
                    }

                    function closeMenu() {
                        var menu = document.querySelector('.floating-menu');
                        menu.style.display = 'none';
                    }
                </script>
            </body>
            </html>