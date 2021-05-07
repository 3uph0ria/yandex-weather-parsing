<?php
$city = $_GET['city'];
$weather = @file_get_contents('https://yandex.ru/pogoda/' . $city);

$tmp = explode('Текущая температура', $weather);
$tmp2 = explode("aria-label=\"", $tmp[1]);
$check = true;

for($i = 6; $check == true; $i++)
{
    $tmp3 = explode('"', trim(strip_tags($tmp2[$i])));
    $checkTmp = explode(' ', $tmp3[0]);
    if($checkTmp[0] != "Закат") $weatherArr['weather'][] = $tmp3[0];
    if($checkTmp[0] == 'В' && $checkTmp[1] == 23) $check = false;
}
echo json_encode($weatherArr, JSON_UNESCAPED_UNICODE);
