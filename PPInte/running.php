<?php 
    date_default_timezone_set('America/Sao_Paulo');


    while (true){
        sleep(30*60);
        $myfile = fopen("Status.txt", "a") or die("Unable to open file!");
        $txt = "O sistema está de pé!\n";
        fwrite($myfile, $txt);
        $txt = "".date('d-m-Y, H:i:s')."\n\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }

?>