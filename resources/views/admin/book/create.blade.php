<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>book register</title>
    </head>

    <body>
        <main>
            <h1>book register</h1>
            <form action="/books" method="POST">
                @csrf
                <div>
                    <label>category</label>
                    <select name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">
                                {{$category->title}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>title</label>
                    <input type="text" name="title">
                </div>
                <div>
                    <label>price</label>
                    <input type="text" name="price">
                </div>
                <input type="submit" value="送信">
            </form>
        </main>
    </body>
</html>