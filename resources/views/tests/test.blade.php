test<br>

@foreach($values as $value)
{{ $value->id }}<br> //{{}}マスダッシュ、口ひげは、XSS攻撃を防ぐためにhtmlspecialchars関数を通して自動的に送信
{{ $value->text }}<br> //@スタートはディレクティブ、view側の構文

@endforeach