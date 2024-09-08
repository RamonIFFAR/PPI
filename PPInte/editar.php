<?php
    require('config.php');

    session_start();

    //variáveis para a checagem se o usuário é um setor

    $prof = $_REQUEST['id_prof'];
    
    if(isset($_REQUEST['excluir'])){
        $removerprofessorsql = "DELETE FROM professor WHERE id_prof = '{$prof}'";
        $removerusuariosql = "DELETE FROM usuario WHERE id_prof = '{$prof}'";
        $conn->query($removerprofessorsql);
        $conn->query($removerusuariosql);
        print "<script>location.href='professores.php'</script>";
    }

    $Checagem = "select * from setor where id_set = '{$_SESSION['id_us']}'";
    $ConsultaC = $conn->query($Checagem);
    $UsoC = $ConsultaC->fetch_object();
    $qtdChecagem = $ConsultaC->num_rows;

    function Atualizar($id, $cpf, $Siape, $nome){
        include('config.php');
        $sql = "UPDATE usuario SET cpf = '{$cpf}', Siape = '{$Siape}', nome = '{$nome}' where id_us = '{$id}'";
        $conn->query($sql) or die($conn->error);
        print "<script> location.href='professores.php'</script>";
    }
    // Variáveis para a conferência do usuário
    $sql = "select * from usuario where id_us = '{$prof}'";
    $res = $conn->query($sql);
    $resSet = $res->fetch_object();

    if ($qtdChecagem > 0) {
?>

            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
                <link rel="stylesheet" href="editarcss.css">
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

                    <div class="Titulo-Professores">
                        <h1>Informações do Professor</h1>
                    </div>

                    <div class="Nomear Classe">
                        <?php
                        ?>
                    </div>
                </div>

                <!-- Nova barra cinza abaixo da nova barra verde -->
                <div class="new-bottom-bar">
                    <div class="box-center">
                        <?php 
                                if(isset($_POST['atualiza'])){
                                    Atualizar($_POST['id_prof'], $_POST['cpf'], $_POST['siape'], $_POST['nome']);
                                }
                                similar_text($UsoC->tipo, "DE", $percent);
                                if($percent  == 100) { ?>
                                            <form action='professor.php' method='POST'>

                                                <div class="Nome">
                                                    <label>Nome:</label> <br>
                                                    <input type='text' name='nome' value=" <?php echo $resSet->nome ?>"> <br>
                                                    <input type='hidden' name='id_prof' value="<?php echo $prof ?>"> <br>
                                                </div>

                                                <div class="CPF">
                                                    <label>CPF:</label> <br>
                                                    <input type='text' name='cpf' value=" <?php echo $resSet->cpf ?>"><br>
                                                </div>

                                                <br>

                                                <div class="SIAPE">
                                                    <label>Matrícula SIAPE:</label> <br>
                                                    <input type='text' name='siape' value=" <?php echo $resSet->Siape ?> "></a><br>
                                                </div>

                                                <br>
                                                
                                                <div class="Posicao">
                                                    <button type=submit name='atualiza'>Salvar alterações</button>
                                                </div>

                                            </form> <br>
                                <?php } else {
                                        print $resSet->nome . "<br>";
                                        print $resSet->Siape . "<br>";
                                        print $resSet->email . "<br>";
                                        print $resSet->cpf . "<br>";
                            }
                            } else {
                                print "<script>location.href='index.php'</script>";
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
