<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 23.04.2019
 * Time: 7:42
 */

require 'vendor/autoload.php';

use Stem\LinguaStemRu;

$documentCount = 100;

//IDF термина а = логарифм(Общее количество документов / Количество документов, в которых встречается термин а)

$indexPath = 'files/index/index.txt';
$s = file_get_contents($indexPath);
$words = unserialize($s);


$idf = [];
foreach ($words as $key => $word){
    $idf[$key] = log($documentCount/count($word));
}

echo  ' создаём файл ';
$fp = fopen('files/idf/idf.txt', "w") or die("невозможно создать файл");
echo  ' записываем ';
fwrite($fp, serialize($idf));