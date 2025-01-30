<?php 
    require('config.php');

    session_start();

    $aluno = $_REQUEST['id'];


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






    // Função usada para excluir aluno
    if(isset($_REQUEST['excluir'])){
        $removercomentarioaluno = "DELETE FROM comentario WHERE matricula = '{$aluno}'";
        $removeralunosql = "DELETE FROM aluno WHERE matricula = '{$aluno}'";
        $conn->query($removercomentarioaluno);
        $conn->query($removeralunosql);
        print "<script>location.href='alunos.php'</script>";
    }
    // XXXXXXXXXX If que confere se o usuário está logado XXXXXXXXXXXXXX
    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }


    // Seleciona coisas do aluno
    $sql = "select * from aluno where matricula = '{$aluno}'";
    $res = $conn->query($sql);
    $resSet = $res->fetch_assoc();

    // Seleciona comentários
    $sqlComentario = "select * from comentario inner join usuario where comentario.id_us = usuario.id_us and matricula = '{$aluno}'";
    $resComentario = $conn->query($sqlComentario);
    $ComentInfo = $res->fetch_assoc();




    function Atualizar($id, $matricula, $telefone, $email, $nome, $genero, $cidade, $dataNasc, $moradia, $cota, $bolsa, $orientador, $reprovacao, $equipTI, $estagio, $cpf, $acompanhamento){
        include('config.php');
        $sql = "UPDATE aluno SET matricula='{$matricula}', telefone='{$telefone}', email='{$email}', nome='{$nome}', genero='{$genero}', cidade='{$cidade}', dataNasc='{$dataNasc}', moradia='{$moradia}', cota='{$cota}', bolsa='{$bolsa}', orientador='{$orientador}', reprovacao='{$reprovacao}', equipTI='{$equipTI}', estagio='{$estagio}', cpf='{$cpf}', acompanhamento='{$acompanhamento}' where matricula = '{$id}'";
        $conn->query($sql) or die($conn->error);
        print "<script> location.href='alunos.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="alunocss.css">
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
        <div class="Posicao">
            <button onclick="if(confirm('Tem certeza que deseja excluir esse perfil de professor?')){location.href='aluno.php?id=<?php echo $aluno ?>&excluir=1'}">
                <img src="Imagens/Lixeira.png" alt="Excluir" class="img-button">
            </button>
        </div>
        <div class="Comentarios">
            <button onclick="location.href='aluno.php?id= <?php echo $aluno ?>&adicao=1'">Adicionar comentário</button>
        </div>
        <div class="Posicao2">
            <a href="editar_aluno.php?id=<?php echo $aluno ?>">
                <button>
                    <img src="Imagens/editar.png" alt="Editar" class="img-button">
                </button>
            </a>
        </div>

        <div class="Titulo-Professores">
            <h1>Informações do Aluno(a)</h1>
        </div>

    </div>

    <div class="new-bottom-bar">
        <div class="box-center">
            <?php 
                if(isset($_POST['atualizar'])){
                    Atualizar($_POST['id'], $_POST['matricula'], $_POST['telefone'], $_POST['email'], $_POST['nome'], $_POST['genero'], $_POST['cidade'], $_POST['dataNasc'], $_POST['moradia'], $_POST['cota'], $_POST['bolsa'], $_POST['orientador'], $_POST['reprovacao'], $_POST['equipTI'], $_POST['estagio'], $_POST['cpf'], $_POST['acompanhamento']);
                }
                if ($qtdChecagem > 0) {
                    similar_text($UsoC->tipo, "DE", $percent);
                    if($percent  == 100) {

            ?>
                
            <form action='aluno.php' method='POST'>
                <input type='hidden' name='id' value="<?php echo $aluno ?>">

                <div class="Matricula">
                    <label>Matrícula:</label> <br>
                    <a type='text' name='matricula'><?php echo $aluno ?></a>
                </div>

                    <div class="Telefone">
                        <label>Telefone:</label> <br>
                        <a type='text' name='telefone'><?php echo $resSet['telefone'] ?></a>
                    </div>

                    <div class="Email">
                        <label>Email:</label> <br>
                        <a type='email' name='email'><?php echo $resSet['email'] ?></a>
                    </div>

                    <div class="Nome">
                        <label>Nome:</label> <br>
                        <a type='text' name='nome'><?php echo $resSet['nome'] ?></a>
                    </div>

                    <div class="Genero">
                        <label>Gênero:</label> <br>
                        <a type='text' name='genero'><?php echo $resSet['genero'] ?></a>
                    </div>

                    <div class="Cidade">
                        <label>Cidade:</label> <br>
                        <a type='text' name='cidade'><?php echo $resSet['cidade'] ?></a>
                    </div>

                    <div class="Data-De-Nascimento">
                        <label>Data de Nascimento:</label> <br>
                        <a type='date' name='dataNasc'><?php echo $resSet['dataNasc'] ?></a>
                    </div>

                    <div class="Moradia">
                        <label>Moradia:</label> <br>
                        <a type='text' name='moradia'><?php echo $resSet['moradia'] ?></a>
                    </div>
                            
                    <div class="Cota">
                        <label>Cota:</label> <br>
                        <a type='text' name='cota'><?php echo $resSet['cota'] ?></a>
                    </div>

                    <div class="Bolsa">
                        <label>Bolsa:</label> <br>
                        <a type='text' name='bolsa'><?php echo $resSet['bolsa'] ?></a>
                    </div>

                    <div class="Orientador">
                        <label>Orientador:</label> <br>
                        <a type='text' name='orientador'><?php echo $resSet['orientador'] ?></a>
                    </div>

                    <div class="Reprovacao">
                        <label>Reprovação:</label> <br>
                        <a type='text' name='reprovacao'><?php echo $resSet['reprovacao'] ?></a>
                    </div>
                
                    <div class="EquipamentoTI">
                        <label>Equipamento TI:</label> <br>
                        <a type='text' name='equipTI'><?php echo $resSet['equipTI'] ?></a>
                    </div>

                    <div class="Cidade">
                        <label>Cidade:</label> <br>
                        <a type='text' name='cidade'><?php echo $resSet['cidade'] ?></a>
                    </div>
                            
                    <div class="Estagio">
                        <label>Estágio:</label> <br>
                        <a type='text' name='estagio'><?php echo $resSet['estagio'] ?></a>
                    </div>

                    <div class="CPF">
                        <label>CPF:</label> <br>
                        <a type='text' name='cpf'><?php echo $resSet['cpf'] ?></a>
                    </div>
                            
                    <div class="Acompanhamento">
                        <label>Acompanhamento:</label> <br>
                        <a type='text' name='acompanhamento'><?php echo $resSet['acompanhamento'] ?></a> <br>
                    </div>
                            
                </form>

                <?php } 
                    }else {
                        print $resSet['matricula'] . "<br>";
                        print $resSet['telefone'] . "<br>";
                        print $resSet['email'] . "<br>";
                        print $resSet['nome'] . "<br>";
                        print $resSet['genero'] . "<br>";
                        print $resSet['cidade'] . "<br>";
                        print $resSet['dataNasc'] . "<br>";
                        print $resSet['moradia'] . "<br>";
                        print $resSet['cota'] . "<br>";
                        print $resSet['bolsa'] . "<br>";
                        print $resSet['orientador'] . "<br>";
                        print $resSet['reprovacao'] . "<br>";
                        print $resSet['equipTI'] . "<br>";
                    }
                ?>
                <?php
                    if(isset($_REQUEST['adicao'])){
                ?>  
                    <div class ="FormComentario">
                        <form action='add_comentario.php' method='POST'>
                            <input type='hidden' name='id_us' value='<?php echo $_SESSION['id_us'] ?>'>
                            <input type='hidden' name='id' value='<?php echo $aluno ?>'>
                            <label>Comentário</label> <br>
                            <input type='text' name='comentario'>
                            <button type='submit' name='comentar'>Adicionar comentário</button>
                        </form>
                    </div>
                <?php
                    }
                    print "<div class='ComentariosPag'>";
                    while ($row = $resComentario->fetch_object()){
                            print  "<br> <br>" . $row->nome . "<br> ";
                            print $row->descricao;
                            if ($row->id_us == $_SESSION['id_us']){
                                print "<br> <button onclick=\"location.href='ed_comentario.php?id_comentario=".$row->id_coment."'\">Editar comentário</button>";
                                print "<br> <button onclick=\"location.href='add_comentario.php?remover=1&id_comentario=" . $row->id_coment . "'\">Remover Comentário</button>";
                            }
                    }
                    print "</div>";
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
