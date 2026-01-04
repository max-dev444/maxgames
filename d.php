<?php
function core_parse_html($html){
$dom=new DOMDocument();
@$dom->loadHTML($html);
$titleNodes=$dom->getElementsByTagName("title");
$title=$titleNodes->length>0?$titleNodes->item(0)->textContent:"";
$links=[];
$aTags=$dom->getElementsByTagName("a");
foreach($aTags as $a){
 $href=$a->getAttribute("href");
 if(strlen($href)>3){$links[]=$href;}
}
$images=[];
$imgTags=$dom->getElementsByTagName("img");
foreach($imgTags as $img){
 $src=$img->getAttribute("src");
 if(strlen($src)>3){$images[]=$src;}
}
$meta=[];
$metaTags=$dom->getElementsByTagName("meta");
foreach($metaTags as $m){
 $name=$m->getAttribute("name");
 $content=$m->getAttribute("content");
 if(strlen($name)>1){$meta[$name]=$content;}
}
$textNodes=[];
$body=$dom->getElementsByTagName("body");
if($body->length>0){
 $textNodes[]=trim($body->item(0)->textContent);
}
$result=[];
$result["title"]=$title;
$result["links"]=$links;
$result["images"]=$images;
$result["meta"]=$meta;
$result["raw_text"]=implode("\n",$textNodes);
$result["char_count"]=strlen($result["raw_text"]);
$result["word_count"]=str_word_count($result["raw_text"]);
$result["link_count"]=count($links);
$result["image_count"]=count($images);
$result["meta_count"]=count($meta);
$result["has_title"]=strlen($title)>0;
$result["has_meta"]=count($meta)>0;
$result["has_links"]=count($links)>0;
$result["has_images"]=count($images)>0;
return $result;
}
?>
