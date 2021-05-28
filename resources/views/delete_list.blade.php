<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<p>{{ Auth::user()->name }}さんの削除ページ</p>
<p><a href="{{ route('upload_form') }}">url</a></p>
<p><button type="submit" form="delete_form">削除する</button></p>

<!-- ↓formタグはループの外に記述する -->
<form action="/delete" id="delete_form" method="post">

<div style="text-align:center;">
@foreach($images as $image)
<div class="delete-confirm btn btn-success" value="A001" data-toggle="modal" data-target="#confirm-delete" style="width: 18rem; margin: 16px; height: 290px;">
  @csrf
  <input type="checkbox" name="del_checks[]" value="{{ $image->id }}">
  <button style="width: 100%; display: inline-block;">
    <img src="{{ Storage::url($image->file_path) }}" style="width: 100%; height: 246px;"/>
  </button>
  <p class="goods_name" style="display:block; margin:auto; text-align:center; border:#28a745; background-color:#28a745; font-weight:bold;"><span style="color:black;">{{ $image->name }}</span></p>
</div>
@endforeach
</div>

</form>
