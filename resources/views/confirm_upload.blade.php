<!-- @if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<img src="{{ Storage::url($upload_image) }}" style="width: 246px; height: 246px;">

<form
  method="post"
  action="/register_goods"
  enctype="multipart/form-data"
>
  @csrf
  <input type="submit" value="登録">
</form> -->