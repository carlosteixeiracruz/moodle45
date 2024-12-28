<?php
$zip = new ZipArchive();
if ($zip->open('test.zip', ZipArchive::CREATE) === TRUE) {
    $zip->addFromString('testfile.txt', 'Hello, world!');
    $zip->close();
    echo 'Arquivo ZIP criado com sucesso!';
} else {
    echo 'Falha ao criar o arquivo ZIP';
}
?>
