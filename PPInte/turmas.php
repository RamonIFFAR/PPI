<?php
    require('config.php');

    // Inicia a sessão
    session_start();

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

    $sql = "select nome, id from turma";
    $Cres = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
                <link rel="stylesheet" href="turmascss.css?v=<?php echo time(); ?>">
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

    <div class="green-bar"></div>

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

    <div class="new-green-bar">
        <div class="Titulo-Turmas">
            <h1>Turma(s)</h1>
        </div>
        <div class="AdicionarProf">
            <?php
                echo "<a href='add_turma.php'>Adicionar turma</a>";
            ?>
        </div>
    </div>

    <div class="new-bottom-bar">
        <div class="box-center">

                <?php 
                        echo "<div class='turmas-container'>"; 
                        while($Crow = $Cres->fetch_object()){
                            echo "<div class='backgroundFundo1'>";

                                echo "<div class='backgroundFundo2'>";
                                    echo "<p class='nome-turma'>" . $Crow->nome . "</p>";
                                echo "</div>";

                                echo "<div class='botaodetalhes'>";
                                echo "<br> <a>Ver detalhes</a>";
                                echo "</div>";
                            
                                echo "<div class='imagemBotao'>";
                                echo "<img onclick=\"window.location.href='turma.php?id=" . htmlspecialchars($Crow->id, ENT_QUOTES, 'UTF-8') . "'\" src='Imagens/Informacoes.png' alt='Detalhes'>";
                                echo "</div>";

                                echo "<div class='designFundoCurso'></div>";

                            echo "</div>";
                        }
                        echo "</div>"; 
                ?>
            </div>
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