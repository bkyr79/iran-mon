<style type="text/css">
.submit_visible {visibility: visible;}
/* .submit_visible {visibility: hidden;} */
/* .submit_visible {background-color: #00ffff;font-weight: bold;} */

ul.header-dropmenu {
  list-style: none;
  width: 100%;
  height: 40px;
  margin: 0 auto;
  padding: 0;
  display: table;
  table-layout: fixed;
}
ul.header-dropmenu > li {
  position: relative;
  display: table-cell;
  vertical-align: middle;
  border: 1px solid #f8f8f8;
  background: #f8f8f8; /* 背景色*/
}
ul.header-dropmenu li a {
  display: block;
  text-align: center;
  line-height: 40px;
  font-weight: bold;
  text-decoration: none;
  font-size: 14px;
}
ul.header-dropmenu li ul {
  visibility: hidden;
  width: 100%;
  list-style: none;
  position: absolute;
  top: 100%;
  left: -1px;
  margin: 0;
  padding: 0;
  border: 1px solid #222; /* マウスオーバー時の枠線 */
  border-top: none;
}
ul.header-dropmenu li:hover ul {
  visibility: visible;
}
ul.header-dropmenu li ul li {
  background: #fff;
  transition: all .2s ease;
}
ul.header-dropmenu > li:hover {
  background: #fff;
  border: 1px solid #222; /* マウスオーバー時の枠線 */
  border-bottom: none;
}
ul.header-dropmenu li:hover ul li:hover {
  background: #f8f8f8;
}
</style>

<!-- Bootstrap導入 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!-- Bootstrap Javascript(jQuery含む) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- ユーザー名を表示 -->
<div style="text-align:right; padding-top:5px; padding-right:9px; color:gray;">{{ Auth::user()->name }}さんがログイン中</div>
<p>{{ Auth::user()->name }}さんのマイページ</p>
<ul class="header-dropmenu">
  <li>
    <a href="#">メニュー</a>
    <ul>
      <li><a href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">ログアウト</a></li>
      <li><a href="{{ url('/shoplist') }}">ショップ一覧へ</a></li>
      <li><a href="{{ route('upload_form') }}">Upload</a></li>
      <li><a href="{{ route('delete_list') }}">Delete</a></li>
    </ul>
  </li>
</ul>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<hr style="margin-top:0px;"/>

<div style="text-align:center;">
@foreach($images as $image)
<div type="button" class="delete-confirm btn btn-success" value="A001" data-toggle="modal" data-target="#confirm-delete" style="width: 18rem; margin: 16px; height: 290px;">
  <form action="/itemlist" name="sampleform" method="post" onsubmit="return func1()">
  @csrf
  <button type="submit" style="width: 100%; display: inline-block; padding: 0px; border: 0px;">
    <img src="{{ Storage::url($image->file_path) }}" style="width: 100%; height: 246px;"/>
  </button>
  <input type="text" class="goods_name" name="goods_name" value="{{ $image->name }}" style="display:block; margin:auto; text-align:center; border:#28a745; background-color:#28a745; font-weight:bold;">
  <input type="hidden" name="id" value="{{ $image->id }}">
  </form>
</div>
@endforeach
</div>
<div style="float:left;">{{ $images->links() }}</div>

<script>
jQuery(function($){
    $('.goods_name').click(function(){
        //classでonを持っているかチェック
        if(!$(this).hasClass('on')){
            //編集可能時はclassでonをつける
            $(this).addClass('on');
            var txt = $(this).text();
            //テキストをinputのvalueに入れてで置き換え
            $(this).html('<input type="text" value="'+txt+'" />');
            //同時にinputにフォーカスをする
            $('.goods_name > input').focus().blur(function(){
                var inputVal = $(this).val();
                //もし空欄だったら空欄にする前の内容に戻す
                if(inputVal===''){
                    inputVal = this.defaultValue;
                };
                //編集が終わったらtextで置き換える
                $(this).parent().removeClass('on').text(inputVal);                
            });
        };

    });
});
</script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!-- <script>
  // 商品名変更のため
  // ループ内の要素をすべて書き換える場合 → [参考]https://web-dragon.com/coding/js-for/
  var greet = document.getElementsByClassName("file_name")
  for(var i = 0; i < greet.length; i++){
    greet[i].innerHTML = "<p>すべて変更しちゃいます〜</p>"
  }
</script> -->