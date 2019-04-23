<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 23.04.2019
 * Time: 6:58
 */


require 'vendor/autoload.php';

use Stem\LinguaStemRu;


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

//TF термина а = (Количество раз, когда термин а встретился в тексте / количество всех слов в тексте)


for ($i = 1;$i<101;$i++){

    $indexPath = 'files/words/document'.$i.' words.txt';
    $s = file_get_contents($indexPath);
    $words = unserialize($s);

    echo $i . 'file';
    //получить текст
    $text = file_get_contents('files/documents/document'.$i.'.txt');
    echo ' удаляем знаки ';
    $text = str_replace($znaki, ' ', $text);

    echo ' получем массив ';
    $allWords = explode(' ',$text);
    $count = count($allWords);

    $tf = [];
    foreach ($words as $word){
        if( !$word)
            continue;
        $tf[$word] = substr_count($text, $word) / $count;
    }

    echo  ' создаём файл ';
    $fp = fopen('files/tf/document'.$i.' words tf.txt', "w") or die("невозможно создать файл");
    echo  ' записываем ';
    fwrite($fp, serialize($words));
    echo  "\n";
}