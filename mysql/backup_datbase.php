<?php

// require "./src/model/const.php";

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "palpitao_db";
$backupFile = $dbname . date("Y-m-d-H-i-s") . '.sql';

// $command = "mysqldump --opt -h $host -u $user -p$pass $dbname > $backupFile";
// $command = "mysqldump -h localhost -u root --no-data --database palpitao_db > palpitao.sql -p";
// $command = "mysqldump -u root -p palpitao_db > backup_banco.sql";
// $command = "C:\Users\User\Desktop\\xamp\htdocs\sistemaPalpitao\\xampp\mysql\bin\mysqldump.exe -u root -p palpitao_db > C:\Users\User\Desktop\\xamp\htdocs\sistemaPalpitao\\xampp\htdocs\palpitao\mysql\backup_palpitao.sql";
$command = 'C:\Users\User\Desktop\xamp\htdocs\sistemaPalpitao\xampp\mysql\bin\mysqldump.exe -h localhost -u root palpitao_db > ..\..\..\htdocs\palpitao\mysql\back_db.sql';
system($command, $output);

echo $command;


echo "Backup realizado com sucesso: $backupFile";