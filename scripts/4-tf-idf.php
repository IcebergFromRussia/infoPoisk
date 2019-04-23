<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 23.04.2019
 * Time: 7:56
 */

require 'vendor/autoload.php';

//TF-IDF термина а = (TF термина а) * (IDF термина а)

$idf = 'files/idf/idf.txt';
$s = file_get_contents($idf);
$idfWords = unserialize($s);

for ($i = 1;$i<101;$i++){
    echo $i . 'file' ."\n";
    $tf = 'files/tf/document'.$i.' words tf.txt';
    $s = file_get_contents($tf);
    $tfWords = unserialize($s);

    $tfIdf = [];
    foreach ($tfWords as $word => $tf){
        $tfIdf[$word] = $tf*$idfWords[$word];
    }

    $fp = fopen('files/tf-idf/document'.$i.' words tf-idf.txt', "w") or die("невозможно создать файл");
    fwrite($fp, serialize($tf));
    fclose($fp);
}
