<?php

ob_start();
require "boletim_template.php";
$html2 = ob_get_clean();

require __DIR__. "../../../vendor/autoload.php";

use Dompdf\Dompdf;

$html = '<img src = "Imagens/Titulo.png">';

$dompdf = new Dompdf([
    "chroot" => __DIR__
]);

$dompdf->loadHtml($html2);


$dompdf->render();

$dompdf->stream("Parecer.pdf", ["Attachment" => 0]);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</body>
</html>