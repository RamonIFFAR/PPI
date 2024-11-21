<?php
    require('config.php');

    // Inicia a sessão
    session_start();

    $prof = $_REQUEST['id_prof'];

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
        echo "<script>location.href='professor.php?id_prof=".$prof."'</script>";
            addRelacionamento($prof, $_POST['turmaN1']);
            addRelacionamento($prof, $_POST['turmaN2']);
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

    function listarTurmas($id_prof){
        include('config.php');
        $sql = "select id, nome from turma where not id = any (select id_turma from professor_turma where id_prof = '{$id_prof}') ";
        $res = $conn->query($sql);
        while($row= $res->fetch_object()){
            echo "<option value='" . $row->id . "'>" . $row->nome . "</option>";
        }
    }

    function atRelacionamento($idr, $idt){
        include('config.php');
        if($idt != 'hollow'){
            $sqlat = "update professor_turma set id_turma = '{$idt}' where id = '{$idr}'";
            $conn->query($sqlat);
        } else{
            $sqlrm = "delete from professor_turma where id = '{$idr}'";
            $conn->query($sqlrm) or die($conn->error);
        }
    }

    function addRelacionamento($idp, $idt){
        if($idt != 'hollow'){
            include('config.php');
            $sqlad = "insert into professor_turma(id_prof, id_turma) values('{$idp}', '{$idt}')";
            $conn->query($sqlad);
        }
    }

    // Seleciona as turma atuais do professor
    $sqlTurma = "select professor_turma.id, turma.nome, professor_turma.id_turma, professor_turma.id_prof from professor_turma inner join turma on professor_turma.id_turma = turma.id where professor_turma.id_prof = '{$prof}'";
    $resTurma = $conn->query($sqlTurma);

    // 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: Turmas do professor</title>
</head>
<body>
    <form method="POST" action='PTurmas.php'>
        <input type='hidden' name='id_prof' value='<?php echo $prof?>'>
        <?php 
            $i = 1;
            while($rowTurma = $resTurma->fetch_object()){
        ?>
            <input type='hidden' name='r<?php echo $i?>' value='<?php echo $rowTurma->id?>'>
            <select id='tur' name='turma<?php echo $i?>'>
                    <option value='<?php echo $rowTurma->id_turma ?>' selected><?php echo $rowTurma->nome?></option>
                        <?php 
                            listarTurmas($prof);
                        ?>
                    <option value='hollow'> </option>
            </select> <br> <br>
        <?php $i++;
    }?> 
            <select id='turN1' name='turmaN1' value='hollow'>
                <option value='hollow' selected>     </option>
                <?php 
                    listarTurmas($prof);
                ?>
            </select> <br> <br>
            <select id='turN2' name='turmaN2' value='hollow'>
                <option value='hollow' selected>     </option>
                <?php 
                    listarTurmas($prof);
                ?>
            </select> <br> <br>

        <input type='hidden' name='nTurmas' value='<?php echo $i?>'>
        <button type='submit' name='atualizar'>Atualizar turmas</button>
    </form>
        <br><br><button onclick="location.href='professor.php?id_prof=<?php echo $prof?>'">Cancelar</button>
</body>
</html>