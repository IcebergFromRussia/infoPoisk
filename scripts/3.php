<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 23.04.2019
 * Time: 5:18
 */

require 'vendor/autoload.php';


//пробегаем по всем файлам со словами
//создаём мапу, слово-ключ сначение-массив с номерами документов
$wordsPath = 'files/words/';
$wordsMap = [];
for ($i = 1; $i<101;$i++){
    echo $i . 'file';
    $s = file_get_contents($wordsPath.'document'.$i.' words.txt');
    $words = unserialize($s);
    foreach ($words as $word){
        $wordsMap[$word][] = $i;
    }
}
echo 'записываем';
$fp = fopen('files/index/index.txt', "w") or die("невозможно создать файл");
fwrite($fp, serialize($wordsMap));
fclose($fp);
var_dump($wordsMap);
