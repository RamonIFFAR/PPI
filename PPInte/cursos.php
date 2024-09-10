<?php 
    require("config.php");

    session_start();

    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    $sql = "select * from usuario inner join setor where usuario.senha = '{$_SESSION["senha"]}' and setor.id_set = '{$_SESSION["id_us"]}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $qtd = $res->num_rows;

    $sqlCurso = "select * from curso";
    $Cres = $conn->query($sqlCurso);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cursoscss.css">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
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
        <div class="Titulo-Professores">
            <h1>CURSOS</h1>
        </div>

        <div class="AdicionarProf">
        </div>
    </div>

    <div class="new-bottom-bar">
        <div class="box-center">
            
                <?php 
                    if($qtd > 0){
                        similar_text($row->tipo, "DE", $percent);
                        if ($percent == 100) {
                            echo "<a href='criar_curso.php'>Adicionar cursos</a>";
                        }
                        echo "<div class='cursos-container'>"; 
                        while($Crow = $Cres->fetch_object()){
                            echo "<div class='backgroundFundo1'>";

                            echo "<div class='Curso-foto'>";
                            echo "<br> <img src='".$Crow->foto."' alt='foto curso'<br>";
                            echo "</div>";

                            echo "<p class='nome-professor'>" . $Crow->nome . "</p>";

                            echo "<div class='botaodetalhes'>";
                            echo "<br> <a>Ver detalhes</a>";
                            echo "</div>";

                            echo "<div class='imagemBotao'>";
                            echo "<img onclick=\"window.location.href='curso.php?id=" . htmlspecialchars($Crow->id_curso, ENT_QUOTES, 'UTF-8') . "'\" src='Imagens/Informacoes.png' alt='Detalhes'>";
                            echo "</div>";

                            //echo "<div class='a'>";
                            //echo "<a href='turmas.php?id=". $Crow->id_curso ."'>Ver turmas <a> <br>";
                            //echo "</div>";

                            echo "<div class='designFundoCurso'></div>";

                            echo "</div>";
                        }
                        echo "</div>"; 
                    }
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
