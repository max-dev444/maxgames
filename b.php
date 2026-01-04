<?php
require "c.php";
require "d.php";

$url=$_GET["u"]??"";
if(!$url){die("No URL provided");}

$fetch=core_fetch_url($url);
if($fetch["ok"]===false){die("Fetch failed");}

$html=$fetch["body"];
$info=[];

$info["url"]=$url;
$info["bytes"]=strlen($html);
$info["lines"]=substr_count($html,"\n");

$parsed=core_parse_html($html);
$info["title"]=$parsed["title"];
$info["links"]=count($parsed["links"]);

echo "URL: ".$info["url"]."\n";
echo "BYTES: ".$info["bytes"]."\n";
echo "LINES: ".$info["lines"]."\n";
echo "TITLE: ".$info["title"]."\n";
echo "LINKS FOUND: ".$info["links"]."\n";

echo "\n--- LINKS ---\n";
foreach($parsed["links"] as $l){
 echo $l."\n";
}
?>
