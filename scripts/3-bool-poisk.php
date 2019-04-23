<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 23.04.2019
 * Time: 5:40
 */

require 'vendor/autoload.php';

use Stem\LinguaStemRu;

$indexPath = 'files/index/index.txt';
$s = file_get_contents($indexPath);
$wordsIndex = unserialize($s);

$stemmer = new LinguaStemRu();

//$zapros = 'соседней AND комнате AND губка OR графинюшка OR князь';
$zapros = 'соседней AND комнате AND  NOT губка ';

$result = [];

//дробим по ИЛИ
$orArray = explode('OR', $zapros);

foreach ($orArray as $orZapros){
    $andArray = [];
    $andArray  = explode('AND', $orZapros);
    //документы подходящие и не подходящие
    $notDocuments = [];

    //в начале мы ищем среди всех документов, потом убираем неподходящие множества
    $documents = [];
    for ($i = 1; $i<101;$i++){
        $documents[] = $i;
    }

    foreach ($andArray as $andZapros){
        if(strpos($andZapros,'NOT')){
            $buf = str_replace('NOT', '', $andZapros);
            $buf = str_replace(' ', '', $buf);
            $buf = $stemmer->stem_word($buf);
            // из-за того что !(a|b) = (!a & !b) в первом случае мы мерджим
            $notDocuments = $notDocuments + $wordsIndex[$buf];
        } else {
            $buf = str_replace(' ', '', $andZapros);
            $buf = $stemmer->stem_word($buf);
            //а тут мы находим схождения
            $documents = array_intersect($documents, $wordsIndex[$buf]);
        }
    }
    $notDocuments = array_unique($notDocuments);
    $documents = array_unique($documents);

    $result = $result + (array_diff($documents,$notDocuments));
}
foreach ($result as $item){
    echo $item . "\n";
}

