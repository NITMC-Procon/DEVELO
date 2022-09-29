<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['created_at','updated_at','deleted_at'];

    
}

/*
説明:
画像を保存するためのモデルです。
ControllerのImageControllerに、UserIDと画像の使用元の作成日からなるreferenced_byと、画像ファイルを渡すことにより、画像の保存とDBへの登録を行えます。

referenced_byの形式:
userIDの桁数、userID、作成日を順に並べ一つの文字列として保存します。
ex)userID=124、作成日167229982098のとき、3124167229982098
*/
