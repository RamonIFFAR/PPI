<?php
    require('config.php');

    // Inicia a sessão
    session_start();

    // Finaliza a sessão
    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    $turma = $_REQUEST['id_turma'];
    $disciplina = $_REQUEST['id_disc'];

    if(!isset($disciplina)){
        print "<script>location.href='turma.php?id=".$turma."'</script>";
    }
    if(!isset($turma)){
        print "<script>location.href='turma.php?id=".$turma."'</script>";
    }
    
    /*
    * Aqui eu tô catando os alunos
    */
    $sql = "select * from aluno where id_turma = '{$turma}'";
    $res = $conn->query($sql) or die($conn->error);
    $qtd = $res->num_rows;

    function pegaFreq($turma, $disc, $aluno, $n){
        include('config.php');
        $sqlF = "select frequencia.* from frequencia inner join aluno on frequencia.matricula = aluno.matricula inner join turma on aluno.id_turma = turma.id where frequencia.disciplina = '{$disc}' and aluno.id_turma = '{$turma}' and frequencia.matricula = '{$aluno}'";
        $resF = $conn->query($sqlF) or die($conn->error);
        $rowF = $resF->fetch_object();
        $qtdF = $resF->num_rows;
        if ($qtdF > 0){
            echo "<td class='N1'>";
                echo "<input type='number' name='Freq-". $n ."' value='". $rowF->faltas ."'>";
            echo "</td>";
        } else{
            echo "<td class='N1'>";
            echo "<input type='number' name='Freq-". $n ."' value=''>";
            echo "</td>";
        }
    }

    function addFreq($disciplina, $aluno, $frequencia){
        include('config.php');
        $sqlC = "select * from frequencia where matricula = '{$aluno}' and disciplina= '{$disciplina}'";
        $resC = $conn->query($sqlC);
        $qtdC = $resC->num_rows;
        if($frequencia < 0){
            $frequencia = 0;
        }
            if($qtdC > 0){
                $sql = "update frequencia set faltas = '{$frequencia}' where matricula = '{$aluno}' and disciplina = '{$disciplina}'";
                $conn->query($sql);
            } else{
                $sql = "insert into frequencia(disciplina, matricula, faltas) values('{$disciplina}', '{$aluno}', '{$frequencia}')";
                $conn->query($sql);
            }
        
        
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

    if(isset($_POST['atFreq'])){
        $n = 1;
        while($n < $_POST['nFreq']){
             addFreq($disciplina, $_POST['id-'.$n], $_POST['Freq-'.$n]);
             $n++;
        }
        echo "<script>alert('Ausências válidas registradas com sucesso!')</script>";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="frequenciacss.css?v=<?php echo time(); ?>">
    <title>SGAE</title>
</head>
<body class="Fundo">
    <div class="Background1"></div>
    <form method="POST" action="frequencia.php">
    <h1> Frequência</h1>
        <div>
            <table class='formulario'>
                <tr>
                    <th class='Infos1'><label >Alunos</label></th>
                    <th class='Infos'><label >Ausências</label> </th>
                </tr>

                <input type='hidden' name='id_disc' value='<?php echo $disciplina ?>'>
                <input type='hidden' name='id_turma' value='<?php echo $turma ?>'>

                
                    <?php
                        echo "<div class='Posicaotr'>";
                        $i = 1;
                        echo "";
                        while($row = $res->fetch_object()){
                                
                            echo "<tr>";
                            echo "";
                            echo "<td class='Nomes'><label>".$row->nome."</label></td> ";
                            echo "";
                                    
                                
                            echo "<input type='hidden' name='id-". $i ."' value='". $row->matricula ."'>";
                            pegaFreq($turma, $disciplina, $row->matricula, $i);
                                    
                            echo "</tr>";
                            $i++;
            
                        }
                        echo "";
                            echo "<td><input type='hidden' name ='nFreq' value='". $i ."'><td>";
                        echo "</div>";
                    ?>
            </table>
        </div>
        <a href='turma.php?id=<?php echo $turma?>'>Cancelar</a><br> 
        <button type='submit' name='atFreq'>Atualizar Frequência</button><br>
    </form><br>
</body>
</html>