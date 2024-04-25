<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ShopController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('tests/test', [ TestController::class,'index' ]); 

Route::get('shops', [ ShopController::class,'index' ]); 

//Route::resource('contacts',ContactFormController::class);//contactsフォルダ、まとめてコントローラーのメソッド（indexなど）が書ける
//Route::get('contacts', [ ContactFormController::class,'index' ])->name('contacts.index'); 
//フォルダ名、使うコントローラー指定、コントローラーの中のメソッド指定。name（フォルダ名.ファイル名）でルート情報に名前を付ける。view側でリンク張るときに便利。

Route::prefix('contacts')//prefixでフォルダ名指定しておけばグループの中では省ける
->middleware(['auth'])//middleware('[auth]')で認証機能が付く
->controller(ContactFormController::class) //コントローラー指定。/部分
->name('contacts.')//名前付きルート
->group(function(){
    Route::get('/','index' )->name('index');  //getの後はurl。使うコントローラー指定、コントローラーの中のメソッド指定。
    Route::get('/create','create' )->name('create');//name（フォルダ名.ファイル名）でルート情報に名前を付ける。view側でリンク張るときに便利。
    Route::post('/','store')->name('store');//DBにデータ保存するのでpost
    Route::get('/{id}','show' )->name('show'); //108リンクをクリックしたらidを渡す
    Route::get('/{id}/edit','edit' )->name('edit');
    Route::post('/{id}','update' )->name('update');
    Route::post('/{id}/destroy','destroy')->name('destroy');
}
);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php'; //auth.phpにルートの情報入ってる
