<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    use HasFactory;

    protected $fillable = [ //106DBにまとめて保存。fillable複数代入可能createメソッドを使うために必要。
        'name',
        'title',
        'email',
        'url',
        'gender',
        'age',
        'contact',
    ];
     //120 検索機能
    public function scopeSearch($query, $search)   //120 メソッドは先頭にscopeをつける。第一引数は$query、第二引数はコントローラーから渡ってくる変数
       { 
        if($search !== null){ 
         $search_split = mb_convert_kana($search, 's'); //mb_convert_kana全角スペースを半角 
         $search_split2 = preg_split('/[\s]+/', $search_split); //preg_split空白で区切る,$search_split2が配列になる
        foreach( $search_split2 as $value ){   
         $query->where('name', 'like', '%' .$value. '%');  } //$queryにwhereをつけていく。whereを複数書くと複数検索。likeはあいまい検索、％は０文字以上になる
         }                                                   //キーワードの分'name'likeをつければAND検索ができる

         return $query; 
  } 
}


