<?php 
    require("config.php");

    session_start();

    $sql = "select * from usuario inner join setor where usuario.senha = '{$_SESSION["senha"]}' and setor.id_set = '{$_SESSION["id_us"]}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $qtd = $res->num_rows;

    $sqlD = "select * from lembrete where dt >= ". date("Y-m-d") ." order by dt asc limit 3";
    $resD = $conn->query($sqlD);
    $rowD = $resD->fetch_object();

    $sqlT = "select * from turma inner join professor_turma on turma.id = professor_turma.id_turma where professor_turma.id_prof = '{$_SESSION['id_us']}'";
    $resT = $conn->query($sqlT);

    $sqlC = "select curso.nome, curso.id_curso from curso inner join turma on turma.id_curso = curso.id_curso inner join professor_turma on turma.id = professor_turma.id_turma where professor_turma.id_prof = '{$_SESSION['id_us']}'";
    $resC = $conn->query($sqlC);

    $sqlSet = "select * from turma";
    $resSet = $conn->query($sqlSet);

    $sqlSetC = "select * from curso";
    $resSetC = $conn->query($sqlSetC);

?>
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="painelcss.css?v=<?php echo time(); ?>">
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

                <!-- Barra cinza 2 -->
                <div class="bottom-bar">

                <div class="arrumar-Favoritos">
                    <a href='t_favoritas.php'>Favoritos</a>
                </div>
                <div class="iconeNotificacao">
                        <img src="Imagens/Notificacao.png">
                    </div>
                    <div class="iconeTitulo">
                        <img src="Imagens/Titulo.png">
                    </div>
                    <div class="iconePerfil">
                        <img src="Imagens/Perfil.png">
                    </div>
                    <!--
                    <div class="menu-abrirPerf" onclick="abrirPerfil()">⭣</div>
                    <div class="perfil">
        
                    </div>
                    <div class="menu-fecharPerf" onclick="fecharPerfil()">⭣</div>-->
                </div>

                <!-- Barra Verde 2 -->
                <div class="new-green-bar">
                </div>

                <!-- Barra Verde 3 -->
                <div class="new-bottom-bar">
                    <div class="box-center">
        
                        <div class="linhaImportantes"></div>
                        <div class="ImportantesTi">
                            <h1>Importante</h1>
                        </div>
                        <div class="noticias-box">
                            <div class="arrumar-Importantes">
                                <?php 
                                    echo "<br>".$rowD->nome."<br>";
                                    echo $rowD->dt."<br>";
                                ?>
                            </div>
                        </div>

                        <div class="linhaCursos"></div>
                        <div class="CursosH1">
                            <h1>Cursos</h1>
                        </div>
                        <div class="cursos-box">
                            <div class="arrumar-Cursos">
                                <?php
                                    if($row->tipo != "DE"){
                                            while($rowC = $resC->fetch_object()){
                                            echo "<br><span>Curso ".$rowC->nome."</span><br>";
                                            echo "<div class='botaoCurso'>";
                                            echo "<img onclick=\"window.location.href='curso.php?id=" . htmlspecialchars($rowC->id_curso, ENT_QUOTES, 'UTF-8') . "'\" src='Imagens/Informacoes.png' alt='Detalhes'>";
                                            echo "</div>";
                                            echo "<div class='LinhaParaSeparar1'></div>";
                                        }
                                    } else if($row->tipo == "DE"){
                                            while($rowSetC = $resSetC->fetch_object()){
                                                echo "<br><span>Curso ".$rowSetC->nome."</span><br>";
                                                echo "<div class='botaoCurso'>";
                                                echo "<img onclick=\"window.location.href='curso.php?id=" . htmlspecialchars($rowSetC->id_curso, ENT_QUOTES, 'UTF-8') . "'\" src='Imagens/Informacoes.png' alt='Detalhes'>";
                                                echo "</div>";
                                                echo "<div class='LinhaParaSeparar1'></div>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="linhaLembretes"></div>
                        <div class="TituloLembretes">
                            <h1>Lembretes</h1>
                        </div>

                        <div class="LembretesA">
                            <a href='lembretes.php'>Ver mais</a>
                            <div class="lembretes-box">
                                <div class="arrumar-Lembretes">
                                    <?php 
                                        while($rowL = $resD->fetch_object()){
                                            echo "<br><span>". $rowL->nome ."</span><br>";
                                            echo "<span>". $rowL->dt ."</span><br><br>";
                                            echo "<div class='linhadivisoria'></div>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="linhaTurmas"></div>
                        <div class="TituloTurmas">
                            <h1>Turmas</h1>
                        </div>
                        <div class="turmas-box">
                            <div class="arrumar-Turmas">
                                <?php
                                if ($row->tipo != "DE" ){
                                    while($rowT = $resT->fetch_object()){
                                        echo "<br><span>Turma ".$rowT->nome."</span><br>";
                                        echo "<div class='botaoTurma'>";
                                        echo "<img onclick=\"window.location.href='turma.php?id=" . htmlspecialchars($rowT->id_turma, ENT_QUOTES, 'UTF-8') . "'\" src='Imagens/Informacoes.png' alt='Detalhes'>";
                                        echo "</div>";
                                        echo "<div class='LinhaParaSeparar2'></div>";
        
                                    }
                                } else if($row->tipo == "DE"){
                                    while($rowSet = $resSet->fetch_object()){
                                        echo "<br><span>Turma ".$rowSet->nome."</span><br>";
                                        echo "<div class='botaoTurma'>";
                                        echo "<img onclick=\"window.location.href='turma.php?id=" . htmlspecialchars($rowSet->id, ENT_QUOTES, 'UTF-8') . "'\" src='Imagens/Informacoes.png' alt='Detalhes'>";
                                        echo "</div>";
                                        echo "<div class='LinhaParaSeparar2'></div>";
        
                                    }
                                }
                                ?>
                        </div>
                        </div>

                        <div class="iconeiff">
                            <img src="Imagens/LogoIffar.png">
                        </div>
                    </div>
                </div>

                <script>
                    //
                    function abrirPerfil() {
                        var menu = document.querySelector('.perfil');
                        menu.style.display = 'block';
                    }

                    function fecharPerfil() {
                        var menu = document.querySelector('.perfil');
                        menu.style.display = 'none';
                    }
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
?>
