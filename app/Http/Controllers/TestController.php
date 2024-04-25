<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;//テーブルの元
use Illuminate\Support\Facades\DB;

class TestController extends Controller //Controllerクラスを継承
{
  public function index()
  {

      dd('test');
    //Eloquent(エロクアント)コレクション型で帰ってくる
    $values = Test::all(); //Models.Testを全権取得

    $count = Test::count();

    $first = Test:: findOrFail(1);

    $whereB = Test::where('text','=','bbbb')->get();//条件指定はしているが情報を取得はしていないのでgetで取得する

    //クエリビルダ
     $queryBuilder = DB::table('tests')->where('text','=','bbbb')
      ->select('id','text')
      ->get();    //getを書くことでコレクション型で情報を取得できる
    
    dd($values,$count,$first,$whereB,$queryBuilder);
     
    return view('tests.test',compact('values')); //viewのフォルダ名.ファイル名
  }
}
