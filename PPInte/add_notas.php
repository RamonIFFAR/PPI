<?php
    require('config.php');

    // Inicia a sessão
    session_start();

    // Finaliza a sessão
    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
    }

    $id_turma = $_POST['id_turma'];
    $id_disc = $_POST['id_disc'];


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
        print"<script>location.href='index.php'</script>";
    }

    $sql = "select * from aluno where id_turma = '{$id_turma}'";
    $res = $conn->query($sql) or die($conn->error);
    $qtd = $res->num_rows;

    function pegaNotas($id_disc, $id_turma, $id_aluno, $n){
        include('config.php');
        $sqlN = "select avaliacao.* from avaliacao inner join aluno on avaliacao.id_aluno = aluno.matricula inner join turma on aluno.id_turma = turma.id where avaliacao.id_disc = '{$id_disc}' and aluno.id_turma = '{$id_turma}' and avaliacao.id_aluno = '{$id_aluno}'";
        $resN = $conn->query($sqlN) or die($conn->error);
        $rowN = $resN->fetch_object();
        $qtdN = $resN->num_rows;
        if ($qtdN > 0){
            echo "<td class='N1'>";
                echo "<input type='number' name='NOTA1-". $n ."' value='". $rowN->NOTA1 ."'>";
            echo "</td>";
            echo "<td class='N1'>";
                echo "<input type='number' name='AIS-". $n ."' value='". $rowN->AIS ."'>";
            echo "</td>";
            echo "<td class='N1'>";
                echo "<input type='number' name='NOTA2-". $n ."' value='". $rowN->NOTA2 ."'>";
            echo "</td>";
            echo "<td class='N1'>";
                echo "<input type='number' name='MC-". $n ."' value='". $rowN->MC ."'>";
            echo "</td>";
            echo "<td class='N1'>";
                echo "<input type='number' name='PPI-". $n ."' value='". $rowN->PPI ."'>";
            echo "</td>";
            echo "<td class='N1'>";
                echo "<input type='number' name='AIA-". $n ."' value='". $rowN->AIA ."'>";
            echo "</td>";
        } else{
            echo "<td class='N1'>";
            echo "<input type='number' name='NOTA1-". $n ."'>";
            echo "</td>";
            echo "<td class='N1'>";
            echo "<input type='number' name='AIS-". $n ."'>";
            echo "</td>";
            echo "<td class='N1'>";
            echo "<input type='number' name='NOTA2-". $n ."'>";
            echo "</td>";
            echo "<td class='N1'>";
                echo "<input type='number' name='MC-". $n ."'>";
            echo "</td>";
            echo "<td class='N1'>";
            echo "<input type='number' name='PPI-". $n ."'>";
            echo "</td>";
            echo "<td class='N1'>";
            echo "<input type='number' name='AIA-". $n ."'>";
            echo "</td>";
        }
    }

    function addNotas($id_d, $id_aluno, $PPI, $AIS, $AIA, $N1, $N2, $MC){
        include('config.php');
        if($PPI == ""){
            $PPI="";
        }
        if($AIS == ""){
            $AIS="";
        }
        if($AIA == ""){
            $AIA="";
        }
        if($N1 == ""){
            $N1="";
        }
        if($N2 == ""){
            $N2="";
        }
        if($MC == ""){
            $MC="";
        }
        $sqlC = "select * from avaliacao where id_aluno = '{$id_aluno}' and id_disc = '{$id_d}'";
        $resC = $conn->query($sqlC);
        $qtdC = $resC->num_rows;
        if($qtdC > 0){
            $sql = "update avaliacao set PPI = NULLIF('{$PPI}',''), AIS = NULLIF('{$AIS}', ''), AIA = NULLIF('{$AIA}', ''), NOTA1 = NULLIF('{$N1}', ''), NOTA2 = NULLIF('{$N2}', ''), MC = NULLIF('{$MC}', '') where id_aluno = '{$id_aluno}' and id_disc = '{$id_d}'";
            $conn->query($sql) or die($conn->error);
        } else{
            $sql = "insert into avaliacao(id_disc, id_aluno, PPI, AIS, AIA, NOTA1, NOTA2, MC) values('{$id_d}', '{$id_aluno}', NULLIF('{$PPI}',''), NULLIF('{$AIS}',''), NULLIF('{$AIA}',''), NULLIF('{$N1}',''), NULLIF('{$N2}',''), NULLIF('{$MC}',''))";
            $conn->query($sql) or die($conn->error);
        }
    }

    if(isset($_POST['atNotas'])){
        $n = 1;
        while($n < $_POST['nNotas']){
             addNotas($id_disc, $_POST['id-'.$n], $_POST['PPI-'.$n], $_POST['AIS-'.$n], $_POST['AIA-'.$n], $_POST['NOTA1-'.$n], $_POST['NOTA2-'.$n], $_POST['MC-'.$n]);
             $n++;
        }
        //echo "<script>alert('Notas cadastradas com sucesso!')</script>";
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="addnotascss2.css?v=<?php echo time(); ?>">
</head>
<body class='Fundo'>
    <div class="Background1"></div>
        <form method="POST" action="add_notas.php">
            <h1> Notas</h1>
            <div>
            <table class='formulario'>
            <tr>
                <th class='Infos'><label >Alunos</label></th>
                <th class='Infos'><label >1° Semestre</label> </th>
                <th class='Infos'><label >AIS</label></th>
                <th class='Infos'><label >2° Semestre</label></th>
                <th class='Infos'><label >Mostra de Ciências</label></th>
                <th class='Infos'><label >PPI</label></th>
                <th class='Infos'><label >AIA</label></th>
            </tr>
            <input type='hidden' name='id_disc' value='<?php echo $id_disc ?>'>
            <input type='hidden' name='id_turma' value='<?php echo $id_turma ?>'>
            <?php
                $i = 1;
                echo "";
                while($row = $res->fetch_object()){
                    echo "<tr>";
                    echo "";
                    echo "<td class='Nomes'><label>".$row->nome."</label></td>";
                    echo "";
                    
                   
                    echo "<input type='hidden' name='id-". $i ."' value='". $row->matricula ."'>";
                    pegaNotas($id_disc, $id_turma, $row->matricula, $i);
                    
                    echo "</tr>";
                    $i++;
                }
                echo "";
                    echo "<td><input type='hidden' name ='nNotas' value='". $i ."'><td>";
            ?>
            </table>
            </div>
            <br>
            <a href='turma.php?id=<?php echo $id_turma?>'>Cancelar</a><br> 
            <button type='submit' name='atNotas'>Atualizar notas</button><br>
        </form>
    </div>
</body>
</html>