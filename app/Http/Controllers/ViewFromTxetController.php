<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewFromTxetController extends Controller
{
    //
    private function extractAttributesFromText($text){
        $pattern = '|/- *(url:.*?:url *)?(text:.*?:text *)?(img:.*?:img *)?(color:.*?:color *)? *-/|';
        $regex_result = preg_match_all($pattern,$text,$matches,2);

        return $matches;
    }

    private function convertAttributesToAssocitive($matches){
        $pattern = "|:(.+):|";
        $attributes_associtive_array = [];
        foreach($matches as $upper_index => $upper_value_array){
            foreach($upper_value_array as $lower_index => $lower_value){
                if($lower_index == 0)continue;
                preg_match($pattern,$lower_value,$regex_result);
                $attribute = mb_strstr($lower_value,':',true);
                $attributes_associtive_array[$upper_index][$attribute] = $regex_result[1] ?? NULL;

            }
        }
        return $attributes_associtive_array;
    }

    private function applyAttributesToText($AAarray,$n){
        if(array_key_exists('img',$AAarray[$n]))return ;
        $url_exist = array_key_exists('url',$seps[$num]);
        $clr_exist = array_key_exists('color',$seps[$num]);
        $txt_exist = array_key_exists('text',$seps[$num]);
        $url = $url_exist ? htmlspecialchars($seps[$num]['url']) : "";
        $color = $clr_exist ? htmlspecialchars($seps[$num]['color']) : "";
        $text = $txt_exist ? htmlspecialchars($seps[$num]['text']) : "";

        $text_applyed = 
        ($url_exist ? "<a href=\"{$url}\" >" : "").
        "<span ".($clr_exist ? "style=\"color: $color;\">" : ">").
        ($txt_exist ? $text : "").
        "</span>".
        ($url_exist ? "</a>" : "")
        ;

        return $text_applyed;
    }

    private function createHTMLToShow($text){
        $attributes = extractAttributesFromText($text);
        $AAA = convertAttributesToAssocitive($attributes);#attributes_associtive_array        $pattern = "|/-.*?-/|";
        $text_splited_without_attirutes = preg_split($pattern,$text);
        $html_to_show_array = ["<p>"];
        foreach($text_splited_without_attirutes as $index => $value){
            array_push($html_to_show_array,htmlspecialchars($value),(array_key_exists($index,$AAA) ? applyAttributesToText($AAA,$index) :""));
        }
        array_push($html_to_show_array,"</p>");
        $html_to_show = implode("",$html_to_show_array);

        return $html_to_show;
    }

    public function viewFromText(Request $request){
        $text = nl2br($request->text);
        $html_to_show;
        
        
    }
}
