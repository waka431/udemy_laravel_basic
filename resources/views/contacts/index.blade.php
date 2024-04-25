contacts.index
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           お問合せ一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    index<br>
                    <a href="{{ route('contacts.create') }}" class="text-blue-500">新規登録</a></dr><!--コンタクトフォルダのクリエイトファイルに飛ぶ-->
                    <!--120検索フォーム-->
                    <form class="mb-8" method="get" action="{{route('contacts.index')}}">
                        <input type="text" name="search" placeholder="検索"> <!--placeholder薄く表示する文字-->
                        <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">検索する</button>
                    </form>
                    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">id</font>
              </font>
            </th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">氏名</font>
              </font>
            </th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">件名</font>
              </font>
            </th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">登録日</font>
              </font>
            </th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">詳細</font>
              </font>
            </th>
          </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)     <!--107繰り返し-->                                          
           <tr>         
            <td class="px-4 py-3">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;"> {{ $contact->id }}</font>
              </font>
            </td>
            <td class="px-4 py-3">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">{{ $contact->name }}</font>
              </font>
            </td>
            <td class="px-4 py-3">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">{{ $contact->title }}</font>
              </font>
            </td>
            <td class="px-4 py-3 text-lg text-gray-900">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">{{ $contact->created_at}}</font>
              </font>
            </td>
            <td class="px-4 py-3">
              <font style="vertical-align: inherit;">                                     
                <font style="vertical-align: inherit;"><a class="text-blue-500" href="{{route('contacts.show',['id'=>$contact->id])}}">詳細を見る</a></font>
              </font>                                             <!--108　パラメータを第二引数として渡す-->
            </td>
            @endforeach    <!--繰り返終了-->
            </tr>
                </div>
            </div>
        </div>
        {{ $contacts->links() }} <!--118ぺージネーション。$contactsがコントローラーからわたる-->
    </div>
</x-app-layout>
