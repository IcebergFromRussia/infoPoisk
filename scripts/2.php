<?php

require 'vendor/autoload.php';

use Stem\LinguaStemRu;

$stemmer = new LinguaStemRu();


$znaki =
    [
        ',',
        '\'',
        ';',
        '"',
        '-',
        '—',
        '.',
        ':',
        '!',
        '?',
        ':',
        '(',
        ')',
        '`',
        "\n",
    ];
for ($i = 1;$i<101;$i++){
    echo $i . 'file';
    //получить текст
    $text = file_get_contents('files/documents/document'.$i.'.txt');
    echo ' удаляем знаки ';
    $text = str_replace($znaki, ' ', $text);
    echo ' получем массив ';
    $words = explode(' ',$text);
    echo ' лимитируем ';
    $stemmedWords = [];
    foreach ($words as $word){
        $stemmedWords[] = $stemmer->stem_word($word);
    }
    echo ' удаляем дублирующиеся ';
    $words = array_unique($stemmedWords);
    echo  ' создаём файл ';
    $fp = fopen('files/words/document'.$i.' words.txt', "w") or die("невозможно создать файл");
    echo  ' записываем ';
    fwrite($fp, serialize($words));
    echo  "\n";
}