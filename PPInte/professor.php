<?php
    require('config.php');

    session_start();

    //variáveis para a checagem se o usuário é um setor

    $prof = $_REQUEST['id_prof'];
    
    if(isset($_REQUEST['excluir'])){

        $busca = "select * from usuario where id_us = '{$prof}'";
        $hoje = date('Y-m-d');
        $pegaC = $conn->query($busca);
        $mostra = $pegaC->fetch_object();
        $sqlH = "Insert into historico (id_us, descricao, dat) values ('{$_SESSION['id_us']}', 'Usuário excluiu o professor de nome ".$mostra->nome."', '". $hoje ."')";
        $QHist = $conn->query($sqlH) or die($conn->error);

        $removerprofessorcoordenador = "UPDATE curso SET id_coord = null WHERE id_coord = '{$prof}'";
        $removerprofessordisciplina = "DELETE FROM professor_disciplina WHERE id_prof = '{$prof}'";
        $removerprofessorturma = "DELETE FROM professor_turma WHERE id_prof = '{$prof}'";
        $removerprofessorfavorita = "DELETE FROM favorita WHERE id_us = '{$prof}'";
        $removerprofessorcomentario = "DELETE FROM comentario WHERE id_us = '{$prof}'";
        $removerprofessorsql = "DELETE FROM professor WHERE id_prof = '{$prof}'";
        $removerusuariosql = "DELETE FROM usuario WHERE id_us = '{$prof}'";
        
        $conn->query($removerprofessorcoordenador) or die($conn->error);
        $conn->query($removerprofessorturma) or die($conn->error);
        $conn->query($removerprofessordisciplina) or die($conn->error);
        $conn->query($removerprofessorfavorita) or die($conn->error);
        $conn->query($removerprofessorcomentario) or die($conn->error);
        $conn->query($removerprofessorsql) or die($conn->error);
        $conn->query($removerusuariosql) or die($conn->error);
        print "<script>alert('Professor removido com sucesso!')</script>";
        print "<script>location.href='professores.php'</script>";
    }

    $Checagem = "select * from setor where id_set = '{$_SESSION['id_us']}'";
    $ConsultaC = $conn->query($Checagem);
    $UsoC = $ConsultaC->fetch_object();
    $qtdChecagem = $ConsultaC->num_rows;

    function Atualizar($id, $cpf, $Siape, $nome, $fone){
        include('config.php');
        $sql = "UPDATE usuario SET cpf = '{$cpf}', Siape = '{$Siape}', nome = '{$nome}', fone='{$fone}' where id_us = '{$id}'";
        $conn->query($sql) or die($conn->error);
        print "<script> location.href='professores.php'</script>";
    }
    // Variáveis para a conferência do usuário
    $sql = "select * from usuario where id_us = '{$prof}'";
    $res = $conn->query($sql);
    $resSet = $res->fetch_object();

    // Seleciona as turma atuais do professor
    $sqlTurma = "select * from professor_turma inner join turma where professor_turma.id_prof ='{$prof}'";
    $resTurma = $conn->query($sqlTurma);

    // Seleciona as disciplinas atuais do professor
    $sqlDisciplina = "select * from professor_disciplina inner join disciplina where professor_disciplina.id_prof = '{$prof}'";
    $resDisciplina = $conn->query($sqlDisciplina);

    if ($qtdChecagem > 0) {
?>

            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
                <link rel="stylesheet" href="professorcss.css">
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
                <a href='PTurmas.php?id_prof=<?php echo $prof?>'>Ver turmas do professor</a>
                <a href='PDisciplinas.php?id_prof=<?php echo $prof?>'>Ver disciplinas do professor</a>
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
                        <button onclick="if(confirm('Tem certeza que deseja excluir esse perfil de professor?')){location.href='professor.php?id_prof=<?php echo $prof ?>&excluir=1'}">
                            <img src="Imagens/Lixeira.png" alt="Excluir" class="img-button">
                        </button>
                    </div>

                    <div class="Posicao2">
                        <a href="editar.php?id_prof=<?php echo $prof ?>">
                            <button>
                                <img src="Imagens/editar.png" alt="Editar" class="img-button">
                            </button>
                        </a>
                    </div>

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
                                    Atualizar($_POST['id_prof'], $_POST['cpf'], $_POST['siape'], $_POST['nome'], $_POST['fone']);
                                }
                                similar_text($UsoC->tipo, "DE", $percent);
                                if($percent  == 100) { ?>
                                            <form action='professor.php' method='POST'>

                                                <div class="Nome">
                                                    <label>Nome:</label> <br>
                                                    <a type='text' name='nome'><?php echo $resSet->nome ?></a> <br>
                                                    <input type='hidden' name='id_prof' value="<?php echo $prof ?>"> <br>
                                                </div>

                                                <div class="CPF">
                                                    <label>CPF:</label> <br>
                                                    <a type='text' name='cpf'><?php echo $resSet->cpf ?></a><br>
                                                </div>

                                                <br>

                                                <div class="SIAPE">
                                                    <label>Matrícula SIAPE:</label> <br>
                                                    <a type='text' name='siape'><?php echo $resSet->Siape ?></a><br>
                                                </div>

                                                <div class="Fone">
                                                    <label>Número de Telefone:</label> <br>
                                                    <a type='text' name='fone'><?php echo $resSet->fone ?></a><br>
                                                </div>

                                                <label>Turmas do professor: </label> <br>
                                                <?php 
                                                while ($rowTurma = $resTurma->fetch_object()){
                                                        echo $rowTurma->nome . "<br>";
                                                }
                                                ?>

                                                <label>Disciplinas do professor: </label> <br>
                                                <?php 
                                                while ($rowDisciplina = $resDisciplina->fetch_object()){
                                                        echo $rowDisciplina->nome . "<br>";
                                                }
                                                ?>

                                                <br>

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
