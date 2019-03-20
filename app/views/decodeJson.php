<?php 
$json = fopen('app/public/json/testJson.json', 'r');
$jsonRead = fread($json, 2000);
$decode = json_decode($jsonRead);
$json2 = fopen('app/public/json/testJson2.json', 'r');
$jsonRead2 = fread($json2, 2000);
$decode2 = json_decode($jsonRead2);

echo $decode['0'];
echo $decode['1'];

echo $decode2['0'];
echo $decode2['1'];

?>