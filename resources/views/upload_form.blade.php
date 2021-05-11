@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form
  method="post"
  action="{{ route('upload_image') }}"
  enctype="multipart/form-data"
>
  @csrf
  <input type="file" name="file_path" accept="image/png, image/jpeg" onchange="previewImage(this);">
  <p sytle="display:inlin-block;"><label for="">商品名：</label><input type="text" name="goods_name"></p>
  <p sytle="display:inlin-block;"><label for="">価格：</label><input type="text" name="goods_price"></p>
  <input type="submit" value="登録">
</form>
<p>
Preview:<br>
<img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="width: 246px; height: 246px;">
</p>

<!-- プレビュー画像を表示させる -->
<script>
function previewImage(obj)
{
	var fileReader = new FileReader();
	fileReader.onload = (function() {
		document.getElementById('preview').src = fileReader.result;
	});
	fileReader.readAsDataURL(obj.files[0]);
}
</script>