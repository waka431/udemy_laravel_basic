<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index()
    {
        //1対多 親->子
        $shops = Area::find(1)->shops; //Areaモデルのshopsメソッド。エリア１にあるショップ
        //親<-子
       $area = Shop::find(3)->area; //ショップ３のエリア
       
        //多対多
        $routes = Shop::find(1)->routes()->get(); //
        
        dd($shops,$area,$routes);
    }
}
