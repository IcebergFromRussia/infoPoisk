<?php
require 'vendor/autoload.php';
use DiDom\Document;


$indexPath = 'files/index.txt';
$index = fopen($indexPath,'w');
for ($i = 1;$i<101;$i++){
    $link = 'https://ilibrary.ru/text/11/p.' . $i . '/index.html';
    $document = new Document($link, true, 'windows-1251');

    $posts = $document->find('#text span.p');

    $text = '';
    foreach($posts as $post) {
        $text .= $post->text(). "\n";
    }
    $fileName = 'files/documents/document'.$i.'.txt';

    $fp = fopen("$fileName", "w") or die("невозможно создать файл");
    fwrite($fp, $text);
    fwrite($index, 'ссылка: ' . $link .' файл document'.$i.'.txt'. "\n");


}
fclose($fp);
fclose($index);