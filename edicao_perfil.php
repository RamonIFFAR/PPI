<?php
    require("config.php");

    session_start();

    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    $sql = "SELECT * FROM usuario WHERE senha = '{$_SESSION["senha"]}' and email = '{$_SESSION["email"]}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $qtd = $res->num_rows;

    function editar($id_us, $nome, $fone){
        include("config.php");
        $SQLatu = "update usuario set nome = '{$nome}', fone = '{$fone}' where id_us = '{$id_us}'";
        $SQLexe = $conn->query($SQLatu);
        echo "<script>location.href='perfil.php'</script>";
    }

    if($qtd > 0){

    } else{
        print"<script> location.href='painel.php' </script>";
    }
    if(isset($_REQUEST['editar'])){
       editar($_POST['id_us'], $_POST['nome'], $_POST['fone']);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="edicao_perfilcss.css?v=<?php echo time(); ?>">
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
        <div class="iconeTitulo">
            <img src="Imagens/Titulo.png">
        </div>
    </div>
    <div class="new-green-bar">
    </div>
    <div class="new-bottom-bar">
        <div class="box-center">
            <div class="Titulo-Professores">
                <h1>Minha conta</h1>
            </div>
            <div class="Linha1"></div>
            <div class="Foto">
                <img src="<?php echo $row->foto?>"></img><br>
            </div>

            <form method='POST' enctype="multipart/form-data" action="edicao_perfil.php">
                <input type='hidden' name='id_us' value='<?php echo $row->id_us ?>'>
                <div class="Nome">
                    <label>Nome:</label>
                    <input type='text' name='nome' value='<?php echo $row->nome?>'><br>
                </div>
                <div class="Telefone">
                    <label>Telefone:</label><br>
                    <input type='text' name='fone' value='<?php echo $row->fone?>'> <br>
                </div>
                <div class ="BotaoSalvar">
                    <button type='submit' name='editar'>Salvar</button> <br>
                </div>
            </form>
            <div class="EditarSenha">
                <button onclick="location.href='edicao_senha.php'">Editar senha</button><br>
            </div>
            <div class="email">
                <span>Email: <?php echo $row->email ?></span><br>
            </div>
            <div class="siape">
                <span>Matrícula SIAPE: <?php echo $row->Siape ?></span><br>
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