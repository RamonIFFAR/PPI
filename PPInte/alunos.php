<?php 
    session_start();

    require('config.php');
    //variáveis para a execução normal do código
    $nome = "select nome from usuario where senha = '{$_SESSION["senha"]}' and email='{$_SESSION['email']}'";
    $sql = "select usuario.id_us, usuario.Siape, usuario.nome, professor.id_prof, usuario.foto from usuario inner join professor where usuario.id_us=professor.id_prof";
    $AlunoSQL = "select * from aluno";
    $res = $conn->query($sql) or die($conn->error);
    $req = $conn->query($nome) or die($conn->error);
    $Ares = $conn->query($AlunoSQL) or die($conn->error);
    $qtd = $res->num_rows;

    //variáveis para a checagem se o usuário é um setor

    $Checagem = "select * from setor where id_set = '{$_SESSION['id_us']}'";
    $ConsultaC = $conn->query($Checagem);
    $PuxaC = $ConsultaC->fetch_object();
    $qtdChecagem = $ConsultaC->num_rows;

    // If utilizado para evitar que um usuário que não pertence à um setor entre
    if ($qtdChecagem > 0) {
        similar_text($PuxaC->tipo, "DE", $percent);
        ?>
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
                <link rel="stylesheet" href="alunos.css">
            </head>
            <body>
                <div class="top-bar">
                    <div class="menu-container"> 
                        <div class="menu-abriricon" onclick="openMenu()">☰</div>
                        

                        <div class="floating-menu"> 
                            <div class="design-menu"></div>
                            <div class="design-menu2"></div>
                            <div class="design-menu3"></div>
                            <div class="Titulo-menu">
                                <img src="Imagens/TituloMenu.png">
                            </div>
                            <div class="menu-fecharicon" onclick="closeMenu()">☰</div>
                            <ul>
                                <li><a href="Pagina_Inicial.php">Início</a></li>
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
                    <div class="Titulo-Alunos">
                        <h1>ALUNOS</h1>
                    </div>

                    <div class="AdicionarAluno">
                        <?php
                        if ($percent == 100) {
                            echo "<a href='criar_aluno.php'>Adicionar aluno(a)</a>";
                        }
                    }
                        ?>
                    </div>
                </div>

                <!-- Nova barra cinza abaixo da nova barra verde -->
                <div class="new-bottom-bar">
                    <div class="box-center">

                    <div class="outer-container">
        <div class="inner-container">
            <div class="title">Técnico em Administração</div>
            <div class="info">
            </div>
        </div>
    </div>
    <div class="green-bar2"></div>

    <div class="InformaçõesProf";>
                            <?php 

                            if($qtd > 0){
                                echo "<div class='alunos-container'>"; // Adicionamos um contêiner flexível
                                while($row = $Ares->fetch_object()){
                                    echo "<p class='nome-aluno'>" . $row->nome . "</p>";
                                    echo "<a>Informações</a>";
                                    echo "<div class='botaoinfo'>";
                                    echo "<div class='imagemBotao'>";
                                    echo "<img onclick=\"window.location.href='aluno.php?id_aluno=" . htmlspecialchars($row->matricula, ENT_QUOTES, 'UTF-8') . "'\" src='Imagens/Informacoes.png' alt='Informações'>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                echo "</div>"; // Fechamos o contêiner flexível
                            }
                                
                            ?>
                        </div>

                        <div class="outer-container">
        <div class="inner-container">
            <div class="title">Técnico em Agropecuária</div>
            
        </div>
    </div>
    <div class="green-bar2"></div>
    <div class="InformaçõesProf";>
                            <?php 

                            if($qtd > 0){
                                echo "<div class='alunos-container'>"; // Adicionamos um contêiner flexível
                                while($row = $Ares->fetch_object()){
                                    echo "<p class='nome-aluno'>" . $row->nome . "</p>";
                                    echo "<div class='botaoinfo'>";
                                    echo "<a>Informações</a>";
                                    echo "<div class='imagemBotao'>";
                                    echo "<img onclick=\"window.location.href='aluno.php?id_aluno=" . htmlspecialchars($row->matricula, ENT_QUOTES, 'UTF-8') . "'\" src='Imagens/Informacoes.png' alt='Informações'>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                echo "</div>"; // Fechamos o contêiner flexível
                            }
                                
                            ?>
                        </div>
                  
    <div class="outer-container">
        <div class="inner-container">
            <div class="title">Técnico em Infornática</div>
            
        </div>
    </div>
    <div class="green-bar2"></div>

    <div class="InformaçõesProf";>
                            <?php 

                            if($qtd > 0){
                                echo "<div class='alunos-container'>"; // Adicionamos um contêiner flexível
                                while($row = $Ares->fetch_object()){
                                    echo "<p class='nome-aluno'>" . $row->nome . "</p>";
                                    echo "<div class='botaoinfo'>";
                                    echo "<a>Informações</a>";
                                    echo "<div class='imagemBotao'>";
                                    echo "<img onclick=\"window.location.href='aluno.php?id_aluno=" . htmlspecialchars($row->matricula, ENT_QUOTES, 'UTF-8') . "'\" src='Imagens/Informacoes.png' alt='Informações'>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                echo "</div>"; // Fechamos o contêiner flexível
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
