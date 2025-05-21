<?php
$file = fopen("miofile.txt", "w");
fwrite($file, "Ciao, mondo!");
fclose($file);

echo $file;
?>