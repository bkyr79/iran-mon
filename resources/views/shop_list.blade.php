<p>ショップ一覧</p>
@foreach($shop_owner_id as $one_id)
    <form action="/shop" method="post">
    @csrf
    <input type="submit" value="{{ $one_id->name }}さんのショップ">
    <input type="hidden" name="owner_id" value="{{ $one_id->id }}">
    <input type="hidden" name="owner_name" value="{{ $one_id->name }}">
    </form>
@endforeach