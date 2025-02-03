<?php

ob_start();
require "slides_template.php";
$html2 = ob_get_clean();

require __DIR__. "../../../vendor/autoload.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf([
    "chroot" => __DIR__
]);

$dompdf->setPaper("A4", "landscape");

$dompdf->loadHtml($html2);

$dompdf->render();

$dompdf->stream("Slides.pdf", ["Attachment" => 0]);
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