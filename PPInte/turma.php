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
        $favorita = $_REQUEST['favorita'];
        if($qtdT == 0){
            if($favorita == 1){
                $sqlF = "insert into favorita(id_us, id_turma) values('{$_SESSION['id_us']}', '{$id_turma}')";
                $resF = $conn->query($sqlF) or die($conn->error);
            }
    }   else if($favorita== 0){
        $sqlF = "delete from favorita where id_turma = '{$id_turma}' and id_us = '{$_SESSION['id_us']}'";
        $resF = $conn->query($sqlF) or die($conn->error);
    }
    } else {
        
    }

    if(isset($_REQUEST['excluir'])){

        $busca = "select * from turma where id_curso = '{$id_turma}'";
        $hoje = date('Y-m-d');
        $pegaC = $conn->query($busca);
        $mostra = $pegaC->fetch_object();
        $sqlH = "Insert into historico (id_us, descricao) values ('{$_SESSION['id_us']}', 'Usuário realizou a exclusão da turma de nome " . $mostra->nome ."', '". $hoje ."')";
        $QHist = $conn->query($sqlH) or die($conn->error);

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
        ?>
        <button onclick="location.href='ed_turma.php?id_turma=<?php echo $id_turma;?>'">Editar turma</button> <br> <br>
        <button onclick="location.href='gerar_parecer.php?id_turma=<?php echo $id_turma;?>'">Gerar parecer</button> <br> <br>
        <button onclick="location.href='gerar_slides.php?id_turma=<?php echo $id_turma;?>'">Gerar material para o conselho de classe</button> <br> <br>
        <?php 
    } else{
    }

    $sql = "select * from turma where id = '{$id_turma}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();

    $sqlFP = "select professor_disciplina.id_prof, professor_disciplina.id_disc, disciplina.nome from professor_disciplina 
inner join professor_turma on professor_disciplina.id_prof = professor_turma.id_prof
inner join disciplina_turma on professor_turma.id_turma = disciplina_turma.id_turma and professor_disciplina.id_disc = disciplina_turma.id_disc
inner join disciplina on disciplina.id = professor_disciplina.id_disc and disciplina.id = disciplina_turma.id_disc
where professor_disciplina.id_prof = '{$_SESSION['id_us']}' and disciplina_turma.id_turma = '{$id_turma}'";
    $resFP = $conn->query($sqlFP) or die($conn->error);
    $resFreq = $conn->query($sqlFP) or die ($conn->error);
    $resRel = $conn->query($sqlFP) or die($conn->error);
    $resRec = $conn->query($sqlFP) or die($conn->error);
    $resP = $conn->query($sqlFP) or die($conn->error);

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
            <span>Cadastrar notas</span><br>
            <form method="POST" action='add_notas.php'>
                <input type='hidden' name='id_turma' value='<?php echo $id_turma?>'>
                <label>Disciplina</label><br>
                <select id="disc" name='id_disc'>
                        <option value="hollow" selected>       </option>
                        <?php
                            while($rowFP = $resFP->fetch_object()){
                                echo "<option value='" . $rowFP->id_disc . "'>" . $rowFP->nome . "</option>";
                            }
                        ?> 
                </select> <br> <button type='submit' name='cadastrar'>Cadastrar notas da turma</button><br><br>
            </form>
            <span>Enviar frequência</span><br>
            <form method="POST" action='frequencia.php'>
                <input type='hidden' name='id_turma' value='<?php echo $id_turma?>'>
                <label>Disciplina</label><br>
                <select id="disc" name='id_disc'>
                        <option value="hollow" selected>       </option>
                        <?php
                            while($rowFreq = $resFreq->fetch_object()){
                                echo "<option value='" . $rowFreq->id_disc . "'>" . $rowFreq->nome . "</option>";
                            }
                        ?> 
                </select> <br> <button type='submit' name='cadastrar'>Cadastrar frequência da turma</button><br><br>
            </form>
            <!-- 
            --
            -- Dentro deste comentário estão os campos de seleção referentes à seleção da disciplina para o envio dos 3 relatórios que os professores precisam fazer.
            -- Genuinamente estou ficando louco com o fato de que qualquer leve alteração no código me obriga a mexer em outros 8 códigos diferentes. 
            -- Para se ter uma ideia, são 14:59 enquanto digito isso, mas eu comecei a mexer nos códigos dessas funcionalidades eram 13:20 e tudo que eu fiz foi apenas permitir que os lembretes servissem de data limite pq eu não tinha ideia de como fazer diferente.
            -- Tomou bastante tempo, vou no banheiro, vlw.
            --
            -->
            <span>Enviar plano de trabalho</span><br>
            <form method="POST" action='plano.php'>
                <input type='hidden' name='id_turma' value='<?php echo $id_turma?>'>
                <label>Disciplina</label><br>
                <select id="disc" name='id_disc'>
                        <option value="hollow" selected>       </option>
                        <?php
                            while($rowP = $resP->fetch_object()){
                                echo "<option value='" . $rowP->id_disc . "'>" . $rowP->nome . "</option>";
                            }
                        ?> 
                </select> <br> <button type='submit' name='cadastrar'>Enviar plano de trabalho da turma</button><br><br>
            </form>

            <span>Enviar relatório de atividades</span><br>
            <form method="POST" action='atividades.php'>
                <input type='hidden' name='id_turma' value='<?php echo $id_turma?>'>
                <label>Disciplina</label><br>
                <select id="disc" name='id_disc'>
                        <option value="hollow" selected>       </option>
                        <?php
                            while($rowRel = $resRel->fetch_object()){
                                echo "<option value='" . $rowRel->id_disc . "'>" . $rowRel->nome . "</option>";
                            }
                        ?> 
                </select> <br> <button type='submit' name='cadastrar'>Enviar relatório de atividades da turma</button><br><br>
            </form>
            
            <span>Enviar registro de recuperação paralela</span><br>
            <form method="POST" action='recuperacao.php'>
                <input type='hidden' name='id_turma' value='<?php echo $id_turma?>'>
                <label>Disciplina</label><br>
                <select id="disc" name='id_disc'>
                        <option value="hollow" selected>       </option>
                        <?php
                            while($rowRec = $resRec->fetch_object()){
                                echo "<option value='" . $rowRec->id_disc . "'>" . $rowRec->nome . "</option>";
                            }
                        ?> 
                </select> <br> <button type='submit' name='cadastrar'>Enviar registro de recuperação paralela da turma</button><br><br>
            </form>

            <!--
            -- Oi, espero que vejam esse comentário na PPI, pois, na minha cabeça, é engraçado, mas, como deu pra ver, eu relatei não estar com minhas faculdades mentais funcionais no momento.
            -- El wiwi, Dale Capo, no hable de mis tamales. Whatever in creation exists without my knowledge, exists without my consent, he is the judge, he says that he will never die, he just keeps dancing and dancing.
            -->
                
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
                <?php 
                if($qtdT > 0){ 
                    ?>
                    <button onclick="location.href='turma.php?id=<?php echo $id_turma?>&favorita=0'">Desfavoritar</button> <br>
                    <?php
                } else {
                ?>
                <button onclick="location.href='turma.php?id=<?php echo $id_turma?>&favorita=1'">Favoritar</button> <br>
                <?php }
                ?>

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
