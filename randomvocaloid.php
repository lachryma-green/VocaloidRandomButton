<?php
function my_file_get_contents($url) 
{
    $cp = curl_init();
    curl_setopt($cp, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($cp, CURLOPT_URL, $url);
    curl_setopt($cp, CURLOPT_TIMEOUT, 30);
    curl_setopt($cp, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    $data = curl_exec($cp);
    $databox = json_decode($data,true);
    $contentID = $databox['data'][rand(0,100)]['contentId'];
    curl_close($cp);
    return $contentID;
}


$SM_ID = my_file_get_contents("https://api.search.nicovideo.jp/api/v2/snapshot/video/contents/search?q=VOCALOID&targets=tags&fields=title,contentId&fields[genre][0]=%E9%9F%B3%E6%A5%BD%E3%83%BB%E3%82%B5%E3%82%A6%E3%83%B3%E3%83%89&_sort=-lastCommentTime&_offset=". strval(rand(0,10000)) ."&_limit=100&_context=apiguide");
$VURL = "https://nico.ms/{$SM_ID}";


header("Location:{$VURL}");
exit();

?>