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
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>SGE</title>
            </head>
            <body>
                <?php 
                    echo "bem-vindo" . "<br>" . "<a href='criar_professor.php'>Adicionar professor</a>";
                    if($qtd > 0){
                        while($row = $res->fetch_object()){
                            print "<br>" . $row->nome;
                            print "<br>" . "<button onclick=\" location.href='professor.php?id_prof=". $row->id_prof ."'\">". "Ver informações" ." </button>";
                            
                        }
                    }
                    
                ?>
                
            </body>
            </html> 
<?php
    // Se o usuário não for um setor, ele é enviado de volta para a página de login
    } else{
        print"<script>location.href='index.php'; alert('Você não tem permissão para acessar esta área do sistema')</script>";
    }
?>