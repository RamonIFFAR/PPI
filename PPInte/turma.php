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

    //  XXXXXXXXXX If que confere se o usuário é um setor DE XXXXXXXXXXXXXX
    if($qtdChecagem > 0){
        ?>
        <button onclick="location.href='ed_turma.php?id_turma=<?php echo $id_turma;?>'">Editar turma</button> <br> <br>
        <?php 
    } else{
    }

    $sql = "select * from turma where id = '{$id_turma}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: Turma</title>
</head>
<body>
    <a href='add_notas.php?id_turma=<?php echo $id_turma?>'>Adicionar notas</a><br>
    <?php 
        if($qtdT > 0){ 
            ?>
            <button onclick="location.href='turma.php?id=<?php echo $id_turma?>&favorita=0'">Desfavoritar</button> <br>
            <?php
        } else {
    ?>
    <button onclick="location.href='turma.php?id=<?php echo $id_turma?>&favorita=1'">Favoritar</button> <br>
    <?php }
        echo "Turma: ". $row->nome."<br><br>";
        echo "Sala: ". $row->sala."<br><br>";
        echo "Sobre:<br>". $row->descricao."<br><br>";
    ?>
</body>
</html>
