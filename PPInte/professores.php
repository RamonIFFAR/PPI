    <?php 
    session_start();

    require('config.php');
    //variáveis para a execução normal do código
    $nome = "select nome from usuario where senha = '{$_SESSION["email"]}'";
    $sql = "select usuario.id_us, usuario.Siape, usuario.nome, professor.id_prof from usuario inner join professor where usuario.id_us=professor.id_prof";
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
                <style>

                    
                    .top-bar {
                        width: 100%;
                        height: 50px;
                        background-color: #d2d6d3; /* Cor cinza */
                        position: relative;
                    }

                    /* Estilo para a barra verde */
                    .green-bar {
                        width: 100%;
                        height: 10px; /* Ajuste a altura conforme necessário */
                        background-color: #015d29; /* Cor verde */
                        position: relative;
                        top: 0px; /* Alinhar a barra verde logo abaixo da barra cinza */
                    }

                    /* Estilo para a nova barra cinza */
                    .bottom-bar {
                        width: 100%;
                        height: 60px; /* Ajuste a altura conforme necessário */
                        background-color: #d2d6d3; /* Cor cinza */
                        position: relative;
                        top: 10px; /* Alinhar a nova barra cinza logo abaixo da barra verde */
                    }

                    .new-green-bar {
                        width: 100%;
                        height: 100px; /* Ajuste a altura conforme necessário */
                        background-color: #015d29; /* Cor verde */
                        position: relative;
                        top: 20px; /* Alinhar a nova barra verde logo abaixo da nova barra cinza */
                    }

                    .new-bottom-bar {
                        width: 100%;
                        height: 75vh; /* Ajuste a altura conforme necessário */
                        background-color: #015d29; /* Cor cinza */
                        position: relative;
                        top: 20px; /* Alinhar a nova barra cinza logo abaixo da nova barra verde */
                    }

                    .box-center {
                        width: 90%;
                        height: 700px;
                        background-color: white;
                        position: relative;
                        top: 47%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        border-radius: 20px;
                        box-sizing: border-box;
                        padding: 20px;
                        overflow: auto; /* Adiciona a barra de rolagem quando necessário */
                    }


                    .Titulo-Professores h1{
                        font-size: 35px;
                        color: White;
                        position: absolute;
                        font-family: 'Anton';
                        font-style: Italic;
                        letter-spacing: 1px;
                        top: 0px;
                        left: 5%;
                    }

                    .iconeTitulo img {
                        width: 250px;
                        height: auto;
                        position: absolute;
                        top: 10px;
                        left: 50px;
                    }

                    .iconeNotificacao img {
                        width: 25px;
                        height: auto;
                        position: absolute;
                        top: 20px;
                        left: 89%;
                    }

                    .iconePerfil img {
                        width: 30px;
                        height: auto;
                        position: absolute;
                        top: 20px;
                        left: 93%;
                    }

                    .menu-container {
                        position: absolute;
                        display: inline-block;
                    }

                    .menu-abriricon {
                        font-size: 24px;
                        cursor: pointer;
                        position: absolute;
                        top: 10px;
                        left: 10px;
                    }

                    .menu-fecharicon {
                        font-size: 24px;
                        color: white;
                        cursor: pointer;
                        position: absolute;
                        top: 10px;
                        left: 15px;
                    }

                    .floating-menu {
                        width: 350px;
                        height: 100vh;
                        display: none;
                        position: relative;
                        top: 100%; 
                        left: 0;
                        background-color: #015d29;
                        z-index: 1000;
                    }

                    .floating-menu ul {
                        position: absolute;
                        font-family: 'Poppins', sans-serif;
                        font-weight: bold;
                        top: 250px;
                        left: 50px;
                        list-style-type: none;
                        padding: 0px;
                        margin: 0;
                    }

                    .floating-menu ul li {
                        padding: 15px 20px;
                        transition: transform 0.3s ease;
                    }

                    .floating-menu ul li a {
                        text-decoration: none;
                        color: White;
                        display: block;
                    }

                    .floating-menu ul li:hover {
                        background-color: #014a21;
                        width: 240px;
                        transform: scale(1.1);
                    }

                    .design-menu {
                        width: 350px;
                        height: 10px;
                        position: absolute;
                        background-color: White;
                        top: 60px;
                    }

                    .Titulo-menu img{
                        width: 300px;
                        height: auto;
                        position: absolute;
                        top: 1px;
                        left: 5%;
                    }

                    .design-menu2 {
                        width: 350px;
                        height: 3px;
                        position: absolute;
                        background-color: White;
                        top: 780px;
                    }

                    .textPosition {
                        text-decoration: none;
                        color: White;
                        display: block;
                        font-weight: bold;
                        font-family: 'Poppins', sans-serif;
                        position:absolute;
                        top: 89%;
                        left: 20%;
                    }

                    .design-menu3 {
                        width: 1555px;
                        height: 100vh;
                        position: absolute;
                        background-color: White;
                        opacity: 0.5;
                        left: 100%;
                        top: 0%;
                    }

                    .imagem-menu2 img {
                        width: 30px;
                        height: auto;
                        position: absolute;
                        top: 255px;
                        left: 5px;
                    }

                    .textPosition {
                        text-decoration: none;
                        color: White;
                        display: block;
                        font-weight: bold;
                        font-family: 'Poppins', sans-serif;
                        position: absolute;
                        top: 89%;
                        left: 20%;
                    }
                    
                    .AdicionarProf {
                        display: inline-block; /* Garante que o contêiner se ajuste ao tamanho do conteúdo */
                        overflow: hidden; /* Garante que o aumento da escala não cause quebra de linha */
                    }

                    .AdicionarProf a {
                        position: absolute;
                        left: 79%;
                        top: 30%;
                        font-size: 25px;
                        font-weight: bold;
                        display: block; /* Garante que o link seja tratado como um bloco dentro do contêiner */
                        text-decoration: none; /* Opcional: remove o sublinhado do link */
                        color: White; /* Opcional: define a cor do texto */
                        padding: 10px; /* Opcional: adiciona preenchimento ao link */
                    }

                    .AdicionarProf a:hover {
                        background-color: #014a21;
                        transform: scale(1.1);
                        transition: transform 0.3s ease, background-color 0.3s ease; /* Adiciona uma transição suave */
                    }

                    /*
                    Design para professores
                    */
                    .professores-container {
                        display: flex;
                        flex-wrap: wrap; /* Permite que os itens quebrem para a próxima linha */
                        gap: 20px; /*
                         Espaçamento entre os elementos */
                    }
                    
                    .backgroundFundo1 {
                        width: 250px;
                        height: 300px;
                        position: relative; /* Para que os elementos absolutos fiquem posicionados dentro deste bloco */
                        background-color: #003417;
                        border-radius: 50px;
                        box-sizing: border-box;
                        padding: 10px; /* Espaço interno */
                        overflow: hidden; /* Evita que elementos internos escapem da caixa */
                    }

                    .designFundoProf {
                        width: 250px;
                        height: 5px;
                        position: absolute;
                        background-color: #0d3e23;
                        top: 210px;
                        left: 0px;
                    }

                    .nome-professor {
                        position: absolute; /* Posição fixa em relação ao .backgroundFundo1 */
                        top: 80px; /* Ajusta a posição no topo */
                        left: 50%; /* Centraliza horizontalmente */
                        transform: translateX(-50%); /* Centraliza horizontalmente em relação ao ponto central */
                        width: 200px; /* Defina uma largura para o elemento para garantir a quebra de linha */
                        font-size: 27px;
                        font-family: 'Poppins', sans-serif;
                        color: white; /* Certifica-se de que o texto seja visível */
                        text-align: center; /* Centraliza o texto dentro do elemento */
                    }

                    .botaoinfo {
                        position: absolute;
                        top: 210px;
                        left: 35%;
                        font-family: 'Poppins', sans-serif;
                        font-size: 18px;
                        color: white;
                    }

                    .imagemBotao img {
                        width: 25px;
                        height: auto;
                        position: relative;
                        top: 217px;
                        left: 19%;
                        cursor: pointer;
                    }

                    body {
                        margin: 0;
                        font-family: Arial, sans-serif;
                    }

                </style>
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
                        <h1>PROFESSORES</h1>
                    </div>

                    <div class="AdicionarProf">
                        <?php
                            echo "<a href='criar_professor.php'>Adicionar professor(a)</a>";
                        ?>
                    </div>
                </div>

                <!-- Nova barra cinza abaixo da nova barra verde -->
                <div class="new-bottom-bar">
                    <div class="box-center">
                        <div class="InformaçõesProf";>
                            <?php 
                                if($qtd > 0){
                                    echo "<div class='professores-container'>"; // Adicionamos um contêiner flexível
                                    while($row = $res->fetch_object()){
                                        echo "<div class='backgroundFundo1'>";
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
<?php
    // Se o usuário não for um setor, ele é enviado de volta para a página de login
    } else{
        print"<script>location.href='index.php'; alert('Você não tem permissão para acessar esta área do sistema')</script>";
    }
?>
