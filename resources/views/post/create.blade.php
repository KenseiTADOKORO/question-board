<form action="{{ action('PostsController@create') }}" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    {{ csrf_field() }}
    <input type="submit" value="アップロード">
</form>