<?php

$text = nl2br("/-text:oh yeah:text color:#AAA:color-/こんなにも/- url:\"></a><h2>hello:url text:素晴らしい:text  color:#500:color-/good/-text:hello:text-/bad/-text:素晴らしすぎる:text color:#FF0:color-/ことがあるでしょうか。");

$regex ='|/- *(url:.*?:url *)?(text:.*?:text *)?(img:.*?:img *)?(color:.*?:color *)? *-/|';

$result = preg_match_all($regex,$text,$matches,2);


foreach($matches as $ir => $iv){
    foreach($iv as $i => $v){
        if($i == 0){
            $seps[$ir]['all'] = $v;
            continue;
        }
        $re = '|:(.+):|';
        $u = preg_match($re,$v,$k);
        $seps[$ir][mb_strstr($v,':',true)] = $k[1] ?? NULL;
        
    }
}

function viewing($seps,$num){
    if(array_key_exists('url',$seps[$num]))echo("<a href=\"{$seps[$num]['url']}\" }>");
    echo("
        <p style=\"color: {$seps[$num]['color']};\">
            {$seps[$num]['text']}
        </p>
    ");
    if(array_key_exists('url',$seps[$num]))echo("</a>");
}

function convertText($seps,$num){
    if(array_key_exists('img',$seps[$num]))return "";
    $url_exist = array_key_exists('url',$seps[$num]);
    $clr_exist = array_key_exists('color',$seps[$num]);
    $img_exist = array_key_exists('img',$seps[$num]);
    $txt_exist = array_key_exists('text',$seps[$num]);
    $url = $url_exist ? htmlspecialchars($seps[$num]['url']) : "";
    $color = $clr_exist ? htmlspecialchars($seps[$num]['color']) : "";
    $text = $txt_exist ? htmlspecialchars($seps[$num]['text']) : "";

    $text_convd=
    ($url_exist ? "<a href=\"{$url}\" >" : "").
    "<span ".($clr_exist ? "style=\"color: $color;\">" : ">").
    ($txt_exist ? $text : "").
    "</span>".
    ($url_exist ? "</a>" : "")."
    "
    ;

    return $text_convd;
}

$reg2 = "|/-.*?-/|";
$text_sepd_arry = preg_split($reg2,$text);
echo "<p>";
foreach($text_sepd_arry as $ind => $ele){
    echo (htmlspecialchars($ele));
    echo (array_key_exists($ind,$seps) ? convertText($seps,$ind) : "");
}
echo "</p>";
print_r($text_sepd_arry);

$html_to_show_array = ["<p>"];
foreach($text_sepd_arry as $index => $value){
    array_push($html_to_show_array,htmlspecialchars($value),htmlspecialchars(array_key_exists($index,$seps) ? convertText($seps,$index) :""));
}
array_push($html_to_show_array,"</p>");
$html_to_show = implode("",$html_to_show_array);
print_r($html_to_show_array);
echo $html_to_show;