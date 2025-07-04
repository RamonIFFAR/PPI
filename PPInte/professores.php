<?php 
    session_start();

    require('config.php');
    //variáveis para a execução normal do código
    $nome = "select nome from usuario where senha = '{$_SESSION["email"]}'";
    $sql = "select usuario.id_us, usuario.Siape, usuario.nome, professor.id_prof, usuario.foto from usuario inner join professor where usuario.id_us=professor.id_prof";
    $res = $conn->query($sql) or die($conn->error);
    $req = $conn->query($nome) or die($conn->error);
    $qtd = $res->num_rows;

    //variáveis para a checagem se o usuário é um setor

    $Checagem = "select * from setor where id_set = '{$_SESSION['id_us']}'";
    $ConsultaC = $conn->query($Checagem);
    $qtdChecagem = $ConsultaC->num_rows;

    // If utilizado para evitar que um usuário que não pertence à um setor entre
    if ($qtdChecagem > 0) {
        ?>
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
                <link rel="stylesheet" href="professorescss.css">
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
                        <h1>PROFESSORES</h1>
                    </div>

                    <div class="AdicionarProf">
                        <?php
                            echo "<a href='criar_professor.php'>Adicionar professor(a)</a>";
                        ?>
                    </div>
                </div>

                
                <div class="new-bottom-bar">
                    <div class="box-center">
                        <div class="InformaçõesProf";>
                            <?php 
                                if($qtd > 0){
                                    echo "<div class='professores-container'>"; 
                                    while($row = $res->fetch_object()){
                                        echo "<div class='backgroundFundo1'>";

                                        echo "<div class='Prof-foto'>";
                                        echo "<br> <img src='".$row->foto."' alt='foto professor'<br>";
                                        echo "</div>";

                                        echo "<p class='nome-professor'>" . $row->nome . "</p>";

                                        echo "<div class='botaoinfo'>";
                                        echo "<br> <a>Informações</a>";
                                        echo "</div>";

                                        echo "<div class='imagemBotao'>";
                                        echo "<img onclick=\"window.location.href='professor.php?id_prof=" . htmlspecialchars($row->id_prof, ENT_QUOTES, 'UTF-8') . "'\" src='Imagens/Informacoes.png' alt='Informações'>";
                                        echo "</div>";

                                        echo "<div class='designFundoProf'></div>";

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
<?php
    // Se o usuário não for um setor, ele é enviado de volta para a página de login
    } else{
        print"<script>location.href='index.php'; alert('Você não tem permissão para acessar esta área do sistema')</script>";
    }
?>