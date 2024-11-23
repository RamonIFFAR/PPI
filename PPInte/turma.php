<?php
    require('config.php');

    // Inicia a sessão
    session_start();

    $id_turma = $_REQUEST['id']; 
    // Finaliza a sessão
    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    $sqlT = "select * from favorita where id_turma = '{$id_turma}' and id_us = '{$_SESSION['id_us']}'";
    $resT = $conn->query($sqlT) or die($conn->error);
    $rowT = $resT->fetch_object();
    $qtdT = $resT->num_rows;

    if(isset($_REQUEST['favorita'])){
        if($qtdT == 0){
            $favorita = $_REQUEST['favorita'];
            if($favorita == 1){
                $sqlF = "insert into favorita(id_us, id_turma) values('{$_SESSION['id_us']}', '{$id_turma}')";
                $resF = $conn->query($sqlF) or die($conn->error);
            } else if($favorita== 0){
                $sqlF = "delete from favorita where id_turma = '{$id_turma}' and id_us = '{$_SESSION['id_us']}'";
                $resF = $conn->query($sqlF) or die($conn->error);
            }
    }
    } else {
        
    }

    if(isset($_REQUEST['excluir'])){
        $removerturmasql = "DELETE FROM turma WHERE id = '{$id_turma}'";
        $conn->query($removerturmasql);
        print "<script>alert('Curso excluído com sucesso!')</script>";
        print "<script>location.href='turmas.php'</script>";
    }

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

    //  XXXXXXXXXX If que confere se o usuário é um setor DE XXXXXXXXXXXXXX
    if($qtdChecagem > 0){
    } else{
        print"<script>alert('Você não tem permissão para estar aqui')</script>";
        print"<script>location.href=index.php</script>";
    }

    $sql = "select * from turma where id = '{$id_turma}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();

?>

            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
                <link rel="stylesheet" href="turmacss.css">
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

                        <?php if($qtdChecagem > 0){
                            similar_text($UsoC->tipo, "DE", $percent);
                                if($percent  == 100) { ?>
                        
                        <button onclick="if(confirm('Tem certeza que deseja excluir essa turma?')){location.href='turma.php?id=<?php echo $id_turma ?>&excluir=1'}">
                            <img src="Imagens/Lixeira.png" alt="Excluir" class="img-button">
                        </button>

                        <?php 
                             }}
                        ?>
                        
                    </div>
                    
                    <div class="Posicao2">

                
                    <?php if($qtdChecagem > 0){
                            similar_text($UsoC->tipo, "DE", $percent);
                                if($percent  == 100) { ?>

                        <a onclick="location.href='ed_turma.php?id_turma=<?php echo $id_turma;?>'">
                            <button>
                                <img src="Imagens/editar.png" alt="Editar" class="img-button">
                            </button>
                        </a>

                        <?php 
                                }
                            }
                        ?>
                    </div>

                    <div class="Titulo-Professores">
                        <h1>Detalhes da Turma</h1>
                    </div>

                </div>

                
                <div class="new-bottom-bar">
                    <div class="box-center">
                        <?php 
                            if ($qtdChecagem > 0){
                                similar_text($UsoC->tipo, "DE", $percent);
                                if($percent  == 100) { ?>
                                    <form action='turma.php' method='POST'>

                                        <div class="Nome">
                                            <label>Nome:</label> <br>
                                            <a type='text' name='nome'><?php echo $row->nome ?></a> <br>
                                        </div>

                                        <div class="Duracao">
                                            <label>Sala:</label> <br>
                                            <a type='text' name='duracao'><?php echo $row->sala ?></a><br>
                                        </div>

                                        <br>

                                        <div class="Descricao">
                                            <label>Descrição:</label> <br>
                                            <a type='text' name='descricao'><?php echo $row->descricao ?></a><br>
                                        </div>
                                        <br>
                                    </form> <br>
                                <?php } 
                        }   else {
                                    print 
                                    "<div class='Nome'>
                                    <label>Nome:</label> <br>
                                    <a type='text' name='nome'>". $row->nome ."</a> <br>
                                    </div>";
                                    print 
                                    "<div class='Duracao'>
                                    <label>Sala:</label> <br>
                                    <a type='text' name='nome'>". $row->sala ."</a> <br>
                                    </div>";
                                    print 
                                    "<div class='Descricao'>
                                    <label>Descrição:</label> <br>
                                    <a type='text' name='nome'>". $row->descricao ."</a> <br>
                                    </div>";
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
