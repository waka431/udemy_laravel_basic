<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactForm;
use App\Services\CheckFormService;
use App\Http\Requests\StoreContactRequest;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$contacts=Contactform::select('id','name','title','created_at')//107エロクアントで取得
        //->get();//getでコレクション型にする

        //ページネーション対応
       // $contacts=Contactform::select('id','name','title','created_at')//107エロクアントで表示するデータ取得
        //->paginate(20); //$contactsでview側にわたる。paginete(表示したい件数)

       //検索対応
       $search = $request->search; //119 sesrchはindex.blade.phpのname。入ってくるキーワード取得
       $query = ContactForm::search($search); //120 ContactForm.phpのfunction scopeSearchメソッド。scopeを取って使うここでの$searchにはwhereがくっついている
       
      $contacts = $query->select('id','name','title','created_at')//DBのオブジェクトkueriORマッピング
       ->paginate(20); 
       
        return view('contacts.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');//フォルダ名.ファイル名
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    //114 StoreContactRequestバリデーション 
    //Requestクラスを外側でインスタンス化したものが入ってくる。Requestクラスでフォーム登録する。
    //リクエスト来た全ての情報をPOSTに設定。$requestにフォームに入力した情報をリクエストクラスに持っていてそれを見るだけで情報が分かる
        {
        //dd($request,$request->name); //フォームに入力した情報が入っている。$request->nameでフォームのネーム属性の値が取れる
   

        ContactForm::create([    //106バリデーションをかけたあとに保存。ContactFormモデルcreateメソッド
            'name' => $request->name, //フォームのネーム属性=>value
            'title' => $request->title,
            'email' => $request->email,
            'url' => $request->url,
            'gender' => $request->gender,
            'age' => $request->age,
            'contact' => $request->contact,
        ]);
            
        return to_route('contacts.index'); //106 to_routeでリダイレクトかけられる
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id 　　　//idの変数？
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $contact=ContactForm::find($id); //108find エロクアントコレクション

     $gender = CheckFormService::checkGender($contact);

      $age = CheckFormService::checkAge($contact);
      
    return view('contacts.show',
    compact('contact','gender','age')); //contactは$contact
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //編集
    {
        $contact=ContactForm::find($id);
    
     return view('contacts.edit',compact('contact'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact=ContactForm::find($id);  
        $contact->name=$request->name;   //111 $contactがDBの情報、$requestがformに入力した情報
        $contact->title=$request->title;
        $contact->email=$request->email;
        $contact->url=$request->url;
        $contact->gender=$request->gender;
        $contact->age=$request->age;
        $contact->contact=$request->contact;
        $contact->save(); //保存

        return to_route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact=ContactForm::find($id);
        $contact->delete(); //112　削除処理

        return to_route('contacts.index');
    }
}
