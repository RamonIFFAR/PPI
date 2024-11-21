<?php
    require('config.php');

    // Inicia a sessão
    session_start();

    $id_disc = $_REQUEST['id_disc'];

    // Finaliza a sessão
    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    if(isset($_POST['atualizar'])){
        $size = $_POST['nTurmas'];
        for($x = 1; $x < $size; $x++){
            atRelacionamento($_POST['r'.$x], $_POST['turma'.$x]);
        }
       
            addRelacionamento($id_disc, $_POST['turmaN1']);
            addRelacionamento($id_disc, $_POST['turmaN2']);
            echo "<script>location.href='disciplina.php?id_disc=".$id_disc."'</script>";
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

    function listarTurmas($id_disc){
        include('config.php');
        $sql = "select id, nome from turma where not id = any (select id_turma from disciplina_turma where id_disc = '{$id_disc}')";
        $res = $conn->query($sql);
        while($row= $res->fetch_object()){
            echo "<option value='" . $row->id . "'>" . $row->nome . "</option>";
        }
    }

    function atRelacionamento($idr, $idt){
        include('config.php');
        if($idt != 'hollow'){
            $sqlat = "update disciplina_turma set id_turma = '{$idt}' where id = '{$idr}'";
            $conn->query($sqlat);
        } else{
            $sqlrm = "delete from disciplina_turma where id = '{$idr}'";
            $conn->query($sqlrm) or die($conn->error);
        }
    }

    function addRelacionamento($idd, $idt){
        if($idt != 'hollow'){
            include('config.php');
            $sqlad = "insert into disciplina_turma(id_disc, id_turma) values('{$idd}', '{$idt}')";
            $conn->query($sqlad);
        }
    }

    // Seleciona as turma atuais do professor
    $sqlTurma = "select disciplina_turma.id, turma.nome, disciplina_turma.id_turma, disciplina_turma.id_disc from disciplina_turma inner join turma on disciplina_turma.id_turma = turma.id where disciplina_turma.id_disc = '{$id_disc}'";
    $resTurma = $conn->query($sqlTurma);

    // 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: Turmas da disciplina</title>
</head>
<body>
    <form method="POST" action='DTurmas.php'>
        <input type='hidden' name='id_disc' value='<?php echo $id_disc?>'>
        <?php 
            $i = 1;
            while($rowTurma = $resTurma->fetch_object()){
        ?>
            <input type='hidden' name='r<?php echo $i?>' value='<?php echo $rowTurma->id?>'>
            <select id='tur' name='turma<?php echo $i?>'>
                    <option value='<?php echo $rowTurma->id_turma ?>' selected><?php echo $rowTurma->nome?></option>
                        <?php 
                            listarTurmas($id_disc);
                        ?>
                    <option value='hollow'> </option>
            </select> <br> <br>
        <?php $i++;
    }?> 
            <select id='turN1' name='turmaN1' value='hollow'>
                <option value='hollow' selected>     </option>
                <?php 
                    listarTurmas($id_disc);
                ?>
            </select> <br> <br>
            <select id='turN2' name='turmaN2' value='hollow'>
                <option value='hollow' selected>     </option>
                <?php 
                    listarTurmas($id_disc);
                ?>
            </select> <br> <br>

        <input type='hidden' name='nTurmas' value='<?php echo $i?>'>
        <button type='submit' name='atualizar'>Atualizar turmas</button>
    </form>
        <br><br><button onclick="location.href='disciplina.php?id_prof=<?php echo $id_disc?>'">Cancelar</button>
</body>
</html>