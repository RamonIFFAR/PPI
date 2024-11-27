<?php
    require('config.php');

    // Inicia a sessão
    session_start();

    // Finaliza a sessão
    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    $id_disc = $_REQUEST['id_disc'];

    // XXXXXXXXXX Confere se o usuário está logado XXXXXXXXXXXXXX
    $Checagem = "select * from usuario where senha = '{$_SESSION['senha']}' and email= '{$_SESSION['email']}'";
    $QChecagem = $conn->query($Checagem);
    $tes = $QChecagem->fetch_object();
    $procura = $QChecagem->num_rows; 

    // Usado para conferir se o setor é da DE
    $Checagem = "select * from setor where id_set = '{$_SESSION['id_us']}' and tipo like 'DE'";
    $ConsultaC = $conn->query($Checagem);
    $UsoC = $ConsultaC->fetch_object();
    $qtdChecagem = $ConsultaC->num_rows;

    // XXXXXXXXXX If que confere se o usuário está logado XXXXXXXXXXXXXX
    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }

    $sql = "select * from disciplina where id = '{$id_disc}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
            <link rel="stylesheet" href="disciplinacss.css">
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
            <div class="Ver-Turmas">
                <a href='DTurmas.php?id_disc=<?php echo $id_disc?>'>Ver turmas com essa disciplina</a> <br> <br>
            </div>
            <div class="Posicao">
                <button onclick="if(confirm('Tem certeza que deseja excluir esse perfil de professor?')){location.href='ed_disciplina.php?id_disc=<?php echo $id_disc ?>&excluir=1'}">
                    <img src="Imagens/Lixeira.png" alt="Excluir" class="img-button">
                </button>  
        </div>
    
        <div class="Posicao2">
            <a href="ed_disciplina.php?id_disc=<?php echo $id_disc ?>">
                <button>
                    <img src="Imagens/editar.png" alt="Editar" class="img-button">
                </button>
            </a>
        </div>

        <div class="Titulo-Professores">
            <h1>Informações da Disciplina</h1>
        </div>
    </div>

    <!-- Nova barra cinza abaixo da nova barra verde -->
    <div class="new-bottom-bar">
        <div class="box-center">   
                <?php
                    if($qtdChecagem > 0){
                        echo "<div class='Nome'>";
                            echo "<label>Nome:</label><br>";
                            echo "<a type='text' name='nome'>" . $row->nome . "</a> <br>";
                        echo "</div>";

                        echo "<div class='Descricao'>";
                            echo "<label>Descrição:</label> <br>";
                            echo "<a type='text' name='descricao'>" .$row->descricao."</a><br>";
                        echo "</div>";
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