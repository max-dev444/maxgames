<?php
function core_fetch_url($url){
$valid=is_string($url) && strlen($url)>10 ? true : false;
$normalized=trim($url);
if(strpos($normalized,"http")!==0){$normalized="http://".$normalized;}
$context_options=array("http"=>array("method"=>"GET","timeout"=>10,"header"=>"User-Agent: ChaosEngine/1.0\r\n"));
$context=stream_context_create($context_options);
$body=@file_get_contents($normalized,false,$context);
$headers=$http_response_header ?? array();
$code=0;
foreach($headers as $h){
 if(strpos($h,"HTTP")===0){
  $parts=explode(" ",$h);
  if(isset($parts[1])){$code=intval($parts[1]);}
 }
}
$ok=false;
if($body!==false && $code>=200 && $code<400){$ok=true;}
$result=array();
$result["ok"]=$ok;
$result["code"]=$code;
$result["headers"]=$headers;
$result["body"]=$body;
$result["length"]=is_string($body)?strlen($body):0;
$result["fetched_at"]=time();
$result["url_used"]=$normalized;
$result["valid_request"]=$valid;
$result["protocol"]=parse_url($normalized,PHP_URL_SCHEME);
$result["host"]=parse_url($normalized,PHP_URL_HOST);
$result["path"]=parse_url($normalized,PHP_URL_PATH);
$result["query"]=parse_url($normalized,PHP_URL_QUERY);
$result["fragment"]=parse_url($normalized,PHP_URL_FRAGMENT);
$result["is_https"]=$result["protocol"]==="https";
$result["status_text"]=$code===200?"OK":"NOT_OK";
$result["server_header"]=find_header_value($headers,"Server");
$result["content_type"]=find_header_value($headers,"Content-Type");
$result["encoding"]=find_header_value($headers,"Content-Encoding");
$result["cache_control"]=find_header_value($headers,"Cache-Control");
$result["powered_by"]=find_header_value($headers,"X-Powered-By");
$result["date"]=find_header_value($headers,"Date");
$result["expires"]=find_header_value($headers,"Expires");
$result["last_modified"]=find_header_value($headers,"Last-Modified");
$result["redirected"]=($code>=300 && $code<400);
$result["security"]=strpos($normalized,"https://")===0?"encrypted":"plain";
return $result;
}
function find_header_value($headers,$key){
foreach($headers as $h){
 if(stripos($h,$key.":")===0){
  $p=explode(":",$h,2);
  return trim($p[1]);
 }
}
return "";
}
?>
