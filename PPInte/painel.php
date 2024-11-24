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
        ?>
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="painelcss.css">
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

                <!-- Barra Verde 2 -->
                <div class="new-green-bar">
                    <div class="arrumar-Favoritos">
                        <a href='t_favoritas.php'>Favoritos:</a>
                    </div>
                </div>

                <!-- Barra Verde 3 -->
                <div class="new-bottom-bar">
                    <div class="box-center">
                        <div class="arrumar-Importantes">
                            <h1>Importante</h1>
                            <?php 
                                echo "<br>".$rowD->nome."<br>";
                                echo $rowD->dt."<br>";
                            ?>
                        </div>
                        <div class="linhaImportantes"></div>
                        <div class="noticias-box"></div>

                        <div class="linhaCursos"></div>
                        <div class="arrumar-Cursos">
                            <h1>Cursos</h1>
                        </div>

                        <div class="linhaLembretes"></div>
                        <div class="arrumar-Lembretes">
                            <h1>Lembretes</h1>
                            <a href='lembretes.php'>Ver mais (Colocar perto dos lembretes)</a>
                           <?php 
                                while($row = $resD->fetch_object()){
                                    echo "<br><span>". $row->nome ."</span><br>";
                                    echo "<span>". $row->dt ."</span><br>";
                                }
                            ?>
                        </div>

                        <div class="lembretes-box"></div>

                        <div class="linhaTurmas"></div>
                        <div class="arrumar-Turmas">
                            <h1>Turmas</h1>
                        </div>

                        <div class="iconeiff">
                            <img src="Imagens/LogoIffar.png">
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
?>
