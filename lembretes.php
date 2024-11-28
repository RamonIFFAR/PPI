<?php 
    require("config.php");

    session_start();

    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    $sql = "select * from usuario where senha = '{$_SESSION["senha"]}' and email = '{$_SESSION["email"]}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $qtd = $res->num_rows;

    $sqlSET = "select * from usuario inner join setor where usuario.senha = '{$_SESSION["senha"]}' and setor.id_set = '{$_SESSION["id_us"]}' and tipo like 'DE'";
    $resSET = $conn->query($sqlSET) or die($conn->error);
    $rowSET = $resSET->fetch_object();
    $qtdSET = $resSET->num_rows;

    if($qtd < 0){
        echo "<script>location.href='painel.php'</script>";
    }

    $sqlLembrete = "select * from lembrete";
    $Lres = $conn->query($sqlLembrete) or die($conn->error);
    $Lqtd = $Lres->num_rows;

    if(isset($_REQUEST['excluir'])){
    $sqlR = "delete from lembrete where id='{$_REQUEST['id_lemb']}'";
    $conn->query($sqlR) or die($conn->error);
    echo "<script>alert('Lembrete excluído com sucesso')</script>";
    echo "<script>location.href='lembretes.php'</script>"; 
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
        <link rel="stylesheet" href="professorescss.css?v=<?php echo time(); ?>">
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
                        <h1>LEMBRETES</h1>
                    </div>

<div class="AdicionarProf">
    <?php 
    if($qtdSET > 0){
        echo "<a href='add_lembrete.php'>Adicionar lembrete</a> <br>";
    }
    ?>
    </div>
</div>
<div class="new-bottom-bar">
                    <div class="box-center">
                        <div class="InformaçõesProf";>
                            <?php
                                if($Lqtd > 0){
                                    while($Lrow = $Lres->fetch_object()){
                                        echo "<br>" . $Lrow->nome . "<br>";
                                        echo $Lrow->descricao . "<br>";
                                        echo $Lrow->dt . "<br>"; ?>
                                        
                                        <?php 
                                        if ($qtdSET > 0 || $Lrow->id_us == $_SESSION['id_us']){
                                            ?>
                                            <button onclick="location.href='lembrete.php?id_lemb=<?php echo $Lrow->id ?>'">Visualizar lembrete</button> <br>
                                            <button onclick="if(confirm('Tem certeza que deseja apagar esse lembrete? Uma fez feita, essa ação não pode ser desfeita')){location.href='lembretes.php?id_lemb=<?php echo $Lrow->id ?>&excluir=1'}">Excluir lembrete</button> <br>
                                            <br>    
                                            <hr>
                                            <?php
                                        }
                                    }
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

